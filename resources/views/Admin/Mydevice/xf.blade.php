@extends('layouts.default')
@section('title','后台首页')
@section('content')
<style>
  .flex{display:flex;width:90px;height:30px;justify-content:center;}
  .div{width:30px;height:30px;color:#58CBFE;font-weight:bold;}
  .bor{border:1px solid #DDDDDD;}
  .juzhong{display:flex;justify-content:center;align-items:center;}
  .emm{text-align:right;}
</style>
<div class="row">
                  <div class="col-sm-12">
                      <section class="panel">
                          <header class="panel-heading">
                              设备续费 
                          </header>
                          <table class="table">
                              <thead>
                              <tr>
                                  <th>#</th>
                                  <th>设备编号</th>
                                  <th>设备型号</th>
                                  <th>单价</th>
                                  <th>小计</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php 
	                              $numid=0;
	                              $numid++;
	                              $xfshop=session()->get("xfshop");
                               ?>
                               @foreach($xfshop as $row)
                                <?php 
                              	$month=$row->month;
                              	$price=$row->price;
                              	$xfxiaoji=$price*$month;
                              	$xfzongjia+=$xfxiaoji;
                              	session()->put("xfzongjia",$xfzongjia);
                               ?>
                              <tr>
                                  <td>{{$numid++}}</td>
                                  <td>{{$row->mid}}</td>
                                  <td>{{$row->confid}}</td>
                                  <td>{{$row->price}}</td>
                                  <td>{{$xfxiaoji}}</td>
                              </tr>
                             
                              @endforeach
                              <tr>
                              	<td ></td>
                              	<td class="emm">总价: <span style="color: red">{{$xfzongjia}}</span>元</td>
                              	<td class="emm">时间/月</td>
                              	<td >
                              		<div class="flex">
						              <a href="/xfmonthjian"><div class="div bor juzhong">-</div></a>
						              <div class="div juzhong">{{$month}}</div>
						              <a href="/xfmonthjia"><div class="div bor juzhong">+</div></a>
						            </div>
                              	</td>
                              	<td><a href="/xforder" data-toggle="modal" class="btn  btn-danger">提交</a></td>
                              </tr>
                              </tbody>
                          </table>
                      </section>
                  </div>    
              </div>
@stop