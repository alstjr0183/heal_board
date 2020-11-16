<?php
include("./conn.php");

session_start();
if($_SESSION['userid'] == null){
    echo "<script>alert('로그인 후 접속 가능합니다'); location='./index.php';</script>";
}else{

}

$idx = $_REQUEST['boardidx'];
$sessionid = $_SESSION['userid'];
$sessionnick = $_SESSION['usernickname'];

$sql = "select * from healboard where idx='$idx'";
$result = $mysqli->query($sql);
$row = mysqli_fetch_array($result);

//조회수 쿼리문
$sql2 ="update healboard set views=views +1 where idx ='$idx'";
$result2 = $mysqli -> query($sql2 );

//하트 쿼리문
$sql3 = "select * from healbest where contentsidx= '$idx' and userid= '$sessionid'";
$result3 = $mysqli -> query($sql3 );
$count = mysqli_num_rows($result3);

//댓글 쿼리문
$sql4= "select * from healcomment where boardnum='$idx'";
$result4 = $mysqli -> query($sql4);
$count4 = mysqli_num_rows($result4);
//댓글 개수

?>
<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/contents.css?after">
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Myeongjo&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<video class="video1" muted autoplay loop src="./img/cloud2.mp4"></video>
<header class="contentsinfo">
    <ul class="contentsinfo-box"><p>닉네임</p> : <?php echo $row['writernick']?></ul>
    <ul class="contentsinfo-box"><p>조회수</p> : <?php echo $row['views']?></ul>
    <ul class="contentsinfo-best"><p>좋아요</p> : <?php echo $row['best']?>
        <a href="./best.php?idx=<?php echo $row['idx']?>&id=<?echo $_SESSION['userid']?>">
            <img class="love1" src="./img/love1.svg" alt="">
            <img class="love2" src="./img/love2.svg" alt="">
        </a>
    </ul>
    <ul class="contentsinfo-box"><?php echo $row['now']?></ul>
    <ul style="margin: 0" class="contentsinfo-box"><p class="commentjs">댓글</p> (<?php echo $count4?>)</ul>
</header>
<main class="mainbox">
    <div class="mainbox-title">
        <h1><?php echo $row['title']?></h1>
        <section>
            <input style="display: none" class="boardcheck1" type="text" value="<?php echo $sessionid?>">
            <input style="display: none" class="boardcheck2" type="text" value="<?php echo $row['writerid']?>">
        <a class="boardupdatebutton" href="./boardupdate.php?boardidx=<?php echo $idx?>">글수정</a>
        <a class="boarddeletebutton" href="./boarddelete2.php?boardidx=<?php echo $idx?>">글삭제</a>
        </section>
    </div>
    <div class="mainbox-contents">
        <?php echo $row['contents']?>
    </div>
</main>
<!--댓글 부분-->
<footer class="commentbox">
    <div class="commentbox-input">
        <form action="comment.php" method="get">
            <input style="display: none" name="commentidx" type="text" value="<?echo $idx?>">
            <input style="display: none" name="commentid" type="text" value="<?echo $sessionid?>">
            <input style="display: none" name="commentnick" type="text" value="<?php echo $sessionnick?>">
            <input name="commentcontents" type="text">
            <button class="commentbox-button" type="submit">등 록</button>
        </form>
    </div>
    <div class="commentbox-contents">
        <?php
        while ($row4=mysqli_fetch_array($result4)){
            $commentidx = $row4['idx'];
            $commentnick = $row4['nickname'];
            $commentcontents = $row4['contents'];
            $commenttime = $row4['now'];
            $commentid = $row4['id'];

            $commentnum = $commentnum+1;
        ?>
            <section class="commentbox-boxboss">
                <span class="commentbox-boxnick"><?php echo $commentnick ?>
                    <input style="display: none" class="commentcheckid<?php echo $commentnum?>" type="text" value="<?php echo $commentid?>">
                    <button style="display: inline-block" class="commentupdate<?php echo $commentnum?>">수정</button>
                    <a href="./commentdelete.php?comidx=<?php echo $commentidx?>"><button class="commentdelete<?php echo $commentnum?>" style="display: inline-block">삭제</button></a>
                </span>
                <span style="    width: 98%;height: 20%;margin-left: 0.5%;border-bottom: 2px solid pink;font-size: 1rem;margin-bottom: 0.5%;
    color: white;"  class="commentbox-boxcontents<?php echo $commentnum?>"><?php echo $commentcontents ?></span>
                <form action="./commentupdate.php" method="get">
                    <input style="display: none" name="comidx" type="text" value="<?php echo $commentidx?>">
                    <input style="display: none;margin-left: 0.5%;margin-bottom: 0.4%; width: 98% height: 20%;font-size: 1rem;" class="updatecheck<?php echo $commentnum?>" name="comcon" type="text" value="<?php echo $commentcontents?>">
                    <input style="display: none" type="submit">
                </form>
                <span class="commentbox-boxtime"><?php echo $commenttime ?></span>
            </section>
            <script>
                const commentbox_boxcontents<?php echo $commentnum?> = document.querySelector(".commentbox-boxcontents<?php echo $commentnum?>")
                const commentupdate<?php echo $commentnum?> = document.querySelector(".commentupdate<?php echo $commentnum?>")
                const updatecheck<?php echo $commentnum?> = document.querySelector(".updatecheck<?php echo $commentnum?>")
                const commentdelete<?php echo $commentnum?> = document.querySelector(".commentdelete<?php echo $commentnum?>")
                const commentcheckid<?php echo $commentnum?> = document.querySelector(".commentcheckid<?php echo $commentnum?>")
                let comnum<?php echo $commentnum?> = 1
                // 댓글 수정 페이지 나타나는 js
                function commentupdatejs(){
                    if( comnum<?php echo $commentnum?>===1){
                        commentbox_boxcontents<?php echo $commentnum?>.style.display ="none"
                        updatecheck<?php echo $commentnum?>.style.display = "block"
                        comnum<?php echo $commentnum?> = comnum<?php echo $commentnum?> - 1
                    } else {
                        commentbox_boxcontents<?php echo $commentnum?>.style.display ="block"
                        updatecheck<?php echo $commentnum?>.style.display = "none"
                        comnum<?php echo $commentnum?> = comnum<?php echo $commentnum?> + 1
                    }
                }
                commentupdate<?php echo $commentnum?>.addEventListener("click",commentupdatejs)

                // 댓글 수정 삭제 버튼 세션아이디로 확인
                window.addEventListener("load",()=>{
                    if( commentcheckid<?php echo $commentnum?>.value === "<?php echo $sessionid?>" ){
                        commentupdate<?php echo $commentnum?>.style.display="inline-block"
                        commentdelete<?php echo $commentnum?>.style.display="inline-block"
                    }else {
                        commentupdate<?php echo $commentnum?>.style.display="none"
                        commentdelete<?php echo $commentnum?>.style.display="none"
                    }
                        })
            </script>
        <?php
        }
        ?>
    </div>
</footer>
<script>
    window.addEventListener("load", ()=>{
        const love1 = document.querySelector(".love1")
        const love2 = document.querySelector(".love2")
        if ( <?php echo $count?> === 0){
            love1.style.display="block"
        } else {
            love2.style.display="block"
        }
    })
  // 댓글창 js
  //   const commentjs = document.querySelector(".commentjs")
  //
  //   function commentani() {
  //       const mainbox = document.querySelector(".mainbox")
  //       const commentbox = document.querySelector(".commentbox")
  //       const commentbox_button = document.querySelector(".commentbox-button")
  //       let numplus = 1
  //       if (numplus === 1) {
  //           numplus = numplus - 1
  //           mainbox.style.transition = "all 0.5s"
  //           commentbox.style.transition = "all 0.5s"
  //           mainbox.style.height = "30vh"
  //           commentbox.style.height = "50vh"
  //           setTimeout(() => {
  //               commentbox_button.style.display = "block"
  //           }, 500)
  //           alert(numplus)
  //       } else  {
  //           alert("하이")
  //       }
  //   }
  //   commentjs.addEventListener("click",commentani)


    const commentjs = document.querySelector(".commentjs")
    const mainbox = document.querySelector(".mainbox")
    const commentbox = document.querySelector(".commentbox")
    const commentbox_button = document.querySelector(".commentbox-button")
    let num = 1

    commentjs.addEventListener("click", () => {

        if (num === 1) {
            mainbox.style.transition = "all 0.5s"
            commentbox.style.transition = "all 0.5s"
            mainbox.style.height = "30vh"
            commentbox.style.height = "50vh"
            setTimeout(() => {
                commentbox_button.style.display = "block"
            }, 500)
            num = num + 1
        } else {
            mainbox.style.transition = "all 0.5s"
            commentbox.style.transition = "all 0.5s"
            mainbox.style.height = "80vh"
            commentbox.style.height = "0vh"
                commentbox_button.style.display = "none"
            num = num - 1
        }
    })
// 게시글 수정 삭제 버튼 활성화
    const boardupdatebutton = document.querySelector(".boardupdatebutton")
    const boarddeletebutton = document.querySelector(".boarddeletebutton")
    const boardcheck1 = document.querySelector(".boardcheck1")
    const boardcheck2 = document.querySelector(".boardcheck2")
    window.addEventListener("load",()=>{
        if( boardcheck1.value === boardcheck2.value) {
            boardupdatebutton.style.display ="inline-block"
            boarddeletebutton.style.display ="inline-block"
        } else {
            boardupdatebutton.style.display ="none"
            boarddeletebutton.style.display ="none"
        }
    })
</script>
</body>
</html>