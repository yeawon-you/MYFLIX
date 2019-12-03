<?php
                $connect = mysqli_connect("127.0.0.1","root","54321","LoginTest");                

 
                @session_start();
 		if(isset($_SESSION['ID'])) {	
                        echo $_SESSION['NICKNAME'];?>님 안녕하세요
                        <br/>

<?php		}
		$category = $_POST['category'];
		$search_term = $_POST['SEARCHTERM'];
?>

		<h1><?php echo $category; ?>에서 '<?php echo $search_term; ?>'검색결과</h1>

		<br></br>
<?php		



		    $sql = "SELECT * FROM Search WHERE $category LIKE '%$search_term%'";
   		    $res = mysqli_query($connect,$sql);	
		    $row=mysqli_fetch_assoc($res); //한번실행 -> 첫번쨰 나온것으로 진행 
		    $_SESSION['TITLE']=$row['TITLE'];



		    $sql = "SELECT * FROM Search WHERE $category LIKE '%$search_term%'";
   		    $res = mysqli_query($connect,$sql);
		    $count = mysqli_num_rows($res);//sql까지 재실행 -> 첫번째나온 결과물으로 인식함 

		    if($count>=1){
				$row=mysqli_fetch_assoc($res); //mysqli_fetch_assoc만 재실행 했으므로 ->2번째껄로 넘어감

				$TITLE=$row['TITLE'];
				$POSTER=$row['POSTER'];
				$INTRO=$row['INTRO'];
				$ACTOR=$row['ACTOR'];
				

				

				echo "$TITLE<br>";
				echo "<img src=$POSTER><br>";
				echo "$ACTOR<br>";
				echo "$INTRO<br>";
?>

				<form name="write" method="post">
				<input type="button" name="COMMENT" value="COMMENT" onclick="mysub(1)">
				<input type="button" name="REVIEW" value="REVIEW" onclick="mysub(2)">
				</form>


<?php
				echo "<br>";
				echo "<br>";
				
			//연관검색들을 표시하는것->제목이랑 포스터만 
			while($row=mysqli_fetch_assoc($res)){
?>
				<?php echo $search_term; ?>이 포함된 다른영화<br>

<?php				
				//검색해서 나온 변수 저장 
				$TITLE=$row['TITLE'];
				$POSTER=$row['POSTER'];

		

				echo "$TITLE<br>";
				echo "<img src=$POSTER><br>";

				echo "<br>";
				
			}

		    

	           
?>

	<!--코맨트를 보여주기 / 리뷰를 보여주기 기능 선택-->
	<!--코맨트를 보여주기 기능 선택-->
		SHOW COMMENT<br>
		<span onclick="checkbox('1')">NO SPOILER </span>
		<input type="checkbox" name="checkbox" checked="checked" id="checkbox1" value="1" onclick="oneCheckbox(this)">
		<span onclick="checkbox('2')">WITH SPOILER </span>
		<input type="checkbox" name="checkbox" id="checkbox1" value="2" onclick="oneCheckbox(this)"><br>
<br>


	<!-- 스포일러 포함 X코맨트만 보여줌 --!>
		<div id="comment" style="display:block">

<?php
		$sql = "SELECT * FROM Comment WHERE MOVIETITLE = '{$_SESSION['TITLE']}' and SPOIL = '2'";
   		$res = mysqli_query($connect,$sql);

	
		while($row=mysqli_fetch_assoc($res)){  //여기서 한번실행해서 첫번째 것을 의미 
			$SCORE=$row['SCORE'];
			$WRITER=$row['WRITER'];
			$CONTENTS=$row['CONTENTS'];
			

			
			if($SCORE=="1"){
				echo "★☆☆☆☆<br>";
			}
			else if($SCORE=="2"){
				echo "★★☆☆☆<br>";
			}
			else if($SCORE=="3"){
				echo "★★★☆☆<br>";
			}
			else if($SCORE=="4"){
				echo "★★★★☆<br>";
			}
			else if($SCORE=="5"){
				echo "★★★★★<br>";
			}

				echo "$WRITER<br>";
				echo "$CONTENTS<br>";
				echo "<br>";
							
		}

?>		
		</div>

	<!-- 스포일러 포함 코맨트같이 보여줌 --!>
		<div id="spoilcomment" style="display:none">

<?php
		$sql = "SELECT * FROM Comment WHERE MOVIETITLE = '{$_SESSION['TITLE']}'";
   		$res = mysqli_query($connect,$sql);

	
		while($row=mysqli_fetch_assoc($res)){  //여기서 한번실행해서 첫번째 것을 의미 
			$SCORE=$row['SCORE'];
			$WRITER=$row['WRITER'];
			$CONTENTS=$row['CONTENTS'];
			

			
			if($SCORE=="1"){
				echo "★☆☆☆☆<br>";
			}
			else if($SCORE=="2"){
				echo "★★☆☆☆<br>";
			}
			else if($SCORE=="3"){
				echo "★★★☆☆<br>";
			}
			else if($SCORE=="4"){
				echo "★★★★☆<br>";
			}
			else if($SCORE=="5"){
				echo "★★★★★<br>";
			}

				echo "$WRITER<br>";
				echo "$CONTENTS<br>";
				echo "<br>";
							
		}

?>		
		</div>



	<!--리뷰를 보여주기 기능 선택 이 밑에 게시판 형식으로 보여주기-->
		//<span onclick="checkbox('0')">SHOW REVIEW </span>
		//<input type="checkbox"  name="checkbox" id="checkbox2" value="2" onclick="oneCheckbox(this)"><br><br>





<?php				
		    }
		else{
			echo "검색 결과가 없습니다.";
		}

?>



<script>

	function mysub(index){
		if(index==1){
			document.write.action="write_comment.php";
		}
		if(index==2){																	document.write.action="write_review.php";
		}	
		document.write.submit();
	}

	function oneCheckbox(a) {
	var obj = document.getElementsByName("checkbox");
	for (var i=0; i<obj.length; i++) {
		if(obj[i]!=a) {
			obj[i].checked = false;
			obj[i].onclick=function(){oneCheckbox(this);};
		} 
	}
	a.onclick=function(){return false;};
	if (a.getAttribute('value') == 1){
		document.getElementById("comment").style.display="block";
		document.getElementById("spoilcomment").style.display="none";
		}
	if (a.getAttribute('value') == 2){
		document.getElementById("spoilcomment").style.display="block";
		document.getElementById("comment").style.display="none";
	}
}

	
	function checkbox(num) {
	$('#checkbox'+num).click();
	}

</script>