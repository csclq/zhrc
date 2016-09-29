<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title><?= Phalcon\Text::upper($title) ?></title>
        <link rel="stylesheet" href="/css/style.css">
        <script src="/js/jquery.js"></script>
        <script src="/js/angular.min.js"></script>
        <script src="/js/index.js"></script>
    </head>
    <body>
        <header>
            <div class="company"><img src="/img/nahuasuan.png" /> 哪划算网络有限公司</div>
            <div class="user">
                <span>欢迎您：<span class="username"></span><a href="#">修改密码</a><a href="#">退出</a></span>
            </div>
        </header>
        <div class="container">
            <div class="menu">
                <div class="menu">
                    <?php foreach ($menus as $menu) { ?>
                    <div class="item">
                        <div class="controller"><?= $menu['remark'] ?></div>
                        <ul class="action">
                            <?php foreach ($menu['child'] as $action) { ?>
                            <li><a href="/<?= $menu['name'] ?>/<?= $action['name'] ?>"><?= $action['remark'] ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="content" ng-app="myapp">
               <img src="/img/in.gif"  class="shrink" />
                <div class="main">
                    <?= $this->getContent() ?>
                </div>
            </div>
        </div>
        <footer>
            Copyright © 2016 苏州哪划算网络有限公司出品.保留所有权利。
        </footer>
    </body>
</html>
