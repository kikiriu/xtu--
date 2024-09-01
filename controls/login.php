<?php
// login($conn, $username, $password);
//查询数据库 登录
class Login
{
    function getuser($conn, $username, $password)
    {
        $sql = "select id,username,password from user where username=? and password=?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);

        if ($stmt->execute()) {
            //bind_result()绑定结果集中的值到变量
            $stmt->bind_result($id, $username, $password); //把username绑定到$name
            if ($stmt->fetch()) {   //判断是否有结果
                //生成token    改用COOKIE
                // $auth = new Auth();
                // $token = $auth->generate($username);
                $result=array("status"=>true, "id" => $id);// ,"msg"=>$token
                return $result;
            } 
            else{
                $result=array("status"=>false);
                return $result;
            }
        }
        $stmt->free_result();
        $stmt->close();
        $conn->close();
    }
}

