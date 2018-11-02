@extends('layouts.default')
@section('title','后台首页')
@section('content')
<div class="row"> 
   <div class="col-lg-12"> 
    <h3 class="page-header"><i class="fa fa-files-o"></i> 添加客户</h3> 
    <ol class="breadcrumb"> 
     <li><i class="fa fa-home"></i><a href="/">首页</a></li> 
     <li><i class="icon_document_alt"></i>客户管理</li> 
     <li><i class="fa fa-files-o"></i>添加客户</li> 
    </ol> 
   </div> 
  </div> 
<div class="row">
  <div class="col-lg-12">
      <section class="panel">
          <header class="panel-heading">
              客户添加
          </header>
          <div class="panel-body">
              <div class="form">
                  <form class="form-validate form-horizontal" id="insertcustomer" action="/customer/store" method="post" enctype="multipart/form-data">	
                      {{ csrf_field() }}
                      <div class="form-group ">
                          <label for="cname" class="control-label col-lg-2">用户名<span class="required">*</span></label>
                          <div class="col-lg-8">
                              <input class="form-control" id="cname" name="username" minlength="5" type="text" required />
                          </div>
                      </div>
                      <div class="form-group ">
                          <label for="ccomment" class="control-label col-lg-2">用户密码<span class="required">*</span></label>
                          <div class="col-lg-8">
                              <input class="form-control" id="subject" name="password" minlength="5" type="text" required />
                          </div>
                      </div>
                      <div class="form-group ">
                          <label for="cname" class="control-label col-lg-2">姓名<span class="required">*</span></label>
                          <div class="col-lg-8">
                              <input class="form-control" id="subject" name="custom_name" type="text" required />
                          </div>
                      </div>
                      <div class="form-group user">
                          <label for="cemail" class="control-label col-lg-2">公司名称<span class="required">*</span></label>
                          <div class="col-lg-8">
                              <input class="form-control " id="cemail" type="text" name="cop" required />
                          </div>
                      </div>                                     
                      <div class="form-group user">
                          <label for="ccomment" class="control-label col-lg-2">手机号<span class="required">*</span></label>
                          <div class="col-lg-8">
                              <input class="form-control" id="subject" name="phone" minlength="5" type="text" required />
                          </div>
                      </div>
                      <div class="form-group user">
                          <label for="ccomment" class="control-label col-lg-2">地址<span class="required">*</span></label>
                          <div class="col-lg-8">
                              <input class="form-control" id="subject" name="address"  type="text" required />
                          </div>
                      </div>
                      <div class="form-group user">
                          <label for="ccomment" class="control-label col-lg-2">邮编<span class="required">*</span></label>
                          <div class="col-lg-8">
                              <input class="form-control" id="subject" name="post"  type="text" required />
                          </div>
                      </div>
                      <div class="form-group user">
                          <label for="ccomment" class="control-label col-lg-2">公司法人<span class="required">*</span></label>
                          <div class="col-lg-8">
                              <input class="form-control" id="subject" name="legal_person"  type="text" />
                          </div>
                      </div>
                      <div class="form-group user">
                          <label for="curl" class="control-label col-lg-2">法人身份证号<span class="required">*</span></label>
                          <div class="col-lg-8">
                              <input class="form-control " id="curl" type="text" name="legal_card" required/>
                          </div>
                      </div> 
                      <div class="form-group user">
                          <label for="curl" class="control-label col-lg-2">营业执照<span class="required">*</span></label>
                          <div class="col-lg-8">
                              <input id="business_pic" type="file" name="business_pic" onchange="showPreview(this)" required/>
                              <img id="portrait" src="" style="display:none;" />
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="col-lg-offset-2 col-lg-8" id="customersubimit">
                              <button class="btn btn-primary" type="submit">添加</button>
                              <a class="btn btn-default" href="/customer">取消</a>
                          </div>
                      </div>     
                  </form>
                  <script>
                    function showPreview(source) {
                      var file = source.files[0];
                      if(window.FileReader) {
                          var fr = new FileReader();
                          console.log(fr);
                          var portrait = document.getElementById('portrait');
                          fr.onloadend = function(e) {
                            portrait.src = e.target.result;
                          };
                          fr.readAsDataURL(file);
                          portrait.style.display = 'block';
                      }
                    }
                  </script>
              </div>
          </div>
      </section>
  </div>
</div>
@stop