<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SessionKeyModel;
use App\Models\UserBalanceModel;
use App\Models\WithdrawModel;

class DashboardController extends Controller
{
    public $userSession;

    public function __construct()
    {
        parent::__construct();

        $this->userSession = session()->get(SessionKeyModel::USER_LOGIN);
    }

    public function index()
    {
        if($this->userSession->tipe_user === 'user') {
            $balance = UserBalanceModel::balanceAnalyticByUserId($this->userSession->id);
            $lastBalance = !empty($balance) ? format_usd($balance->last_balance) : 0;
            $lastBalance1Month = !empty($balance) ? format_usd($balance->last_1_month_balance) : 0;
            $lastBalance2Month = !empty($balance) ? format_usd($balance->last_2_month_balance) : 0;
            $lastBalance3Month = !empty($balance) ? format_usd($balance->last_3_month_balance) : 0;

            $lastBalancePercentage = !empty($balance) ? $balance->last_month_percentage : 0;
            $lastBalance1MonthPercentage = !empty($balance) ? $balance->last_1_month_percentage : 0;
            $lastBalance2MonthPercentage = !empty($balance) ? $balance->last_2_month_percentage : 0;

            $lastMonthName = !empty($balance) ? $balance->last_monthname : '';
            $last1MonthName = !empty($balance) ? $balance->last_1_monthname : '';
            $last2MonthName = !empty($balance) ? $balance->last_2_monthname : '';

            $infoLastMonth = !empty($balance) ? $balance->info_last_month : '';
            $info1LastMonth = !empty($balance) ? $balance->info_last_1_month : '';
            $info2LastMonth = !empty($balance) ? $balance->info_last_2_month : '';
        } else {
            $balance = WithdrawModel::monthlyDashboard();

            $lastBalance = !empty($balance) ? format_usd($balance->last_month_wd) : 0;
            $lastBalance1Month = !empty($balance) ? format_usd($balance->last_1_month_wd) : 0;
            $lastBalance2Month = !empty($balance) ? format_usd($balance->last_2_month_wd) : 0;
            $lastBalance3Month = !empty($balance) ? format_usd($balance->last_3_month_wd) : 0;

            $lastBalancePercentage = !empty($balance) ? $balance->last_month_percentage : 0;
            $lastBalance1MonthPercentage = !empty($balance) ? $balance->last_1_month_percentage : 0;
            $lastBalance2MonthPercentage = !empty($balance) ? $balance->last_2_month_percentage : 0;

            $lastMonthName = !empty($balance) ? $balance->last_month_name : '';
            $last1MonthName = !empty($balance) ? $balance->last_1_month_name : '';
            $last2MonthName = !empty($balance) ? $balance->last_2_month_name : '';

            $infoLastMonth = !empty($balance) ? $balance->info_last_month : '';
            $info1LastMonth = !empty($balance) ? $balance->info_last_1_month : '';
            $info2LastMonth = !empty($balance) ? $balance->info_last_2_month : '';
        }


        $data = compact(
            'lastBalance',
            'lastBalance1Month',
            'lastBalance2Month',
            'lastBalance3Month',
            'lastBalancePercentage',
            'lastBalance1MonthPercentage',
            'lastBalance2MonthPercentage',
            'lastMonthName',
            'last1MonthName',
            'last2MonthName',
            'infoLastMonth',
            'info1LastMonth',
            'info2LastMonth'
        );


        return view('backend.dashboard', $data);
    }
}
