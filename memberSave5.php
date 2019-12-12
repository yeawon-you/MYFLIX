
<?php
    $connect = mysqli_connect("127.0.0.1","root","54321","LoginTest");
 
//if($connect) 
  //    echo "db connected";
    // else
      //echo "db not connected"; 
    
 

    $ID=$_POST['ID'];
    $PASSWORD=$_POST['PASSWORD'];
    $NICKNAME=$_POST['NICKNAME'];

 



    //PHP에서 유효성 재확인
 
    //아이디 중복검사.

   // echo $ID.$NICKNAME.$PASSWORD.' <<END>>';
 
 
    //ID, PASSWORD, NICKNAME을 입력하지 않았을 때 
    if($ID == ''){
?>
        <script>
                alert("아이디를 입력해주세요.");
                location.replace("./JOINUS_FINAL.php");
        </script>
<?php
	exit;
    }
    else if($PASSWORD == ''){
?>
	<script>
                alert("비밀번호를 입력해주세요.");
                location.replace("./JOINUS_FINAL.php");
        </script>
<?php
	exit;
    }
    else if($NICKNAME == ''){
?>
	<script>
                alert("닉네임을 입력해주세요.");
                location.replace("./JOINUS_FINAL.php");
        </script>

<?php
	exit;
    }
   
    //길이제한 ID(4~15자) , PASSWORD(8~12자), NICKNAME(2~8자)  
    if(mb_strlen($ID)<4){
?>
	<script>
                alert("ID는 4~15자 이내로 가능합니다.");
                location.replace("./JOINUS_FINAL.php");
        </script>

<?php
	exit;
    }else if(15<mb_strlen($ID)){
?>
	<script>
                alert("ID는 4~15자 이내로 가능합니다.");
                location.replace("./JOINUS_FINAL.php");
        </script>

<?php
	exit;
    }

    if(mb_strlen($PASSWORD)<8){
?>
	<script>
                alert("비밀번호는 8~12자 이내로 가능합니다.");
                location.replace("./JOINUS_FINAL.php");
        </script>
<?php
	exit;
    }
    else if(12<mb_strlen($PASSWORD)){
?>
	<script>
                alert("비밀번호는 8~12자 이내로 가능합니다.");
                location.replace("./JOINUS_FINAL.php");
        </script>

<?php
	exit;
    }else{ // 비밀번호 조건이 만족되었음을 확인하면 암호화진행 
	$PASSWORD=md5($PASSWORD);	
    }


    if(mb_strlen($NICKNAME)<2){
?>
	<script>
                alert("닉네임은 2~8자 이내로 가능합니다.");
                location.replace("./JOINUS_FINAL.php");
        </script>

<?php
	exit;
    }
    else if(8<mb_strlen($NICKNAME)){
?>
	<script>
                alert("닉네임은 2~8자 이내로 가능합니다.");
                location.replace("./JOINUS_FINAL.php");
        </script>

<?php
	exit;
    }

    //ID중복검사 
    $sql = "SELECT * FROM Users WHERE ID = '{$ID}'"; //Users테이블의 ID 칼럼에서 입력된 ID와 같은 값을 가진 데이터를 가져오는 명령어
    $res = mysqli_query($connect,$sql); //명령어 데이터베이스에서 실행하여 res에 값저장 
    if($res->num_rows >= 1){ //res가 1줄이상이면 이미 존재
?>
        <script>
                alert("이미 존재하는 아이디 입니다.");
                location.replace("./JOINUS_FINAL.php");
        </script>
<?php
        exit;
    }

    //닉네임 중복검사 
    $sql = "SELECT * FROM Users WHERE NICKNAME = '{$NICKNAME}'";
    $res = mysqli_query($connect,$sql);
    if($res->num_rows >= 1){
?>
	<script>
                alert("이미 존재하는 닉네임입니다.");
                location.replace("./JOINUS_FINAL.php");
        </script>

<?php
        exit;
    }

    $PROFILE1='https://github.com/yeawon-you/MYFLIX/blob/master/images/profile1.png?raw=true';
    $PROFILE2='https://github.com/yeawon-you/MYFLIX/blob/master/images/profile2.png?raw=true';
    $PROFILE3='https://github.com/yeawon-you/MYFLIX/blob/master/images/profile3.png?raw=true';
    $PROFILE4='https://github.com/yeawon-you/MYFLIX/blob/master/images/profile4.png?raw=true';
    $PROFILE5='https://github.com/yeawon-you/MYFLIX/blob/master/images/profile5.png?raw=true';	


    $randomNum=mt_rand(1,5);   
    
    if($randomNum==1)
	$PROFILEIMAGE=$PROFILE1;
    else if($randomNum==2)
	$PROFILEIMAGE=$PROFILE2;
    else if($randomNum==3)
	$PROFILEIMAGE=$PROFILE3;
    else if($randomNum==4)
	$PROFILEIMAGE=$PROFILE4;
    else if($randomNum==5)
	$PROFILEIMAGE=$PROFILE5;


    //위의 조건을 모두 만족함 -> 데이터베이스에 넣기 시작 
    $sql = "INSERT INTO Users(ID, PASSWORD, NICKNAME, PROFILEIMAGE) VALUES('{$ID}','{$PASSWORD}','{$NICKNAME}','{$PROFILEIMAGE}');";
 

$result = mysqli_query($connect,$sql);


    if(!$result){
?>
        <script>
                alert("오류가 발생하였습니다. 다시 시도해주세요.");
                location.replace("./JOINUS_FINAL.php");
        </script>

<?php
    }else{
?>
	<script>
                alert("회원가입이 완료되었습니다.");
                location.replace("./LOGIN_PAGE.php");
        </script>
<?php
    }

?>
