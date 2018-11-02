@extends('layouts.default')
@section('title','后台首页')
@section('content')
<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
        历史通知记录
        </header>
      
            <table class="table table-striped table-advance table-hover" id="tb">
                <tbody id="show_tbody">
                    <tr>
                        <th><i class="icon_profile"></i> id</th>
                        <th><i class="icon_calendar"></i> 设备id</th>
                        <th><i class="icon_mail_alt"></i> 类型</th>
                        <th><i class="icon_pin_alt"></i> 内容</th>
                        <th><i class="icon_mobile"></i> 发送时间</th>
                        <th><i class="icon_cogs"></i> 标题</th>
                        <th><i class="icon_cogs"></i>录入人</th>
                        
                    </tr>
                    @foreach($user as $v)
                    <tr>
                        <td>{{$v->id}}</td>
                        <td>{{$v->mid}}</td>
                        <td>{{$v->type}}</td>
                        <td>{{$v->content}}</td>
                        <td>{{date('Y/m/d H:i:s',$v->sending_time)}}</td>
                        <td>{{$v->title}}</td>
                        <td>{{$v->operator}}</td>
                        
                    </tr>   
                    @endforeach
                </tbody>
            </table>
            <div align="center">{{ $user->render() }}</div>
    </section>   
</div>
<script type="text/javascript">
        //Ajax增删改查
        //1.创建请求对象
        //2.初始化请求对象
        //3.发送请求
        //4.客户端接受相应收据
        // function fun(){
        //     var xmlhttp;
        //     if(window.XMLHttpRequest){
        //         xmlhttp=new XMLHttpRequest();
        //     }else{
        //         xmlhttp=new ActiveXOBject("Microsoft.XMLHTTP");
        //     }
        // }
        // xmlhttp.open('get','show_notice.blade.php',true);
        // xmlhttp.send();
        // xmlhttp.onreadystarechange=function(){
        //     if(xmlhttp.readyState == 4 && xmlhttp.status ==200){
        //         str = xmlhttp.responseText;
        //         alert(str);
        //     }
        // }
        // 新增
        // $("#add").click(function() {
        //     var hideTr = $("#hide_tbody", tb).children().first();
        //     var newTr = hideTr.clone().show();
        //     $("#show_tbody", tb).append(newTr);
        // });
        // 删除
        // $(".del").click(function(){
        //     console.log(111);
        //     $(this).parents('tr').remove();
        // });
        
        
</script>
@stop

 