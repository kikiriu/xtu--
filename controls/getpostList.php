<?php
include_once "../models/conn.php";
//查询
$arr=getpostList($conn);
echo json_encode($arr);
// echo $arr;
function getpostList($conn)
{
    $sql = "select pub_id,pub_title,pub_content,pub_owner,pub_time,pub_hits,section,is_top,status from publish order by is_top desc,pub_time desc";
    $stmt = $conn->prepare($sql);
    $arr = array(); //初始化数组
    if ($stmt->execute()) {
        $pub_id = null;
        $pub_title = null;
        $pub_content = null;
        $pub_owner = null;
        $pub_time = null;
        $pub_hits = null;
        $is_top = null;
        $section = null;
        $status = null;
        $stmt->bind_result($pub_id, $pub_title,$pub_content,$pub_owner,$pub_time,$pub_hits,$is_top,$section,$status);
        while ($stmt->fetch()) {
            array_push($arr, array($pub_id, $pub_title,$pub_content,$pub_owner,$pub_time,$pub_hits,$is_top,$section,$status));//插入到数组
        }
    }
    return $arr;
}

