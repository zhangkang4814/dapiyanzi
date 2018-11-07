@extends('layouts.default')
@section('title','后台首页')
@section('content')
<div class="row"> 
   <div class="col-lg-12"> 
    <h3 class="page-header"><i class="fa fa-files-o"></i> 用户中心</h3> 
    <ol class="breadcrumb"> 
     <li><i class="fa fa-home"></i><a href="/">首页</a></li> 
     <li><i class="icon_document_alt"></i>用户中心</li>  
    </ol> 
   </div> 
  </div> 
   <div class="row">
    <!-- profile-widget -->
    <div class="col-lg-12">
        <div class="profile-widget profile-widget-info">
              <div class="panel-body">
                <div class="col-lg-2 col-sm-2">
                  <h4>{{$users->name}}</h4>  
                  <div class="follow-ava">
                    <img src="/admin/img/faceimg.png" alt="">
                  </div>             
                </div>
                <div class="col-lg-4 col-sm-4 follow-info">
                    <p>{{$users->cop}}</p>
                    <p>{{$users->address}}</p>
					<p><i class="fa fa-phone">{{$users->phone}}</i></p>
                    <h6>
                        <span><i class="icon_clock_alt"></i>{{date('H:i:s',time())}}</span>
                        <span><i class="icon_calendar"></i>{{date('Y/m/d',time())}}</span>
                        <span><i class="icon_pin_alt"></i>{{$users->area}}</span>
                    </h6>
                </div>
                <div class="col-lg-2 col-sm-6 follow-info weather-category">
                	<a href="#myModal-js" style="color:#fff" data-toggle="modal">
                          <ul>
                              <li class="active">
                                  
                                  <i class="fa fa-database fa-2x"> </i><br>
								  
								                    结算记录
                              </li>
                          </ul>
                    </a>
                </div>
                <div class="col-lg-2 col-sm-6 follow-info weather-category" style="margin-left:20px">
                  <a href="#myModal-yeji" style="color:#fff" data-toggle="modal">
                          <ul>
                              <li class="active">
                                  
                                  <i class="fa fa-tasks fa-2x"> </i><br>
                  
                                    查看业绩
                              </li>
                          </ul>
                    </a>
                </div>
              </div>
        </div>
    </div>
  </div>
  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-js" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">结算记录</h4>
            </div>
            <div class="modal-body" style="overflow-y:auto;height:400px">
              @if(count($settlement))
              @foreach($settlement as $v)
              <div id="recent-activity" class="tab-pane active">
                  <div class="profile-activity">                                          
                      <div class="act-time">                                      
                          <div class="activity-body act-in">
                              <span class="arrow"></span>
                              <div class="text">
                                  <a href="#" class="activity-img"></a>
                                  <p class="attribution">{{date('H:i:s Y/m/d',$v->time)}}</p>
                                  <p>{{$users->name}} 结算金额 人民币{{$v->price}}元 (已结清)</p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              @endforeach
              @else
              <span class="arrow"></span>
              <div class="text">
                  <a href="#" class="activity-img"></a>
                  <p class="attribution">暂无记录!!!</p>
              </div>
              @endif
            </div>
        </div>
    </div>
</div>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-yeji" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">业绩表</h4>
            </div>
            <div class="modal-body" style="overflow-y:auto;height:400px">
              @if(count($yeji))
              <table class="table table-hover">
                <thead>
                <tr>
                    <th>用户名</th>
                    <th>业绩额(元)</th>
                    <th>提成比例(%)</th>
                    <th>是否提现</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($yeji as $v)
                <tr>
                    <td>{{$users->name}}</td>
                    <td>{{$v->price}}</td>
                    <td>{{$v->proportions}}(%)</td>
                    <td>
                      @if($v->state==0)
                      未提现
                      @elseif($v->state==1)
                      已申请提现
                      @else
                      已提现完成
                      @endif
                    </td>
                    <td><a href="#" >查看</a></td>
                </tr>
                @endforeach
                </tbody>
              </table>
              @else
              <div align="center">暂无记录!!!</div>
              @endif
            </div>
        </div>
    </div>
</div>
  <!-- page start-->
  <div class="row">
     <div class="col-lg-12">
        <section class="panel">
              <header class="panel-heading tab-bg-info">
                  <ul class="nav nav-tabs">
                      <li class="active">
                          <a data-toggle="tab" href="#profile">
                              <i class="icon-user"></i>
                              用户信息
                          </a>
                      </li>
                  </ul>
              </header>
              <div class="panel-body">
                  <div class="tab-content">
                    <div id="recent-activity" class="tab-pane active">
                      <div class="profile-activity">                                          
                          <div class="act-time">                                      
                              <div id="profile" class="tab-pane">
                                <section class="panel">
                                  <div class="bio-graph-heading">
                                            广告位
                                  </div>
                                  <div class="panel-body bio-graph-info">
                                      <h1>{{$users->name}}</h1>
                                      <div class="row">
                                          <div class="bio-row">
                                              <p><span>公司地址</span>{{$users->address}}</p>
                                          </div>
                                          <div class="bio-row">
                                              <p><span>区域</span>{{$users->area}}</p>
                                          </div>
                                          <div class="bio-row">
                                              <p><span>联系方式</span>{{$users->phone}}</p>
                                          </div>
                                          <div class="bio-row">
                                              <p><span>银行卡号</span>{{$users->bank_card}}</p>
                                          </div>
                                          <div class="bio-row">
                                              <p><span>身份证号</span>{{$users->id_card}}</p>
                                          </div>
                                          <div class="bio-row">
                                              <p><span>提成比例</span>{{$users->proportions}}%</p>
                                          </div>
                                          <div class="bio-row">
                                              <p><span>下级用户总数</span>{{count($son)}}人&nbsp;&nbsp;&nbsp;&nbsp;<span>
                                              @if(count($son)>0)
                                              <a href="#myModal" data-toggle="modal" class="btn btn-info">
                                                  查看详情
                                              </a>
                                              @endif
                                              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                                                  <div class="modal-dialog">
                                                      <div class="modal-content">
                                                          <div class="modal-header">
                                                              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                              <h4 class="modal-title">下级用户</h4>
                                                          </div>
                                                          <div class="modal-body" style="overflow-y:auto;height:400px">
                                                              <table class="table table-hover">
                                                                <thead>
                                                                <tr>
                                                                    <th>用户名</th>
                                                                    <th>公司名称</th>
                                                                    <th>提成比例(%)</th>
                                                                    <th>区域</th>
                                                                    <th>操作</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($son as $v)
                                                                <tr>
                                                                    <td>{{$v->name}}</td>
                                                                    <td>{{$v->cop}}</td>
                                                                    <td>{{$v->proportions}}</td>
                                                                    <td>{{$v->area}}</td>
                                                                    <td><a href="{{ route('usercheck',$v->id) }}" >查看</a></td>
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
                                          <div class="bio-row">
                                              <p><span>拥有客户总数</span>{{count($customer)}}人&nbsp;&nbsp;&nbsp;&nbsp;<span>
                                              @if(count($customer)>0)
                                              <a href="#myModal-1" data-toggle="modal" class="btn  btn-info">
                                                  查看详情
                                              </a>
                                              @endif
                                              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-1" class="modal fade">
                                                  <div class="modal-dialog">
                                                      <div class="modal-content">
                                                          <div class="modal-header">
                                                              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                              <h4 class="modal-title">客户列表</h4>
                                                          </div>
                                                          <div class="modal-body" style="overflow-y:auto;height:400px">
                                                              <table class="table table-hover">
                                                                <thead>
                                                                <tr>
                                                                    <th>客户姓名</th>
                                                                    <th>公司名称</th>
                                                                    <th>公司地址</th>
                                                                    <th>联系方式</th>
                                                                    <th>操作</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($customer as $v)
                                                                <tr>
                                                                    <td>{{$v->custom_name}}</td>
                                                                    <td>{{$v->cop}}</td>
                                                                    <td>{{$v->address}}</td>
                                                                    <td>{{$v->phone}}</td>
                                                                    <td><a href="{{ route('customcheck',$v->cid) }}">查看</a></td>
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
                      </div>
                  </div>
                      <!-- profile -->
                      
                  </div>
              </div>
          </section>
     </div>
  </div>
@stop

