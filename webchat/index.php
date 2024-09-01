<?php
//将常用路径保存成常量
define('M','db/');
define('V','templates/');
define('C','controller/');
define('URL','http://localhost/webchat/');  //将文件根目录定义成常量

//加载初始化文件
include(M.'init.php');

//路由规则
// $v = !empty($_GET['v'])?$_GET['v']:'login';
$v = $_GET['v'];

include(C.$v.'.php');
?>