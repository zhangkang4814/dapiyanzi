@extends('layouts.default')
@section('title','后台首页')
@section('content')
<div class="row"> 
   <div class="col-lg-12"> 
    <h3 class="page-header"><i class="fa fa-files-o"></i> 客户列表</h3> 
    <ol class="breadcrumb"> 
     <li><i class="fa fa-home"></i><a href="/">首页</a></li> 
     <li><i class="icon_document_alt"></i>客户管理</li> 
     <li><i class="fa fa-files-o"></i>客户列表</li> 
    </ol> 
   </div> 
  </div> 
  <div class="row">
      <div class="col-lg-12">
          <section class="panel">
              <header class="panel-heading">
                  客户列表
              </header>
              
              <table class="table table-striped table-advance table-hover">
               <tbody>
                  <tr>
                     	<th>客户编号</th>
						<th>公司名称</th>
						<th>地址</th>
						<th>姓名</th>
						<th>手机号</th>
						<th>邮编</th>
						<th>公司法人</th>
						<th>法人身份证</th>
						<th>营业执照</th>
						<th>操作</th>
                  </tr>
				  @foreach($customer as $v)
                  <tr class="userinfo">
						<td class="info">{{$v->cid}}</td>
						<td class="info" name="cop">{{$v->cop}}</td>
						<td class="info" name="id_card">{{$v->address}}</td>
						<td class="info" name="name">{{$v->custom_name}}</td>
						<td class="info" name="phone">{{$v->phone}}</td>
						<td class="info" name="address">{{$v->post}}</td>
						<td class="info" name="qq">{{$v->legal_person}}</td>
						<td class="info" name="bank_card">{{$v->legal_card}}</td>
						<td class="info"><img width="150px" src="{{$v->business_pic}}" alt=""></td>
                     	<td>
                        <div class="btn-group">
                          <a class="btn btn-primary" href="{{ route('customerCreate') }}">添加</a>
                          <a class="btn btn-success" href="/customer/edit?id={{$v->cid}}">修改</a>
                          <a class="btn btn-danger del" href="javascript:void(0)">删除</a>
                        </div>
                        </td>
                  </tr>
            	  @endforeach                        
               </tbody>
               
               <script>
               	$(".del").click(function(){
					del = $(this);
					id = del.parents('tr').find('td:first').html();
					$.ajax({
						type:"post",
						dataType:'json',
						data:{'_method':'post','_token':'{{csrf_token()}}','id':id},
						url:'/customer/destroy',
						success:function(data){
									if(data==1){
										alert('删除成功');
										del.parents('tr').remove();
									}
								}
					});
				});


				// $(".info").dblclick(function(){
				// 	user = $(this);
				// 	if(user.attr('name')){
				// 		info=user.html();
				// 		if(info=='<input type="text">'){
				// 			info='';
				// 		}
				// 		input=$("<input type='text'>");
				// 		user.empty();
				// 		input.val(info);
				// 		user.append(input);
				// 		input.blur(function(){
				// 			id=$(this).parents('tr').find('td:first').html();
				// 			newInfo=$(this).val();
				// 			var type = $(this).parents('td').attr('name');
				// 			$.ajax({
				// 				type:'post',
				// 				dataType:'json',
				// 				data:{'_method':'post','_token':'{{csrf_token()}}','id':id,'info':newInfo,'type':type},
				// 				url:'/user/update',
				// 				success:function(data){
				// 							if(data==1){
				// 								alert('修改成功');
				// 								user.html(newInfo);
				// 							}else{
				// 								alert('修改失败');
				// 								user.html(info);
				// 							}
				// 						}
				// 			});
				// 		});
				// 	}
				// });

               </script>
            </table>
            <div align="center">
            {{$customer->render()}}
            </div>
          </section>
      </div>
  </div>
@stop