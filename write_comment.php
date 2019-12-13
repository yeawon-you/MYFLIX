<?php
	$connect = mysqli_connect("127.0.0.1","root","1234","LoginTest");

	@session_start();

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="assets/css/main.css?after">
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

</head>

<body>
<div id="wrap">
<!--헤더 : 이너 + 메뉴 -->
	<header class="header">
		<!--헤더 이너 : 로고, 검색창, 로그인-->
		<div class="inner">
			<!--이너 1) 로고-->
			<div class="logo">
				<a href="main.php">
					<img src="https://github.com/yeawon-you/MYFLIX/blob/master/images/logo.png?raw=true"/>
				</a>
			</div>

			<!--이너3) 메뉴바-->
			<div class="gnb" style="overflow: hidden;">
				<ul >
					<li class="gnb_list">
						<a href="review.html">
							<span>Review</span>
						</a>
					</li>
					<li class="gnb_list">
						<a href="ranking.html">
							<span>Ranking</span>
						</a>
					</li>

					<li class="gnb_list">
						<form name="test1" method="POST">
							<span id=nickname>
							<?php
                     		if(isset($_SESSION['ID'])){?>
                           <input type="button" value="MYPAGE" onclick="sub(1)" id="btn1">
                           
                  <?php   } 
							

							else { ?>
							<input type="button" value="로그인" onclick="sub(1)" id="btn1">
						<?php } ?>
							
	
					</li>


					<li class="gnb_list">
						<?php

						if(isset($_SESSION['ID'])){ ?>
							<input type="button" value="로그아웃" onclick='location.replace("./logout_action.php")' id="btn2">
						<?php } 

						else{
						?>			
							<input type="button" value="회원가입" onclick="sub(2)" id="btn2">
						</form>
						<?php }
						?>
					</li>

				</ul>
			</div>
			<!--//메뉴바-->

		
			<!--이너4) 검색창-->
			<div class="main_search">
           		<select name="searchtype"  class="searchType">
                	<option value="제목">제목</option>
                	<option value="배우">배우</option>
                	<option value="장르">장르</option>
                	<option value="닉네임">닉네임</option>
            	</select> 
				<input name="searchterm" class="searchTerm" type="text" size="100%" placeholder="검색어를 입력해주세요">
				<button type="submit" class="searchButton"><img src="https://github.com/yeawon-you/MYFLIX/blob/master/images/search.png?raw=true"></button>
			</div>
		</div>
		<!--헤더 이너-->	

	</header>
	<!--//헤더--> 


<!--영화정보-->


<div id="content" class="main">
<!--분석글--> <!--코멘트 라인-->
<div id="analysis">
	<div class="comment_line">
	<!--코멘트 헤더-->
	<div class="comment_header">
		<p style="text-align: center;">
			<img src="https://github.com/yeawon-you/MYFLIX/blob/master/images/%EC%BD%94%EB%A9%98%ED%8A%B8%20%EC%9E%91%EC%84%B1.png?raw=true"/>
		</p>
	</div>	
	<!--//코멘트 헤더-->

	<!--코멘트 form : 1) comment_title 2)comment_option 3)-->
	<div class="comment_form">

		<!--1) comment_title-->
		<div class="comment_title">
		<?php echo $_SESSION['TITLE']; ?>
		
		</div>
		<!--//comment_title-->

		<!--2)commnet option-->
		<div class= "comment_option1">
			<!--별점-->
				<img src="https://github.com/yeawon-you/MYFLIX/blob/master/images/%EB%B3%84%EC%A0%90.png?raw=true">
		</div>

		<div class="comment_option2">
			<form name = "writecomment" method="POST" action="commentSave.php">

				<input type="hidden" value="" name="star" id="star">
				<label id="star1" class="star" onclick="checkStar(1)">☆</label>
				<label id="star2" class="star" onclick="checkStar(2)">☆</label>
				<label id="star3" class="star" onclick="checkStar(3)">☆</label>
				<label id="star4" class="star" onclick="checkStar(4)">☆</label>
				<label id="star5" class="star" onclick="checkStar(5)">☆</label>
		</div>


		<div class= "comment_option3">
			<img src="https://github.com/yeawon-you/MYFLIX/blob/master/images/%EC%8A%A4%ED%8F%AC%EC%9D%BC%EB%9F%AC.png?raw=true">
		</div>

		<div class="comment_option4">
			<!--스포일러선택-->
			<input type="hidden" value name="n1" id="n1">

			<div class="checkButton" onclick="check('1', '1', 2)" id="bt_1_1">O</div> 
			<div class="checkButton" onclick="check('1', '2', 2)" id="bt_1_2">X</div><br><br>


		</div>
		<!--//comment option-->
	

		<!--칸-->
		<div class="textarea_outline">
		<textarea class="textarea1" name="analysis" cols="300" rows="10" placeholder="코멘트를 입력해주세요"></textarea>
		</div>

		<!--해시태그입력-->
		

		<input type="text" name="hashtag" placeholder="해시태그를 입력하세요 ex) #5점 " size="80">


		<!--등록버튼-->

		<div class="comment_submit">
		<input type="submit" value="등록하기">
		</div>
		</form>
		
	</div>
	</div>
</div>
</div>
</div>

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


</body>
</html>