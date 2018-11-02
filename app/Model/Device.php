<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Device extends Model
{
    use Notifiable;

    protected $table = "device";

    protected $fillable = ['mid', 'confid', 'mac', 'customid', 'manufacturer', 'batch', 'buytime', 'op', 'state', 'usestate', 'startime', 'expiretime',];

    public $timestamps = false;
}