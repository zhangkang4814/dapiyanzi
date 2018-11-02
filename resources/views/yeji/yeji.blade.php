@extends('layouts.default')
@section('title','后台首页')
@section('content')

     
		  <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-table"></i> Table</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="/yeji">当前业绩</a></li>
            <li><i class="fa fa-th-list"></i><a href="/appli">申请结算的业绩</a></li>
						<li><i class="fa fa-table"></i><a href="/lishigeren/{{$yeji[0]->user_id}}">个人历史业绩</a></li>
					</ol>
				</div>
			</div>
              <!-- page start-->
              
              
              
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             {{$yeji[0]->name}} 业绩表
                          </header>
                          <div class="table-responsive">
                            <table class="table">
                              <thead>
                              @foreach($yeji as $row)
                                <tr>
              							      <th>配置</th>
                                  <th>订单开始时间</th>  
                                  <th>到期时间</th> 
              							      <th>数量</th>
              							      <th>单价</th>
                                  <th>总价</th>
                                  <th>提成</th>
              							      <th>操作</th>

                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>配置{{$row->confid}}</td>
                                  <td><?php echo date('Y/m/d h:i:s',$row->starttime) ?></td>
                                  <td><?php echo date('Y/m/d h:i:s',$row->expiretime) ?></td>
                                  <td>{{$row->num}}</td>
                                  <td>{{$row->price}}</td>
                                  <td><?php echo $row->num*$row->price ?></td>
                                  <td><?php echo ($row->num*$row->price*$row->proportions)/100 ?></td>
                                  
                                  <td>
	                                  <div class="btn-group">
	                                      <!-- <a class="btn btn-primary" href="#" title="查看业绩"><i class="icon_plus_alt2"></i></a> -->
	                                      <a class="btn btn-success" href="" ><i class="icon_check_alt2"></i></a>
	                                      <!-- <a class="btn btn-danger" href="#" title="查看业绩"><i class="icon_close_alt2"></i></a> -->
	                                  </div>
                                  </td>
                                </tr>
								
							               @endforeach
                              </tbody>
                            </table>
                          </div>

                      </section>
                  </div>
              </div>
              
     
@endsection