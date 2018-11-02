
@extends('layouts.default')
@section('title','后台首页')
@section('content')
<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
        结算历史记录
        </header>
      
            <table class="table table-striped table-advance table-hover" id="tb">
                <tbody id="show_tbody">
                    <tr>
                        <th>用户名</th>
                        <th>价格</th>
                        <th>分成比例%</th>
                        <th>申请状态</th>
                        <th>结算时间</th>
                        <th>提成</th>
                    </tr>
                    @foreach($history as $kk)
                    <tr>
                        <td>ZKKO</td>
                        <td>{{$kk['price']}}</td>
                        <td>{{$kk['proportions']}}%</td>
                        <td>{{$kk['state']}}</td>
                        <td>{{isset($kk['sqsj_time'])?date('Y/m/d H:i:s',$kk['sqsj_time']):''}}</td>
                        <td>{{$kk['proportions'] * $kk['price'] /100 }}</td>
                    </tr>   
                    @endforeach
                </tbody>
            </table>
            
    </section>   
</div>
@stop



