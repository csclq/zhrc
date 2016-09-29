<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    </style>
</head>
<body>
<div class="box">
    <form action="/login/login" method="post">
        用户名:<input name="username" /><br />
        密 &nbsp; 码:<input type="password" name="password" /><br />
        <input type="submit" value="确定">

    </form>
</div>

</body>
</html>