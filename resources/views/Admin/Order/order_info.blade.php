@extends('layouts.default')
@section('title','后台首页')
@section('content')
  <div class="col-sm-6">
                      <section class="panel">
                          <header class="panel-heading">
                              订单详情  <a href="/myorder"><i class="fa fa-chevron-up"></i></a>
                          </header>
                          <table class="table">
                              <thead>
                              <tr>
                                  <th>#</th>
                                  <th>配置型号</th>
                                  <th>数量</th>
                                  <th>时间</th>
                              </tr>
                              </thead>
                              <tbody>
                              @foreach($order_info as $row)
                              <tr>
                                <td></td>
                                <td>{{$row->conf_id}}</td>
                                <td>{{$row->num}} 台</td>
                                <td>{{$row->month}} 月</td>
                              </tr>
                              @endforeach
                              </tbody>
                          </table>
                      </section>
                  </div>
@stop