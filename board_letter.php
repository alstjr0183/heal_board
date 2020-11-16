
<?php
include ("./conn.php");
$myid = $_POST['letter_myid'];
$mynickname = $_POST['letter_mynickname'];
$send_nick = $_POST['letter_sendnick'];
$send_title=$_POST['letter_sendtitle'];
$contents = $_POST['letter_contents'];
$time = date('Y-m-d H:i:s');

$sql = "insert into healletter (id,nickname, you_nickname,title,contents, now) values ('$myid','$mynickname','$send_nick','$send_title','$contents','$time')";
$result = $mysqli -> query($sql);
if($result >0){
    echo "<script>alert('쪽지가 발송되었습니다'); history.back(-1);</script>";
}else {
    echo "<script>alert('쪽지 발송에 실패하였습니다');
		history.back(-1);</script>";
}
?>