<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB; 
use App\Model\User;
use App\Model\Login;
use App\Model\Manager;

class UserController extends Controller
{	
	//用户列表页
    public function index(Request $request)
    {   
        if(session('user')->role==0){
            //查询所有数据返回给前台页面
            $users = User::where('name','like','%'.$request->input('name').'%')
                        ->orderBy('id','asc')
                        ->paginate(10);
            $pid = 0;
        }elseif(session('user')->role>0){
            //查询所有数据返回给前台页面
            $find = session('userinfo')->id;
            $users = User::where('name','like','%'.$request->input('name').'%')
                        ->where('find','like','%'.$find.'%')
                        ->orderBy('id','asc')
                        ->paginate(10);

            $pid = session('userinfo')->id;

        }else{

        }

        $user = User::getTree($users,$pid);

        return view('user.index',['users'=>$users,'user'=>$user,'request'=>$request->all()]);
    	
    }

    //添加用户页面
    public function create()
    {
    	return view('user.add');
    }

    //执行添加操作
    public function store(Request $request)
    {   
    	$user = $request->except(['_token','username','password']);
    	$login = $request->only(['username','password']);
        $login['password'] = md5($login['password']);
        $login['role'] = $user['auth'];
        if($user['auth']==0){
            DB::beginTransaction();
            try {
                $userid = Manager::create($user)->id;
                $login['uid'] = $userid;
                Login::create($login);
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                session()->flash('warning','添加用户失败');
            }
        }else{
            if($user['father']==0){
                $user['find'] = $user['father'].',';
            }else{
                $find = User::where('id',$user['father'])
                            ->first(['find']);
                $user['find'] = $find->find.$user['father'].',';
            }
            DB::beginTransaction();
            try {
                $userid = User::create($user)->id;
                $login['uid'] = $userid;
                Login::create($login);
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                session()->flash('warning','添加用户失败');
            }
        }

    	return redirect('/user');
    }

    //删除
    public function destroy(Request $request)
    {
    	//获取id
		$id = $request->input('id');

        $user = User::where('father',$id)
                    ->first();
        if($user){
            return 2;
        }else{
            //执行删除
            DB::beginTransaction();
            try {
                User::where('id','=',$id)
                    ->delete();
                Login::where('uid',$id)
                    ->where('role','>',0)
                    ->delete();
                DB::commit();

            } catch (Exception $e) {
                return 0;
            }
        }
		
        return 1;
    	
    }

    public function edit(Request $request)
    {
        $id = $request->input('id');

        $user = User::where('id',$id)
                    ->first();

        return view('user.edit',compact('user'));
    }

    //修改
    public function update(Request $request)
    {	
        if($request->ajax()){
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
        }else{
            $id = $request->only('id');
            $auth = $request->only('auth');
            $user = $request->except(['_token','id','username']);
            if($auth==0){
                try {
                    User::where('id',$id)
                        ->update($user);
                } catch (Exception $e) {
                    session()->flash('warning','修改失败');
                }
            }else{
                try {
                    User::where('id',$id)
                        ->update($user);     
                } catch (Exception $e) {
                    session()->flash('warning','修改失败');
                }
            }

            session()->flash('success','修改成功');
            return redirect('/user');
        }
		
    	
    }

    //个人中心
    public function show()
    {   
        if(session('user')->role==0){
            $user = Manager::where('id',session('user')->uid)
                            ->first();
        }else{
            $user = User::where('id','=',session('user')->uid)
                    ->first();
        }
    	
    	return view('user.profile',compact('user'));
    }

    //分级
    public function grade(Request $request)
    {
        $id = $request->input('id');

        $users = User::where('find','like','%'.$id.'%')
                    ->paginate(10);

        $user = User::getTree($users,$id);


        return view('user.index',compact(['user','users']));
    }

}
