@extends('layouts.default')
@section('title','后台首页')
@section('content')
 <div class="row">
                  <div class="col-lg-4">
                      <section class="panel">
                          <header class="panel-heading">
                             确认订单
                          </header>
                          <div class="panel-body">
                              <form class="form-horizontal " action="/pays" method="post">
                                  <div class="form-group">
                                      <label class="col-sm-5 control-label">订单编号</label>
                                      <div class="col-sm-7" style="line-height:35px">
                                          {{$order->order_name}}
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-5 control-label">申请时间</label>
                                      <div class="col-sm-7" style="line-height:35px">
                                          {{date("Y-m-d H:i",$order->sq_time)}}
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-5 control-label">申请人</label>
                                      <div class="col-sm-7" style="line-height:35px">
                                          {{$order->custom_name}}
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-5 control-label">总金额</label>
                                      <div class="col-sm-7" style="line-height:35px">
                                          {{$order->total}} 元
                                      </div>
                                  </div>
                    			  <input type="hidden" name="order_id" value="{{$order->id}}">
                    			  {{csrf_field()}} 
                                  <div class="form-group">
                                      <label class="col-sm-5 control-label"></label>
                                      <div class="col-sm-7" style="line-height:35px">
                                           <button type="submit"  class="btn  btn-danger">确认付款</button>
                                      </div>
                                  </div>
                                 
                              </form>
                          </div>
                      </section>
                   </div>
 </div>
@stop