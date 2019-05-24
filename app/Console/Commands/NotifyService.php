<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Ixudra\Curl\Facades\Curl;
use App\Sms;

class NotifyService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:sms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify sms callback';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /**
         *  {
         *     "id":111,
         *     "url":"http:/xxxxx/com",
         *     "data":{},
         *     "notifycount":0
         *  }
         */

        $message = Redis::lpop(Sms::SMS_LIST_KEY);

        //$message = '{"id":1,"url":"http://www.baidu.com","data":{"name":"111"},"notifycount":0}';
        if(!$message) {
            return;
        }

        Log::debug("Message: $message");

        $message = json_decode($message, true);

        $sms = Sms::where('id', $message['id'])->first();

        if(!$sms) {
            Log::debug("Sms not exists {$message['id']}");
            return;
        }

        if($sms->notifystatus == 1) {
            Log::debug("SMS:{$message['id']} already notified.");
        }

        $response = Curl::to($message['url'])->withData( $message['data'] )->returnResponseObject()->post();

        /**
         *
         * Response Structure
        {
        "content": "Message content here",
        "status": 200,
        "contentType": "content-type response header (ex: application/json)",
        "error": "Error message goes here (Only added if an error occurs)"
        }
         */

        if($response->status == 200) {
            // 回调通知成功
            Log::debug("SMS:{$message['id']} notify success");
            $sms->notifystatus = 1;
            $sms->save();
        }
        else {
            // 回调失败
            if($message['notifycount'] == 2) {
                $sms->notifystatus = 2;
                $sms->save();
                Log::debug("SMS:{$message['id']} notify failed");
            }
            else {
                $message['notifycount'] += 1;
                Log::debug("SMS:{$message['id']} notify retry {$message['notifycount']}");
                Redis::rpush(Sms::SMS_LIST_KEY, json_encode($message));
            }
        }



    }
}
