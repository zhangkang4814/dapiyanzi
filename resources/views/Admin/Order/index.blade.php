@extends('layouts.default')
@section('title','后台首页')
@section('content')
<div>
  <div class="col-sm-6">
                      <section class="panel">
                          <header class="panel-heading">
                              我的订单
                          </header>
                          <table class="table">
                              <thead>
                              <tr>
                                  <th>#</th>
                                  <th>订单号</th>
                                  <th>申请时间</th>
                                  <th>金额</th>
                                  <th>状态</th>
                                  <th>操作</th>
                              </tr>
                              </thead>
                              <tbody>
                              @foreach($order as $row)
                           
                              <tr>
                                  <td></td>
                                  <td>{{$row->order_name}}</td>
                                  <td>{{date("Y-m-d H:i",$row->sq_time)}}</td>
                                  <td>{{$row->total}}</td>
                                  <td>
                                    @if($row->state==0)
                                      未支付
                                    @else
                                      已支付
                                    @endif
                                  </td>
                                  <td><a href="/orderinfo/{{$row->id}}">点击查看</a></td>
                              </tr>
                              @endforeach
                              </tbody>
                          </table>
                      </section>
                  </div>
  <div class="col-sm-6">
                      <section class="panel">
                          <header class="panel-heading">
                              我的续费
                          </header>
                          <table class="table">
                              <thead>
                              <tr>
                                  <th>#</th>
                                  <th>订单号</th>
                                  <th>申请时间</th>
                                  <th>金额</th>
                                  <th>状态</th>
                                  <th>操作</th>
                              </tr>
                              </thead>
                              <tbody>
                              @foreach($xforder as $row)
                           
                              <tr>
                                  <td></td>
                                  <td>{{$row->xforder_name}}</td>
                                  <td>{{date("Y-m-d H:i",$row->xf_time)}}</td>
                                  <td>{{$row->total}}</td>
                                  <td>
                                    @if($row->state==0)
                                      未支付
                                    @else
                                      已支付
                                    @endif
                                  </td>
                                  <td><a href="/xforderinfo/{{$row->id}}">点击查看</a></td>
                              </tr>
                              @endforeach
                              </tbody>
                          </table>
                      </section>
                  </div>

</div>
@stop