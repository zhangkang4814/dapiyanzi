@extends('layouts.default')
@section('title','设备列表')
@section('content')
    <div class="row"> 
   <div class="col-lg-12"> 
    <h3 class="page-header"><i class="fa fa-files-o"></i> 添加配置</h3> 
    <ol class="breadcrumb"> 
     <li><i class="fa fa-home"></i><a href="/">首页</a></li> 
     <li><i class="fa fa-files-o"></i>添加配置</li> 
    </ol> 
   </div> 
  </div> 
  <!-- Form validations --> 
  <div class="row"> 
   <div class="col-lg-12"> 
    <section class="panel"> 
     <header class="panel-heading">
       添加配置
     </header> 
     <div class="panel-body"> 
      <div class="form"> 
       <form class="form-validate form-horizontal" id="feedback_form" method="POST" action="{{ route('config.store') }}"> 
           {{ csrf_field() }}
        <div class="form-group "> 
         <label for="cname" class="control-label col-lg-2">CPU： <span class="required">*</span></label> 
         <div class="col-lg-10"> 
          <input class="form-control" id="cname" name="cpu" type="text" required="" value="{{ old('cpu') }}"/> 
         </div> 
        </div> 
        <div class="form-group "> 
         <label for="cemail" class="control-label col-lg-2">内存： <span class="required">*</span></label> 
         <div class="col-lg-10"> 
          <input class="form-control " id="cemail" type="text" name="memory" required="" value="{{ old('memory') }}"/> 
         </div> 
        </div> 
        <div class="form-group "> 
         <label for="cname" class="control-label col-lg-2">硬盘大小： <span class="required">*</span></label> 
         <div class="col-lg-10"> 
          <input class="form-control" id="subject" name="disk" value="{{ old('disk') }}" type="text" required="" /> 
         </div> 
        </div> 
        <div class="form-group "> 
         <label for="ccomment" class="control-label col-lg-2">操作系统：<span class="required">*</span></label> 
         <div class="col-lg-10"> 
          <input class="form-control " id="ccomment" name="system" required="" value="{{ old('system') }}" type="text">
         </div> 
        </div> 
        <div class="form-group "> 
         <label for="cname" class="control-label col-lg-2">显卡： <span class="required">*</span></label> 
         <div class="col-lg-10"> 
          <input class="form-control" id="subject" name="video_card" value="{{ old('video_card') }}" type="text" required="" /> 
         </div> 
        </div>
        <div class="form-group "> 
         <label for="cname" class="control-label col-lg-2">单价： <span class="required">*</span></label> 
         <div class="col-lg-10"> 
          <input class="form-control" id="subject" name="price" value="{{ old('price') }}" type="text" required="" /> 
         </div> 
        </div>  
        <div class="form-group"> 
         <div class="col-lg-offset-2 col-lg-10"> 
          <button class="btn btn-primary" type="submit">添加</button> 
         </div> 
        </div> 
       </form> 
      </div> 
     </div> 
    </section> 
   </div> 
</div>
@stop