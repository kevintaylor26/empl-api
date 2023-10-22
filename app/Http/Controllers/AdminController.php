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

class AdminController extends CustomBaseController
{

    use ControllerTrait;
    public function admin_panel()
    {
        return view('admin.adminpanel');
    }

}
