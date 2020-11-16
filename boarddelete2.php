<?php
include ("./conn.php");
session_start();

$idx = $_REQUEST['boardidx'];

$sql ="delete from healboard where idx='$idx'";
$result = $mysqli -> query($sql );

if($result >0){
    echo "<script>alert('글 삭제가 완료되었습니다');
		history.go(-2);
		</script>";
}else {
    echo "<script>alert('글 삭제가 실패하였습니다');
		history.go(-1);
		</script>";
}
?>