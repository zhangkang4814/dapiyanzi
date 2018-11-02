<?php

namespace App\Http\Controllers\Agent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB; 
use App\Model\User;
use App\Model\Login;

class AgentController extends Controller
{
    //用户列表页
    public function index(Request $request)
    {	
    	//查询所有数据返回给前台页面
    	$users = User::where('name','like','%'.$request->input('name').'%')
    				->where(function($query){
    					$find = session('user')->uid;
    					$query->where('id','=',$find)
    					      ->orwhere('find','like','%'.$find.'%');
    				})
    				->orderBy('id','asc')
    				->paginate(5);
    	return view('index',['users'=>$users,'request'=>$request->all()]);
    }

    //用户添加
    public function store(Request $request)
    {
    	$user = $request->except(['_token','username','password']);
    	$login = $request->only(['username','password']);
    	$user['find'] = $user['father'].',';
    	$login['role'] = $user['auth'];
    	DB::beginTransaction();
    	try {
    		$userid = User::create($user)->id;
    		$login['uid'] = $userid;
    		Login::create($login);
    		DB::commit();
    	} catch (Exception $e) {
    		DB::rollback();
    		return redirect('/user/create')->back()->withInput()->withErrors("添加失败");
    	}

    	return redirect('/agent');
    }

    //删除
    public function destroy(Request $request)
    {
    	//获取id
		$id = $request->input('id');

		//执行删除
		$bool = User::where('id','=',$id)
			->delete();
		//返回数据
		if($bool){
			return 1;
		}else{
			return 0;
		}
    	
    }

    //修改
    public function update(Request $request)
    {	
    	//获取参数
		$id=$request->input('id');
		$type=$request->input('type');
		$info=$request->input('info');
		//判断参数类型 执行更新操作 返回结果
		$bool = User::where('id','=',$id)
					->update([$type=>$info]);
		if($bool){
			return 1;//成功
		}else{
			return 0;//失败
		}
    	
    }

    //个人中心
    public function show()
    {
    	$user = User::where('id','=',session('user')->uid)
    				->first();
    	return $user;
    }
}
