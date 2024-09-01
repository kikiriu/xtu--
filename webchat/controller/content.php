<?php
// if(!empty($_POST)) {
//     // 获取 POST 数据
//     $nickname = isset($_POST['nickname']) ? $_POST['nickname'] : '';
// 	$result = getOne($mysqli, 'user', "nickname='$nickname'");
// 	var_dump($result);
// 	if ($result) {
//     // 提取用户的 id
//     $to_userId = $result['id'];

// 	echo $to_userId;
// 	echo $to_userId;

// 	}
	
// }
// var_dump('你好');
// var_dump('你好');
// var_dump('你好');
// var_dump('你好');
// var_dump('你好');
// var_dump('你好');
// var_dump('你好');
// var_dump('你好');
// var_dump('你好');
// var_dump($_POST);
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     var_dump($_POST);
//     echo 'Received POST data';
// }
// var_dump($_SERVER['REQUEST_METHOD']);
// $rows = getAll($mysqli,'chat',1,"INNER JOIN `user` ON `chat`.`userid`=`user`.`id`");
// foreach($rows as &$v){
// 	if($v['userid'] == $_SESSION['userid']){
// 		$v['is_mine'] = 1;
// 	}else if($v['userid'] == $to_userId){
// 		$v['is_mine'] = 0;
// 	}else{
// 		$v['is_mine'] = 3;
// 	}
// }
// if(!empty($_SERVER['HTTP_X_REQUESTED_WITH'])){
// 	$rows = getAll($mysqli,'chat',1,"INNER JOIN `user` ON `chat`.`userid`=`user`.`id`");
//     foreach($rows as &$v){
// 		if($v['userid'] == $_SESSION['userid']){
// 			$v['is_mine'] = 1;
// 		}else if($v['userid'] == $to_userId){
// 			$v['is_mine'] = 0;
// 		}else{
// 			$v['is_mine'] = 3;
// 		}
// 	}
// 	echo json_encode($rows);
// }else{
// 	$rows = getAll($mysqli,'chat',1,"INNER JOIN `user` ON `chat`.`userid`=`user`.`id`");
// 	foreach($rows as &$v){
// 		if($v['userid'] == $_SESSION['userid']){
// 			$v['is_mine'] = 1;
// 		}else{
// 			$v['is_mine'] = 0;
// 		}
// 	}
// 	include(V.'frame/content.html');
// }
// echo session_id();
// echo session_save_path();
// echo $_SESSION['username'];
// echo $_SESSION['userid'];

// echo ini_get('error_log');



	
if (isset($_GET['nickname']))
{
	$nickname = $_GET['nickname'];
	$id = $_SESSION['userid'];
	$wheres = "nickname = '$nickname'";
	$result = getOne($mysqli, 'user', $wheres);
	$f_id = $result['id'];
	$sql = "UPDATE user SET to_userid_tmp = '$f_id' WHERE id = $id";
	$results = mysqli_query($mysqli, $sql);
}
$id = $_SESSION['userid'];
$wheret = "id=$id";
$result = getOne($mysqli, 'user', $wheret);
$to_userId = $result['to_userid_tmp'];
$wheret = "id=$to_userId";
$result_new = getOne($mysqli, 'user', $wheret);
$_SESSION['to_userid'] = $to_userId;
$_SESSION['nickname'] = $result['nickname'];
$_SESSION['avatar'] = $result['avatar'];
$_SESSION['to_avatar'] = $result_new['avatar'];
$_SESSION['to_nickname'] = $result_new['nickname'];
$userId = $_SESSION['userid'];
if(isset($_GET['flag'])){
	// var_dump($_GET['flag']);
	$_SESSION['flag'] = true;

	// $wheres = "";
	$rows = getAll($mysqli,'public_chat');
	$rows = getAll($mysqli,'public_chat',1,"INNER JOIN `user` ON `public_chat`.`userid`=`user`.`id`");
	foreach($rows as &$v){
		if($v['userid'] == $_SESSION['userid']){
			$v['is_mine'] = 1;
		}else{
			$v['is_mine'] = 0;
		}
	}
	unset($v);
	// var_dump($_SESSION);
}else{
	// var_dump($_GET['flag']);
	$_SESSION['flag'] = false;
	// var_dump($_SESSION);
	$wheres = "userid = $userId AND to_userid = $to_userId OR userid = $to_userId AND to_userid = $userId";
	$rows = getAll($mysqli,'chat',$wheres,"INNER JOIN `user` ON `chat`.`userid`=`user`.`id`");
	// var_dump($rows);
	foreach($rows as &$v){
		if($v['userid'] == $_SESSION['userid']){
			$v['is_mine'] = 1;
		}else{
			$v['is_mine'] = 0;
		}
	}

	unset($v); // 取消对最后一个元素的引用
}
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH'])){
	echo json_encode($rows);
}else{
	include(V.'frame/content.html');
}
?>