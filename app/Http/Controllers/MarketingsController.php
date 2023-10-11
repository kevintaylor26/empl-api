<?php

namespace App\Http\Controllers;

use App\Helpers\IpHelper;
use App\Http\Controllers\CustomBaseController;
use App\Models\IpLogs;
use App\Models\Marketings;
use App\Traits\ControllerTrait;
use Exception;
use Generator;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\Facades\FastExcel;

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
            ->get();
            // ->paginate($this->perPage());
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

    private function getQuery(array $params, bool $isFree): mixed
    {
        if(!$params['criteria'])
            return Marketings::where('id', '<', '0');
        if ($isFree)
            return Marketings::whereLike($params['criteria'], 'first_name')
                ->orWhereLike($params['criteria'], 'last_name')
                ->orWhereLike($params['criteria'], 'email')
                ->orWhereLike($params['criteria'], 'title')
                ->orWhereLike($params['criteria'], 'company')
                ->orWhereLike($params['criteria'], 'domain')
                ->orWhereLike($params['criteria'], 'city')
                ->limit(5);
        else
            return Marketings::whereLike($params['criteria'], 'first_name')
                ->orWhereLike($params['criteria'], 'last_name')
                ->orWhereLike($params['criteria'], 'email')
                ->orWhereLike($params['criteria'], 'title')
                ->orWhereLike($params['criteria'], 'company')
                ->orWhereLike($params['criteria'], 'domain')
                ->orWhereLike($params['criteria'], 'city')
                ->order();
    }

    public function download(Request $request)
    {
        $criteria = $request->input('criteria') ?? '';
        $params = [
            'criteria' => $criteria
        ];
        $user = auth()->user();
        $query = $this->getQuery($params, !$user || !$user->is_paid);
        /**
         * @param $query
         * @return Generator
         */
        function dateGenerator($query): Generator
        {
            foreach ($query->lazy() as $item) {
                yield $item;
            }
        }

        $id = uniqid();
        return FastExcel::data(dateGenerator($query))->download("marketing_$id.xlsx", function ($item) {
            return [
                'id' => $item->id,
                'first_name' => $item->first_name ?? '-',
                'last_name' => $item->last_name ?? '-',
                'email' => $item->email ?? '-',
                'linkedin_url' => $item->linkedin_url ?? '-',
                'title' => $item->title ?? '-',
                'company' => $item->company ?? '-',
                'domain' => $item->domain ?? '-',
                'city' => $item->city ?? '-',
            ];
        });
    }


}
