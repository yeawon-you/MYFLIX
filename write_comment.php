<?php
	$connect = mysqli_connect("127.0.0.1","root","54321","LoginTest");

	@session_start();


?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>MYFLIX</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript">
function checkbox(num) {
   $('#checkbox'+num).click();
}

function check(wht, num, maxn) {
   for (var i = 1; i < maxn+1; i++) {
      $('#bt_'+wht+'_'+i).attr('class', 'checkButton');
   
   }
   $('#bt_'+wht+'_'+num).attr('class', 'checkButtonOn');
   $('#n'+wht).val(num);
}

function register() {
      if ($("input[name=title]").val() == "")
         alert("제목을 입력하세요");
      else if ($("#n1").val() == "")
         alert("스포일러 여부를 선택하세요");
      else if ($("#n2").val() == "")
         alert("공개 여부를 선택하세요");
      else if ($("textarea[name=analysis]").val() == "")
         alert("분석글 내용을 써주세요");
      else
         document.sendForm.submit();
}
</script>
<style>
   .checkButton {
      font-size: 12px;
      display: inline-block;
      background-color: rgba(226, 226, 226, 1);
      border:1px solid rgba(0, 0, 0, 1);
      padding: 5px 10px 5px 10px;
   }

   .checkButtonOn {
      font-size: 12px;
      padding: 5px 10px 5px 10px;
      display: inline-block;
      background-color: rgba(255, 127, 127, 1);
      border:1px solid rgba(0, 0, 0, 1);
   }
</style>
</head>

<body>
<!--영화정보-->
<?php
	echo $_SESSION['TITLE'];
?>

<!--분석글-->
<form name = "writecomment" method="POST" action="commentSave.php">
<div id="analysis">
   
	<!--별점-->
	별점 : 
	<input type="hidden" value="" name="star" id="star">
	<label id="star1" class="star" onclick="checkStar(1)">☆</label>
	<label id="star2" class="star" onclick="checkStar(2)">☆</label>
	<label id="star3" class="star" onclick="checkStar(3)">☆</label>
	<label id="star4" class="star" onclick="checkStar(4)">☆</label>
	<label id="star5" class="star" onclick="checkStar(5)">☆</label>

	<br><br>

   <!--스포일러선택-->
   <input type="hidden" value name="n1" id="n1">
   스포일러 <div class="checkButton" onclick="check('1', '1', 2)" id="bt_1_1">있음</div> 
             <div class="checkButton" onclick="check('1', '2', 2)" id="bt_1_2">없음</div><br><br>

   
   <textarea name="analysis" cols="100" rows="30"></textarea>
</div>
<br>

<!--해시태그입력-->
   해시태그 : <input type="text" name="hashtag" placeholder="해시태그를 입력하세요 ex)#5점" size="200"><br><br>


<br><br><br>
<!--등록버튼--!>
<div id="registerbutton">

   <input type="submit" value="등록하기" >
</div>
</form>

<script type="text/javascript">


 
function oneCheckbox(a) {
	var obj = document.getElementsByName("checkbox");
	for (var i=0; i<obj.length; i++) {
		if(obj[i]!=a) {
			obj[i].checked = false;
			obj[i].onclick=function(){oneCheckbox(this);};
		} 
	}
	a.onclick=function(){return false;};
	if (a.getAttribute('value') == 1)
		document.getElementById("analysis").style.display="block";
	else
		document.getElementById("analysis").style.display="none";
}
function checkbox(num) {
	$('#checkbox'+num).click();
}
function check(wht, num, maxn) {
	for (var i = 1; i < maxn+1; i++) {
		$('#bt_'+wht+'_'+i).attr('class', 'checkButton');
	
	}
	$('#bt_'+wht+'_'+num).attr('class', 'checkButtonOn');
	$('#n'+wht).val(num);
}

function checkStar(num) {
	$('#star').val(0);
	for (var i=1; i<6;i++) {
		if ( i <= num ) {
			$('#star'+i).text('★');
			$('#star').val(i);//i가 별의 개수임 form star의 value값임
		}
		else
			$('#star'+i).text('☆');
	}

}

function register() {
	if ($('#star1').text() == '☆') {
		alert("별점을 입력하세요");
		return false;
	}
	if ($("input:checkbox[id=checkbox2]").is(":checked") == true) {
		if (document.sendForm.comment.value == "")
			alert("코멘트를 입력하세요");
		else
			document.sendForm.submit();
	} else {
		if ($("input[name=title]").val() == "")
			alert("제목을 입력하세요");
		else if ($("#n1").val() == "")
			alert("스포일러 여부를 선택하세요");
		else if ($("#n2").val() == "")
			alert("공개 여부를 선택하세요");
		else if ($("textarea[name=analysis]").val() == "")
			alert("분석글 내용을 써주세요");
		else
			document.sendForm.submit();
	}
	
}
</script>

<>


</body>
</html>