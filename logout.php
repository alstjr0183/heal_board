<?php
include("conn.php");

unset($_SESSION["usernickname"]);
unset($_SESSION["userid"]);

echo "<script>alert('로그아웃이 되었습니다'); location='./index.php';</script>";
?>