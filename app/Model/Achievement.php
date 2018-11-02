<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    //
    protected $table = 'achievement';

    protected $fillable = [
        'user_id','price','auth','sqsj_time','settime','proportions','state'
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
