<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SessionKeyModel;
use App\Models\UserBalanceModel;
use App\Models\WithdrawModel;

class DashboardController extends Controller {
    public $userSession;

    public function __construct() {
        parent::__construct();

        $this->userSession = session()->get(SessionKeyModel::USER_LOGIN);
    }

    public function index() {
        $wd1Total = 0;
        $wd2Total = 0;
        $wd3Total = 0;

        $wd1Percentage = 0;
        $wd2Percentage = 0;
        $wd3Percentage = 0;

        $wd1MonthName = '';
        $wd2MonthName = '';
        $wd3MonthName = '';

        if ($this->userSession->tipe_user === 'user') {
            $balance = UserBalanceModel::balanceAnalyticByUserId($this->userSession->id);
            $lastBalance = !empty($balance) ? format_usd($balance->last_balance) : 0;

            $lastBalance1Month = !empty($balance) ? format_usd($balance->last_1_month_balance) : 0;
            $lastBalance2Month = !empty($balance) ? format_usd($balance->last_2_month_balance) : 0;
            $lastBalance3Month = !empty($balance) ? format_usd($balance->last_3_month_balance) : 0;
            $lastBalance4Month = !empty($balance) ? format_usd($balance->last_4_month_balance) : 0;
            $lastBalance5Month = !empty($balance) ? format_usd($balance->last_5_month_balance) : 0;
            $lastBalance6Month = !empty($balance) ? format_usd($balance->last_6_month_balance) : 0;
            $lastBalance7Month = !empty($balance) ? format_usd($balance->last_7_month_balance) : 0;
            $lastBalance8Month = !empty($balance) ? format_usd($balance->last_8_month_balance) : 0;
            $lastBalance9Month = !empty($balance) ? format_usd($balance->last_9_month_balance) : 0;
            $lastBalance10Month = !empty($balance) ? format_usd($balance->last_10_month_balance) : 0;
            $lastBalance11Month = !empty($balance) ? format_usd($balance->last_11_month_balance) : 0;
            $lastBalance12Month = !empty($balance) ? format_usd($balance->last_12_month_balance) : 0;

            $lastBalancePercentage = !empty($balance) ? $balance->last_1_month_percentage : 0;
            $lastBalance1MonthPercentage = !empty($balance) ? $balance->last_2_month_percentage : 0;
            $lastBalance2MonthPercentage = !empty($balance) ? $balance->last_3_month_percentage : 0;

            $lastMonthName = !empty($balance) ? $balance->last_1_monthname : '';
            $last1MonthName = !empty($balance) ? $balance->last_2_monthname : '';
            $last2MonthName = !empty($balance) ? $balance->last_3_monthname : '';
            $last3MonthName = !empty($balance) ? $balance->last_4_monthname : '';
            $last4MonthName = !empty($balance) ? $balance->last_5_monthname : '';
            $last5MonthName = !empty($balance) ? $balance->last_6_monthname : '';
            $last6MonthName = !empty($balance) ? $balance->last_7_monthname : '';
            $last7MonthName = !empty($balance) ? $balance->last_8_monthname : '';
            $last8MonthName = !empty($balance) ? $balance->last_9_monthname : '';
            $last9MonthName = !empty($balance) ? $balance->last_10_monthname : '';
            $last10MonthName = !empty($balance) ? $balance->last_11_monthname : '';
            $last11MonthName = !empty($balance) ? $balance->last_12_monthname : '';
            $last12MonthName = !empty($balance) ? $balance->last_12_monthname : '';

            $infoLastMonth = !empty($balance) ? $balance->info_last_1_month : '';
            $info1LastMonth = !empty($balance) ? $balance->info_last_2_month : '';
            $info2LastMonth = !empty($balance) ? $balance->info_last_3_month : '';
        } else {
            $balance = WithdrawModel::monthlyDashboard();

            $lastBalance = !empty($balance) ? format_usd($balance->last_month_wd) : 0;

            $lastBalance1Month = !empty($balance) ? format_usd($balance->last_month_wd) : 0;
            $lastBalance2Month = !empty($balance) ? format_usd($balance->last_1_month_wd) : 0;
            $lastBalance3Month = !empty($balance) ? format_usd($balance->last_2_month_wd) : 0;
            $lastBalance4Month = !empty($balance) ? format_usd($balance->last_3_month_wd) : 0;
            $lastBalance5Month = !empty($balance) ? format_usd($balance->last_4_month_wd) : 0;
            $lastBalance6Month = !empty($balance) ? format_usd($balance->last_5_month_wd) : 0;
            $lastBalance7Month = !empty($balance) ? format_usd($balance->last_6_month_wd) : 0;
            $lastBalance8Month = !empty($balance) ? format_usd($balance->last_7_month_wd) : 0;
            $lastBalance9Month = !empty($balance) ? format_usd($balance->last_8_month_wd) : 0;
            $lastBalance10Month = !empty($balance) ? format_usd($balance->last_9_month_wd) : 0;
            $lastBalance11Month = !empty($balance) ? format_usd($balance->last_10_month_wd) : 0;
            $lastBalance12Month = !empty($balance) ? format_usd($balance->last_11_month_wd) : 0;

            $lastBalancePercentage = !empty($balance) ? $balance->last_month_percentage : 0;
            $lastBalance1MonthPercentage = !empty($balance) ? $balance->last_1_month_percentage : 0;
            $lastBalance2MonthPercentage = !empty($balance) ? $balance->last_2_month_percentage : 0;

            $lastMonthName = !empty($balance) ? $balance->last_month_name : '';
            $last1MonthName = !empty($balance) ? $balance->last_1_month_name : '';
            $last2MonthName = !empty($balance) ? $balance->last_2_month_name : '';
            $last3MonthName = !empty($balance) ? $balance->last_3_month_name : '';
            $last4MonthName = !empty($balance) ? $balance->last_4_month_name : '';
            $last5MonthName = !empty($balance) ? $balance->last_5_month_name : '';
            $last6MonthName = !empty($balance) ? $balance->last_6_month_name : '';
            $last7MonthName = !empty($balance) ? $balance->last_7_month_name : '';
            $last8MonthName = !empty($balance) ? $balance->last_8_month_name : '';
            $last9MonthName = !empty($balance) ? $balance->last_9_month_name : '';
            $last10MonthName = !empty($balance) ? $balance->last_10_month_name : '';
            $last11MonthName = !empty($balance) ? $balance->last_11_month_name : '';
            $last12MonthName = !empty($balance) ? $balance->last_12_month_name : '';

            $infoLastMonth = !empty($balance) ? $balance->info_last_month : '';
            $info1LastMonth = !empty($balance) ? $balance->info_last_1_month : '';
            $info2LastMonth = !empty($balance) ? $balance->info_last_2_month : '';


            $wd1Total = !empty($balance) ? format_usd($balance->last_1_month_wd) : 0;
            $wd2Total = !empty($balance) ? format_usd($balance->last_2_month_wd) : 0;
            $wd3Total = !empty($balance) ? format_usd($balance->last_3_month_wd) : 0;

            $wd1MonthName = !empty($balance) ? $balance->last_1_month_name : '';
            $wd2MonthName = !empty($balance) ? $balance->last_2_month_name : '';
            $wd3MonthName = !empty($balance) ? $balance->last_3_month_name : '';

            $wd1Percentage = !empty($balance) ? $balance->last_month_percentage : 0;
            $wd2Percentage = !empty($balance) ? $balance->last_1_month_percentage : 0;
            $wd3Percentage = !empty($balance) ? $balance->last_2_month_percentage : 0;
        }


        $data = compact(
            'lastBalance',

            'lastBalance1Month',
            'lastBalance2Month',
            'lastBalance3Month',
            'lastBalance4Month',
            'lastBalance5Month',
            'lastBalance6Month',
            'lastBalance7Month',
            'lastBalance8Month',
            'lastBalance9Month',
            'lastBalance10Month',
            'lastBalance11Month',
            'lastBalance12Month',

            'lastBalancePercentage',
            'lastBalance1MonthPercentage',
            'lastBalance2MonthPercentage',

            'lastMonthName',
            'last1MonthName',
            'last2MonthName',
            'last3MonthName',
            'last4MonthName',
            'last5MonthName',
            'last6MonthName',
            'last7MonthName',
            'last8MonthName',
            'last9MonthName',
            'last10MonthName',
            'last11MonthName',
            'last12MonthName',

            'infoLastMonth',
            'info1LastMonth',
            'info2LastMonth',

            'wd1Total',
            'wd2Total',
            'wd3Total',

            'wd1MonthName',
            'wd2MonthName',
            'wd3MonthName',

            'wd1Percentage',
            'wd2Percentage',
            'wd3Percentage',
        );


        return view('backend.dashboard', $data);
    }
}
