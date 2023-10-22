<?php

namespace App\Http\Controllers;

use App\Exceptions\Err;
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
    public function admin_search(Request $request)
    {
        $user = $this->getUser();
        if($user->user_type != 1) {
            return [];
        }
        $params = $request->validate([
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'email' => 'nullable|string',
            'title' => 'nullable|string',
            'company' => 'nullable|string',
            'domain' => 'nullable|string',
            'city' => 'nullable|string',
            'perPage' => 'nullable',
            'curPage' => 'nullable',
        ]);
        $marketing = Marketings::ifWhereLike($params, 'last_name')
            ->ifWhereLike($params, 'first_name')
            ->ifWhereLike($params, 'email')
            ->ifWhereLike($params, 'title')
            ->ifWhereLike($params, 'company')
            ->ifWhereLike($params, 'domain')
            ->ifWhereLike($params, 'city')
            ->get();
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

    private function getQuery(array $params, bool $isFree): mixed
    {
        if(!$params['criteria'])
            return Marketings::where('id', '<', '0');
        if ($isFree)
            return Marketings::whereLike($params['first_name'], 'first_name')
                ->orWhereLike($params['last_name'], 'last_name')
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


    private function getAdminQuery(array $params): mixed
    {
        return Marketings::whereLike($params['first_name'], 'first_name')
            ->orWhereLike($params['last_name'], 'last_name')
            ->orWhereLike($params['email'], 'email')
            ->orWhereLike($params['title'], 'title')
            ->orWhereLike($params['company'], 'company')
            ->orWhereLike($params['domain'], 'domain')
            ->orWhereLike($params['city'], 'city')
            ->order();
    }
    public function admin_download(Request $request)
    {
        $user = $this->getUser();
        if($user->user_type != 1) {
            Err::Throw('You are not allowed to download');
        }
        $params = [
            'first_name' => $request->input('first_name') ?? '',
            'last_name' => $request->input('last_name') ?? '',
            'email' => $request->input('email') ?? '',
            'title' => $request->input('title') ?? '',
            'company' => $request->input('company') ?? '',
            'domain' => $request->input('domain') ?? '',
            'city' => $request->input('city') ?? '',
        ];
        $user = auth()->user();
        $query = $this->getAdminQuery($params);
        /**
         * @param $query
         * @return Generator
         */
        function dataGenerator($query): Generator
        {
            foreach ($query->lazy() as $item) {
                yield $item;
            }
        }

        $id = uniqid();
        return FastExcel::data(dataGenerator($query))->download("marketing_$id.xlsx", function ($item) {
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
