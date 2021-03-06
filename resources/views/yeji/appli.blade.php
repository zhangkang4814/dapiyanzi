@extends('layouts.default')
@section('title','后台首页')
@section('content')

		  <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-table"></i> Table</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="/yeji">当前业绩</a></li>					
						<li><i class="fa fa-th-list"></i><a href="/appli">申请结算的业绩</a></li>
						<li><i class="fa fa-table"></i><a href="/lishiyeji">历史业绩</a></li>
					</ol>
				</div>
			</div>
              <!-- page start-->
              
              
              
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              业绩表
                          </header>
                          <div class="table-responsive">
                            <table class="table">
                              <thead>
                              @foreach($appli as $row)
                                <tr>
                                  <th>姓名</th>
              							      <th>身份</th>   
              							      <th>提成</th>
              							      <th>价格</th>
              							      <!-- <th>操作</th> -->
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>{{$row->name}}</td>
                                  <td>{{$row->auth}}</td>
                                  <td>{{$row->proportions}}</td>
                                  <td>{{$row->price}}</td>
                                  <td>
	                                  <div class="btn-group">
	                                      <!-- <a class="btn btn-primary" href="#" title="查看业绩"><i class="icon_plus_alt2"></i></a> -->
	                                      <!-- <a class="btn btn-success" href="" title="查看个人业绩"><i class="icon_check_alt2"></i></a> -->
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