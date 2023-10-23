<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ControllerTrait;
use Illuminate\Http\Request;

class UsersController extends CustomBaseController
{
    //
    use ControllerTrait;
    public function users_search(Request $request): mixed
    {
        $user = $this->getUser();
        if ($user->user_type != 1) {
            return [];
        }
        $params = $request->validate([
            'email' => 'nullable|string',
            'perPage' => 'nullable',
            'curPage' => 'nullable',
        ]);
        return User::ifWhereLike($params, 'email')
            ->where('user_type', 0)
            ->paginate($this->perPage());
    }
}
