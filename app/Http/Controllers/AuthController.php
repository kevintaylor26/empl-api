<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CustomBaseController;
use App\Models\Marketings;
use App\Models\User;
use App\Models\Users;
use App\Traits\ControllerTrait;
use Exception;

use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends CustomBaseController
{

    use ControllerTrait;
    public function loginPage()
    {
        return view('auth.login');
    }

    public function signupPage()
    {
        return view('auth.register');
    }

    public function throttleKey(Request $request)
    {
        return Str::lower($request->input('user_id')) . '|' . $request->ip();
    }
    //
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $params = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'remember' => 'nullable',
        ]);
        $user = User::ifWhere($params, 'email')
            ->first();
        if (!$user || !Hash::check($params['password'], $user->password)) {
            throw new Exception("Account or password error");
        }
        if (!Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            RateLimiter::hit($this->throttleKey($request));

            throw new Exception(__('auth.failed'));
        }
        RateLimiter::clear($this->throttleKey($request));
        $user->tokens()->where('name', 'customer')->delete();
        return [
            'user' => $user,
            'token' => ['access_token' => $user->createToken('customer', ['customer'])->plainTextToken],
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function signup(Request $request)
    {
        $params = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::ifWhere($params, 'email')->first();
        if ($user)
            throw new Exception("Email already exists");
        $user = User::create([
            'email' => $params['email'],#
            'password' => bcrypt($params['password']),
        ]);
        if (!$user || !Hash::check($params['password'], $user->password)) {
            throw new Exception("Account or password error");
        }
        $user->tokens()->where('name', 'customer')->delete();

        if (!Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            RateLimiter::hit($this->throttleKey($request));

            throw new Exception(__('auth.failed'));
        }
        return [
            'user' => $user,
            'token' => ['access_token' => $user->createToken('customer', ['customer'])->plainTextToken],
        ];
    }

    public function autologin(Request $request)
    {
        $user = $this->getUser();
        // $user->last_login_at = now()->toDateTimeString();
        // $user->last_login_ip = IpHelper::GetIP();
        // $user->save();

        // Cache::tags([CacheTagsEnum::OnlineStatus->value])->put($user->id, true, 70);
        return $user->toArray();
    }

    public function signout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function changePassword(Request $request)
    {
        $params = $request->validate([
            'oldPassword' => 'required|string',
            'newPassword' => 'required|string'
        ]);
        $user = $this->getUser();
        if (!$user || !Hash::check($params['oldPassword'], $user->password)) {
            throw new Exception("Incorrect old password");
        }
        $user->password = bcrypt($params['newPassword']);
        $user->save();
    }

}
