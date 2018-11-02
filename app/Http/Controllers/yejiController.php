<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

//当前业绩
class yejiController extends Controller
{
    public function index(){
    	$uid=session('userinfo')->id;

        //当前所有业绩综合
    	$yeji=DB::table("pay")->rightjoin("user","pay.user_id","=","id")
    			->select(DB::raw('id,user_id,sum(num*price) as price,starttime,num,customer_id,name,confid,auth,find,proportions,state'))
    			->where('state','=','0')
    			->groupBy('user_id')
    			->Where(function ($query)use($uid) {
            		$query->where('father','=',$uid)
                  	->orwhere('user_id', '=', $uid);
        		})
    			->get();
    		// dd($yeji);
    	//业绩表中没有总结的业绩
    	$ach=DB::table("achievement")->where("state","=","0")->get();

    	//查询出的所有业绩的价格
    	$countprice1=0;
    		foreach($yeji as $row){
    			$countprice1+=$row->price;
    		}
    	//业绩表中的钱的综合
    	$countprice2=0;
    		foreach($ach as $ye){
    			$countprice2+=$ye->price;
    		}

        //用户总额    
        $user=DB::table('user')->where('id','=',$uid)->first();
        // dd($user);
        $allxiaji=DB::table("achievement")->join("user","user_id","=","user.id")
                ->where('state','=','0')->where('father','=',$uid)
                ->select(DB::raw('sum(extract) as countextract'))
                ->first();
        if($user) {
             $all=($countprice1*$user->proportions)/100;
            // dd($all);

           
            // dd($allxiaji);

            $kena=$all-$allxiaji->countextract;
        }else {
            $kena = 0;
        }
       
        // dd($kena);
        // $ids=0;
        // $tas=DB::table("user")->join("settlement",'user.id','=','user_id')->where('state','=','0')
        //     ->where('father','=',$ids)
        //     ->get();
        //     dd($tas);
        // echo $all; 
        


    	$data=[];
    	//判断是否有没插入没结算的业绩数据库
    	if(count($yeji)!=count($ach) || $countprice1!=$countprice2){
    		DB::table("achievement")->where('state','=','0')->delete();
			foreach($yeji as $value){
				$data['user_id']=$value->user_id;
				$data['price']=$value->price;
				$data['auth']=$value->auth;
				$data['state']=0;
				$data['proportions']=$value->proportions;
                $data['extract']=($value->price*$row->proportions)/100;
				DB::table("achievement")->insert($data);
			}    		
    	}


    	//看是否结算完成
    	$path=DB::table('achievement')->join('user','user_id','=','user.id')
    			->Where(function ($query)use($uid) {
            		$query->where('father','=',$uid)
                  	->orwhere('user_id', '=', $uid);
        		})
                ->where('state','=','1')->get();
        // dd($path);

    	return view("yeji.index",['yeji'=>$yeji,'path'=>$path,'kena'=>$kena,'allxiaji'=>$allxiaji]);

    }

    //申请结算的业绩
    public function appli(){
    	//当前所有业绩综合
    	$appli=DB::table("achievement")->join('user','user.id','user_id')->where("state","=","1")->get();
    	// dd($appli);

    	return view('yeji.appli',['appli'=>$appli]);
    }

    //申请结算
    public function app(){
    	$uid=session('userinfo')->id;
    	// echo $id;
    	// 改变pay中的结算状态
    	$charu=DB::table("pay")->rightjoin("user","pay.user_id","=","id")
				->where('state','=','0')
                ->Where(function ($query)use($uid) {
                    $query->where('father','=',$uid)
                    ->orwhere('user_id', '=', $uid);
                })
    			->update(['state'=>1,'sqsj_time'=>time()]);
    	// dd($charu);
    // 	//改变业绩表状态
    	$app=DB::table("achievement")->where('state','=','0')->rightjoin("user","user_id","=","user.id")
                ->Where(function ($query)use($uid) {
                    $query->where('father','=',$uid)
                    ->orwhere('user_id', '=', $uid);
                })
            ->update(['state'=>1,'sqsj_time'=>time()]);
        
    	$jiesuan=DB::table('achievement')->rightjoin("user","user_id","=","user.id")
                ->Where(function ($query)use($uid) {
                    $query->where('father','=',$uid)
                     ->orwhere('user_id', '=', $uid);
                })
                ->where('state','=','1')->get();
            //所有业绩总和
            $countprice=0;
            foreach($jiesuan as $row){
                $countprice+=$row->price;
            }
            // echo $countprice;
            $user=DB::table('user')->where('id','=',$uid)->first();
            // dd($user);

            $path['user_id']=$user->id;
            $path['proportions']=$user->proportions;
            $path['price']=$countprice;
            $path['state']=0;
            $path['sqsj_time']=time();
            // dd($path);
            // 插入结算表中
            $jiesuan=DB::table("settlement")->insert($path);

    	// dd($app);
        // dd($jiesuan);
    	if($app && $charu && $jiesuan){
    		return redirect("/yeji")->with('success',"申请结算成功");
    	}else{
            return redirect("/yeji")->with('success',"申请结算失败");

        }
    }


    //个人当前业绩
    public function select($id){
    	// echo $id;
    	$yeji=DB::table("pay")->rightjoin("user","pay.user_id","=","id")
    			->where('id','=',$id)->where('state','=','0')->get();
    			// dd($yeji);
    	return view("yeji.yeji",['yeji'=>$yeji]);
    }



    //历史业绩
    public function lishiyeji(){
    	$uid=session('userinfo')->id;
    	$yeji=DB::table("achievement")->rightjoin("user","achievement.user_id","=","user.id")
    			->where('state','=','2')
    			->Where(function ($query)use($uid) {
            		$query->where('father','=',$uid)
                  	->orwhere('user_id', '=', $uid);
        		})
    			->orderBy('settime','desc')->get();
    	// dd($yeji);
    	return view('yeji.lishindex',['yeji'=>$yeji]);
    }


    //历史个人业绩
    public function lishigeren($id){
    	// echo $id;
    	$yeji=DB::table("pay")->rightjoin("user","pay.user_id","=","id")
    			->where('user.id','=',$id)->where('state','=','2')
    			->orderBy('stime','desc')->get();
    	// dd($yeji);
    	return view('yeji.lishigeren',['yeji'=>$yeji]);
    }

}
