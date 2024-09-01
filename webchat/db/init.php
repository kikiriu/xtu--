<?php
session_start();  //开启session
date_default_timezone_set('PRC'); //设置时区
error_reporting(E_ALL);  //隐藏所有错误
include(M.'db.fun.php');  //加载数据库函数
$mysqli = conn();  //连接数据库
?>