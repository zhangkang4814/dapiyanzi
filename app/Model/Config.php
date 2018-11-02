<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Config extends Model
{
    use Notifiable;

    protected $table = "config";
    //cpu memory内存 disk硬盘 system操作系统 video_card图形处理化（显卡） 
    protected $fillable = ['cpu', 'memory', 'disk', 'system', 'video_card', 'price',];

    public $timestamps = false;
}
