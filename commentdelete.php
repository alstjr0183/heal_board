<?php
    include ("./conn.php");

    $idx = $_REQUEST['comidx'];
    $sql = "delete from healcomment where idx='$idx'";
    $result = $mysqli -> query($sql );

if($result >0){
    echo "<script>alert('댓글 삭제가 완료되었습니다');
		history.go(-1);
		</script>";
}else {
    echo "<script>alert('댓글 삭제가 실패하였습니다');
		history.go(-1);
		</script>";
}
?>