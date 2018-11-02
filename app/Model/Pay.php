<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    //
    protected $table = 'pay';

    protected $fillable = [
		'user_id','state','stime'
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
