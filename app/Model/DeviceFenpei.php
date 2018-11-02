<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DeviceFenpei extends Model
{
    protected $table = "device_fenpei";

    protected $fillable = ['custom_id','confid', 'num', 'time', 'op', 'order_name',];

    public $timestamps = false;
}
