<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BbinPayOnline;


class ApiController extends Controller
{

    /**
     * bbin线上支付记录
     */
    public function addOnlinePay(Request $request)
    {
        $result = ['msg' => 'failed'];
        $sOrders   = $request->input('jsonData') ?? '';

        if (!empty($sOrders))
        {
            $aOrders = array_reverse(json_decode($sOrders, true));
            foreach ($aOrders as $key => $val)
            {
                /**
                 *   Array
                    (
                        [0] => 201903221360520112
                        [1] => -
                        [2] => qyk688688
                        [3] => 人民币
                        [4] => 单笔1万
                        [5] => 2019-03-22 00:00:42
                        [6] => 人民币
                        [7] => 二维支付
                        [8] => 5000
                        [9] => 5000
                        [10] => 1
                        [11] => 迅捷付 (迅捷（5568）)
                        [12] =>
                        [13] =>
                        [14] =>
                    )
                 */

                $str = explode(' ', $val[11]);
                $oOrders = BbinPayOnline::firstOrCreate(['order_no' => $val[0]], [
                    'account'    => $val[2],
                    'currency'   => $val[3],
                    'level'      => $val[4],
                    'time'       => $val[5],
                    'pay_way'    => $val[7],
                    'amount'     => $val[8],
                    'real_amount'=> $val[9],
                    'status'     => $val[10],
                    'platform'   => $str[0],
                    'remark'     => $val[11],
                ]);
                $result = ['msg' => 'success' ];
            }
        }
        return response()->json($result);
    }

}
