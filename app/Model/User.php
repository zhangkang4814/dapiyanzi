<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['cop','id_card','name','phone','address','qq','bank_card','auth','father','find','proportions','area'];

    protected $table = 'user';

    public $timestamps = false;
    
    public static function getTree($param=[],$pid=0){
    	
    	if(empty($param)){
    		$param = self::get();
    	}

    	$tmp = [];

    	foreach ($param as $k => $v) {
    		
    		if($pid==$v->father){

    			$v->son = self::getTree($param,$v->id);

    			$tmp[$v->id] = $v;
    		}
    	}

    	return $tmp;
    }
}
