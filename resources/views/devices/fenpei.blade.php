@extends('layouts.default')
@section('title','设备列表')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-table"></i> 分配列表</h3>
            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="/">首页</a></li>
                <li><i class="fa fa-table"></i>设备管理</li>
                <li><i class="fa fa-th-list"></i>分配列表</li>
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
                    <form class="navbar-form" action="{{ route('device.fp') }}" style="display: inline-block;">
                        <input class="form-control" name="search" placeholder="搜索" type="text">
                    </form>
                </header>
                <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>客户</th>
                        <th>配置</th>
                        <th>数量</th>
                        <th>开始时间</th>
                        <th>结束时间</th>
                        <th>操作员</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $v)
                        <tr>
                            <td>{{ $v->custom_name }}</td>
                            <td>{{ $v->system }}--{{ $v->cpu }}--{{ $v->memory }}--{{ $v->video_card }}</td>
                            <td>{{ $v->num }}</td>
                            <td>{{ date('Y-m-d H:i:s',$v->startime) }}</td>
                            <td>{{ date('Y-m-d H:i:s',$v->expiretime) }}</td>
                            <td>{{ $v->op }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div align="center">
                    {!! $data->appends(['search'=>$search])->render() !!}
                </div>
                </div>
            </section>
        </div>
    </div>
@stop   