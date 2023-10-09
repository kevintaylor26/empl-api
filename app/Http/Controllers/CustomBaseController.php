<?php

namespace App\Http\Controllers;
use App\Helpers\IpHelper;
use App\Models\IpLogs;
use App\Models\User;
use Exception;
class CustomBaseController extends Controller
{
    protected ?User $user = null;

    /**
     * @return Users|null
     * @throws Err
     */
    public function getUser(): ?User
    {
        if (!$this->user) {
            $user = auth()->user();
            if (get_class($user) != User::class)
                throw new Exception(__("User not login"), 10000);
            $this->user = $user;
        }
        return $this->user;
    }

    public function checkIpAddrValidation(string $method): void
    {
        $user = auth()->user();
        $ipAddr = IpHelper::GetIP();
        logger("$ipAddr is Searching Data");
        if (!$user) {
            $ipLog = IpLogs::where('ip_address', $ipAddr)
                ->where('method', $method)
                ->first();
            if(!$ipLog) {
                $ipLog = IpLogs::create([
                    'ip_address' => $ipAddr,
                    'method' => $method
                ]);
            }
            if($ipLog->try_num >= 500) {
                throw new Exception('You have tried limited times, Please try after login', 10008);
            }
            $ipLog->try_num += 1;
            $ipLog->save();
        } else {
            $ipLog = IpLogs::where('method', $method)
                ->where('users_id', $user->id)
                ->first();
            if(!$ipLog) {
                $ipLog = IpLogs::create([
                    'ip_address' => $ipAddr,
                    'method' => $method
                ]);
            }
            $ipLog->try_num += 1;
            $ipLog->save();
        }
    }
}
