<?php
   $connect = mysqli_connect("127.0.0.1","root","54321","LoginTest");

   @session_start();


	if(!$_SESSION['ID']){

		echo "<script>alert('로그인 후에 사용할 수 있는 기능입니다.');</script>";

		echo "<meta http-equiv='refresh' content='1; URL=main_logout.php'>";

    	}


?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="main.css">
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

                            <!--이너 3) 메뉴바,로그인-->
         <div class="gnb" style="overflow: hidden;">
            <ul >
               <li class="gnb_list">
                  <a href="review_list.php">
                     <span>Review</span>
                  </a>
               </li>
               <li class="gnb_list">
                  <a href="ranking.php">
                     <span>Ranking</span>
                  </a>
               </li>

               <li class="gnb_list">
                  <form name="test1" method="get">

                           <input type="button" value="MYPAGE" onclick="sub(1)" id="btn1">
                      
                     </form>
   
               </li>


               <li class="gnb_list">
                  
                     <input type="button" value="로그아웃" onclick='location.replace("./logout_action.php")' id="btn2">
                
               </li>

            </ul>
         </div>
         <!--//메뉴바-->
      
          <!--이너2) 검색창-->
         <div class="main_search">
                 <!--선택-->
                 
                 <form class="search_form"  name="searchmovie" action="search_movie.php" method="get" >
                 <select name="category"  class="searchType">
                   <option value="TITLE">제목</option>
                   <option value="ACTOR">배우</option>
                   <option value="GENRE">장르</option>
                </select> 
                <!--검색어 쓰는 곳-->
                <input type="text" name="SEARCHTERM" class="searchTerm" size="100%" placeholder="검색어를 입력해주세요.">
                <!--버튼-->

                <?php

                  if(isset($_SESSION['ID'])){ ?>
                 <button type="button" class="searchButton" id="search_button" name="SEARCH" onclick="button();"><img src="https://github.com/yeawon-you/MYFLIX/blob/master/images/search.png?raw=true">

                   <?php } 

                  else{
                  ?>     

                   <button type="button" class="searchButton" id="search_button" name="SEARCH" onclick="button();" ><img src="https://github.com/yeawon-you/MYFLIX/blob/master/images/search.png?raw=true"> <?php }?>


              </form>
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
      
      <div class="comment_hashtag">
      <input type="text" name="hashtag" placeholder="해시태그를 입력하세요 ex) #5점 " size="80">
      </div>

      <!--등록버튼-->

      <div class="comment_submit">
      <input type="button" value="등록하기" onclick="sub(5)">
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

    function sub(index){
      if(index == 1){
         document.test1.action="mypage2.php"; //sub(1)은 로그인 기능을 하는 php로 연결
	 document.test1.submit();
      }
      if(index == 2){
         document.test1.action="JOINUS_FINAL.html"; //sub(2)은 회원가입 기능을 하는 php로 연결
	 document.test1.submit();
      }
      if(index == 3){
	 event.stopImmediatePropagation();
         document.searchmovie.action="search_movie.php";
	 document.searchmovie.submit();
      }
      if(index == 4){
	event.stopImmediatePropagation();
         document.searchmovie2.action="search_movie.php";
	 document.searchmovie2.submit();
      }           
      if(index == 5){
	 event.stopImmediatePropagation();
	document.writecomment.action="commentSave.php";
	 document.writecomment.submit();
	}
   }

   function button(){
    event.stopImmediatePropagation(); //위의 div로 기능이 넘어가지 않게 하는 것 
    document.searchmovie.action='search_movie.php';
    document.searchmovie.submit();
   }



</script>


</body>
</html>