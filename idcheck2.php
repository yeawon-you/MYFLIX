<?php
    $connect = mysqli_connect("127.0.0.1","root","1234","LoginTest");
 
if($connect) 
      echo "db connected";
     else
      echo "db not connected"; 
	

    $ID=$_POST['ID'];

 

    
    //ID을 입력하지 않았을 때 
    if($ID == ''){
        echo 'ID는 4글자부터 가능합니다.';
	exit;
    }

    //길이제한 ID(4~15자) 
    if(mb_strlen($ID)<4){
        echo 'ID는 4~15자 이내로 가능합니다.';
	exit;
    }else if(15<mb_strlen($ID)){
        echo 'ID는 4~15자 이내로 가능합니다.';
	exit;
    }


    //ID중복검사 
    $sql = "SELECT * FROM Users WHERE ID = '{$ID}'"; //Users테이블의 ID 칼럼에서 입력된 ID와 같은 값을 가진 데이터를 가져오는 명령어
    $res = mysqli_query($connect,$sql); //명령어 데이터베이스에서 실행하여 res에 값저장 
    if($res->num_rows >= 1){ //res가 1줄이상이면 이미 존재
        echo '이미 존재하는 아이디가 있습니다.';
        exit;
    }	
    else{
    	echo '사용 가능한 아이디 입니다.';
    }



    
?>