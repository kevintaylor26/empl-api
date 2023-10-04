<?php

namespace App\Http\Controllers;

use App\Models\Marketings;
use App\Traits\ControllerTrait;
use Illuminate\Http\Request;

class MarketingsController extends Controller
{

    use ControllerTrait;
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $params = $request->validate([
            'criteria' => 'required|string',
            'perPage' => 'nullable',
            'curPage' => 'nullable',
        ]);
        $perPage = $params['perPage'] ?? 20;
        $curPage = $params['curPage'] ?? 0;
        $marketing = Marketings::whereLike($params['criteria'], 'first_name')
            ->orWhereLike($params['criteria'], 'last_name')
            ->orWhereLike($params['criteria'], 'email')
            ->orWhereLike($params['criteria'], 'title')
            ->orWhereLike($params['criteria'], 'company')
            ->orWhereLike($params['criteria'], 'domain')
            ->orWhereLike($params['criteria'], 'city')
            ->paginate($this->perPage());
        return $marketing;
    }
}
