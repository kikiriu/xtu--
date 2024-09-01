<?php
include_once "../controls/getuserList.php";

$arr=getuserList($conn);

echo json_encode($arr);
