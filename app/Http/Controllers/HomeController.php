<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\Mood;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class HomeController extends CustomBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function home()
    {
        $user = $this->getUser();
        $expired_days = 0;
        if($user && $user->is_paid == 1 && $user->last_paid_at) {
            $lastPaidAt = Carbon::parse($user->last_paid_at);
            if($lastPaidAt->addMonth() < now()) {
                $user->is_paid = 0;
                $user->save();
            } else {
                $expired_days = $lastPaidAt->diffInDays(now());
            }
        }
        return view('home', compact('expired_days'));
    }

}
