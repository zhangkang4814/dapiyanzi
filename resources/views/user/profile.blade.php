@extends('layouts.default')
@section('title','后台首页')
@section('content')
<div class="row"> 
   <div class="col-lg-12"> 
    <h3 class="page-header"><i class="fa fa-files-o"></i> 个人中心</h3> 
    <ol class="breadcrumb"> 
     <li><i class="fa fa-home"></i><a href="/">首页</a></li> 
     <li><i class="icon_document_alt"></i>个人中心</li>  
    </ol> 
   </div> 
  </div> 
   <div class="row">
    <!-- profile-widget -->
    <div class="col-lg-12">
        <div class="profile-widget profile-widget-info">
              <div class="panel-body">
                <div class="col-lg-2 col-sm-2">
                  <h4>{{session('userinfo')->name}}</h4>  
                  <div class="follow-ava">
                    <img src="/admin/img/faceimg.png" alt="">
                  </div>             
                  <h6>
                  @if(session('user')->role==0)
				  管理员
				  @elseif(session('userinfo')->auth==1)
				  代理商
				  @elseif(session('userinfo')->auth==2)
				  经销商
				  @else
				  业务员
				  @endif
                  </h6>
                </div>
                <div class="col-lg-4 col-sm-4 follow-info">
                    <p>{{session('userinfo')->cop}}</p>
                    <p>{{session('userinfo')->address}}</p>
					<p><i class="fa fa-twitter">{{session('userinfo')->qq}}</i></p>
                    <h6>
                        <span><i class="icon_clock_alt"></i>{{date('H:i:s',time())}}</span>
                        <span><i class="icon_calendar"></i>{{date('Y/m/d',time())}}</span>
                        <span><i class="icon_pin_alt"></i>{{session('userinfo')->area}}</span>
                    </h6>
                </div>
                @if(session('user')->role!=0)
                <div class="col-lg-2 col-sm-6 follow-info weather-category">
                	<a href="#" style="color:#fff">
                          <ul>
                              <li class="active">
                                  
                                  <i class="fa fa-comments fa-2x"> </i><br>
								  
								  查看业绩
                              </li>
							   
                          </ul>
                    </a>
                </div>
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
                          <a data-toggle="tab" href="#recent-activity">
                              <i class="icon-home"></i>
                              结算记录
                          </a>
                      </li>
                      <li>
                          <a data-toggle="tab" href="#profile">
                              <i class="icon-user"></i>
                              个人信息
                          </a>
                      </li>
                  </ul>
              </header>
              <div class="panel-body">
                  <div class="tab-content">
                      <div id="recent-activity" class="tab-pane active">
                          <div class="profile-activity">                                          
                              <div class="act-time">                                      
                                  <div class="activity-body act-in">
                                      <span class="arrow"></span>
                                      <div class="text">
                                          <a href="#" class="activity-img"><img class="avatar" src="img/chat-avatar.jpg" alt=""></a>
                                          <p class="attribution"><a href="#">Jonatanh Doe</a> at 4:25pm, 30th Octmber 2014</p>
                                          <p>It is a long established fact that a reader will be distracted layout</p>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- profile -->
                      <div id="profile" class="tab-pane">
                        <section class="panel">
                          <div class="bio-graph-heading">
                                    广告位
                          </div>
                          <div class="panel-body bio-graph-info">
                              <h1>{{$user->name}}</h1>
                              <div class="row">
                                  <div class="bio-row">
                                      <p><span>姓名</span>{{$user->name}}</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>公司名称</span>{{$user->cop}}</p>
                                  </div>                                              
                                  <div class="bio-row">
                                      <p><span>公司地址</span>{{$user->address}}</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>区域</span>{{$user->area}}</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>联系方式</span>{{$user->phone}}</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>银行卡号</span>{{$user->bank_card}}</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>身份证号</span>{{$user->id_card}}</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>提成比例</span>{{$user->proportions}}%</p>
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
          </section>
     </div>
  </div>
@stop