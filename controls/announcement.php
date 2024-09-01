<?php
include_once "../models/conn.php";

$announcement = $_POST["announcement"];
$announcement = "【公告】" . $announcement;
$time = date("Y-m-d H:i:s");

// 插入公告到notifications表中
$insert_sql = "INSERT INTO notifications (username, message, pub_id, isread, time) VALUES (?, ?, 0, 0, ?)";
$stmt = $conn->prepare($insert_sql);
$stmt->bind_param("sss", $username, $announcement, $time);

if ($stmt->execute()) {
    echo "<script>alert('公告已成功发布！'); window.location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
} else {
    echo "<script>alert('公告发布失败！'); window.location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
}


$conn->close();
