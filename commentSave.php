<?php
    $connect = mysqli_connect("127.0.0.1","root","54321","LoginTest");
 

    @session_start();
	

    $MOVIETITLE=$_SESSION['TITLE'];
    $CONTENTS=$_POST['analysis'];
    $HASHTAG=$_POST['hashtag'];
    $SCORE=$_POST['star'];
    $SPOIL=$_POST['n1'];
    $WRITER=$_SESSION['NICKNAME'];
    

 
    //PHP에서 유효성 재확인 ->확인완료
    echo $MOVIETITLE.$CONTENTS.$HASHTAG.$SCORE.$SPOIL.$WRITER;
 
    //입력하지 않았을 때

	if($CONTENTS ==''){
		echo '내용을 입력해주세요.';
		exit;
	}
	else if($HASHTAG ==''){
		echo '해시태그를 입력해주세요.';
		exit;
	}
	else if($SCORE ==''){
		echo '별점을 입력해주세요.';
		exit;
	}
	else if($SPOIL ==''){
		echo '스포일러 여부를 체크해주세요.';
		exit;
	}
	//별점과 스포일러 여부를 int형으로 전환
	$SCORE=$SCORE+0;
   	$SPOIL=$SPOIL+0;


	$sql = "INSERT INTO Comment(MOVIETITLE, SCORE, SPOIL,CONTENTS,HASHTAG,WRITER) VALUES('{$MOVIETITLE}', '{$SCORE}', '{$SPOIL}', '{$CONTENTS}', '{$HASHTAG}','{$WRITER}');";
 

$result = mysqli_query($connect,$sql);


    if(!$result){
        echo '오류 발생';
    }else
	echo '게시글 작성이 완료되었습니다.';

?>