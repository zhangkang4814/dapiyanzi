@extends('layouts.default')
@section('title','后台首页')
@section('content')
  <div class="col-sm-6">
                      <section class="panel">
                          <header class="panel-heading">
                              续费详情  <a href="/myorder"><i class="fa fa-chevron-up"></i></a>
                          </header>
                          <table class="table">
                              <thead>
                              <tr>
                                  <th>#</th>
                                  <th>设备编号</th>
                                  <th>时间</th>
                              </tr>
                              </thead>
                              <tbody>
                              @foreach($xforder_info as $row)
                              <tr>
                                <td></td>
                                <td>{{$row->mid}}</td>
                                <td>{{$row->month}} 月</td>
                              </tr>
                              @endforeach
                              </tbody>
                          </table>
                      </section>
                  </div>
@stop