<?php
include_once "../models/conn.php";
require_once "../controls/login.php";
//session_start();

$username = $_GET["l-username"];
$password = $_GET["l-password"];
$Username='username';
$login = new Login();
$result = $login->getuser($conn, $username, $password);
if ($result["status"]) {
    // $token=$result["msg"];
    $_SESSION[$Username]=$username;
    $_SESSION['userid'] = $result['id'];
    setcookie("username","$username",time()+10800,"/","localhost" );
    echo "<script>window.location.href='../controls/urindex.php?username={$username}';</script>"; 
} else {
    echo "<script>alert('登录失败');
    location.href='" . $_SERVER["HTTP_REFERER"] . "'</script>"; //返回上一个页面
}
