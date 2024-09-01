<?php

include '../models/conn.php';

$username = $_COOKIE['username'];

$rep_id = $_GET['rep_id'];


//数据库操作
$sql = "delete from reply where rep_id = '$rep_id'";


$result = $conn->query($sql);
if ($result) {
    echo "<script>alert('删除成功');
    location.href='" . $_SERVER["HTTP_REFERER"] . "'</script>";
} else {
    echo "<script>alert('删除失败，发生未知错误');
    location.href='" . $_SERVER["HTTP_REFERER"] . "'</script>";
}
