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
                              <form class="form-horizontal " action="/xfpays" method="post">
                                  <div class="form-group">
                                      <label class="col-sm-5 control-label">订单编号</label>
                                      <div class="col-sm-7" style="line-height:35px">
                                          {{$xforder->xforder_name}}
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-5 control-label">申请时间</label>
                                      <div class="col-sm-7" style="line-height:35px">
                                          {{date("Y-m-d H:i",$xforder->xf_time)}}
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-5 control-label">申请人</label>
                                      <div class="col-sm-7" style="line-height:35px">
                                          {{$xforder->custom_name}}
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-5 control-label">总金额</label>
                                      <div class="col-sm-7" style="line-height:35px">
                                          {{$xforder->total}} 元
                                      </div>
                                  </div>
                    			  <input type="hidden" name="xforder_id" value="{{$xforder->id}}">
                    			  {{csrf_field()}} 
                                  <button type="submit"  class="btn  btn-danger">确认付款</button>
                              </form>
                          </div>
                      </section>
                   </div>
 </div>
@stop