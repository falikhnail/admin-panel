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
        $sql = "SELECT
                    balance.balance as last_balance,
                    u2.balance as last_1_month_balance,
                    u3.balance as last_2_month_balance,
                    u4.balance as last_3_month_balance,
                    -- percentage
                    IFNULL(CAST(((u2.balance - u3.balance) / u3.balance) * 100 AS DECIMAL(12, 2)), 0.0) as last_month_percentage,
                    IFNULL(CAST(((u3.balance - u4.balance) / u4.balance) * 100 AS DECIMAL(12, 2)), 0.0) as last_1_month_percentage,
                    IFNULL(CAST(((u4.balance - u5.balance) / u5.balance) * 100 AS DECIMAL(12, 2)), 0.0) as last_2_month_percentage,
                    -- month name
                    MONTHNAME(IFNULL(u2.created_at, now())) as last_monthname,
                    MONTHNAME(IFNULL(u3.created_at, now() - INTERVAL 1 MONTH)) as last_1_monthname,
                    MONTHNAME(IFNULL(u4.created_at, now() - INTERVAL 2 MONTH)) as last_2_monthname,
                    -- info
                    CASE
                        WHEN u2.balance IS NOT NULL AND u3.balance IS NOT NULL THEN
                            IF(u2.balance > u3.balance, 'Increase', 'Decrease')
                        ELSE
                            'Static'
                    end as info_last_month,

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
                    end as info_last_2_month
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
                    LEFT JOIN (
                                        SELECT
                                            SUM(IFNULL(u1.debit, 0)) as balance,
                                            u1.users_id,
                                            u1.created_at
                                        FROM
                                            users_balance u1
                                        WHERE
                                            u1.users_id = '$userId'
                                            AND MONTH ( created_at ) = MONTH (now())
                    ) u2 ON u1.id = u2.users_id
                    LEFT JOIN (
                                        SELECT
                                            SUM(IFNULL(u1.debit, 0)) as balance,
                                            u1.users_id,
                                            u1.created_at
                                        FROM
                                            users_balance u1
                                        WHERE
                                            users_id = '$userId'
                                            AND MONTH ( created_at ) = MONTH (now()) - 1
                    ) u3 on u1.id = u3.users_id
                    LEFT JOIN (
                                        SELECT
                                            SUM(IFNULL(u1.debit, 0)) as balance,
                                            u1.users_id,
                                            u1.created_at
                                        FROM
                                            users_balance u1
                                        WHERE
                                            users_id = '$userId'
                                            AND MONTH ( created_at ) = MONTH (now()) - 2
                    ) u4 on u1.id = u4.users_id
                    LEFT JOIN (
                                        SELECT
                                            SUM(IFNULL(u1.debit, 0)) as balance,
                                            u1.users_id,
                                            u1.created_at
                                        FROM
                                            users_balance u1
                                        WHERE
                                            users_id = '$userId'
                                            AND MONTH ( created_at ) = MONTH (now()) - 3
                    ) u5 on u1.id = u5.users_id
                WHERE
                    u1.id = '$userId'";
        \Log::warning($sql);
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
