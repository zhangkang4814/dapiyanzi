<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{
    //
    protected $table = 'settlement';

    protected $fillable = [
		'sqsj_time','num','mid','proportions','price','state','countprice','user_id','settime','auth','extract'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public $timestamps = false;
}
