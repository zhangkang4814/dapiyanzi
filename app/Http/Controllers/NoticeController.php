<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Notice; //引入模型

class NoticeController extends Controller
{
    //获取所有信息 --生成分页数据
    public function hq(Request $request){
		$user = Notice::where('content','like','%'.$request->input('content').'%')
    				->orderBy('sending_time','desc')
    				->paginate(5);
		return view("show_notice",['user'=>$user,'request'=>$request->all()]);
	}
	//添加方法
 	public function add(Request $request){
 		return view("notice");
 	}
    //通过模型插入数据方法
    public function orm(Request $request){
    	$operator = $request->input('operator'); 
            if($operator==null){
                return back();
            }
            $notice = $request->all();
    	$notice['sending_time']=time();
    	try {
    		Notice::create($notice);	
    	} catch (Exception $e) {
    		session()->flash('waring','操作失败,请重新插入!');
            return back();
    	}
        session()->flash('success','操作成功!');
    	return redirect('/show_notice');
    }
    //删除操作
    public function del(){
        
    }
    //修改操作
    public function update(){

    }
    //增加操作\
    public function create(){

    }
}