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
  @if(count($path)>0)
  <a id="shengqing" class="btn btn-primary" style="margin-right:5px;">结算中</a>
  @else
  <a id="shengqing" class="btn btn-primary" href="/app"  onClick="return confirm('确定结算?')" title="申请结算业绩" style="margin-right:5px;">申请结算</a>
  @endif
  <a class="btn btn-primary" style="margin-right:5px;">我的提成所得￥{{$kena}}</a>
  <a class="btn btn-primary" style="margin-right:5px;">我的下级提成总所得￥{{$allxiaji->countextract}}</a><br/>
  
  <div class="row">
      <div class="col-lg-12">
          <section class="panel">
              <header class="panel-heading">
                  业绩表
              </header>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                  @foreach($yeji as $row)
                    <tr>
                      <th>姓名</th>
        				      <th>身份</th>   
        				      <th>提成比例(%)</th>
        				      <th>价格</th>
                      <th>手下提成</th>
        				      <th>操作</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{$row->name}}</td>
                      <td>{{$row->auth}}</td>
                      <td>{{$row->proportions}}</td>
                      <td>{{$row->price}}</td>
                      <td><?php echo ($row->price*$row->proportions)/100 ?></td>
                      <td>
                          <div class="btn-group">
                              <!-- <a class="btn btn-primary" href="/app/{{$row->id}}"  onClick="return confirm('确定结算?')" title="申请结算业绩" style="margin-right:3px;">申请结算</a> -->
                              <a class="btn btn-success" href="/yejichaxun/{{$row->id}}" title="查看个人业绩"><i class="icon_search"></i></a>
                              <!-- <a class="btn btn-danger" href="/app/{{$row->id}}" title="申请结算业绩"><i class="icon_check_alt2"></i></a> -->
                          </div>
                      </td>
                    </tr>
					
				@endforeach
                  </tbody>
                </table>
              </div>
				
          </section>
          <script type="text/javascript">
          
          	document.getElementById("shengqing").disabled=ture;
          </script>
      </div>
  </div>
    
     
@endsection