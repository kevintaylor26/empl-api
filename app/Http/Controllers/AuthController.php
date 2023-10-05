<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CustomBaseController;
use App\Models\Marketings;
use App\Models\Users;
use App\Traits\ControllerTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class AuthController extends CustomBaseController
{

    use ControllerTrait;
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
            'password' => 'required'
        ]);
        $user = Users::ifWhere($params, 'email')
            ->first();
        if (!$user || !Hash::check($params['password'], $user->password)) {
            throw new Exception("Account or password error");
        }
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
        $user = Users::ifWhere($params, 'email')->first();
        if ($user)
            throw new Exception("Email already exists");
        $user = Users::create([
            'email' => $params['email'],#
            'password' => bcrypt($params['password']),
        ]);
        if (!$user || !Hash::check($params['password'], $user->password)) {
            throw new Exception("Account or password error");
        }
        $user->tokens()->where('name', 'customer')->delete();
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


}
