<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function __construct()
    {
        // BBIN 后台美东时间
        date_default_timezone_set('America/New_York');
    }

    /**
     * 线上充值成功率
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        $aRes        = $labels2        = $labels        = [];
        $dataArr     = [];
        $failDataArr = [];
        $allDataArr  = [];
        //获取支付平台的充值记录
        $platforms = DB::table('bbin_pay_onlines')
            ->select(DB::raw('platform, count(*) as nums'))
            ->groupBy('platform')
            ->get();
        foreach ($platforms as $key => $one) {
            $labels[$one->platform] = $one->nums;
        }
        //获取支付平台成功的充值记录
        $platforms2 = DB::table('bbin_pay_onlines')
            ->select(DB::raw('platform, count(*) as nums'))
            ->where('status', 1)
            ->groupBy('platform')
            ->get();
        foreach ($platforms2 as $one2) {
            $labels2[$one2->platform] = $one2->nums;
        }
        foreach ($labels as $k => $v) {
            //只要平台有成功的记录
            if (key_exists($k, $labels2)) {
                $aRes[$k]        = 100 * round($labels2[$k] / $v, 2);
                $dataArr[$k]     = $labels2[$k];
                $failDataArr[$k] = $v - $labels2[$k];
            } else {
                $aRes[$k] = 0;
            }
        }
        foreach ($aRes as $key => $value) {
            if ($value == 0) {
                unset($aRes[$key]);
            }
        }
        foreach ($dataArr as $key1 => $value1) {
            if ($value1 == 0) {
                unset($dataArr[$key1]);
            }
        }
        arsort($aRes);
        $aData = [
            'labels'      => array_keys($aRes), //横坐标数据
            'data'        => array_values($aRes), //纵坐标数据
            'payData'     => $dataArr, // failDataArr
            'allDataArr'  => $labels, //
            'failDataArr' => $failDataArr, //
        ];
        return $content->header('线上充值成功率')
            ->row(view('admin.charts.bar', $aData));
    }

    /**
     * pullSyccessTable 获取成功数据
     */
    public function pullSyccessTable()
    {
        $date        = $_GET['date'];
        $labels      = [];
        $labels2     = [];
        $dataArr     = [];
        $failDataArr = [];
        $aRes        = [];
        if (strlen($date) == 2) {
            $dateDate  = date("Y-m-d H:i:s", strtotime("-" . $date . " min"));
            // echo $dateDate;die;
            $platforms = DB::table('bbin_pay_onlines')
                ->select(DB::raw('remark, count(*) as nums'))
                ->where('time', '>', $dateDate)
                ->groupBy('remark')
                ->get();

            $platforms2 = DB::table('bbin_pay_onlines')
                ->select(DB::raw('remark, count(*) as nums'))
                ->where('time', '>', $dateDate)
                ->where('status', 1)
                ->groupBy('remark')
                ->get();

        } elseif (strlen($date) == 1) {
            $dateDate = date("Y-m-d", strtotime("-" . $date . " day"));
            $dateDate .= '%';
            $platforms = DB::table('bbin_pay_onlines')
                ->select(DB::raw('remark, count(*) as nums'))
                ->where('time', 'like', $dateDate)
                ->groupBy('remark')
                ->get();
            $platforms2 = DB::table('bbin_pay_onlines')
                ->select(DB::raw('remark, count(*) as nums'))
                ->where('time', 'like', $dateDate)
                ->where('status', 1)
                ->groupBy('remark')
                ->get();
        }

        foreach ($platforms as $key => $one) {
            $labels[$one->remark] = $one->nums;
        }
        foreach ($platforms2 as $one2) {
            $labels2[$one2->remark] = $one2->nums;
        }
        foreach ($labels as $k => $v) {
            //只要平台有成功的记录
            if (key_exists($k, $labels2)) {
                $aRes[$k]        = 100 * round($labels2[$k] / $v, 2);
                $dataArr[$k]     = $labels2[$k];
                $failDataArr[$k] = $v - $labels2[$k];
            } else {
                $aRes[$k] = 0;
            }
        }
        foreach ($aRes as $key => $value) {
            if ($value == 0) {
                unset($aRes[$key]);
            }
        }

        $data = [
            'labels'      => array_keys($aRes), //横坐标数据
            'data'        => array_values($aRes), //纵坐标数据
            'payData'     => $dataArr, // failDataArr
            'allDataArr'  => $labels, //
            'failDataArr' => $failDataArr, //
        ];
        $datas = [
            'data'   => $data,
            'status' => 0,
        ];
        return $datas;
    }

    /**
     * paySuccessTable 实时充值成功率
     */
    public function paySuccessTable(Content $content)
    {
        return $content->header('实时充值成功率')
            ->row(view('admin.charts.table'));
    }

    /**
     * 入款成功笔数
     * @param Content $content
     * @return Content
     */
    public function allSuccessPay(Content $content)
    {

        return $content->header('入款成功笔数')
            ->row(view('admin.charts.line'));
    }

    /**
     * 入款成功笔数
     * @param $tag
     * @return Content
     */
    public function pullSuccessPay()
    {
        $client   = new Client();
        // print_r($client);die;
        $mins     = $_GET['mins'];
        $days     = $_GET['days'];
        $url      = config('url') . "?days=" . $days . "&mins=" . $mins;
        // echo $url;die;
        $response = $client->request('GET', $url);
        // print_r($response);die;
        if ($response->getStatusCode() == '200') {
            print_r($response->getBody()->getContents());die;
        }
    }

}
