<?php

namespace App\Http\Controllers;

use App\Helpers\IpHelper;
use App\Http\Controllers\CustomBaseController;
use App\Models\IpLogs;
use App\Models\Marketings;
use App\Traits\ControllerTrait;
use Exception;
use Illuminate\Http\Request;

class MarketingsController extends CustomBaseController
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
        $ipAddr = IpHelper::GetIP();
        $method = __FUNCTION__;
        logger("$ipAddr is Searching Data");
        $this->checkIpAddrValidation($method);

        $params = $request->validate([
            'criteria' => 'required|string',
            'perPage' => 'nullable',
            'curPage' => 'nullable',
        ]);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function free_search(Request $request)
    {
        $ipAddr = IpHelper::GetIP();
        $method = __FUNCTION__;
        logger("$ipAddr is Searching Data");
        $this->checkIpAddrValidation($method);

        $params = $request->validate([
            'criteria' => 'required|string',
            'perPage' => 'nullable',
            'curPage' => 'nullable',
        ]);
        $marketing = Marketings::whereLike($params['criteria'], 'first_name')
            ->orWhereLike($params['criteria'], 'last_name')
            ->orWhereLike($params['criteria'], 'email')
            ->orWhereLike($params['criteria'], 'title')
            ->orWhereLike($params['criteria'], 'company')
            ->orWhereLike($params['criteria'], 'domain')
            ->orWhereLike($params['criteria'], 'city')
            ->limit(5)->get();
        return $marketing;
    }
}
