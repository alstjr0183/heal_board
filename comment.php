
<?php
include ("./conn.php");
$idx = $_REQUEST['commentidx'];
$id = $_REQUEST['commentid'];
$contents = $_REQUEST['commentcontents'];
$nickname = $_REQUEST['commentnick'];
$time = date('Y-m-d H:i:s');

$sql = "insert into healcomment (boardnum , id,nickname, contents, now) values ('$idx','$id','$nickname','$contents','$time')";
$result = $mysqli -> query($sql);
if($result >0){
    echo "<script>alert('댓글작성이 완료되었습니다'); history.back(-1);</script>";
}else {
    echo "<script>alert('댓글작성이 실패하였습니다');
		history.back(-1);</script>";
}
?>
