<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB; 
use App\Model\User;
use App\Model\Login;
use App\Model\Manager;
use App\Model\Device;
use App\Model\Customer;
use App\Model\Order;
use App\Model\OrderInfo;
use App\Model\Config;
use App\Model\DeviceFenpei;
use App\Model\Settlement;

class UserController extends Controller
{	
	//用户列表页
    public function index(Request $request)
    {      
        $level = $request -> route('level');

        if(session('user')->role == 0){
            //查询所有数据返回给前台页面
            
            $users = User::where('level',$level)
                        ->orderBy('id','asc')
                        ->paginate(10);

        }elseif(session('user')->role > 0 && $level == session('userinfo')->level){

            $users = User::where('id',session('userinfo')->id)
                        ->orderBy('id','asc')
                        ->paginate(10);

        }elseif(session('user')->role > 0 && $level != session('userinfo')->level){

            $users = User::where('find','like','%,'.session('userinfo')->id.',%')
                        ->where('level',$level)
                        ->orderBy('id','asc')
                        ->paginate(10);
        }elseif(session('user') < 0){

            session()->flash('warning','没有权限');
            return redirect('/');
        }

        return view('user.index',['users'=>$users,'request'=>$request->all()]);
    	
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

        $username = Login::where('username',$login['username'])
                            ->first();
        if($username){
            session()->flash('warning','用户名已存在!!');
            return redirect('/user/create');
        }

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
            $user['level'] = substr_count($user['find'],',');
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

    //查看
    public function check(Request $request)
    {   
        $id = $request->route('id');

        $users = User::where('id',$id)
                    ->first();

        $son = User::where('father',$id)
                    ->get();

        $customer = Customer::where('user_id',$id)
                            ->get();

        $settlement = Settlement::where('user_id',$id)
                                ->where('state',1)
                                ->get();

        $yeji = DB::table('achievement')->where('user_id',$id)->get();

        return view('user.check',compact(['users','son','customer','settlement','yeji']));
    }
    
}
