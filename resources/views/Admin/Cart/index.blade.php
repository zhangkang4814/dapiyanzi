@extends('layouts.default')
@section('title','后台首页')
@section('content')
<style>
  .flex{display:flex;width:90px;height:30px;justify-content:center;}
  .div{width:30px;height:30px;color:#58CBFE;font-weight:bold;}
  .bor{border:1px solid #DDDDDD;}
  .juzhong{display:flex;justify-content:center;align-items:center;}
</style>
  <div class="row"> 
   <div class="col-lg-9 col-md-12"> 
    <div class="panel panel-default"> 
     <div class="panel-heading"> 
      <h2><i class="fa fa-flag-o red"></i><strong>申请单</strong></h2> 
      <div class="panel-actions"> 
       <a href="/cart" class="btn-setting"><i class="fa fa-rotate-right"></i></a> 
       <a href="/shebei" class="btn-minimize"><i class="fa fa-chevron-up"></i></a> 
       <a href="/cartqk" class="btn-close"><i class="fa fa-times"></i></a> 
      </div> 
     </div> 
     <div class="panel-body"> 
      <table class="table bootstrap-datatable countries"> 
       <thead> 
          <tr>
            <th></th>
            <th>设备编号</th>
            <th>cpu/核</th>
            <th>存储/G</th>
            <th>硬盘/G</th>
            <th>系统</th>
            <th>显卡</th>
            <th>价格/元</th>
            <th>数量/台</th>
            <th>时间/月</th>
            <th>小计</th>
            <th>操作</th>
          </tr>
       </thead> 
       <tbody> 
       @if($shop)
        @foreach($shop as $row)
        <tr>
          <td><input type="checkbox"></td>
          <td>{{$row->id}}</td>
          <td>{{$row->cpu}}</td>
          <td>{{$row->memory}}</td>
          <td>{{$row->disk}}</td>
          <td>{{$row->system}}</td>
          <td>{{$row->video_card}}</td>
          <td>{{$row->price}}</td>
          <!-- <td><a href="/cartnumjian/{{$row->id}}"><button>-</button></a>{{$row->num}}<a href="/cartnumjia/{{$row->id}}"><button>+</button></a> 台</td>
          <td><a href="cartmonthjian/{{$row->id}}"><button>-</button></a>{{$row->month}} <a href="/cartmonthjia/{{$row->id}}"><button>+</button></a>月</td> -->
          <td>
            <div class="flex">
              <a href="/cartnumjian/{{$row->id}}"><div class="div bor juzhong">-</div></a>
              <div class="div juzhong">{{$row->num}}</div>
              <a href="/cartnumjia/{{$row->id}}"><div class="div bor juzhong">+</div></a>
            </div>
          </td>
          <td>
            <div class="flex">
              <a href="/cartmonthjian/{{$row->id}}"><div class="div bor juzhong">-</div></a>
              <div class="div juzhong">{{$row->month}}</div>
              <a href="/cartmonthjia/{{$row->id}}"><div class="div bor juzhong">+</div></a>
            </div>
          </td>
          <?php 
            $month=$row->month;
            $num=$row->num;
            $price=$row->price;
            $xiaoji=$price*$num*$month;
            $zongjia+=$xiaoji;
            session()->put("zongjia",$zongjia);
           ?>
          <td style="color:red"><div style="width:80px;height: 30px;line-height:30px">{{$xiaoji}} 元</div></td>
          <td><a href="/cartsc/{{$row->id}}">删除</a></td>
        </tr>
        @endforeach
        <tr>
          <td colspan="9"><a href=""></a></td>
          <td colspan="2" >总金额: <span style="color:red;padding:3px;font-size:20px;">{{$zongjia}}</span> 元</td>
          <td>
            <a href="/order" data-toggle="modal" class="btn  btn-danger">提交申请</a>
          </td>
        </tr>
        @else
        <tr>
          <td colspan="12" style="text-align:center;">暂未申请,<a href="/shebei">点击去申请</a></td>
        </tr>
        @endif
       </tbody> 
      </table> 
     </div> 
    </div> 
   </div>
   <!--/col--> 

@stop