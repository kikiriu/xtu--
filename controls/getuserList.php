<?php
include_once "../models/conn.php";
//查询
function getuserList($conn)
{
    $sql = "select username,password,nickname,avatar,banned,contact from user order by username asc";
    $stmt = $conn->prepare($sql);
    $arr = array(); //初始化数组
    if ($stmt->execute()) {
        $users = null;
        $password = null;
        $nickname = null;
        $avatar = null;
        $banned = null;
        $contact = null;
        //头像？uid？邮箱？
        $stmt->bind_result($users, $password,$nickname,$avatar,$banned,$contact);
        while ($stmt->fetch()) {
            array_push($arr, array($users,$password,$nickname,$avatar,$banned,$contact));//插入到数组
            //echo "用户名：" . $users."<br>";
        }
        //echo var_dump($arr);
        //echo '<pre>' , var_dump($arr) , '</pre>';//使得输出结果换行易于阅读
    }
    return $arr;
}
