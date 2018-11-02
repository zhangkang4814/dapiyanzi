<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Device;
use App\Model\Config;
use App\Model\Order;
use App\Model\OrderInfo;
use App\Model\Customer;
use App\Model\DeviceFenpei;

class DevicesController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $configs = Config::all();
        $devices = Device::where('mid','like',"%$search%")
                            ->orwhere('manufacturer','like',"%$search%")
                            ->orwhere('op','like',"%$search%")
                            ->paginate(20);
        //使用状态：0 未使用 1已使用 2已报修 3已报废
        $usestate = ['未使用','已使用','已报修','已报废'];
        //状态：0 未分配  1 已分配（試用期15天）  2 已使用
        $state = ['未分配','已分配（試用期15天）','已使用'];
        foreach ($devices as $k => $v) {
            foreach ($configs as $key => $val) {
                if ($v->confid == $val->id) {
                    $devices[$k]['configs'] = $val;
                }
            }
            foreach ($usestate as $uk => $uv) {
                if ($v->usestate == $uk) {
                    $devices[$k]['usestate'] = $uv;
                }
            }
            foreach ($state as $sk => $sv) {
                if ($v->state == $sk) {
                    $devices[$k]['state'] = $sv;
                }
            }
        }
        return view('devices.device', compact('search','devices'));
    }

    public function add()
    {
        $configs = Config::all();
        return view('devices.add_device', compact('configs'));
    }

    public function edit(Request $request)
    {   
        $configs = Config::all();
        $mid = $request->route('device');
        $data = Device::where('mid',$mid)->get();
        $device = $data[0];
        return view('devices.edit_device', compact('mid','device','configs'));
    }

    public function update(Request $request)
    {
        $data = $request->except('_token','_method');
        $data['buytime'] = strtotime($data['buytime']);
        if (Device::where('mid',$data['mid'])->update($data)) {
            session()->flash('success','修改成功！');
            return redirect('device');
        } else {
            session()->flash('warning', '修改失败！');
            return back();
        }
    }

    public function store(Request $request)
    {   
        $device = $request->except('_token');
        $device['buytime'] = strtotime($device['buytime']);
        $device['op'] = session('userinfo')->name;
        if (in_array('',$device)) {
            session()->flash('warning','数据不能为空！');
            return back();
        }
        $data = Device::create($device);
        if ($data) {
            session()->flash('success','添加成功！');
            return redirect('device');
        } else {
            session()->flash('danger','添加失败！');
            return back();
        }
    }

    public function order()
    {
        $orders = Order::join('customer','customer.cid','=','cust_id')
                        ->where('state',1)->paginate(20);
        return view('devices.apple',compact('orders'));
    }

    public function apply(Request $request)
    {
        $id = $request->route( 'id' );
        $order_name = $request->route( 'order_name' );
        $orderInfos = OrderInfo::join('config','config.id','=','order_info.conf_id')
                                ->select('order_info.*','config.id as config_id','config.cpu','config.memory','config.disk','config.system','config.video_card','config.price')
                                ->where([['order_id',$id],['order_info.num','>','0']])
                                ->get();                            
        foreach ($orderInfos as $k => $v) {
            $config_id[$k] = $v->config_id;
        }
        $cust_id = $request->route( 'cust_id' );
        $customer = Customer::where('cid',$cust_id)->first();
        $configs = Device::join('config','config.id','=','device.confid')
                            ->whereIn('device.confid',$config_id)
                            ->where('device.state',0)
                            ->get();
        return view('devices.app_device',compact('order_name','id','orderInfos','customer','configs'));
    }

    //设备分配
    public function device_app(Request $request)
    {
        $op = session()->get('userinfo')->name;
        $order_info_id = $request->input('order_info_id');
        $confids = $request->input('confids');
        $configs = $request->input('configs');
        $order_id = $request->input('order_id');
        $custom_id = $request->input('cid');
        if (!$configs || !$confids || !$order_id || !$custom_id || !$order_info_id) {
            session()->flash('warning','请选择');
            return back();  
        }
        $confids_data = Device::whereIn('mid',$configs)->get();
        $order_infos = OrderInfo::whereIn('order_id',$order_id)->get();
        // $startime = time();
        $time = time();
        foreach ($confids as $k => $confid) {
            $data[$k]['custom_id'] = $custom_id;
            // $data[$k]['startime'] = $startime;
            $data[$k]['time'] = $time;
            $data[$k]['confid'] = $confid;
            $data[$k]['order_name'] = $request->input('order_name');
            $data[$k]['op'] = $op;
            $data[$k]['num'] = 0;
            foreach ($confids_data as $val) {
                if ($confid == $val->confid) {
                    $data[$k]['num'] += 1;
                }
            }
            // foreach ($order_infos as $order_info) {
            //     if ($confid == $order_info->conf_id) {
            //         $day = 15+($order_info->month*30);
            //         $data[$k]['expiretime'] = strtotime("+$day day");
            //     }
            // }
        }   
        foreach ($data as $k => $v) {
            foreach ($order_infos as $order_info) {
                if ($v['confid'] == $order_info['conf_id']) {
                    $order_num = $order_info['num'] - $v['num'];
                    if ($order_num == 0) {
                        $id[] = $order_info['id'];
                    } elseif ($order_num < 0) {
                        session()->flash('danger','数量过多!');
                        return back();
                    } else {
                        $more[$k]['id'] = $order_info['id'];
                        $more[$k]['num'] = $order_num;
                    }
                }
            }
            if($v['num'] == 0) {
                unset($data[$k]);
            }
        }
        if (!in_array('',$data)) {
            $device_fenpei = DeviceFenpei::insert($data);
            if (!$device_fenpei) {
                session()->flash('danger','DeviceFenpei分配失败!');
                return back();
            }
            if (isset($id)) {
                $order_row = OrderInfo::whereIn('id',$id)->update(['num'=>0]);           
            }
            if (isset($more)) {
                    foreach ($more as $k => $v) {
                        $row = OrderInfo::where('id',$v['id'])->update(['num'=>$v['num']]);
                    }
                }
        }
        //修改Device表狀態
        foreach ($configs as $k => $config) {
            $configs_confid = Device::where('mid',$config)->get();
            $month = OrderInfo::where([['conf_id',$configs_confid[0]->confid],['order_id',$order_id]])->get();
            $day = 15+($month[0]->month*30);
            $expiretime = strtotime("+$day day");
            $device = Device::where('mid',$config)->update(['op'=>$op,'customid'=>$custom_id,'state'=>1,'usestate'=>1,'startime'=>$time,'expiretime'=>$expiretime]);
            if (!$device) {
                session()->flash('danger','分配失败!');
                return back();
            }
        }
        //修改Order表狀態
        if (isset($id)) {
            if (count($id) == count($confids)) {
                $order = Order::where('id',$order_info_id)->update(['state'=>2]);
                if (!$device_fenpei) {
                    session()->flash('danger','分配失败!');
                    return back();  
                }
            }
        }
        return redirect()->route('device.fp');
    }

    //分配列表
    public function device_fenpei(Request $request)
    {
        $search = $request->input('search');
        $data = DeviceFenpei::join('customer','customer.cid','=','device_fenpei.custom_id')
                                ->join('config','config.id','=','device_fenpei.confid')
                                ->where('device_fenpei.op','like',"%$search%")
                                ->orwhere('customer.custom_name','like',"%$search%")
                                ->paginate(20);
        return view('devices.fenpei',compact('search','data'));
    }

    public function mydelete(Request $request)
    {
        $mid = $request->route('mid');
        if (Device::where('mid',$mid)->delete()) {
            session()->flash('success', '删除成功！');
            return redirect('device');
        } else {
            session()->flash('warning', '删除失败！');
            return back();
        }
    }
}
