@extends('layouts.default')
@section('title','后台首页')
@section('content')
    <div class="row">
        <div class="col-lg-12">
             <section class="panel">
                <header class="panel-heading">
                  添加通知
                </header>
                    <div class="panel-body">
                        <div class="form">
                            <form class="form-validate form-horizontal" id="feedback_form" method="post" action="{{ route('notice.orm') }}" novalidate="novalidate">
                        {{ csrf_field() }}
                            <div class="form-group ">
                                <label for="cname" class="control-label col-lg-2" >发送目标 <span class="required">*</span></label>
                                <div class="col-lg-10">
                                    <input class="form-control" id="cname" name="mid" minlength="5" type="text" required="">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="cemail" class="control-label col-lg-2">通知类型 <span class="required">*</span></label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15" name="type">
                                        <option>广告通知</option>
                                        <option>优惠通知</option>
                                        <option>催费通知</option>
                                    </select>
                              <!-- <input class="form-control " id="cemail" type="email" name="email" required="" value="{{old('type')}}"> -->
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="curl" class="control-label col-lg-2">通知标题</label>
                                <div class="col-lg-10">
                                    <input class="form-control " id="curl" type="url" name="title" value="{{old('title')}}">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="ccomment" class="control-label col-lg-2">内容</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control " id="ccomment" name="content" required="" value="{{old('content')}}"></textarea>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="cname" class="control-label col-lg-2">操作员<span class="required">*</span></label>
                                <div class="col-lg-10">
                                    <input class="form-control" id="subject" name="operator" minlength="5" type="text" required="">
                                </div>
                            </div>                                      
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-primary" type="submit">添加</button>
                                    <!-- <button class="btn btn-default" type="button">取消</button> -->
                                </div>
                            </div>
                    </div>
            </section>
        </div>
    </div>
@stop
