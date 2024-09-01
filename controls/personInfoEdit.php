<?php
include_once "../models/conn.php";



if (isset($_POST["signature"])) {
    $username = $_POST["uname"];
    $nickname = $_POST["nickname"];
    $contact = $_POST["contact"];
    $signature = $_POST["signature"];
    infoedit($conn, $username, $nickname, $signature, $contact);
}
else {
    $urname = $_POST["urname"];
    $username = $_POST["uname2"];
    $nickname = $_POST["nickname"];
    $contact = $_POST["contact"];
    $password = $_POST["password"];
    infoedit2($conn,$urname, $username, $nickname, $password, $contact);
}
// 更新数据库信息  用户端
function infoedit($conn, $username, $nickname, $signature, $contact)
{
    // 使用预处理语句，防止 SQL 注入攻击
    $sql = "UPDATE user SET nickname=?, signature=?, contact=? WHERE username=?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssss", $nickname, $signature, $contact, $username);
        $stmt->execute();
        $stmt->close();
    } else {
        echo "数据库错误：" . $conn->error;
    }
    echo "<script>location.href='" . $_SERVER["HTTP_REFERER"] . "'</script>"; //返回上一个页面
}
//管理端
function infoedit2($conn,$urname, $username, $nickname, $password, $contact)
{
    // 使用预处理语句，防止 SQL 注入攻击
    $sql = "UPDATE user SET username=?, nickname=?, password=?, contact=? WHERE username=?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sssss", $username, $nickname, $password, $contact, $urname); // 注意参数的顺序
        $stmt->execute();
        $stmt->close();
    } else {
        echo "数据库错误：" . $conn->error;
    }
    echo "<script>location.href='" . $_SERVER["HTTP_REFERER"] . "'</script>"; //返回上一个页面
}