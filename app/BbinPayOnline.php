<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BbinPayOnline extends Model
{
    protected $fillable = [
        'order_no',
        'account',
        'currency',
        'level',
        'time',
        'pay_way',
        'amount',
        'real_amount',
        'status',
        'platform',
        'remark',
    ];

}
