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
}
