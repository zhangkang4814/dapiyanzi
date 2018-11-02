
@extends('layouts.default')
@section('title','后台首页')
@section('content')
<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
        申请结算表
        </header>
            <table class="table table-striped table-advance table-hover" id="tb">
                <tbody id="show_tbody">
                    <tr>
                        <th>id</th>
                        <th>用户ID</th>
                        <th>单价</th>
                        <th>申请时间</th>
                        <th>结算时间</th>
                        <th>提成比例(%)</th>
                        <th>结算状态</th>
                        <th>编辑</th>
                        <!-- <th>申请状态</th> -->
                    </tr>
                    @foreach($all as $kk)
                    <tr>
                        <td>{{$kk['id']}}</td>
                        <td class="userid">{{$kk['user_id']}}</td>
                        <td>{{$kk['price']}}</td>
                        <td>{{isset($kk['sqsj_time'])?date('Y/m/d H:i:s',$kk['sqsj_time']):0}}</td>
                        <td class="settime">{{date('Y/m/d H:i:s',$kk['settime'])}}</td>
                        <td>{{$kk['proportions']}}%</td>
                        <td>{{$kk['state']}}</td>
                        <td>
                            <div class="btn-group">
                                <!-- <a class="btn btn-primary" href="{{route('useradd')}}"><i class="icon_plus_alt2"></i></a> -->
                                <input type="button" class="alert confirm" value="申请提现" />
                            </div>
                        </td>
                    </tr>   
                    @endforeach
                </tbody>
            </table>
            
    </section>   
</div>
<script type="text/javascript">

    $('.confirm').click(function(){
            
            _this = $(this);
            var r = confirm("是否确认提现?");
            if(r==true){
                userid = $(this).parents('tr').find('.userid').html();
               // alert(userid);
               $.ajax({
                        type:"post",
                        url:'/sqtx',
                        data:{'_token':'{{csrf_token()}}','userid':userid},
                        success:function(data){
                            if(data ==1){
                                //处理
                                _this.parents('tr').find('.state').html(1);
                                alert('申请提现成功')
                            }else{
                                alert('申请提现失败,请重试');
                            }
                        }
                });
            }else{
                alert('失败');
            }
        });
</script>
@stop



