<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/js/jquery.js"></script>
    <title>哪划算</title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        body{
            height: 100vh;
            background: url('/img/bg.jpg');
            background-size:100% 100% ;
        }
        .box{
            width: 40vw;
            height: 30vh;
            position: absolute;
            top:20vh;
            left: 30vw;
            background: #fff;
            border-radius: 1.2em;
            text-align: center;
        }
        table{
            width: 80%;
            text-align: center;
        }
        tr{
            height: 2.6em;
        }
        th{
           width:  30%;
            text-align: right;
        }
        .input{
            width: 80%;
            height: 30px;
            border: 1px solid #aeaeae;
            border-radius: 5px;
        }
        .sinput{
            width: calc(70% - 80px);
            height: 30px;
            border: 1px solid #aeaeae;
            border-radius: 5px;
            margin-right: 10%;
        }
        td img{
            vertical-align: middle;
        }
    </style>
</head>
<body>
<div class="box">
    <form action="/login/login" method="post">
        <br />
        <table>
            <tr>
                <th>用户名 ：</th>
                <td><input name="username" class="input" required /></td>
            </tr>
            <tr>
                <th>密 &nbsp; 码 ：</th>
                <td><input type="password" name="password" class="input" required /></td>
            </tr>
            <tr>
                <th>验证码 ：</th>
                <td><input type="text" name="code" class="sinput" required /><img src="/login/verify" /></td>
            </tr>
            <tr>
                <th colspan="2" style="text-align: center"> <input type="submit" value="确  定" style="text-align: center;width: 50%;cursor: pointer;background: #00a65a;color:#fff;height: 30px;border-radius: 5px"></th>
            </tr>
        </table>
    </form>
</div>

</body>
</html>
<script>
    $("form img").click(function () {
        $(this).attr("src","/login/verify?"+Math.random());
    })
</script>