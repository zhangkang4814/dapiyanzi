@extends('layouts.default')
@section('title','后台首页')
@section('content')
<section class="panel">
    <header class="panel-heading tab-bg-primary tab-right ">
        <ul class="nav nav-tabs pull-right">
            <li class="active">
                <a data-toggle="tab" href="#home-3">
                    <i class="icon-home"></i>
                    基本信息
                </a>
            </li>
            <li class="">
                <a data-toggle="tab" href="#about-3">
                    <i class="icon-user"></i>
                    客户订单
                </a>
            </li>
            <li class="">
                <a data-toggle="tab" href="#contact-3">
                    <i class="icon-envelope"></i>
                    Contact
                </a>
            </li>
        </ul>
        <span class="hidden-sm wht-color">{{$customer->custom_name}}</span>
    </header>
    <div class="panel-body">
        <div class="tab-content">
            <div id="home-3" class="tab-pane active">
              <div id="profile" class="tab-pane">
                <section class="panel">
                  <div class="bio-graph-heading">
                    基本信息
                  </div>
                  <div class="panel-body bio-graph-info">
                      <h1>{{$customer->custom_name}}</h1>
                      <div class="row">
                          <div class="bio-row">
                              <p><span>公司名称</span>{{$customer->cop}}</p>
                          </div>
                          <div class="bio-row">
                              <p><span>公司地址</span>{{$customer->address}}</p>
                          </div>
                          <div class="bio-row">
                              <p><span>联系方式</span>{{$customer->phone}}</p>
                          </div>
                          <div class="bio-row">
                              <p><span>邮编</span>{{$customer->post}}</p>
                          </div>
                          <div class="bio-row">
                              <p><span>公司法人</span>{{$customer->legal_person}}</p>
                          </div>
                          <div class="bio-row">
                              <p><span>法人身份证</span>{{$customer->legal_card}}</p>
                          </div>
                          <div class="bio-row">
                              <p><span>营业执照</span><a a href="#myModal-yingye" data-toggle="modal"><img src="{{$customer->business_pic}}" alt="" width="150px"></a></p>
                          </div>
                          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-yingye" class="modal fade">
                              <div class="modal-dialog" width="800px">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                          <h4 class="modal-title">营业执照</h4>
                                      </div>
                                      <div class="modal-body">
                                          <img src="{{$customer->business_pic}}" alt="" width="100%">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="bio-row">
                              <p><span>设备总数</span>{{count($device)}}台&nbsp;&nbsp;&nbsp;&nbsp;<span>
                              <a href="#myModal" data-toggle="modal" class="btn btn-info">
                                  查看详情
                              </a>
                              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                              <h4 class="modal-title">设备列表</h4>
                                          </div>
                                          <div class="modal-body" style="overflow-y:auto;height:400px">
                                              <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th>编号</th>
                                                    <th>配置</th>
                                                    <th>购买时间</th>
                                                    <th>状态</th>
                                                    <th>到期时间</th>
                                                    <th>操作</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($device as $v)
                                                <tr>
                                                  <td style="vertical-align:middle">{{$v->mid}}</td>
                                                  <td>
                                                    cpu:{{$v->cpu}}<br/>
                                                    内存:{{$v->memory}}<br/>
                                                    硬盘:{{$v->disk}}<br/>
                                                    操作系统:{{$v->system}}<br/>
                                                    显卡:{{$v->video_card}}<br/>
                                                  </td>
                                                  <td style="vertical-align:middle">{{date('Y/m/d',$v->buytime)}}</td>
                                                  <td style="vertical-align:middle">
                                                    @if($v->state == 1)
                                                    试用中
                                                    @elseif($v->state == 2 && $v->usestate == 1)
                                                    计费中
                                                    @elseif($v->state == 2 && $v->usestate == 2)
                                                    已报修
                                                    @elseif($v->state == 2 && $v->usestate == 3)
                                                    已报废
                                                    @endif
                                                  </td>
                                                  <td style="vertical-align:middle">{{date('Y/m/d',$v->expiretime)}}</td>
                                                  <td style="vertical-align:middle">
                                                    <a href="#">查看</a>
                                                  </td>
                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              </span></p>
                          </div>
                      </div>
                  </div>
                </section>
                  <section>
                      <div class="row">
                      </div>
                  </section>
              </div>
            </div>
            <div id="about-3" class="tab-pane">
              <table class="table table-hover">
                <thead>
                <tr>
                    <th>订单编号</th>
                    <th>下单时间</th>
                    <th>配置详情</th>
                    <th>数量</th>
                    <th>购买时长</th>
                    <th>总金额(元)</th>
                    <th>订单状态</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order as $v)
                <tr>
                  <td style="vertical-align:middle">{{$v->order_name}}</td>
                  <td style="vertical-align:middle">{{date('Y-m-d H:i:s',$v->sq_time)}}</td>
                  <td style="vertical-align:middle">
                    CPU:{{$v->cpu}}<br/>
                    内存:{{$v->memory}}<br/>
                    硬盘:{{$v->disk}}<br/>
                    操作系统:{{$v->system}}<br/>
                    显卡:{{$v->video_card}}<br/>
                  </td>
                  <td style="vertical-align:middle">{{$v->num}}</td>
                  <td style="vertical-align:middle">{{$v->month}}</td>
                  <td style="vertical-align:middle">{{$v->total}}</td>
                  <td style="vertical-align:middle">
                    @if($v->state == 1)
                    申请中
                    @elseif($v->state == 2)
                    已分配
                    @endif
                  </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            <div align="center">{{$order->render()}}</div>
            </div>
            <div id="contact-3" class="tab-pane">Contact</div>
        </div>
    </div>
</section>
@stop