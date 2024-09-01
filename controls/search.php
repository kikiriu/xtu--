<?php

include '../models/conn.php';
$search = $_GET["search"];
$ckusername = $_COOKIE['username'];
if ($search == "") echo "<script>
var username = '<?php echo $ckusername; ?>';
alert('搜索内容不能为空');
location.href='/controls/urindex.php?username='+username
</script>";
// 以下的代码跟分页有关
// 接收当前页码数  从URL参数（拼接的字符串）中得到

//第一次进入时没有默认第一页
$pageNum = isset($_GET['num']) ? $_GET['num'] : 1;
// 定义每一页显示的记录数
$rowsPerPage = 5;
// 查询总记录数
$sql = "select count(*) as sum from publish";
$result = $conn->query($sql);
$row = $result->fetch_assoc(); // 还是一个数组
$rowCount = $row['sum']; // 得到总记录数
// 计算总页数
$pages = ceil($rowCount / $rowsPerPage);

// 拼凑出页码字符串
$strPage = '';
// 拼凑出“首页”
$strPage .= '<a href="./urindex.php?num=1&username=' . $_COOKIE["username"] . '">首页</a>';

// 拼凑出“上一页”
$preNum = $pageNum == 1 ? 1 : $pageNum - 1;
if ($pageNum != 1) {
    $strPage .= '<a href="./urindex.php?num=' . $preNum . '&username=' . $_COOKIE["username"] . '"><<上一页</a>';
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
    $strPage .= "<a href=\"./urindex.php?num=$i&username=" . $_COOKIE["username"] . "\">$i</a>";
}
// 拼凑出“下一页”
$nextNum = $pageNum == $pages ? $pages : $pageNum + 1;
if ($pageNum != $pages) {
    $strPage .= '<a href="./urindex.php?num=' . $nextNum . '&username=' . $_COOKIE["username"] . '">下一页</a>';
}
// 拼凑出“尾页”
$strPage .= '<a href="./urindex.php?num=' . $pages . '&username=' . $_COOKIE["username"] . '">尾页</a>';
// 拼凑出“总页数”
$strPage .= "总页数:$pages";

$offset = ($pageNum - 1) * $rowsPerPage;
$sql = "SELECT * FROM publish WHERE pub_title LIKE '%$search%' ORDER BY pub_time DESC LIMIT $offset, $rowsPerPage";
// 按时间降序  $offset+1开始 ，共$rowsPerPage条
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "<script>
    var username = '<?php echo $ckusername; ?>';
    alert('无相关内容');
    location.href='/controls/urindex.php?username='+username
    </script>";
}


include '../view/urindex.html';
