<?php
if(!empty($_POST)){
	$id = $_SESSION['userid'];
	$wheres = "id=$id";
	$result = getOne($mysqli, 'user', $wheres);
	$to_userId = $result['to_userid_tmp'];
	$_POST['userid'] = $_SESSION['userid'];
	$_POST['systime'] = time();
	$_POST['to_userid'] = $to_userId;
	insertOne($mysqli,'chat',$_POST);
	
}
include(V.'frame/send.html');
?>