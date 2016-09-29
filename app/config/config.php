<?php

defined('APP_PATH') || define('APP_PATH', realpath('.'));

return new \Phalcon\Config(array(
    'database' => array(
        'adapter'     => 'Mysql',
        'host'        => 'localhost',
        'username'    => 'root',
        'password'    => 'woniuzaixian',
        'dbname'      => 'o2o',
        'charset'     => 'utf8',
        'preTable'    => 'nhs_o2o_'
    ),
    'application' => array(
        'controllersDir' => APP_PATH . '/app/controllers/',
        'modelsDir'      => APP_PATH . '/app/models/',
        'migrationsDir'  => APP_PATH . '/app/migrations/',
        'viewsDir'       => APP_PATH . '/app/views/',
        'pluginsDir'     => APP_PATH . '/app/plugins/',
        'libraryDir'     => APP_PATH . '/app/library/',
        'cacheDir'       => APP_PATH . '/app/cache/',
        'baseUri'        => '/',
    ),
    'thirdpart' => array(                                   //JAVA接口配置参数
        'url'   =>  'http://www.163.com',
        'port'  => 80
    ),
    'dataDir'   =>  '/data/',                             //数据库备份文件路径
    'superadmin'    => 'admin',                           //超级管理员
    'pageNum'   =>  20,                                   //每页条数
    'uploadDir' =>  '/uploads/',                          //上传文件目录


));
