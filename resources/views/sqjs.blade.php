
@extends('layouts.default')
@section('title','后台首页')
@section('content')
<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
        结算申请
        </header>
      
            <table class="table table-striped table-advance table-hover" id="tb">
                <tbody id="show_tbody">
                    <tr>
                        <th>用户名</th>
                        <th>价格</th>
                        <th>分成比例%</th>
                        <th>申请状态</th>
                        <th>申请时间</th>
                        <th>提成</th>
                        <th>编辑</th>
                    </tr>
                    @foreach($js as $kk)
                    <tr>
                        <td>{{$kk['name']}}</td>
                        <td id="gg" style="display:none;">{{$kk['user_id']}}</td>
                        <td>{{$kk['price']}}</td>
                        <td>{{$kk['proportions']}}%</td>
                        <td class="state">{{$kk['state']}}</td>
                        <td>{{isset($kk['sqsj_time'])?date('Y/m/d H:i:s',$kk['sqsj_time']):''}}</td>
                        <td>{{$kk['proportions'] * $kk['price'] /100 }}</td>
                        <td>
                            @if ($kk['state'] == 0)
                            <div class="btn-group">
                                <!-- <a class="btn btn-primary" href="{{route('useradd')}}"><i class="icon_plus_alt2"></i></a> -->
                                <input type="button" class="alert confirm2" value="确认结算" />
                            </div>
                            @else 
                                 <div class="btn-group">
                                <!-- <a class="btn btn-primary" href="{{route('useradd')}}"><i class="icon_plus_alt2"></i></a> -->
                                    已结算
                                </div>
                            
                            @endif
                        </td>
                    </tr>   
                    @endforeach
                </tbody>
            </table>
            
    </section>   
</div>
<script type="text/javascript">
    $('.confirm2').click(function(){
            
            _this = $(this);
            var r = confirm("是否同意?");
            if(r==true){
                userid = $(this).parents('tr').find('#gg').html();
               // alert(userid);
               $.ajax({
                        type:"post",
                        url:'/jiesuan',
                        data:{'_token':'{{csrf_token()}}','userid':userid},
                        success:function(data){
                            if(data ==1){
                                //处理
                                _this.parents('tr').find('.state').html(1);
                                alert('结算成功')
                            }else{
                                alert('结算失败,请重试');
                            }
                        }
                });
            }else{
                alert('失败');
            }
        });
</script>
@stop



