<?php
include_once "../models/conn.php";


$username = $_POST["username"];
$isban = $_POST["isban"];
echo $isban;
if($isban == 1)ban($conn,$username);
else unban($conn, $username);
//封禁用户
function ban($conn, $username)
{
    $sql = "update user set banned=1 where username = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    if ($stmt->execute())
        echo "<script>alert('该用户已被封禁！');window.location.href='" . $_SERVER["HTTP_REFERER"] . "';
            </script>";
    else{
        echo "<script>alert('操作失败，发生未知错误');window.location.href='" . $_SERVER["HTTP_REFERER"] . "';
            </script>";
    }
    $stmt->free_result();
    $stmt->close();
}

function unban($conn, $username)
{
    $sql = "update user set banned=0 where username = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    if ($stmt->execute())
        echo "<script>alert('已成功解封！');window.location.href='" . $_SERVER["HTTP_REFERER"] . "';
            </script>";
    else{
        echo "<script>alert('操作失败，发生未知错误');window.location.href='" . $_SERVER["HTTP_REFERER"] . "';
            </script>";
    }
    $stmt->free_result();
    $stmt->close();
}
$conn->close();
