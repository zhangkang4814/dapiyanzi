<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderInfo extends Model
{
    protected $table = "order_info";

    protected $fillable = ['conf_id','num', 'month', 'order_id',];

    public $timestamps = false;
}
