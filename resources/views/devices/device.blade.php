@extends('layouts.default')
@section('title','设备列表')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-table"></i> 设备列表</h3>
            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="/">首页</a></li>
                <li><i class="fa fa-table"></i>设备管理</li>
                <li><i class="fa fa-th-list"></i>设备列表</li>
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
                    设备列表
                    <form class="navbar-form" action="{{ route('device.index') }}" style="display: inline-block;">
                        <input class="form-control" name="search" placeholder="搜索" type="text">
                    </form>
                </header>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>生产厂家</th>
                            <th>购买日期</th>
                            <th>批次</th>
                            <th>cpu</th>
                            <th>内存</th>
                            <th>硬盘大小</th>
                            <th>mac地址</th>
                            <th>编号</th>
                            <th>录入人员</th>
                            <th>状态</th>
                            <th>使用状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($devices as $device)
                        <tr>
                            <td>{{ $device-> manufacturer}}</td>
                            <td>{{ date('Y-m-d H:i:s',$device-> buytime) }}</td>
                            <td>{{ $device-> batch}}</td>
                            <td>{{ $device-> configs -> cpu}}</td>
                            <td>{{ $device-> configs -> memory}}</td>
                            <td>{{ $device-> configs -> disk}}</td>
                            <td>{{ $device-> mac}}</td>
                            <td>{{ $device-> mid}}</td>
                            <td>{{ $device-> op}}</td>
                            <td>{{ $device-> state}}</td>
                            <td>{{ $device-> usestate}}</td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-primary" href="{{ route('device.edit',$device->mid) }}">修改</a>
                                     <a class="btn btn-danger" href="{{ route('device_del',$device->mid) }}">删除</a>      
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div align="center">
                        {!! $devices->appends(['search'=>$search])->render() !!}
                    </div>
                </div>
            </section>
        </div>
    </div>
@stop   
