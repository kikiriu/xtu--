<?php
include_once "../models/conn.php";
$username = $_COOKIE['username'];
$pub_id = $_GET["pub_id"];
$action = $_GET["action"];
if($action=="收藏")
addfavorites($conn,$username,$pub_id);
elseif($action=="取消收藏")
deletefavorites($conn,$username,$pub_id);
elseif($action=="完结")
overed($conn,$pub_id);
elseif($action=="取消完结")
notovered($conn,$pub_id);
function addfavorites($conn,$username,$pub_id)
{
    $sql = "insert into favorites(username,pub_id) values(?,?);";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $username,$pub_id);
    if ($stmt->execute())
        echo "<script>alert('收藏成功！');window.location.href='" . $_SERVER["HTTP_REFERER"] . "';
            </script>";
    else{
        echo "<script>alert('收藏失败，发生未知错误');window.location.href='" . $_SERVER["HTTP_REFERER"] . "';
            </script>";
    }
    $stmt->free_result();
    $stmt->close();
}
function deletefavorites($conn,$username,$pub_id)
{
    $sql = "delete from favorites where username = ? and pub_id = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $username,$pub_id);
    if ($stmt->execute())
        echo "<script>alert('取消收藏成功！');window.location.href='" . $_SERVER["HTTP_REFERER"] . "';
            </script>";
    else{
        echo "<script>alert('取消收藏失败，发生未知错误');window.location.href='" . $_SERVER["HTTP_REFERER"] . "';
            </script>";
    }
    $stmt->free_result();
    $stmt->close();
}

function overed($conn,$pub_id)
{
    $sql = "update publish set status = '已完结' where pub_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$pub_id);
    if ($stmt->execute())
        echo "<script>window.location.href='" . $_SERVER["HTTP_REFERER"] . "';
            </script>";
    else{
        echo "<script>window.location.href='" . $_SERVER["HTTP_REFERER"] . "';
            </script>";
    }
    $stmt->free_result();
    $stmt->close();
}
function notovered($conn,$pub_id)
{
    $sql = "update publish set status = '生效中' where pub_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$pub_id);
    if ($stmt->execute())
        echo "<script>window.location.href='" . $_SERVER["HTTP_REFERER"] . "';
            </script>";
    else{
        echo "<script>window.location.href='" . $_SERVER["HTTP_REFERER"] . "';
            </script>";
    }
    $stmt->free_result();
    $stmt->close();
}
$conn->close();
