<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index.index');
});

// Route::get('user/index','UserController@index');
// //ajax删除
// Route::post('user/destroy','UserController@destroy');
// //返回添加页面
// Route::get('user/create','UserController@create');
// //执行添加
// Route::post('user/store','UserController@store');
// //ajax修改
// Route::post('user/update','UserController@update');
//资源控制器
// Route::resource('user','UserController')->middleware('login');
// //注册路由
// Route::get('signup','Home\SignController@signup');
// //注册验证码路由
// Route::post('proof','Home\SignController@proof');
// //校验验证码
// Route::get('doproof','Home\SignController@doproof');
// //验证用户名可用
// Route::post('uname','Home\SignController@uname');
// //执行注册路由
// Route::post('dosignup','Home\SignController@dosignup');
Route::group(['middleware'=>'login'],function(){
    
    //用户  章康
    Route::get('/','LoginController@index');
	Route::get('{level}/user','Manager\Usercontroller@index')->name('user');
	Route::get('user/create','Manager\Usercontroller@create')->name('usercreate');
	Route::post('user/store','Manager\Usercontroller@store');
	Route::get('user/edit','Manager\Usercontroller@edit');
	Route::post('user/update','Manager\Usercontroller@update');
	Route::post('user/destroy','Manager\Usercontroller@destroy');
	Route::get('user/show','Manager\Usercontroller@show');
	Route::get('user/check/{id}','Manager\Usercontroller@check')->name('usercheck');
	Route::get('/admin/loginout','LoginController@loginout');
	Route::get('user/grade','Manager\Usercontroller@grade');
	Route::get('customer','Customer\CUstomerController@index')->name('customer');
	Route::get('customer/create','Customer\CUstomerController@create')->name('customerCreate');
	Route::post('customer/store','Customer\CUstomerController@store');
	Route::post('customer/destroy','Customer\CUstomerController@destroy');
	Route::get('customer/edit','Customer\CUstomerController@edit');
    Route::post('customer/update','Customer\CUstomerController@update');
    Route::get('customer/check/{cid}','Customer\CUstomerController@check')->name('customcheck');
    //end 章康

	//设备  张仁灿
    Route::resource('device','DevicesController');
    Route::get('adddevice','DevicesController@add')->name('add');
    Route::get('/device/{mid}/delete','DevicesController@mydelete')->name('device_del');
    Route::get('/device/{mid}/edit', 'DevicesController@edit')->name('device.edit');
    Route::put('/device/{mid}', 'DevicesController@update')->name('device.update');
    //设备分配
    Route::get('device_order','DevicesController@order')->name('de_order');
    Route::get('device_app','DevicesController@device_app')->name('deviceapp');
    Route::get('apply/{id}/{cust_id}/{order_name}','DevicesController@apply')->name('apply');
    Route::get('device_fenpei','DevicesController@device_fenpei')->name('device.fp');
    //配置添加
    Route::resource('config','ConfigsController');
    //end 张仁灿
    
    //gy
    Route::post("/add_notice",'NoticeController@orm')->name('notice.orm');
    Route::get("/show_notice",'NoticeController@hq')->name('user_show');
    Route::get("/notice",'NoticeController@add')->name('useradd');
    Route::get("/ht_settlement",'SettlementController@index');
//ajax方法
    Route::post("/sqtx",'SettlementController@sqtx');
//显示页面
    Route::get('/sqjs','SettlementController@jssq');
//ajax
    Route::post('/jiesuan','SettlementController@jiesuan');
//历史记录
    Route::get('/history','SettlementController@check');

    //业绩管理
    Route::get("/yeji",'yejiController@index');
    //个人业绩
    Route::get("/yejichaxun/{id}",'yejiController@select');
    //历史业绩
    Route::get("/lishiyeji","yejiController@lishiyeji");
    //历史个人记录业绩
    Route::get("/lishigeren/{id}","yejiController@lishigeren");
    //申请中的业绩
    Route::get("/appli","yejiController@appli");

    //申请结算
    Route::get("/app","yejiController@app");
    
// 刘洋  客户模块
Route::resource("/shebei","Admin\ShebeiController");
// 购物车
Route::resource("/cart","Admin\CartController");
// 购物车数量增加
Route::get("/cartnumjia/{id}","Admin\CartController@cartnumjia");
// 购物车数量减少
Route::get("/cartnumjian/{id}","Admin\CartController@cartnumjian");
// 购物车月数增加
Route::get("/cartmonthjia/{id}","Admin\CartController@cartmonthjia");
// 购物车月数减少
Route::get("/cartmonthjian/{id}","Admin\CartController@cartmonthjian");
// 购物车商品删除
Route::get("/cartsc/{id}","Admin\CartController@cartsc");
// 清空购物车
Route::get("/cartqk","Admin\CartController@cartqk");
// 添加订单表
Route::get("/order","Admin\CartController@order");
// 确认订单
Route::get("/qrorder/{id}","Admin\CartController@qrorder");
// 支付宝调用pays
Route::post("/pays","Admin\CartController@pays");
// 我的设备
Route::resource("/mydevice","Admin\MyDeviceConrtoller");
// 续费
Route::post("/xfq","Admin\MyDeviceConrtoller@xfq");
// 续费
Route::get("/xf","Admin\MyDeviceConrtoller@xf");
// 我的订单
Route::resource("/myorder","Admin\OrderConrtoller");
// 查看订单详情
Route::get("/orderinfo/{id}","Admin\OrderConrtoller@orderinfo");
// 续费时间增加
Route::get("/xfmonthjia","Admin\MyDeviceConrtoller@xfmonthjia");
// 续费时间减少
Route::get("/xfmonthjian","Admin\MyDeviceConrtoller@xfmonthjian");
// 续费订单添加
Route::get("/xforder","Admin\MyDeviceConrtoller@xforder");
// 查看续费订单详情
Route::get("/xforderinfo/{id}","Admin\OrderConrtoller@xforderinfo");
// 确认续费订单
Route::get("/qrxforder/{id}","Admin\MyDeviceConrtoller@qrxforder");
// 支付宝调用pays
Route::post("/xfpays","Admin\MyDeviceConrtoller@xfpays");
});

//后台登录路由
Route::get('/admin/login','LoginController@login');
//执行登录路由
Route::post('/admin/dologin','LoginController@dologin');



