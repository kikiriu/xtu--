<?php

include '../models/conn.php';

// 查询用户的banned属性
$username = $_COOKIE['username'];
$banned = "";
$sql = "SELECT * FROM user WHERE username = '$username'";
$result1 = $conn->query($sql);
$row1 = $result1->fetch_assoc();

$banned = $row1["banned"];

//处理JSON格式的POST数据
$data = json_decode(file_get_contents("php://input"), true);
if ($data === null) {
    echo "Failed to parse JSON data.";
    exit;
}
//获取回帖信息
$rep_id = $data['rep_id'];
$rep_content = $data['rep_content'];
$pub_id = $data['pub_id'];

//检查帖子状态
$sql = "SELECT * FROM publish WHERE pub_id = '$pub_id'";
$result2 = $conn->query($sql);
$row1 = $result2->fetch_assoc();

$status = $row1["status"];

rep($conn, $rep_content, $rep_id, $banned, $status);

function rep($conn, $rep_content, $rep_id, $banned, $status)
{
    $sql = "update reply set rep_content = '$rep_content',changed = 1 where rep_id = '$rep_id'";

    if (!empty($rep_content)) {
        if (isset($_COOKIE['username'])) {
            $result = $conn->query($sql);
            if ($status == "已完结")
            echo json_encode(array("status" => false,"error"=>"overed"));
            else if($banned==1)
            echo json_encode(array("status" => false,"error"=>"banned"));
            else if ($result) {
                echo json_encode(array("status" => true, "content" => $rep_content, "sql" => $sql));
            }
        }
    }
}
