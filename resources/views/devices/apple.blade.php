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
                <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>申请时间</th>
                        <th>订单号</th>
                        <th>金额</th>
                        <th>客户</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                     @foreach ($orders as $order)
                        <tr>
                            <td>{{ date('Y-m-d H:i:s',$order->sq_time) }}</td>
                            <td>{{ $order->order_name }}</td>
                            <td>{{ $order->total }}</td>
                            <td>{{ $order->custom_name }}</td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-primary" href="{{ route('apply',[$order->id,$order->cid,$order->order_name]) }}">分配</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div align="center">
                    {!! $orders->render() !!}
                </div>
                </div>
            </section>
        </div>
    </div>
@stop   