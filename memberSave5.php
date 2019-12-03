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
        echo 'ID를 입력해주세요.';
	exit;
    }
    else if($PASSWORD == ''){
	echo '비밀번호를 입력해주세요.';
	exit;
    }
    else if($NICKNAME == ''){
	echo '닉네임을 입력해주세요.';
	exit;
    }
   
    //길이제한 ID(4~15자) , PASSWORD(8~12자), NICKNAME(2~8자)  
    if(mb_strlen($ID)<4){
        echo 'ID는 4~15자 이내로 가능합니다.';
	exit;
    }else if(15<mb_strlen($ID)){
        echo 'ID는 4~15자 이내로 가능합니다.';
	exit;
    }

    if(mb_strlen($PASSWORD)<8){
        echo '비밀번호는 8~12자 이내로 가능합니다.';
	exit;
    }
    else if(12<mb_strlen($PASSWORD)){
        echo '비밀번호는 8~12자 이내로 가능합니다.';
	exit;
    }else{ // 비밀번호 조건이 만족되었음을 확인하면 암호화진행 
	$PASSWORD=md5($PASSWORD);	
    }


    if(mb_strlen($NICKNAME)<2){
        echo '닉네임은 2~8자 이내로 가능합니다.';
	exit;
    }
    else if(8<mb_strlen($NICKNAME)){
	echo '닉네임은 2~8자 이내로 가능합니다.';
	exit;
    }

    //ID중복검사 
    $sql = "SELECT * FROM Users WHERE ID = '{$ID}'"; //Users테이블의 ID 칼럼에서 입력된 ID와 같은 값을 가진 데이터를 가져오는 명령어
    $res = mysqli_query($connect,$sql); //명령어 데이터베이스에서 실행하여 res에 값저장 
    if($res->num_rows >= 1){ //res가 1줄이상이면 이미 존재
        echo '이미 존재하는 아이디가 있습니다.';
        exit;
    }

    //닉네임 중복검사 
    $sql = "SELECT * FROM Users WHERE NICKNAME = '{$NICKNAME}'";
    $res = mysqli_query($connect,$sql);
    if($res->num_rows >= 1){
        echo '이미 존재하는 닉네임이 있습니다.';
        exit;
    }


    

    //위의 조건을 모두 만족함 -> 데이터베이스에 넣기 시작 
    $sql = "INSERT INTO Users(ID, PASSWORD, NICKNAME) VALUES('{$ID}','{$PASSWORD}','{$NICKNAME}');";
 

$result = mysqli_query($connect,$sql);


    if(!$result){
        echo '오류 발생';
    }else
	echo '회원 가입이 완료되었습니다.';

?>
 