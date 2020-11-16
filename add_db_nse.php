<?php
include "../include/connect_db.php"; // 데이터 베이스 접속 프로그램 불러오기

$title= $_POST['title'];
$timedata =	date('Y-m-d H:i');
$nse_content = $connect->escape_string($_POST['ir1']);
$writer = $_REQUEST['writer'];
$writerid = $_REQUEST['writerid'];

$sql = "insert into healboard (title,contents,writerid,writernick,now)";
$sql .= " value('$title','{$nse_content}','$writerid','$writer','$timedata')";
$res = $connect->query($sql);

if($res){
    //입력 성공시
    echo "<script>alert('글작성이 완료되었습니다'); location='main.php';</script>";
} else{
    echo "<script>alert('글작성이 실패하였습니다');</script>";
}
?>