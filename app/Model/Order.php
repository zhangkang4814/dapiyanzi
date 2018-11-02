<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "order";

    protected $fillable = ['sq_time','order_name', 'total', 'state', 'cust_id'];

    public $timestamps = false;
}
