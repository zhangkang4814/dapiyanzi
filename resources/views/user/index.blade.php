@extends('layouts.default')
@section('title','后台首页')
@section('content')
<div class="row"> 
   <div class="col-lg-12"> 
    <h3 class="page-header"><i class="fa fa-files-o"></i> 用户列表</h3> 
    <ol class="breadcrumb"> 
     <li><i class="fa fa-home"></i><a href="/">首页</a></li> 
     <li><i class="icon_document_alt"></i>用户管理</li> 
     <li><i class="fa fa-files-o"></i>用户列表</li> 
    </ol> 
   </div> 
  </div> 
  <div class="row">
      <div class="col-lg-12">
          <section class="panel">
              <header class="panel-heading">
                  用户列表
              </header>
              
              <table class="table table-striped table-advance table-hover">
               <tbody>
                  <tr>
						<th>姓名</th>
						<th>公司名称</th>
						<th>身份证号</th>
						<th>手机号</th>
						<th>地址</th>
						<th>区域</th>
						<th>QQ号</th>
						<th>银行卡号</th>
						<th>用户身份</th>
						<th>分成比例(%)</th>
						<th>操作</th>
                  </tr>
				  @foreach($user as $v)
                  <tr class="userinfo">
                  		<td class="info" name="name">{{$v->name}}</td>
						<td class="info" style="display:none">{{$v->id}}</td>
						<td class="info" name="cop">{{$v->cop}}</td>
						<td class="info" name="id_card">{{$v->id_card}}</td>
						<td class="info" name="phone">{{$v->phone}}</td>
						<td class="info" name="address">{{$v->address}}</td>
						<td class="info" name="area">{{$v->area}}</td>
						<td class="info" name="qq">{{$v->qq}}</td>
						<td class="info" name="bank_card">{{$v->bank_card}}</td>
						<td class="info">
						@if($v->auth==1)
						代理商
						@elseif($v->auth==2)
						经销商
						@else
						业务员
						@endif
						</td>
						<td class="info" name="proportions">{{$v->proportions}}</td>
                     	<td>
                        <div class="btn-group">
                          @if($v->son)
                          <a class="btn btn-info" href="/user/grade?id={{$v->id}}">下级</a>
                          @endif
                          @if(session('user')->uid!=$v->id)
                          <a class="btn btn-primary" href="/user/edit?id={{$v->id}}">修改</a>
                          <a class="btn btn-danger del" href="javascript:void(0)">删除</a>
                          @endif
                        </div>
                        </td>
                  </tr>
            	  @endforeach
            	  <tr>
            	  	<td colspan="13" align="right">
                          <a class="btn btn-success" href="/user/create">添加</a>
                          <a class="btn btn-success back" href="javascript:void(0)">返回</a>
            	  	</td>
            	  </tr>                        
               </tbody>
               
               <script>
               	$(".del").click(function(){
					del = $(this);
					id = del.parents('tr').find('td:first').html();
					$.ajax({
						type:"post",
						dataType:'json',
						data:{'_method':'post','_token':'{{csrf_token()}}','id':id},
						url:'/user/destroy',
						success:function(data){
									if(data==1){
										alert('删除成功');
										del.parents('tr').remove();
									}else if(data==2){
										alert('该用户下有子用户存在，无法直接删除');
									}
								}
					});
				});


				$(".info").dblclick(function(){
					user = $(this);
					if(user.attr('name')){
						info=user.html();
						if(info=='<input type="text">'){
							info='';
						}
						input=$("<input type='text'>");
						user.empty();
						input.val(info);
						user.append(input);
						input.blur(function(){
							id=$(this).parents('tr').find('td:first').html();
							newInfo=$(this).val();
							var type = $(this).parents('td').attr('name');
							$.ajax({
								type:'post',
								dataType:'json',
								data:{'_method':'post','_token':'{{csrf_token()}}','id':id,'info':newInfo,'type':type},
								url:'/user/update',
								success:function(data){
											if(data==1){
												alert('修改成功');
												user.html(newInfo);
											}else{
												alert('修改失败');
												user.html(info);
											}
										}
							});
						});
					}
				});


				//返回上一级
				$('.back').click(function(){
					history.back(-1);
				});
               </script>
            </table>
            <div align="center">
            {{$users->render()}}
            </div>
          </section>
      </div>
  </div>
@stop