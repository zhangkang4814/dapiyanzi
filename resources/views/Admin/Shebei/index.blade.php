@extends('layouts.default')
@section('title','后台首页')
@section('content')
  <div class="row"> 
   <div class="col-lg-9 col-md-12"> 
    <div class="panel panel-default"> 
     <div class="panel-heading"> 
      <h2><i class="fa fa-flag-o red"></i><strong>设备选择</strong></h2> 
      <div class="panel-actions"> 
       <a href="index.html#" class="btn-setting"><i class="fa fa-rotate-right"></i></a> 
       <a href="index.html#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a> 
       <a href="index.html#" class="btn-close"><i class="fa fa-times"></i></a> 
      </div> 
     </div> 
     <div class="panel-body"> 
      <table class="table bootstrap-datatable countries"> 
       <thead> 
        <tr> 
         <th></th> 
         <th>设备ID</th> 
         <th>CPU</th> 
         <th>内存</th> 
         <th>硬盘</th>
         <th>系统</th>
         <th>显卡</th> 
         <th>操作</th>
        </tr> 
       </thead> 
       <tbody> 
       @foreach($shebei as $row)
        <tr>
         <td><input type="checkbox"></td> 
         <td>{{$row->id}}</td> 
         <td>{{$row->cpu}}</td> 
         <td>{{$row->memory}}</td> 
         <td>{{$row->disk}}</td>
         <td>{{$row->system}}</td>
         <td>{{$row->video_card}}</td>
         <td><a href="/cart/{{$row->id}}">立即申请</a></td>
        </tr> 
       @endforeach
       </tbody> 
      </table> 
     </div> 
    </div> 
   </div>
   <!--/col--> 

@stop