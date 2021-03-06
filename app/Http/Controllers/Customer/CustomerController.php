<?php

namespace App\Http\Controllers\Customer;

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


class CustomerController extends Controller
{
    public function index()
    {
    	$customer = Customer::where('user_id',session('userinfo')->id)
    						->orderBy('cid','asc')
                        	->paginate(10);
    	return view('customer.index',compact('customer'));
    }

    public function create()
    {
    	return view('customer.add');
    }

    //执行添加操作
    public function store(Request $request)
    {   

        $login = $request->only(['username','password']);
        $login['password'] = md5($login['password']);
        $username = Login::where('username',$login['username'])
                            ->first();
        if($username){
            session()->flash('warning','用户名已存在!!');
            return redirect('/customer/create');
        }

        //上传营业执照
    	$file = $request->file('business_pic');
    	if($file->isValid()){
	    	$url_path = '/upload';
	    	$rule = ['jpg', 'png', 'gif'];
	        $clientName = $file->getClientOriginalName();
	        $tmpName = $file->getFileName();
	        $realPath = $file->getRealPath();
	        $entension = $file->getClientOriginalExtension();
	        if (!in_array($entension, $rule)) {
	            return '图片格式为jpg,png,gif';
	        }
	        $newName = md5(date("Y-m-d H:i:s") . $clientName) . "." . $entension;
	        $path = $file->move(public_path().$url_path, $newName);
	        $namePath = $url_path . '/' . $newName;
	    }

    	$customer = $request->except(['_token','username','password']);
    	$customer['user_id'] = session('userinfo')->id;
    	$customer['business_pic'] = $namePath;

        DB::beginTransaction();
        try {
            $userid = Customer::create($customer)->id;
            $login['role'] = -1;
            $login['uid'] = $userid;
            Login::create($login);
            DB::commit();
            session()->flash('success','添加客户成功');
        } catch (Exception $e) {
            DB::rollback();
            session()->flash('warning','添加用户失败');
        }

    	return redirect('/customer');
    } 

    public function edit(Request $request)
    {
        $id = $request->input('id');

        $customer = Customer::where('cid',$id)
                        ->first();

        return view('customer.edit',compact(['customer','login']));
    }

    public function update(Request $request)
    {	
        $id = $request->only('id');
        $customer = $request->except(['_token','id']);
        if($request->file('business_pic')){
        	$file = $request->file('business_pic');
	    	if($file->isValid()){
		    	$url_path = '/upload';
		    	$rule = ['jpg', 'png', 'gif'];
		        $clientName = $file->getClientOriginalName();
		        $tmpName = $file->getFileName();
		        $realPath = $file->getRealPath();
		        $entension = $file->getClientOriginalExtension();
		        if (!in_array($entension, $rule)) {
		            return '图片格式为jpg,png,gif';
		        }
		        $newName = md5(date("Y-m-d H:i:s") . $clientName) . "." . $entension;
		        $path = $file->move(public_path().$url_path, $newName);
		        $namePath = $url_path . '/' . $newName;
		    }

		    $customer['business_pic'] = $namePath;
        }

    	try {
    		$img = Customer::where('cid',$id)
    						->first(['business_pic']);
            Customer::where('cid',$id)
                    ->update($customer);
            if(isset($customer['business_pic'])){
            	unlink(public_path().$img->business_pic);
            }
        	session()->flash('success','修改成功');
        } catch (Exception $e) {
            session()->flash('warning','修改失败');
        }

        return redirect('/customer');
 	
    }

    public function destroy(Request $request)
    {
    	//获取id
		$id = $request->input('id');

        //执行删除
        DB::beginTransaction();
        try {
            Customer::where('cid','=',$id)
                ->delete();
            Login::where('uid',$id)
                ->where('role',-1)
                ->delete();
            DB::commit();

        } catch (Exception $e) {
            return 0;
        }
		
        return 1;
    }

    public function check(Request $request)
    {   
        $id = $request->route('cid');

        $customer = Customer::where('cid',$id)
                            ->first();

        $device = Device::join('config','config.id','=','device.confid')
                        ->where('customid',$id)
                        ->where('state','>',0)
                        ->get();

        $order = Order::join('order_info','order.id','=','order_info.order_id')
                        ->join('config','order_info.conf_id','=','config.id')
                        ->where('cust_id',$id)
                        ->paginate(4);

        return view('customer.check',compact(['customer','device','order']));
    }
}
