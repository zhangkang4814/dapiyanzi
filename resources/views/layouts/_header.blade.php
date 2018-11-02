<header class="header dark-bg">
    <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"></div>
    </div>

    <!--logo start-->
    <a href="/" class="logo">我骗子 <span class="lite">打钱</span></a>
    <!--logo end-->
    <div class="top-nav notification-row">                
        <!-- notificatoin dropdown start-->
        <ul class="nav pull-right top-menu">
            <!-- alert notification end-->
            <!-- user login dropdown start-->
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <span class="username">{{session('userinfo')->name}}</span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout">
                    <div class="log-arrow-up"></div>
                    <li class="eborder-top">
                        <a href="/user/show"><i class="icon_profile"></i>个人中心</a>
                    </li>
                    <li>
                        <a href="/admin/loginout"><i class="icon_key_alt"></i>退出登录</a>
                    </li>
                </ul>
            </li>
            <!-- user login dropdown end -->
        </ul>
        <!-- notificatoin dropdown end-->
    </div>
</header>  
    <!--header end-->

<!--sidebar start-->
<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
            <li class="active">
                <a class="" href="/">
                    <i class="icon_house_alt"></i>
                    <span>首页</span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="javascript:;" class="">
                    <i class="icon_table"></i>
                    <span>设备管理</span>
                    <span class="menu-arrow arrow_carrot-right"></span>
                </a>
                <ul class="sub">
                    <li><a class="" href="{{ route('device.index') }}">设备列表</a></li>
                    <li><a class="" href="{{ route('add') }}">设备添加</a></li>
                    <li><a class="" href="{{ route('de_order') }}">设备分配</a></li>
                    <li><a class="" href="{{ route('device.fp') }}">分配列表</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;" class="">
                    <i class="icon_desktop"></i>
                    <span>客户中心</span>
                    <span class="menu-arrow arrow_carrot-right"></span>
                </a>
                <ul class="sub">
                    <li><a class="" href="">选择设备</a></li>
                    <li><a class="" href="buttons.html">我的设备</a></li>
                    <li><a class="" href="grids.html">交易记录</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a class="" href="{{ route('config.index') }}">
                    <i class="icon_genius"></i>
                    <span>添加配置</span>
                </a>
            </li>               
             
            <li class="sub-menu">
                <a href="javascript:;" class="">
                    <i class="icon_table"></i>
                    <span>用户管理</span>
                    <span class="menu-arrow arrow_carrot-right"></span>
                </a>
                <ul class="sub">
                    <li><a class="" href="{{route('user')}}">用户列表</a></li>
                    <li><a class="" href="{{route('usercreate')}}">添加用户</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:;" class="">
                    <i class="icon_table"></i>
                    <span>客户管理</span>
                    <span class="menu-arrow arrow_carrot-right"></span>
                </a>
                <ul class="sub">
                    <li><a class="" href="{{route('customer')}}">客户列表</a></li>
                    <li><a class="" href="{{route('customerCreate')}}">添加客户</a></li>
                </ul>
            </li>

             <li class="sub-menu">
                <a href="javascript:;" class="">
                    <i class="icon_table"></i>
                    <span>结算管理</span>
                    <span class="menu-arrow arrow_carrot-right"></span>
                </a>
                <ul class="sub">
                    <!-- <li><a class="" href="/ht_settlement">申请结算</a></li> -->
                    <li><a class="" href="/sqjs">结算申请</a></li>
                    <li><a class="" href="/history">历史结算记录表</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:;" class="">
                    <i class="icon_document_alt"></i>
                    <span>业绩管理</span>
                    <span class="menu-arrow arrow_carrot-right"></span>
                </a>
                <ul class="sub">
                    <li><a class="" href="/yeji">业绩表</a></li>                          
                </ul>
            </li> 
            
            <li class="sub-menu">
                <a href="javascript:;" class="">
                    <i class="icon_table"></i>
                    <span>系统设置</span>
                    <span class="menu-arrow arrow_carrot-right"></span>
                </a>
                <ul class="sub">
                    <li><a class="" href="{{route('useradd')}}">添加通知</a></li>
                    <li><a class="" href="{{route('user_show')}}">历史通知记录</a></li>
                </ul>
            </li>
            
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->