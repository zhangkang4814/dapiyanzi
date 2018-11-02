@extends('layouts.default')
@section('title','设备添加')
@section('content')
<div class="row"> 
   <div class="col-lg-12"> 
    <h3 class="page-header"><i class="fa fa-files-o"></i> 添加设备</h3> 
    <ol class="breadcrumb"> 
     <li><i class="fa fa-home"></i><a href="/">首页</a></li> 
     <li><i class="icon_document_alt"></i>设备管理</li> 
     <li><i class="fa fa-files-o"></i>添加设备</li> 
    </ol> 
   </div> 
  </div> 
  <!-- Form validations --> 
  <div class="row"> 
   <div class="col-lg-12"> 
    <section class="panel"> 
     <header class="panel-heading">
       添加设备
     </header> 
     <div class="panel-body"> 
      <div class="form"> 
       <form class="form-validate form-horizontal" id="feedback_form" method="POST" action="{{ route('device.store') }}"> 
           {{ csrf_field() }}
        <div class="form-group "> 
         <label for="cname" class="control-label col-lg-2">生产厂家： <span class="required">*</span></label> 
         <div class="col-lg-10"> 
          <input class="form-control" id="cname" name="manufacturer" type="text" required="" value="{{ old('manufacturer') }}"/> 
         </div> 
        </div> 
        <div class="form-group "> 
         <label for="cemail" class="control-label col-lg-2">批次： <span class="required">*</span></label> 
         <div class="col-lg-10"> 
          <input class="form-control " id="cemail" type="text" name="batch" required="" value="{{ old('batch') }}"/> 
         </div> 
        </div> 
        <div class="form-group "> 
         <label for="curl" class="control-label col-lg-2">配置：</label> 
         <div class="col-lg-10">
            @foreach ($configs as $config)
                    <div class="radio">
                        <label>
                            <input type="radio" name="confid" id="optionsRadios1" value="{{ $config->id }}" checked="">
                            {{ $config->system }}-{{ $config->cpu }}-{{ $config->memory }}-{{ $config->disk }}-{{ $config->video_card }}
                        </label>
                    </div>
            @endforeach    
         </div> 
        </div> 
        <div class="form-group "> 
         <label for="cname" class="control-label col-lg-2">mac地址： <span class="required">*</span></label> 
         <div class="col-lg-10"> 
          <input class="form-control" id="subject" name="mac" value="{{ old('mac') }}" type="text" required="" /> 
         </div> 
        </div> 
        <div class="form-group "> 
         <label for="ccomment" class="control-label col-lg-2">购买时间：</label> 
         <div class="col-lg-10"> 
          <input class="form-control " id="ccomment" name="buytime" required="" value="{{ old('buytime') }}" type="datetime-local">
         </div> 
        </div> 
        <div class="form-group "> 
         <label for="cname" class="control-label col-lg-2">编号： <span class="required">*</span></label> 
         <div class="col-lg-10"> 
          <input class="form-control" id="subject" name="mid" value="{{ old('mid') }}" type="text" required="" /> 
         </div> 
        </div> 
        <div class="form-group "> 
         <label for="cname" class="control-label col-lg-2">录入人员： <span class="required">*</span></label> 
         <div class="col-lg-10"> 
          <input class="form-control" id="subject" name="op" value="{{ session('userinfo')->name }}" type="text" required="" readonly/> 
         </div> 
        </div> 
        <div class="form-group "> 
         <label for="cname" class="control-label col-lg-2">状态： <span class="required">*</span></label> 
         <div class="col-lg-10"> 
            <select class="form-control m-bot15" name="state">
                <option value="0">未分配</option>
                <option value="1">已分配</option>
                <option value="2">已使用</option>
            </select>
         </div> 
        </div>
        <div class="form-group "> 
         <label for="cname" class="control-label col-lg-2">使用状态： <span class="required">*</span></label> 
         <div class="col-lg-10"> 
            <select class="form-control m-bot15" name="usestate">
                <option value="0">未使用</option>
                <option value="1">已使用</option>
                <option value="2">已报修</option>
                <option value="3">已报废</option>
            </select>
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