<?php
include("./conn.php");

$idx = $_REQUEST['boardidx'];

session_start();
if ($_SESSION['userid'] == null) {
    echo "<script>alert('로그인 후 접속 가능합니다'); location='./index.php';</script>";
} else {

}

$sql = "select * from healboard where idx='$idx'";
$result = $mysqli->query($sql);
$row = mysqli_fetch_array($result);
?>


<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>글쓰기 페이지</title>
    <style>
        .nse_content {
            width: 660px;
            height: 500px
        }
    </style>
    <script type="text/javascript" src="../nse_files/js/HuskyEZCreator.js" charset="utf-8"></script>
    <link rel="stylesheet" href="./css/boardupdate.css?after">
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Myeongjo&display=swap" rel="stylesheet">
    <script>

        const healboard = {
            phptitle: "<?php echo $row['title']?>"
        }
        window.onload = () => {
            const titlebinput = document.querySelector(".titleinput")
            titlebinput.value = healboard.phptitle
        }

    </script>
</head>
<body>
<video class="video1" muted autoplay loop src="./img/cloud2.mp4"></video>
<form name="nse" action="add_db_nse2.php" method="post">
    <input style="display: none" type="text" name="idx" value="<?php echo $row['idx'] ?>">
    <div style="display: flex; justify-content: center">
        <input type="text" name="title" class="titleinput" placeholder="제목을입력해주세요">
    </div>
    <textarea  style="width: 50vw; " name="ir1" id="ir1" class="nse_content"><?php echo $row['contents'] ?></textarea>
    <div>
    <script type="text/javascript">
        var oEditors = [];
        nhn.husky.EZCreator.createInIFrame({
            oAppRef: oEditors,
            elPlaceHolder: "ir1",
            sSkinURI: "../nse_files/SmartEditor2Skin.html",
            fCreator: "createSEditor2"
        });

        function submitContents(elClickedObj) {
            oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
            // 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.

            try {
                elClickedObj.form.submit();
            } catch (e) {
            }
        }
    </script>
    </div>
    <div style="display: flex; justify-content: center">
        <input class="submitcss" type="submit" value="수정" onclick="submitContents(this)"/>
    </div>

</form>
<script>
    const titleinput = document.querySelector(".titleinput")
    const transitiontime = 0.5
    // 제목 마우스 오버시
    titleinput.onmouseover = ()=>{
        titleinput.style.transition =`all ${transitiontime}s`
        titleinput.style.backgroundColor ="white"
    }
    titleinput.onmouseleave = ()=>{
        titleinput.style.transition =`all ${transitiontime}s`
        titleinput.style.backgroundColor ="rgba(255,255,255,0)"
    }

</script>
</body>
</html>

