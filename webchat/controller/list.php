<?php
$rows = getAll($mysqli,'user');
// if(!empty($_SERVER['HTTP_X_REQUESTED_WITH'])){
// 	$nickname = $_POST['nickname'];
//     $id = $_SESSION['userid'];
//     $wheres = "nickname = '$nickname'";
//     $result = getOne($mysqli, 'user', $wheres);
//     $f_id = $result['id'];
//     $sql = "UPDATE user SET to_userid_tmp = '$f_id' WHERE id = $id";
//     $results = mysqli_query($mysqli, $sql);
// }else{
    include(V.'frame/list.html');
// }
?>