<?php
require_once "../models/conn.php";

$username = $_GET["username"];

getAvatar($conn,$username);

function getAvatar($conn,$username){
    $sql = "select avatar from user where username=? LIMIT 1   ;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $avatar="";
    if ($stmt->execute()) {
        $stmt->bind_result($avatar);
        while($stmt->fetch()){
            echo json_encode(array("status"=>true,"avatar"=>$avatar));//php->js
            return;
        }
    }else{
        echo json_encode(array("status"=>false,"avatar"=>""));
    }
    $stmt->free_result();
    $stmt->close();
    $conn->close();
}