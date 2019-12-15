<?php
    $connect = mysqli_connect("127.0.0.1","root","54321","LoginTest");
 

    @session_start();

$NEWPASSWORD=$_GET['NEWPASSWORD'];
$NEWNICKNAME=$_GET['NEWNICKNAME'];

$ID = $_SESSION['ID'];

if(mb_strlen($NEWPASSWORD)<8){
?>
    <script>
                alert("비밀번호는 8~12자 이내로 가능합니다.");
                history.back();
        </script>
<?php
    exit;
    }
    else if(12<mb_strlen($NEWPASSWORD)){
?>
    <script>
                alert("비밀번호는 8~12자 이내로 가능합니다.");
                history.back();
        </script>

<?php
    exit;
    }else{ // 비밀번호 조건이 만족되었음을 확인하면 암호화진행 
    $NEWPASSWORD=md5($NEWPASSWORD);   
    }



    $sql = "SELECT * FROM Users WHERE NICKNAME = '{$NEWNICKNAME}'"; //Users테이블의 닉네임 칼럼에서 입력된 닉네임와 같은 값을 가진 데이터를 가져오는 명령어
    $res = mysqli_query($connect,$sql); //명령어 데이터베이스에서 실행하여 res에 값저장 
    if($res->num_rows >= 1){ //res가 1줄이상이면 이미 존재
?>
        <script>
                alert("이미 존재하는 닉네임 입니다.");
                history.back();
        </script>
<?php
        exit;
    }

else{
	$query="UPDATE Users SET PASSWORD='$NEWPASSWORD', NICKNAME='$NEWNICKNAME' WHERE ID = '$ID'";
	$res = mysqli_query($connect,$query);
	if(!$res){
?>
	<script>
		alert("오류가 발생했습니다.");
		history.back();
	</script>
<?php
	}
	else{
?>
	<script>
		alert("비밀번호와 닉네임이 정상적으로 변경되었습니다.\n재로그인 하여 주시기 바랍니다.");
		location.replace("./logout_action.php");
	</script>
<?php

	}
}
?>
    