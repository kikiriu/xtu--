<?php
include_once "../models/conn.php";

if (isset($_COOKIE['account']) ) {
    setcookie('account','',time()-3600,'/','localhost');
}
unset($_SESSION["account"]);
//session_destroy();
echo "<script>alert('已经清除登录数据！');window.location.href='./adlogin.html'</script>";