<?php
require_once "../models/conn.php";

$username = $_POST["username"];
$files = $_FILES["file"];
uploadAvatar($conn, $username, $files);
function uploadAvatar($conn, $username, $files)
{
    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $files["name"]);
    echo $files["size"];
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
            if (!file_exists("../upload/avatar/" . $files["name"])) {
                move_uploaded_file($files["tmp_name"], "../upload/avatar/" . $files["name"]);
            }
            //更新数据库
            $avatarPath = "../upload/avatar/" . $files["name"];
            $sql = "update user set avatar=? where username=?;";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $avatarPath, $username);
            if ($stmt->execute()) {
                echo PHP_EOL; //换行
            }
            $stmt->free_result();
            $stmt->close();
            echo "<script>alert('头像上传成功！');window.location.href='".$_SERVER["HTTP_REFERER"]."'</script>";
        }
    } else {
        echo "<script>alert('非法的文件格式！');window.location.href='".$_SERVER["HTTP_REFERER"]."'</script>";
    }
    $conn->close();
}