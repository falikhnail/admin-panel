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
                                    reporting_period as created_at
                                FROM
                                    report_general
                                WHERE
                                    users_id = '$userId'
                                    AND MONTH (reporting_period) = MONTH (now()) - $month
                            ) $alias ON u1.id = $alias.users_id";
        };

        $sql = "SELECT
                    balance.balance as last_balance,
                    u3.balance as last_1_month_balance,
                    u4.balance as last_2_month_balance,
                    u5.balance as last_3_month_balance,
                    -- percentage
                    IFNULL(CAST(((u3.balance - u4.balance) / u4.balance) * 100 AS DECIMAL(12, 2)), 0.0) as last_1_month_percentage,
                    IFNULL(CAST(((u4.balance - u5.balance) / u5.balance) * 100 AS DECIMAL(12, 2)), 0.0) as last_2_month_percentage,
                    IFNULL(CAST(((u5.balance - u6.balance) / u6.balance) * 100 AS DECIMAL(12, 2)), 0.0) as last_3_month_percentage,
                    -- month name
                    MONTHNAME(IFNULL(u3.created_at, now() - INTERVAL 2 MONTH)) as last_1_monthname,
                    MONTHNAME(IFNULL(u4.created_at, now() - INTERVAL 3 MONTH)) as last_2_monthname,
                    MONTHNAME(IFNULL(u5.created_at, now() - INTERVAL 4 MONTH)) as last_3_monthname,
                    -- info
                    CASE
                        WHEN u3.balance IS NOT NULL AND u4.balance IS NOT NULL THEN
                            IF(u3.balance > u4.balance, 'Increase', 'Decrease')
                        ELSE
                            'Static'
                    end as info_last_1_month,

                    CASE
                        WHEN u4.balance IS NOT NULL AND u5.balance IS NOT NULL THEN
                            IF(u4.balance > u5.balance, 'Increase', 'Decrease')
                        ELSE
                            'Static'
                    end as info_last_2_month,

                    CASE
                        WHEN u5.balance IS NOT NULL AND u6.balance IS NOT NULL THEN
                            IF(u5.balance > u6.balance, 'Increase', 'Decrease')
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
                    " . $joinRevenue('u3', 2) . "
                    " . $joinRevenue('u4', 3) . "
                    " . $joinRevenue('u5', 4) . "
                    " . $joinRevenue('u6', 5) . "
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
