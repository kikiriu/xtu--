<?php
include_once "../models/conn.php";

$username = $_GET["uname"];


userdelete($conn, $username);
//插入
function userdelete($conn, $username)
{
    $sql = "delete from user where username = '$username'";//加上单引号确保其被视为字符串
    $conn->query($sql);
    echo "<script>alert('删除成功');
    location.href='" . $_SERVER["HTTP_REFERER"] . "'</script>"; //返回上一个页面
}
