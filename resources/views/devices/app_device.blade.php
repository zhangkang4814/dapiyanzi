@extends('layouts.default')
@section('title','设备列表')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-table"></i> 设备分配</h3>
            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="/">首页</a></li>
                <li><i class="fa fa-table"></i>设备管理</li>
                <li><i class="fa fa-th-list"></i>设备分配</li>
            </ol>
        </div>
    </div>
    <div class="row">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    设备分配
                </header>
                <div class="panel-body">
                    <form class="form-horizontal " method="get" action="{{ route('deviceapp') }}">
                        <input type="hidden" class="form-control" name="order_info_id" value="{{ $id }}">
                        <input type="hidden" class="form-control" name="order_name" value="{{ $order_name }}">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">客户: </label>
                            <div class="col-lg-10">
                                <p class="form-control-static">{{ $customer->custom_name }}</p>
                            </div>
                            <input type="hidden" class="form-control" name="cid" value="{{ $customer->cid }}">
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">需求: </label>
                            <div class="col-lg-10">
                                @foreach ($orderInfos as $k => $v)
                                <p class="form-control-static">{{ $v->system }}--{{ $v->cpu }}--{{ $v->memory }}--{{ $v->disk }}--{{ $v->video_card }}::{{ $v->num }}台</p>
                                <input type="hidden" name="confids[]" value="{{ $v->conf_id }}">
                                <input type="hidden" name="order_id[]" value="{{ $v->order_id }}">
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2" for="inputSuccess">分配: </label>
                            <div class="col-lg-10"> 
                                <div class="checkbox" style="max-height:200px;overflow-y:scroll;">
                                    <label>
                                        @foreach ($configs as $config)
                                        <input name="configs[]" type="checkbox" value="{{ $config->mid }}">{{ $config->mid }}:{{ $config->system }}--{{ $config->cpu }}--{{ $config->memory }}--{{ $config->video_card }}<br>
                                        @endforeach                                        
                                    </label>
                                </div>          
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-primary" type="submit">分配</button>
                                <button class="btn btn-default" type="button"><a href="/" style="color:#000;">取消</a></button>
                            </div>
                        </div>
                    </form>
               
                </div>
            </section>
        </div>
    </div>
@stop   
