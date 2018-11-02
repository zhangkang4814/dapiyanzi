@extends('layouts.default')
@section('title','后台首页')
@section('content')
	<div class="row">
    	<div class="col-lg-12">
        	<section class="panel">
              	<header class="panel-heading">
                    我的设备
                </header>
				<table class="table table-striped table-advance table-hover">
	                <tbody>
	                              <tr>
	                                 <th>#</th>
	                                 <th>设备编号</th>
	                                 <th>设备型号</th>
	                                 <th>CPU</th>
	                                 <th>内存</th>
	                                 <th>硬盘</th>
	                                 <th>系统</th>
	                                 <th>显卡</th>
	                                 <th>开始时间</th>
	                                 <th>到期时间</th>
	                              </tr>
	                             <form action="/xfq" id="myform" method="post">
	                              @foreach($device as $row)
	                              <tr>
	                                 <td><input type="checkbox" name="mid[]" value="{{$row->mid}}"></td>
	                                 <td class="mid">{{$row->mid}}</td>
	                                 <td>{{$row->confid}}</td>
	                                 <td>{{$row->cpu}}</td>
	                                 <td>{{$row->memory}}</td>
	                                 <td>{{$row->disk}}</td>
	                                 <td>{{$row->system}}</td>
	                                 <td>{{$row->video_card}}</td>
	                                 <td>{{date("Y-m-d H:i",$row->startime)}}</td>
	                                 <td>{{date("Y-m-d H:i",$row->expiretime)}}</td>
	                              </tr>
									{{csrf_field()}}
	                              @endforeach
	                              <tr>
								</form>
	                              	<td colspan="9">
	                              		<div class="btn-group">
	                              		  <a class="btn btn-default" href="#" onclick="select(true)">全选</a>
	                              		  <a class="btn btn-default" href="#" onclick="select(false)">全不选</a>
	                                      <a class="btn btn-default" href="#" onclick="fanxuan()">反选</a>
	                              		</div>
	                              	</td>
	                              	<td colspan ="1">
	                              		<div class="btn-group">
	                              		  <a class="btn btn-primary" href="#" onclick="test()">续费</a>
	                              		  <a class="btn btn-success" href="#">维修</a>
	                                      <a class="btn btn-danger" href="#">退还</a>
	                              		</div>
	                              	</td>
	                              </tr>
	                              
	                </tbody>
                </table>
            </section>         
        </div>        
    </div>
    <script>
    	var inputs = document.getElementsByTagName('input');
    	//全选全不选函数
	function  select(mask){
		//alert(mask);
		
		for(var i =0; i<inputs.length;i++){
			inputs[i].checked=mask;

		}
	}

	//反选函数
	function fanxuan(){
		for(var i =0;i<inputs.length;i++){
			inputs[i].checked =!inputs[i].checked;
		}
	}

	function test()
	{
	    document.getElementById("myform").submit();    
	}

    </script>
@stop