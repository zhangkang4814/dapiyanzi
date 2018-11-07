<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Login;
use App\Model\User;
use App\Model\Customer;
use App\Model\Manager;
use App\Model\Device;
use App\Model\Order;

class LoginController extends Controller
{	
	//返回一个登录界面
    public function login()
    {
    	return view('login');
    }

    //执行登录操作
    public function dologin(Request $request)
    {
    	//获取登录参数
    	$data = $request->all();
    	//对比数据库数据
    	$user = Login::where([
    		['username','=',$data['username']],
    		['password','=',md5($data['password'])],
    		])->first();

        if(!$user){
            return back()->withErrors(['账号或密码有误,请重试']);;
        }

        if($user->role==0){
            $userinfo = Manager::where('id',$user->uid)
                                ->first();
        }elseif($user->role>0){
            $userinfo = User::where('id',$user->uid)
                        ->first();            
        }else{
            $userinfo = Customer::where('cid',$user->uid)
                        ->first();
        }
        
    	if(empty($user)){
            
    		return redirect('/admin/login');

    	}else{
            $level = User::max('find');
            $level = substr_count($level,',');
            $arr = ['一','二','三','四','五','六','七','八','九','十'];
            $level = array_slice($arr,0,$level);
            session()->flash('success','登录成功');
            session(['level'=>$level]);
            session(['user' => $user]);
            session(['userinfo'=>$userinfo]);
            $id=session('userinfo')->cid; //存入的是user_id
            session()->put("cusid",$id);
            return redirect('/');    
            		
    	}
    }

    //跳转到主页
    public function index()
    {
        $devices = Device::all();
        foreach ($devices as $k => $v) {
            $time = (time() - $v->startime) / (24*60*60);
            if($time > 15 && $v->state != 0) {
                Device::where('mid',$v->mid)->update(['state'=>2]);
            }
        }
        $devices_num = count($devices);
        $order_num = count(Order::where('state',1)->get());
        return view('index.index',compact('order_num','devices_num'));
    }

    //退出登录
    public function loginout(Request $request)
    {
        $request->session()->forget(['user','userinfo']);

        return redirect('/admin/login');
    }
}
