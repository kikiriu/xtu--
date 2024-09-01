<?php

//发帖和编辑帖子
include '../models/conn.php';

$username = $_COOKIE['username'];
$banned = "";
// 查询用户的banned属性
$sql = "SELECT * FROM user WHERE username = '$username'";
$result1 = $conn->query($sql);
$row1 = $result1->fetch_assoc();

$banned = $row1["banned"];
mysqli_free_result($result1);
if ($banned == 1) {
    echo "<script>alert('很抱歉，您已经被封禁！');
    location.href='/controls/urindex.php'</script>";
    die();
} //终止程序


//接收发帖数据
//过滤标签内容  还有添加转义字符
if(isset($_POST['module_id']))$section = $_POST['module_id'];
$pub_title = addslashes(strip_tags(trim($_POST['pub_title'])));
$pub_content = addslashes(strip_tags(trim($_POST['pub_content'])));


$pub_owner = $_COOKIE['username'];
// 注意变量名不能和数组下标相同，这样刷新页面后session值也会清空，
// 比如$user=$_SESSION['user']['name']这种形式的赋值是错误的，命名变量不能和session的下标相同。

//获取当前的发帖时间
$pub_time = time();

//数据库操作
// $sql = "insert into publish values (null,'$pub_title','$pub_content', '$pub_owner', '$pub_time', default) ";
if (isset($_FILES["pub_image"]) && $_FILES["pub_image"]["error"] === UPLOAD_ERR_OK) {
    $files = $_FILES["pub_image"];

    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $files["name"]);
    // echo $files["size"];
    $extension = end($temp);     // 获取文件后缀名
    if ((($files["type"] == "image/gif")
            || ($files["type"] == "image/jpeg")
            || ($files["type"] == "image/jpg")
            || ($files["type"] == "image/pjpeg")
            || ($files["type"] == "image/x-png")
            || ($files["type"] == "image/png"))
        && ($files["size"] < 4096000)   // 小于 4000 kb
        && in_array($extension, $allowedExts)
    ) {
        if ($files["error"] > 0) {
            echo "错误：: " . $files["error"] . "<br>";
        } else {
            if (!file_exists("../upload/staff/" . $files["name"])) {
                move_uploaded_file($files["tmp_name"], "../upload/staff/" . $files["name"]);
            }
            //更新数据库
            $pub_imgPath = "../upload/staff/" . $files["name"];
            //判断是修改还是发布帖子
            if (isset($_POST['reedit'])) {
                $pub_id = $_POST['reedit'];
                $sql = "UPDATE publish SET pub_title = '$pub_title', pub_content = '$pub_content', pub_image = '$pub_imgPath' WHERE pub_id = '$pub_id'";
            } else $sql = "insert into publish(pub_id,pub_title,pub_content,pub_owner,pub_time,pub_hits,is_top,section,pub_image)
            values (null,'$pub_title','$pub_content', '$pub_owner', '$pub_time', 0, 0,'$section','$pub_imgPath') ";
        }
    } else {
        echo "<script>alert('非法的文件格式！');window.location.href='" . $_SERVER["HTTP_REFERER"] . "'</script>";
    }
} else {
    if (isset($_POST['reedit'])) {
        $pub_id = $_POST['reedit'];
        $sql = "UPDATE publish SET pub_title = '$pub_title', pub_content = '$pub_content',changed = 1 WHERE pub_id = '$pub_id'";
    } else
        $sql = "insert into publish(pub_id,pub_title,pub_content,pub_owner,pub_time,pub_hits,is_top,section)
 values (null,'$pub_title','$pub_content', '$pub_owner', '$pub_time', 0, 0,'$section') ";
}

//删除图片
if (isset($_POST['reedit'])){
    $pub_id = $_POST['reedit'];
    $imageAction = $_POST["image_action"];
    if ($imageAction == "delete"){
        $sql2 = "UPDATE publish SET pub_image = '' WHERE pub_id = '$pub_id'";
        $conn->query($sql2);
    }
}
//发布或修改帖子
if (empty("$pub_title") || empty("$pub_content")) {
    echo "<script>alert('内容和标题不能为空');
    location.href='" . $_SERVER["HTTP_REFERER"] . "'</script>";
} else {
    $result = $conn->query($sql);

    if ($result) {
        if (!isset($_POST['reedit']))
        echo "<script>alert('发帖成功');
    location.href='/controls/urindex.php'</script>";
    else echo "<script>alert('修改成功');
    location.href='" . $_SERVER["HTTP_REFERER"] . "'</script>";
    } else {
        echo "<script>alert('发生未知错误QAQ~');
    location.href='" . $_SERVER["HTTP_REFERER"] . "'</script>";
    }
}
