<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class OrderConrtoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(session()->get("cusid"));
        $id=session()->get("cusid");
        $order=DB::table("order")->where("cust_id","=",$id)->get();
        $xforder=DB::table("xforder")->where("cust_id","=",$id)->get();
        // dump($order);
        return view("Admin.Order.index",["order"=>$order,"xforder"=>$xforder]);
    }

    public function orderinfo($id){
        $order_info=DB::table("order_info")->where("order_id","=",$id)->get();
        // dump($order_info);
        return view('Admin.Order.order_info',["order_info"=>$order_info]);
    }

    public function xforderinfo($id){
        $xforder_info=DB::table("xforder_info")->where("xforder_id","=",$id)->get();
        // dump($order_info);
        return view('Admin.Order.xforder_info',["xforder_info"=>$xforder_info]);
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
        //
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
}
