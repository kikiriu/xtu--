<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "tek";//选择数据库，只连接时不需要此行

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
$conn->set_charset('utf8');

//全局打开session
session_start();
