<?php

include '../models/conn.php';

if (isset($_GET["section"])) $section = $_GET["section"];

//第一次进入时没有默认第一页
$pageNum = isset($_GET['num']) ? $_GET['num'] : 1;
// 定义每一页显示的记录数
$rowsPerPage = 5;
$username = $_COOKIE["username"];
// 查询总记录数
if (isset($_GET["section"])) {
	if ($section == 1) $sql = "select count(*) as sum from publish where section = '失物招领'";
	elseif ($section == 2) $sql = "select count(*) as sum from publish where section = '寻物启事'";
	elseif ($section == 3) $sql = "select count(*) as sum from publish where section = '其它'";
	elseif ($section == 0) $sql = "select count(*) as sum from publish";
	elseif ($section == 4) $sql = "select count(*) as sum from publish where pub_id in(
		select pub_id from favorites where username = '$username')";//收藏
} else $sql = "select count(*) as sum from publish";
$result = $conn->query($sql);
$row = $result->fetch_assoc(); // 还是一个数组
$rowCount = $row['sum']; // 得到总记录数
// 计算总页数
$pages = ceil($rowCount / $rowsPerPage);

// 拼凑出页码字符串
$strPage = '';
// 拼凑出“首页”
if (isset($_GET["section"])) $strPage .= '<a href="./urindex.php?num=1&username=' . $_COOKIE["username"] . '&section=' . $section . '">首页</a>';
else $strPage .= '<a href="./urindex.php?num=1&username=' . $_COOKIE["username"] . '">首页</a>';
// 拼凑出“上一页”
$preNum = $pageNum == 1 ? 1 : $pageNum - 1;
if ($pageNum != 1) {
	if (isset($_GET["section"])) $strPage .= '<a href="./urindex.php?num=' . $preNum . '&username=' . $_COOKIE["username"] . '&section=' . $section . '"><<上一页</a>';
	else $strPage .= '<a href="./urindex.php?num=' . $preNum . '&username=' . $_COOKIE["username"] . '"><<上一页</a>';
}

// 确定显示的第1个页码$startNum的值
if ($pageNum <= 3) {
	$startNum = 1;
} else {
	$startNum = $pageNum - 2;
}
// 确定$startNum的最大值
if ($startNum > $pages - 4) {
	$startNum = $pages - 4;
}
// 防止$startNum出现负值
if ($startNum <= 1) {
	$startNum = 1;
}
// 确定显示的最后1个页码$endNum的值
$endNum = $startNum + 4;
// 防止$endNum越界
if ($endNum > $pages) {
	$endNum = $pages;
}

// 拼凑出中间的页码
for ($i = $startNum; $i <= $endNum; $i++) {

	if (isset($_GET["section"])) $strPage .= "<a href=\"./urindex.php?num=$i&username=" . $_COOKIE["username"] . "&section=$section\">$i</a>";
	else $strPage .= "<a href=\"./urindex.php?num=$i&username=" . $_COOKIE["username"] . "\">$i</a>";
}
// 拼凑出“下一页”
$nextNum = $pageNum == $pages ? $pages : $pageNum + 1;
if ($pageNum != $pages) {
	if (isset($_GET["section"]))$strPage .= '<a href="./urindex.php?num=' . $nextNum . '&username=' . $_COOKIE["username"] . '&section=' . $section . '">下一页</a>';
	else $strPage .= '<a href="./urindex.php?num=' . $nextNum . '&username=' . $_COOKIE["username"] .'">下一页</a>';
}
// 拼凑出“尾页”
if (isset($_GET["section"]))$strPage .= '<a href="./urindex.php?num=' . $pages . '&username=' . $_COOKIE["username"] . '&section=' . $section . '">尾页</a>';
else $strPage .= '<a href="./urindex.php?num=' . $pages . '&username=' . $_COOKIE["username"] .'">尾页</a>';
// 拼凑出“总页数”
$strPage .= "总页数:$pages";


$offset = ($pageNum - 1) * $rowsPerPage;
if (isset($_GET["section"])) {
	$section = $_GET["section"];
	if ($section == 1) {
		$sql = "select * from publish where section = '失物招领' order by is_top desc,pub_time desc limit $offset, $rowsPerPage";
	} elseif ($section == 2) {
		$sql = "select * from publish where section = '寻物启事' order by is_top desc,pub_time desc limit $offset, $rowsPerPage";
	} elseif ($section == 3) {
		$sql = "select * from publish where section = '其它' order by is_top desc,pub_time desc limit $offset, $rowsPerPage";
	} elseif ($section == 4) {
		$sql = "select * from publish where pub_id in(select pub_id from favorites where username = '$username') order by is_top desc,pub_time desc limit $offset, $rowsPerPage";
	} 
	else $sql = "select * from publish order by is_top desc,pub_time desc limit $offset, $rowsPerPage";
} else {
	$sql = "select * from publish order by is_top desc,pub_time desc limit $offset, $rowsPerPage";
}
// 按时间降序  $offset+1开始 ，共$rowsPerPage条
$result = $conn->query($sql);

if ($result->num_rows == 0) {
	$row  = array('pub_content' => '信息消失了~', 'pub_owner' => '');
}

// echo session_id();
include '../view/urindex.html';
