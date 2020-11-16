<?php
include("./conn.php");

$userid = $_POST['userid'];
$userpw = $_POST['userpw'];
$usernick = $_POST['usernick'];
$userhint = $_POST['userhint'];

$sql ="insert into healuser(id,pw,nickname,forgethint) values('$userid','$userpw','$usernick','$userhint') ";
$result = $mysqli -> query($sql);
if($result >0){
    echo "<script>alert('회원가입이 완료되었습니다');
		location='./index.php';
		</script>";
}else {
    echo "<script>alert('회원가입이 실패하였습니다');
		history.go(-1);
		</script>";
}
?>