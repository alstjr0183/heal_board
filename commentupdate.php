<?php
include ("./conn.php");

$comcon = $_REQUEST['comcon'];
$idx = $_REQUEST['comidx'];

$sql ="update healcomment set contents='$comcon' where idx='$idx'";
$result = $mysqli -> query($sql );

if($result >0){
    echo "<script>alert('댓글 수정이 완료되었습니다');
		history.go(-1);
		</script>";
}else {
    echo "<script>alert('댓글 수정이 실패하였습니다');
		history.go(-1);
		</script>";
}
?>