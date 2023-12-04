<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Log;

class UserBalanceModel extends BaseModel {
    use HasFactory;

    protected $table = 'users_balance';

    public $timestamp = false;

    public static function lastBalanceByUserId($userId) {
        $max = DB::raw("(SELECT MAX(id) AS id FROM users_balance WHERE users_id = $userId) AS max");
        return self::join($max, 'users_balance.id', '=', 'max.id')
            ->select('users_balance.*')
            ->first();
    }

    public static function balanceAnalyticByUserId($userId) {
        $joinMaxBalance = function (string $alias, int $month) use ($userId) {
            return "LEFT JOIN (
                                        SELECT
                                            u1.*
                                        FROM
                                            users_balance u1
                                            INNER JOIN ( SELECT MAX( id ) AS id, balance FROM users_balance GROUP BY users_id ) u2 ON u1.id = u2.id
                                        WHERE
                                            u1.users_id = '$userId'
                                            AND MONTH ( created_at ) = MONTH (now()) - $month
                    ) $alias ON u1.id = $alias.users_id";
        };

        $joinRevenue = function (string $alias, int $month) use ($userId) {
            return "LEFT JOIN (
                                SELECT
                                    users_id,
                                    SUM(revenue) as balance,
                                    DATE_ADD( reporting_period, INTERVAL 2 MONTH ) as created_at
                                FROM
                                    report_general
                                WHERE
                                    users_id = '$userId'
                                    AND MONTH (DATE_ADD( reporting_period, INTERVAL 2 MONTH )) = MONTH (now()) - $month
                                    # AND YEAR (DATE_ADD( reporting_period, INTERVAL 2 MONTH )) = YEAR (MONTH (now()) - $month)
                            ) $alias ON u1.id = $alias.users_id";
        };

        $sql = "SELECT
                    balance.balance as last_balance,
                    u4.balance as last_1_month_balance,
                    u5.balance as last_2_month_balance,
                    u6.balance as last_3_month_balance,
                    u7.balance as last_4_month_balance,
				    u8.balance as last_5_month_balance,
				    u9.balance as last_6_month_balance,
				    u10.balance as last_7_month_balance,
				    u11.balance as last_8_month_balance,
				    u12.balance as last_9_month_balance,
				    u13.balance as last_10_month_balance,
				    u14.balance as last_11_month_balance,
				    u15.balance as last_12_month_balance,

                    -- percentage
                    IFNULL(CAST(((u4.balance - u5.balance) / u5.balance) * 100 AS DECIMAL(12, 2)), 0.0) as last_1_month_percentage,
                    IFNULL(CAST(((u5.balance - u6.balance) / u6.balance) * 100 AS DECIMAL(12, 2)), 0.0) as last_2_month_percentage,
                    IFNULL(CAST(((u6.balance - u7.balance) / u7.balance) * 100 AS DECIMAL(12, 2)), 0.0) as last_3_month_percentage,
                    -- month name
                    MONTHNAME(IFNULL(u4.created_at, now() - INTERVAL 2 MONTH)) as last_1_monthname,
                    MONTHNAME(IFNULL(u5.created_at, now() - INTERVAL 3 MONTH)) as last_2_monthname,
                    MONTHNAME(IFNULL(u6.created_at, now() - INTERVAL 4 MONTH)) as last_3_monthname,

                    MONTHNAME(IFNULL(u7.created_at, now() - INTERVAL 5 MONTH)) as last_4_monthname,
					MONTHNAME(IFNULL(u8.created_at, now() - INTERVAL 6 MONTH)) as last_5_monthname,
					MONTHNAME(IFNULL(u9.created_at, now() - INTERVAL 7 MONTH)) as last_6_monthname,
					MONTHNAME(IFNULL(u10.created_at, now() - INTERVAL 8 MONTH)) as last_7_monthname,
					MONTHNAME(IFNULL(u11.created_at, now() - INTERVAL 9 MONTH)) as last_8_monthname,
					MONTHNAME(IFNULL(u12.created_at, now() - INTERVAL 10 MONTH)) as last_9_monthname,
					MONTHNAME(IFNULL(u13.created_at, now() - INTERVAL 11 MONTH)) as last_10_monthname,
					MONTHNAME(IFNULL(u14.created_at, now() - INTERVAL 12 MONTH)) as last_11_monthname,
					MONTHNAME(IFNULL(u15.created_at, now() - INTERVAL 13 MONTH)) as last_12_monthname,

                    YEAR(IFNULL(u4.created_at, now() - INTERVAL 2 MONTH)) as last_1_year,
                    YEAR(IFNULL(u5.created_at, now() - INTERVAL 3 MONTH)) as last_2_year,
                    YEAR(IFNULL(u6.created_at, now() - INTERVAL 4 MONTH)) as last_3_year,
                    YEAR(IFNULL(u7.created_at, now() - INTERVAL 5 MONTH)) as last_4_year,
                    YEAR(IFNULL(u8.created_at, now() - INTERVAL 6 MONTH)) as last_5_year,
                    YEAR(IFNULL(u9.created_at, now() - INTERVAL 7 MONTH)) as last_6_year,
                    YEAR(IFNULL(u10.created_at, now() - INTERVAL 8 MONTH)) as last_7_year,
                    YEAR(IFNULL(u11.created_at, now() - INTERVAL 9 MONTH)) as last_8_year,
                    YEAR(IFNULL(u12.created_at, now() - INTERVAL 10 MONTH)) as last_9_year,
                    YEAR(IFNULL(u13.created_at, now() - INTERVAL 11 MONTH)) as last_10_year,
                    YEAR(IFNULL(u14.created_at, now() - INTERVAL 12 MONTH)) as last_11_year,
                    YEAR(IFNULL(u15.created_at, now() - INTERVAL 13 MONTH)) as last_12_year,
                    -- info
                    CASE
                        WHEN u4.balance IS NOT NULL AND u5.balance IS NOT NULL THEN
                            IF(u4.balance > u5.balance, 'Increase', 'Decrease')
                        ELSE
                            'Static'
                    end as info_last_1_month,

                    CASE
                        WHEN u5.balance IS NOT NULL AND u6.balance IS NOT NULL THEN
                            IF(u5.balance > u6.balance, 'Increase', 'Decrease')
                        ELSE
                            'Static'
                    end as info_last_2_month,

                    CASE
                        WHEN u6.balance IS NOT NULL AND u7.balance IS NOT NULL THEN
                            IF(u6.balance > u7.balance, 'Increase', 'Decrease')
                        ELSE
                            'Static'
                    end as info_last_3_month
                FROM
                    users u1
                    LEFT JOIN (
                                        SELECT
                                            u1.*
                                        FROM
                                            users_balance u1
                                            INNER JOIN ( SELECT MAX( id ) AS id, balance FROM users_balance GROUP BY users_id ) u2 ON u1.id = u2.id
                                        WHERE
                                            u1.users_id = '$userId'
                    ) balance ON u1.id = balance.users_id
                    " . $joinRevenue('u3', 1) . "

                    # calculation was start here, it's will calculate 12 month
                    " . $joinRevenue('u4', 2) . "
                    " . $joinRevenue('u5', 3) . "
                    " . $joinRevenue('u6', 4) . "
                    " . $joinRevenue('u7', 5) . "
                    " . $joinRevenue('u8', 6) . "
                    " . $joinRevenue('u9', 7) . "
                    " . $joinRevenue('u10', 8) . "
                    " . $joinRevenue('u11', 9) . "
                    " . $joinRevenue('u12', 10) . "
                    " . $joinRevenue('u13', 11) . "
                    " . $joinRevenue('u14', 12) . "
                    " . $joinRevenue('u15', 13) . "
                WHERE
                    u1.id = '$userId'";
        //Log::warning($sql);
        $query = DB::select($sql);
        if (count($query) > 0) {
            return $query[0];
        }

        return [];
    }

    public static function addRevenue($userId, $revenue) {
        $userData = UserModel::where('id', $userId)->first();
        Log::warning($userData);

        if (!empty($userData)) {
            $lastBalanceUserData = UserBalanceModel::lastBalanceByUserId($userId);
            $lastBalanceUser = 0;
            if (!empty($lastBalanceUserData)) {
                $lastBalanceUser = $lastBalanceUserData->balance;
            }

            UserBalanceModel::query()
                ->insert([
                    'users_id' => $userId,
                    'kredit' => 0.0,
                    'debit' => (float) $revenue,
                    'balance' => (float) $lastBalanceUser + (float) $revenue,
                    'keterangan' => 'revenue',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
        }
    }
}
