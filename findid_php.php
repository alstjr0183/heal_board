
<?php
include ("conn.php");
$nickname = $_POST['findid_nickname'];
$hint = $_POST['findid_hint'];
$sql = "select id from healuser where nickname='$nickname' and forgethint='$hint' ";
$result = $mysqli -> query($sql);
$row =mysqli_fetch_array($result);
$userid = $row['id'];

$count = mysqli_num_rows($result);
if($count>0){

}else{
    // 아이디가 없을 경우
    echo "<script>alert('아이디가 없습니다'); history.go(-1);</script>";
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Myeongjo&display=swap" rel="stylesheet">
    <title>아이디 찾기</title>
    <style>
        *{
            font-family: 'Nanum Myeongjo', serif;
            font-weight: 600;
        }
        body {
            width: 100%;
            height: 100vh;
            margin: 0;
            padding: 0;
            background-color: darkseagreen;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        div {
            font-size: 1.5rem;
            margin-bottom: 3rem;
        }
        span {
            color: white;
        }
    </style>
</head>
<body>
<div style="">
    <div>
        찾으시는 아이디는
    </div>
    <span><?php echo $userid?></span> 입니다
</div>

</body>
</html>