<?php
//数据库函数库
function conn($ip='localhost',$user='root',$pwd='',$db='tek'){
	$mysqli = mysqli_connect($ip,$user,$pwd,$db);
	if(!$mysqli){
		return false;
	}
	mysqli_query($mysqli,'SET NAMES UTF8');
	return $mysqli;
}

//查询一条数据
function getOne($mysqli,$table,$where=1){
	$sql = "SELECT * FROM `$table` WHERE $where";
	$result = mysqli_query($mysqli,$sql);
	return mysqli_fetch_assoc($result);
}

//查询多条数据
function getAll($mysqli,$table,$where=1,$join=''){
	$sql = "SELECT * FROM `$table` $join WHERE $where ORDER BY `$table`.`id` ASC";
	$result = mysqli_query($mysqli,$sql);
	$rows = array();
	while($r = mysqli_fetch_assoc($result)){
		$rows[] = $r;
	}
	return $rows;
}

//插入一条数据
function insertOne($mysqli,$table,$data=array()){
	$cols = '';
	$vals = '';
	foreach($data as $k=>$v){
		$cols .= "`$k`,";
		$vals .= "'$v',";
	}
	$cols = substr($cols,0,strlen($cols)-1);
	$vals = substr($vals,0,strlen($vals)-1);
	$sql = "INSERT INTO `$table`($cols) VALUES($vals)";
	mysqli_query($mysqli,$sql);
	return mysqli_affected_rows($mysqli);
}
?>