<?php
    //header('location:/index.php/admin/Index/index');

    define('APP_PATH',__DIR__.'/application/');

    //绑定模块
    define('BIND_MODULE','admin');
    define('__ROOT__',str_replace('/admin.php/main','',dirname($_SERVER['PHP_SELF'])));

    /*echo '<pre>';
    print_r($_SERVER['PHP_SELF']);
    echo '</pre>';
    echo __FILE__;*/

  //加载框架引导文件
    require __DIR__.'/thinkphp/start.php';
?>