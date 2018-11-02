<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Achievement;
use App\Model\Settlement;
use App\Model\Pay;

class SettlementController extends Controller
{	
	//申请结算
	//展示待结算的业绩->从业绩表里获取数据
	public static function hq(){
		$js = Achievement::where('state','=',1)->get();
		// dd($js);
		$all = [];
		foreach ($js as $k => $val) {
			$aa['id'] = $val->id;
			$aa['user_id'] = $val->user_id;
			$aa['price'] = $val->price;
			$aa['auth'] =$val->auth;			
			$aa['sqsj_time'] = $val->sqsj_time;
			$aa['settime'] = $val->settime;
			$aa['proportions'] = $val->proportions;
			$aa['extract'] = $val->extract;
 			$aa['state'] = $val->state;
			array_push($all,$aa);
			$aa = [];
		}
		return $all;
	}
	//返回页面
	public function index(Request $request){
		//继承静态方法
		$all = self::hq();
		return view('ht_settlement',compact('all'));
	}
	//发起申请提现
	public function sqtx(Request $request)
	{
		$all = self::hq();
		$userid = $request->input('userid');
		foreach ($all as $key => $value) {
			if($value['user_id']==$userid){
				$arr = $value;
			}
		}
		$arr['sqsj_time'] = time();

		unset($arr['id']);
		// dd($arr);
		if($request->ajax()){
			try {
				Settlement::create($arr);
			} catch (Exception $e) {
				return 0;
			}
				return 1;		
		}
		//插入数据到结算表

		// try {
		// 	Settlement::insert($all);
		// 	// dd(settlement)
		// } catch (Exception $e) {
		// 	session()->flash('waring','操作失败,请重新插入!');
		// 	 	return back();
		// }
		// session()->flash('success','操作成功!');
  //   	return redirect('ht_settlement');
	}

	//结算申请方法
	public function jssq(Request $request)
	{
		$uid=0;
		$js = settlement::join('user','user.id','=','settlement.user_id')
							->where('settlement.state','=','0')
							->where('user.father','=',$uid)
							->get();
		// dd($js);
		return view('sqjs',compact('js'));
	}

	//处理结算申请方法
	public function jiesuan(Request $request)
	{

		if($request->ajax()){
			$userid = $request->input('userid');
			try {
				Settlement::where('user_id',$userid)
						->update(['state'=>1,'time'=>time()]);
			} catch (Exception $e) {
				return 0;
			}
				//同意结算后将业绩表的状态更改
				achievement::join("user","user.id",'=','user_id')
							->where('state','=','1')
			                ->Where(function ($query)use($userid) {
			                    $query->where('father','=',$userid)
			                    ->orwhere('user_id', '=', $userid);
			                })
			                // ->get();
							->update(['state'=>2,'settime'=>time()]);
							// dd($jj);
				//将订单表中的状态更改
				Pay::join('user','user.id','=','pay.user_id')
						->where('state','=','1')
						->Where(function ($query)use($userid) {
                   			$query->where('father','=',$userid)
                   			->orwhere('user_id', '=', $userid);
                		})
                		// ->get();
                		// dd($jj);
    					->update(['state'=>2,'stime'=>time()]);	
				return 1;		
		}
	}
	//查询历史记录方法
	public function check(){
		$history=settlement::where('state','=','1')->get();
		// dd($history);
		return view('history',compact('history'));
	}
}
