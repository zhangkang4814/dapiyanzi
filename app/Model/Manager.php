<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    protected $fillable = ['name'];

    protected $table = 'manager';

    public $timestamps = false;
}
