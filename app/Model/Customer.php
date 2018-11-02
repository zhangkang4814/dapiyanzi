<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['user_id','cop','address','phone','custom_name','post','legal_person','legal_card','business_pic'];

    protected $table = 'customer';

    public $timestamps = false;
}
