<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $shop=session()->get("shop");
       $zongjia=0;
       return view("Admin.Cart.index",['shop'=>$shop,'zongjia'=>$zongjia]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (session()->get("shop.$id")) {
            // 重复点击同一商品
            $shop=session()->get("shop.$id");
            $num=$shop->num;
            $num+=1;
            $shop->num=$num;
            return redirect("/cart");
        }else{
            // 第一次点击
            $shop=DB::table("config")->where("id","=",$id)->first();
            $shop->num=1;
            $shop->month=1;
            session()->put("shop.$id",$shop);
            return redirect("/cart");
        }
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    // 购物车数量添加
    public function cartnumjia($id){
        $shop=session()->get("shop.$id");
        $num=$shop->num;
        $num+=1;
        $shop->num=$num;
        return redirect("/cart");
    }

     // 购物车数量减少
    public function cartnumjian($id){
        $shop=session()->get("shop.$id");
        $num=$shop->num;
        if ($num<=1) {
            return back();
        }
        $num-=1;
        $shop->num=$num;
        return redirect("/cart");
    }

      // 购物车月数添加
    public function cartmonthjia($id){
        $shop=session()->get("shop.$id");
        $month=$shop->month;
        $month+=1;
        $shop->month=$month;
        return redirect("/cart");
    }

     // 购物车月数减少
    public function cartmonthjian($id){
        $shop=session()->get("shop.$id");
        $month=$shop->month;
        if ($month<=1) {
            return back();
        }
        $month-=1;
        $shop->month=$month;
        return redirect("/cart");
    }

    public function cartsc($id){
      session()->pull("shop.$id");
      return redirect("/cart");
    }

    // 清空购物车并返回
    public function cartqk(){
        session()->pull("shop");
        return redirect("/shebei");
    }

    // 添加订单表
    public function order(){
        $shop=session()->get("shop");
        // dd(session()->get("zongjia"));
        $order['sq_time']=time();
        $order['state']=0;
        $order['order_name']=time()+rand(1,10000);
        $order['cust_id']=session()->get("cusid");
        $order['total']=session()->get("zongjia");
        // 获取插入的id
        $id=DB::table("order")->insertGetId($order);
        foreach ($shop as $value) {
           $order_info['order_id']=$id;
           $order_info['conf_id']=$value->id;
           $order_info['num']=$value->num;
           $order_info['month']=$value->month;
           DB::table("order_info")->insert($order_info);
         }
         // 添加成功后的操作
        // 清除session里面的购物数据
         session()->pull('shop');
         return redirect("/qrorder/{$id}");
    }

    public function qrorder($id){
        $orders=DB::table("order")->join("customer","order.cust_id","=","customer.cid")->where("id","=",$id)->get();
        // dd($orders[0]);
        $order=$orders[0];
        return view("Admin.Cart.qrorder",["order"=>$order]);
    }

    public function pays(Request $request){
       // dd($request->all());
        $order_id=$request->input("order_id");
        // dd($order_id);
        // 更改订单表状态 等接口后需要修改
        $data['state']=1;
        DB::table("order")->where("id","=",$order_id)->update($data);
        return redirect("/");
    }

}
