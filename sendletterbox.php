<?php
include("./conn.php");
$idx = $_REQUEST['letteridx'];

$sql = "select * from healletter where idx='$idx'";
$result = $mysqli->query($sql);
$row = mysqli_fetch_array($result);
$nickname = $row['nickname'];
$title = $row['title'];
$contents = $row['contents'];
$now = $row['now'];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/sendletterbox.css">
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Myeongjo&display=swap" rel="stylesheet">
    <title>쪽지함</title>
</head>
<body>
    <div>
        <p>보낸사람: <?php echo $nickname?></p>
    </div>
    <div>
        <p>제목: <?php echo $title?></p>
    </div>
    <div class="box_contents">
        <?php echo $contents?>
    </div>
    <div class="box_time">
        <p>보낸 시간: <?php echo $now?></p>
        <button onclick="replybox_open()">답장</button>
    </div>
<!--    답장 박스-->
    <section class="box_reply">
        <form action="./reply.php" method="post">
            <input style="display: none" name="reply" value="<?php echo $_SESSION['userid']?>" type="text">
            <input style="display: none" name="reply_mynickname" value="<?php echo $_SESSION['usernickname']?>" type="text">
            <input style="display: none" type="text" name="reply_sendnick" value="<?php echo $nickname?>">
            <input name="reply_title" type="text" placeholder="제목을 입력해주세요" required>
            <textarea name="reply_contents" name="" id="" cols="30" rows="10" required placeholder="내용을 입력해주세요"></textarea>
            <button >보내기</button>
        </form>
    </section>
    <script>
        const box_reply = document.querySelector('.box_reply')
        let check = true
        const replybox_open =()=>{
            if(check===true){
                box_reply.style.display = 'block'
                check = false
            } else if(check === false){
                box_reply.style.display = 'none'
                check = true
            }
        }
    </script>
</body>
</html>
