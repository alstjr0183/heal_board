<?php
include ("./conn.php");

session_start();
if($_SESSION['userid'] == null){
    echo "<script>alert('로그인 후 접속 가능합니다'); location='./index.php';</script>";
}else{

}

$findtitle = $_REQUEST['findtitle'];
$findnickname= $_REQUEST['findnickname'];

//게시물 역순으로 쿼리문
$sql = "select * from healboard where title ='$findtitle' or writernick ='$findnickname' order by idx desc";
$res = mysqli_query($mysqli, $sql);
$count = mysqli_num_rows($res);
//if($res === 1){
if($count===0){
    // 로그인 성공
    echo "<script>alert('검색내역이 없습니다'); history.go(-1);</script>";
}else{
}
//}
//게시물 추천순으로 쿼리문
$sql2 = "SELECT * FROM `healboard` order by best desc limit 0,5 ";
$res2 = mysqli_query($mysqli, $sql2);
//찾은 게시물 값 쿼리문

?>
<!doctype html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>힐링</title>
    <link rel="stylesheet" href="./css/findboard.css">
    <script type="text/javascript" src="../nse_files/js/HuskyEZCreator.js" charset="utf-8"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Myeongjo&display=swap" rel="stylesheet">
</head>

<body>
<audio autoplay controls loop class="seasound" src="./img/wavesound2.mp3"></audio>
<audio style="display: none" controls loop class="campfiresound" src="./img/camfireaudio.mp3"></audio>
<video class="video1" muted autoplay loop src="./img/wave.mp4"></video>
<video class="video2" muted autoplay loop src="./img/camfire2.mp4"></video>
<!--게시판 메뉴 리스트-->
<header class="menulistboss">
    <nav class="menulist">
        <div class="category">
            <ul>카테고리
                <li>회사</li>
                <li>학교</li>
            </ul>
        </div>
        <div class="popular">
            위로가 필요한 글
        </div>
        <div class="chat">
            채팅
        </div>
    </nav>
</header>
<!--메인 컨텐츠 박스-->
<main>
    <div class="mainboss">
        <section class="mainbox">
            <!--            인기글 박스-->

            <!--                카테고리 박스-->
            <div class="categorybox">
                <table>
                    <tr>
                        <th style="border-left: 2px solid #17A7D6;">게시물넘버</th>
                        <th>제목</th>
                        <th>닉네임</th>
                        <th>시간</th>
                        <th>조회수</th>
                        <th>추천</th>
                    </tr>
                    <?php
                    while($row=mysqli_fetch_array($res)){
                        $idx = $row['idx'];
                        $title = $row['title'];
                        $writernick = $row['writernick'];
                        $now = $row['now'];
                        $views = $row['views'];
                        $best = $row['best'];
                        ?>
                        <tr>
                            <td><?php echo $idx?></td>
                            <td><a href="contents.php?boardidx=<?php echo $idx?>"><?php echo $title?></a></td>
                            <td><?php echo $writernick?></td>
                            <td><?php echo $now?></td>
                            <td><?php echo $views?></td>
                            <td><?php echo $best?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    <div class="categorybox-bar">
                        <!--                            검색 박스-->
                        <section class="searchboss">
                            <div class="searchbox-title">
                                <div class="searchbox-title-1" >제목</div>
                            </div>
                            <form action="" method="get">
                                <input class="searchbox-input" name="findtitle" type="text" placeholder="제목을 입력해주세요">
                                <input class="searchbox-submit" type="submit">
                            </form>
                        </section>
                        <!-- 페이징 처리 -->
                        <section>1,2,3,</section>
                        <!-- 글쓰기 버튼 -->
                        <section class="writeboss">
                            <button class="writebutton">글쓰기</button>
                            <div class="writebox">
                                <form name="nse"  action="add_db_nse.php" method="post">
                                    <section class="writetitle">
                                        <div>
                                            <input type="text"  name="writer" value="<?php echo $_SESSION['usernickname']?>" placeholder="작성자를 입력해주세요">
                                        </div>
                                        <div>
                                            <input type="text" name="title" placeholder="제목을입력해주세요">
                                        </div>
                                    </section>
                                    <textarea name="ir1" id="ir1" class="nse_content"></textarea>
                                    <script type="text/javascript">
                                        var oEditors = [];
                                        nhn.husky.EZCreator.createInIFrame({
                                            oAppRef: oEditors,
                                            elPlaceHolder: "ir1",
                                            sSkinURI: "../nse_files/SmartEditor2Skin.html",
                                            fCreator: "createSEditor2"
                                        });

                                        function submitContents(elClickedObj) {
                                            oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD",
                                                []); // 에디터의 내용이 textarea에 적용됩니다.
                                            // 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.

                                            try {
                                                elClickedObj.form.submit();
                                            } catch (e) {}
                                        }
                                    </script>
                                    <input calss="sendwrite" type="submit" value="전송" onclick="submitContents(this)" />
                                </form>
                            </div>
                        </section>
                    </div>
                </table>
                <!-- 하단 검색, 글넘김, 글작성 부분  -->
            </div>
            <div class="popularbox">
                <div class="topcss">
                    <div>TOP</div>
                    <div>1</div>
                    <div>2</div>
                    <div>3</div>
                    <div>4</div>
                    <div>5</div>
                </div>
                <div>
                    <div class="chartmenu">
                        <div>위로가 필요한 글</div>
                    </div>
                    <div>
                        <?php
                        while($row2=mysqli_fetch_array($res2)){
                            $idx2 = $row2['idx'];
                            $title2 = $row2['title'];
                            $best2 = $row2['best'];
                            $upnum = $upnum+1;
                            ?>
                            <div class="chartcss">
                                <span>
                                    <a style="color: #17A7D6;" href=""><?php echo $title2?></a>
                                    <div style="background-color: #0E87E3; height: 3vh"
                                         class="bestchart<?php echo $upnum?>"></div>
                                    <div class="movebesttext<?php echo $upnum?>"><?php echo $best2?></div>
                                </span>
                            </div>
                            <script>
                                // 차트 그래프 js
                                const bestchart<?php echo $upnum?> =
                                    document.querySelector(".bestchart<?php echo $upnum?>")
                                function chartjs() {
                                    bestchart<?php echo $upnum?>.style.width ="<?php echo $best2?>%"
                                }
                                window.addEventListener("load",chartjs)
                            </script>

                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!--            채팅 박스-->
            <div class="chatbox">채팅</div>
        </section>
    </div>
</main>
<!-- 메뉴클릭시 이벤트 -->
<script>
    const body = document.querySelector("body")
    const mainbox = document.querySelector(".mainbox")
    const popular = document.querySelector(".popular")
    const category = document.querySelector(".category")
    const chat = document.querySelector(".chat")
    const video1 = document.querySelector(".video1")
    const video2 = document.querySelector(".video2")
    const campfiresound = document.querySelector(".campfiresound")
    const seasound = document.querySelector(".seasound")

    function popularjs() {
        mainbox.style.transition = "all 1s"
        video1.style.transition = "all 1s"
        video2.style.transition = "all 1s"
        mainbox.style.transform = "translate(-90vw,0)"
        popular.style.backgroundColor = "#17A7D6"
        category.style.backgroundColor = "#17A7D6"
        chat.style.backgroundColor = "#17A7D6"
        mainbox.style.backgroundColor = "white"
        // video1.play()
        // video2.pause()
        campfiresound.style.display = "none"
        seasound.style.display = "block"
        seasound.play()
        campfiresound.pause()
        video1.style.transform = "translate(0,0)"
        video2.style.transform = "translate(0,0)"
    }

    function categoryjs() {
        mainbox.style.transition = "all 1s"
        video1.style.transition = "all 1s"
        video2.style.transition = "all 1s"
        mainbox.style.transform = "translate(0,0)"
        popular.style.backgroundColor = "#17A7D6"
        category.style.backgroundColor = "#17A7D6"
        chat.style.backgroundColor = "#17A7D6"
        mainbox.style.backgroundColor = "white"
        // video1.play()
        // video2.pause()
        campfiresound.style.display = "none"
        seasound.style.display = "block"
        seasound.play()
        campfiresound.pause()
        video1.style.transform = "translate(0,0)"
        video2.style.transform = "translate(0,0)"
    }

    function chatjs() {
        video2.style.transition = "all 1s"
        mainbox.style.transform = "translate(-180vw,0)"
        popular.style.backgroundColor = "orange"
        category.style.backgroundColor = "orange"
        chat.style.backgroundColor = "orange"
        mainbox.style.backgroundColor = "black"
        // video1.pause()
        // video2.play()
        campfiresound.style.display = "block"
        seasound.style.display = "none"
        campfiresound.play()
        seasound.pause()
        video1.style.transform = "translate(-100vw,0)"
        video2.style.transform = "translate(-100vw,0)"
        mainbox.style.transition = "all 1s"
        video1.style.transition = "all 1s"
    }
    popular.addEventListener("click", popularjs)
    category.addEventListener("click", categoryjs)
    chat.addEventListener("click", chatjs)
    // 검색 이벤트
    const searchbox_title_1 = document.querySelector(".searchbox-title-1")
    const searchbox_input = document.querySelector(".searchbox-input")
    let findboardnum = 1
    searchbox_title_1.addEventListener("click",()=>{
        if (findboardnum === 1){
            searchbox_title_1.textContent ="닉네임"
            searchbox_input.name = "findnickname"
            searchbox_input.placeholder = "닉네임을 입력해주세요"
            findboardnum = findboardnum - 1
        } else {
            searchbox_title_1.textContent ="제목"
            searchbox_input.name = "findtitle"
            searchbox_input.placeholder = "제목을 입력해주세요"
            findboardnum = findboardnum + 1
        }
    })
    // <!-- 글쓰기 클릭시 이벤트 -->
    const writebox = document.querySelector(".writebox")
    const writebutton = document.querySelector(".writebutton")
    let num = 0

    writebutton.addEventListener("click", () => {

        if (num === 1) {
            writebox.style.zIndex = "-1"
            writebox.style.opacity = "0"
            writebutton.textContent = "글쓰기"
            writebutton.style.backgroundColor ="#17A7D6"
            writebutton.style.color ="white"
            num = num - 1
        } else {
            writebox.style.zIndex = "2"
            writebox.style.opacity = "1"
            writebutton.textContent = "닫기"
            writebutton.style.backgroundColor ="white"
            writebutton.style.color = "#17A7D6"
            num = num + 1
        }
    })
</script>
</body>

</html>