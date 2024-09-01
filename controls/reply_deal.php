<?php

include '../models/conn.php';

$username = $_COOKIE['username'];
$banned = "";
// 查询用户的banned属性
$sql = "SELECT * FROM user WHERE username = '$username'";
$result1 = $conn->query($sql);
$row1 = $result1->fetch_assoc();

$banned = $row1["banned"];
if ($banned == 1) {
	echo "<script>alert('很抱歉，您已经被封禁！');
	window.location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
	die();
}
mysqli_free_result($result1);



//获取回帖信息
$rep_pub_id = $_POST['pub_id'];
$rep_user = $_COOKIE['username'];
$rep_content = trim($_POST['rep_content']);
$rep_time = time();

//检查帖子状态,获取贴主信息，帖子标题
$sql = "SELECT status, pub_title,pub_owner FROM publish WHERE pub_id = '$rep_pub_id'";
$result2 = $conn->query($sql);
$row1 = $result2->fetch_assoc();
$status = $row1["status"];
$pub_title = $row1["pub_title"];
$pub_owner = $row1["pub_owner"];

if ($status == "已完结") {
	echo "<script>alert('很抱歉，此贴已完结！');
	window.location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
	die();
}
echo "<script>console.log('pub_title: " . addslashes($pub_title) . "');</script>";

echo "<script>console.log('status: " . addslashes($status) . "');</script>";
mysqli_free_result($result2);


//执行插入操作
$sql = "INSERT INTO reply(rep_id, rep_pub_id, rep_user, rep_content, rep_time) VALUES (NULL, '$rep_pub_id', '$rep_user', '$rep_content', '$rep_time')";
if (!empty($rep_content)) {
    if (isset($_COOKIE['username'])) {
        $result = $conn->query($sql);
        if ($result) {
            // 插入提醒消息
            $message = "您的帖子“{$pub_title}”收到了新的回复，点击查看";
            //$pub_id = "$rep_pub_id";
            $notification_sql = "INSERT INTO notifications (username, message, pub_id) VALUES ('$pub_owner', '$message', '$rep_pub_id')";
            $notification_result = $conn->query($notification_sql);
            if ($notification_result) {
                echo "<script>alert('回复成功');
                location.href='./detail.php?pub_id=$rep_pub_id&action=reply'</script>";
            } else {
                echo "<script>alert('回复成功，但通知贴主失败');
                location.href='./detail.php?pub_id=$rep_pub_id&action=reply'</script>";
            }
        } else {
            echo "<script>alert('回复失败，发生未知错误');
                location.href='./show.php?pub_id=$rep_pub_id&action=reply'</script>";
        }
    }
} else {
    echo "<script>alert('回复内容不能为空!');
    location.href='./detail.php?pub_id=$rep_pub_id'</script>";
}