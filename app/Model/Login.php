<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    protected $fillable = ['username','password','role','uid'];

    protected $table = 'login';

    public $timestamps = false;
}
