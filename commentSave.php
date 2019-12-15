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
?>
		<script>
                        alert("내용을 입력해주세요.");
                        history.back();
                </script>

		
<?php
		exit;
	}
	else if($HASHTAG ==''){

?>
		<script>
                        alert("해시태그를 입력해주세요.");
                        history.back();
                </script>

<?php
		exit;
	}
	else if($SCORE ==''){

?>

		<script>
                        alert("해시태그를 입력해주세요.");
                        history.back();
                </script>

<?php
		exit;
	}
	else if($SPOIL ==''){

?>
		<script>
                        alert("스포일러 여부를 체크해주세요.");
                        history.back();
                </script>



<?php
		exit;
	}
	//별점과 스포일러 여부를 int형으로 전환
	$SCORE=$SCORE+0;
   	$SPOIL=$SPOIL+0;


	$sql = "INSERT INTO Comment(MOVIETITLE, SCORE, SPOIL,CONTENTS,HASHTAG,WRITER) VALUES('{$MOVIETITLE}', '{$SCORE}', '{$SPOIL}', '{$CONTENTS}', '{$HASHTAG}','{$WRITER}');";
 

$result = mysqli_query($connect,$sql);


    if(!$result){

?>
		<script>
                        alert("오류가 발생하였습니다.");
                        location.replace("./main.php");
                </script>

<?php
        
    }else
?>
		<script>
                        alert("게시글 작성이 완료되었습니다.");
                        location.replace(href="search_movie.php?category=TITLE&SEARCHTERM=<?php echo $_SESSION['TITLE']; ?>"); //코맨트 작성한다음 바로 볼 수 있도록 그창으로 이동됨 
                </script>

