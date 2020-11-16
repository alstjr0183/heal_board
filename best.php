<?php
    include ("./conn.php");
    $idx = $_REQUEST['idx'];
    $id = $_REQUEST['id'];


    $sql = "select * from healbest where contentsidx= '$idx' and userid= '$id'";
//    $sql = "insert into healbest (userid, contentsidx) value ('$id','$idx')";
    $result = $mysqli -> query($sql );
    $count = mysqli_num_rows($result);
    if($count>0){
        $sql3 = "delete from healbest where contentsidx='$idx' and userid ='$id'";
        $result3 = $mysqli -> query($sql3);
        $sql4 = "update healboard set best=best -1 where idx='$idx'";
        $result4 = $mysqli -> query($sql4);
        echo "<script>alert('추천이 취소되었습니다'); 
		history.go(-1);
		</script>";
    }else{
        $sql2 = "insert into healbest (userid, contentsidx) value ('$id','$idx')";
        $result2 = $mysqli -> query($sql2 );
        $sql5 = "update healboard set best=best +1 where idx='$idx'";
        $result5 = $mysqli -> query($sql5);
        echo "<script>alert('추천이 되었습니다'); 
		history.go(-1);
		</script>";
    }
?>