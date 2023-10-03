<?php

namespace App\Http\Controllers;

use App\Models\Marketings;
use Illuminate\Http\Request;

class MarketingsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $marketing = Marketings::all();
        return $marketing;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function topRates(Request $request)
    {
        $marketing = Marketings::where('title', 'like', '%CEO%')->limit(20)->inRandomOrder()->get();
        return $marketing;
    }
}
