<?php
include_once "../models/conn.php";


$account = $_POST["account"];
$password = $_POST["a-password"];
login($conn, $account, $password);
//查询数据库 登录
function login($conn, $account, $password)
{
    $sql = "select * from admin where account=? and password=?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $account, $password);
    if ($stmt->execute()) {
        //bind_result()绑定结果集中的值到变量
        $stmt->bind_result($account, $password); //把account绑定到$name
        echo PHP_EOL; //换行
        if ($stmt->fetch()) {   //判断是否有结果
            $_SESSION["account"]=$account;//单引号或双引号都可以
            setcookie("account","$account",time()+10800,"/","localhost" );
            echo "<script>window.location.href='../view/adIndex.php';</script>"; //注意href拼写
        } else
            echo "<script>alert('登录失败');window.location.href='../view/adlogin.html';
            </script>";
    }
    $stmt->free_result();
    $stmt->close();
    
}
$conn->close();