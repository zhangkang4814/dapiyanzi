<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class MyDeviceConrtoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // 判断session,登录
       $id=session()->get("cusid");
       // 根据$id查询改用户下的所有设备
       $device=DB::table("device")->join("config","device.confid","=","config.id")->where("customid","=",$id)->get();
       // dump($device);
       return view("Admin.Mydevice.index",["device"=>$device]);
    }

    public function xfq(Request $request){
        // dump($request->input("mid"));
        $xfmid=$request->input("mid");
        if ($xfmid!=null) {
            foreach ($xfmid as $value) {
                // dump($value);
                $confid=DB::table("device")->join("config","device.confid","=","config.id")->where("mid","=",$value)->get();
                $confid[0]->month=1;
                // dump($confid[0]);
                $xfshop[]=$confid[0];
            }
            session()->put("xfshop",$xfshop);
            return redirect("/xf");
        }else{
            return back();
        }
    }

    public function xf(){
        $xfzongjia=0;
        return view("Admin.Mydevice.xf",["xfzongjia"=>$xfzongjia]);
        
    }

    public function xfmonthjia(){
        $xfshop=session()->get("xfshop");
        foreach ($xfshop as $value) {
            // dump($value->month);
            $month=$value->month;
            $month+=1;
            // dump($month);
            $value->month=$month;
        }
        // dump(session()->get("xfshop"));
        return redirect('/xf');
    }

    public function xfmonthjian(){
        $xfshop=session()->get("xfshop");
        foreach ($xfshop as $value) {
            // dump($value->month);
            $month=$value->month;
            if ($month<=1) {
                return back();
            }
            $month-=1;
            // dump($month);
            $value->month=$month;
        }
        // dump(session()->get("xfshop"));
        return redirect('/xf');
    }
    
    // 添加续费表
    public function xforder(){
        // dd(session()->get("xfshop"));
        // dd(session()->get("xfzongjia"));
        // dd(session()->get("cusid"));
        $custid=session()->get("cusid");
        $xforder['total']=session()->get("xfzongjia");
        $xforder['xforder_name']=time()+rand(1,10000);
        $xforder['xf_time']=time();
        $xforder['state']=0;
        $xforder['cust_id']=$custid;
        $id=DB::table("xforder")->insertGetId($xforder);
        $xfshop=session()->get("xfshop");
        foreach ($xfshop as $value) {
            $xf_info['mid']=$value->mid;
            $xf_info['month']=$value->month;
            $xf_info['xforder_id']=$id;
            DB::table("xforder_info")->insert($xf_info);
        }
        // echo "完成";
        session()->pull('xfshop');
        return redirect("/qrxforder/{$id}");
    }

    public function qrxforder($id){
        // echo $id;
        $orders=DB::table("xforder")->join("customer","xforder.cust_id","=","customer.cid")->where("id","=",$id)->get();
        // dump($orders[0]);
        $xforder=$orders[0];
        return view("Admin.Mydevice.qrxforder",["xforder"=>$xforder]);
    }

    public function xfpays(Request $request){
        // dd($request->all());
        $xforder_id=$request->input("xforder_id");
        $data['state']=1;
        DB::table("xforder")->where("id","=",$xforder_id)->update($data);
        // 修改设备的到期时间
        $xfinfo=DB::table("xforder_info")->where("xforder_id","=",$xforder_id)->get();
        // dump($xfinfo);
        foreach ($xfinfo as $value) {
            // dump($value);
            $time=$value->month*24*3600;
            $device=DB::table("device")->where("mid","=",$value->mid)->get();
            // dump($device[0]->expiretime);
            $datas['expiretime']=$device[0]->expiretime+$time;
            DB::table("device")->where("mid","=",$value->mid)->update($datas);
        }
        session()->flash("success","缴费成功");
        return redirect('/');
    }

}
