<?php
ini_set('display_errors', 'Off');//去除掉session_start()重复的提示
include_once "../models/conn.php";

$post_action = $_GET["module_id"];
$pub_id = $_GET["pub_id"];

if ($post_action == "delete") deletepost($conn, $pub_id,$isadmin);

else if ($post_action == "view") {
    // $isadmin=$_SESSION["account"];
    // echo $isadmin;
    include './detail.php';
}
else if($post_action == "sticky"){
    $sql = "update publish set is_top =1 where pub_id = $pub_id";
    $conn->query($sql);
    echo "<script>alert('设置成功');
    location.href='" . $_SERVER["HTTP_REFERER"] . "'</script>";
}
else if($post_action == "unsticky"){
    $sql = "update publish set is_top =0 where pub_id = $pub_id";
    $conn->query($sql);
    echo "<script>alert('成功取消');
    location.href='" . $_SERVER["HTTP_REFERER"] . "'</script>";
}
else if($post_action == "over"){  
    $sql = "update publish set status = '已完结' where pub_id = $pub_id";
    $conn->query($sql);
    echo "<script>alert('设置成功');
    location.href='" . $_SERVER["HTTP_REFERER"] . "'</script>";
}
else if($post_action == "unover"){  
    $sql = "update publish set status = '生效中' where pub_id = $pub_id";
    $conn->query($sql);
    echo "<script>alert('设置成功');
    location.href='" . $_SERVER["HTTP_REFERER"] . "'</script>";
}
function deletepost($conn, $pub_id)//是否为管理员进行删除
{
    $sql = "delete from publish where pub_id = $pub_id";
    $conn->query($sql);

    if(isset($_GET["isnotadmin"]))//不是管理员 直接从链接参数得到
    echo "<script>alert('删除成功');
    location.href=href='/controls/urindex.php?username=ff'</script>";
    else echo "<script>alert('删除成功');
    location.href='" . $_SERVER["HTTP_REFERER"] . "'</script>";
}
