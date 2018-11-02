@extends('layouts.default')
@section('title','后台首页')
@section('content')
<div class="row"> 
   <div class="col-lg-12"> 
    <h3 class="page-header"><i class="fa fa-files-o"></i> 用户修改</h3> 
    <ol class="breadcrumb"> 
     <li><i class="fa fa-home"></i><a href="/">首页</a></li> 
     <li><i class="icon_document_alt"></i>用户管理</li> 
     <li><i class="fa fa-files-o"></i>用户修改</li> 
    </ol> 
   </div> 
  </div> 
<div class="row">
  <div class="col-lg-12">
      <section class="panel">
          <header class="panel-heading">
              用户修改
          </header>
          <div class="panel-body">
              <div class="form">
                  <form class="form-validate form-horizontal" id="insertuser" action="/user/update"method="post">  
                      {{ csrf_field() }}
                      <div class="form-group ">
                          <label for="cname" class="control-label col-lg-2">姓名<span class="required">*</span></label>
                          <div class="col-lg-8">
                              <input class="form-control" id="subject" name="name" type="text" value="{{$user->name}}"  required />
                              <input type="hidden" name="id" value="{{$user->id}}" />
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-lg-2">用户身份*</label>
                            <div class="col-lg-8">
                            <select name="auth" class='form-control'>
                              <option value="-1">请选择</option>
                              @if($user->auth == 0)
                              <option value="0" 
                              @if($login->role==0)
                              selected
                              @endif
                              >管理员</option>
                              @endif
                              <option value="1"
                              @if($user->auth==1)
                              selected
                              @endif
                              >代理商</option>
                              @if(session('user')->role < 2)
                              <option value="2"
                              @if($user->auth==2)
                              selected
                              @endif
                              >经销商</option>
                              @endif
                              @if(session('user')->role < 3)
                              <option value="3"
                              @if($user->auth==3)
                              selected
                              @endif
                              >业务员</option>
                              @endif
                            </select>
                            </div>
                        </div>
                        @if(session('user')->role == 0)
                        <input type="hidden" name="father" value="{{session('user')->uid}}">
                        @else
                        <div class="form-group">
                          <label class="control-label col-lg-2">上级用户*</label>
                          <div class="col-lg-8">
                             <input type="text" name="father" id="" class="form-control" value="{{session('user')->uid}}" disabled>
                             <input type="hidden" name="father" value="{{session('user')->uid}}">
                             <span></span>
                          </div>
                        </div>
                        @endif
                      <div class="form-group user">
                          <label for="cemail" class="control-label col-lg-2">公司名称<span class="required">*</span></label>
                          <div class="col-lg-8">
                              <input class="form-control " id="cemail" type="text" name="cop" value="{{$user->cop}}"  required />
                          </div>
                      </div>
                      <div class="form-group user">
                          <label for="curl" class="control-label col-lg-2">身份证号<span class="required">*</span></label>
                          <div class="col-lg-8">
                              <input class="form-control " id="curl" type="text" name="id_card" value="{{$user->id_card}}"  required/>
                          </div>
                      </div>                                      
                      <div class="form-group user">
                          <label for="ccomment" class="control-label col-lg-2">手机号<span class="required">*</span></label>
                          <div class="col-lg-8">
                              <input class="form-control" id="subject" name="phone" minlength="5" type="text" value="{{$user->phone}}" required />
                          </div>
                      </div>
                      <div class="form-group user">
                          <label for="ccomment" class="control-label col-lg-2">地址<span class="required">*</span></label>
                          <div class="col-lg-8">
                              <input class="form-control" id="subject" name="address"  type="text" value="{{$user->address}}" required />
                          </div>
                      </div>
                      <div class="form-group user">
                          <label for="ccomment" class="control-label col-lg-2">QQ号</label>
                          <div class="col-lg-8">
                              <input class="form-control" id="subject" name="qq" minlength="5" type="text" value="{{$user->qq}}" />
                          </div>
                      </div>
                      <div class="form-group user">
                          <label for="ccomment" class="control-label col-lg-2">银行卡号<span class="required">*</span></label>
                          <div class="col-lg-8">
                              <input class="form-control" id="subject" name="bank_card" minlength="5" type="text" value="{{$user->bank_card}}" required />
                          </div>
                      </div>
                      <div class="form-group user">
                          <label for="ccomment" class="control-label col-lg-2">区域<span class="required">*</span></label>
                          <div class="col-lg-8">
                              <input class="form-control" id="subject" name="area"  type="text" value="{{$user->area}}"  required />
                          </div>
                      </div>
                      <div class="form-group user">
                          <label for="ccomment" class="control-label col-lg-2">分成比例<span class="required">*</span></label>
                          <div class="col-lg-8">
                              <input class="form-control" id="subject" name="proportions"  type="number" value="{{$user->proportions}}" required />
                          </div>
                      </div>
                      <div class="form-group" id="usersubimit">
                          <div class="col-lg-offset-2 col-lg-8">
                              <button class="btn btn-primary" type="submit">修改</button>
                              <a class="btn btn-default cancel" href="javascript:void(0)">取消</a>
                          </div>
                      </div>     
                  </form>
                  <script>
                    $('select[name="auth"]').change(function(){
                        auth = $(this).val();
                        console.log(auth);
                        if(auth==0){
                        console.log($('#user'));
                          $('.user').insertAfter($('#insertuser')).css('display','none');
                        }else{
                          $('.user').insertBefore($('#usersubimit')).css('display','block');
                        }
                    });
                    
                    $('#insertuser').submit(function(){
                      val = $('select[name="auth"]').val();
                      if(val==-1){
                        alert('请选择用户身份');
                        return false;
                      }
                    });
                    
                    $('.cancel').click(function(){
                      history.back(-1);
                    });
                  </script>
              </div>
          </div>
      </section>
  </div>
</div>
@stop