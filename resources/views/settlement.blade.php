<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <title>通知</title>
    </head>
    <body style="width:900px;margin-top:50px;">
        <center>
            <form action="/ht_settlement" method="post" style="text-align:right;">
                {{csrf_field()}}
                时间:<input type="text" name="time"><br>
                数量:<input type="text" name="num"><br>
                设备ID:<input type="text" name="mid"><br>
                提成比例:<input type="text" name="proportions"><br>
                价格:<input type="text" name="price"><br>
                状态:<input type="text" name="state"><br>
                <input type="submit" value="结算">
            </form>
        </center>
    </body>
</html>
