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


<div id="content" class="main">
  <!--리뷰 라인-->
   <div class="review_line">
      <!--리뷰 헤더-->
     <div class="review_header">
        <p style="text-align: center;">
           <img src="https://github.com/yeawon-you/MYFLIX/blob/master/images/%EB%A6%AC%EB%B7%B0%EC%9E%91%EC%84%B1.png?raw=true"/>
        </p>
     </div>   
     <!--//리뷰 헤더 -->

  <!--리뷰 form : 1) movie_title 2)review_title 3)파일 선택 4)content-->
    <div class="review_form">
       <!--파일첨부를 위한 ENCTYPE추가-->
              <form name='writereview' method='post' ENCTYPE='multipart/form-data' action='reviewSave.php'>
          <!--1) movie_title-->
          <div class="movie_title_img">
            <img src="https://github.com/yeawon-you/MYFLIX/blob/master/images/%EC%9E%91%ED%92%88.png?raw=true"> 
          </div>
          <div class="movie_title_input">  
            <input type="text" name="MOVIETITLE" placeholder="작품 제목을 입력하세요" size="90">    
          </div>
          <!--// movie_title-->
       
          <!--2) review title-->
          <div class="review_title_img">
            <img src="https://github.com/yeawon-you/MYFLIX/blob/master/images/%EC%A0%9C%EB%AA%A9.png?raw=true"> 
          </div>
          <div class="review_title_input">
            <input type="text" name="TITLE" placeholder="리뷰 제목을 입력하세요" size="90"> 
           </div>
          <!-- // review_title-->

          <!--3)파일 선택-->
          <div class= "review_file_img">
                <img src="https://github.com/yeawon-you/MYFLIX/blob/master/images/%ED%8C%8C%EC%9D%BC.png?raw=true">
          </div>

          <div class="review_file_input">
             <!--파일업로드 기능버튼-->

             <input type="file" name="upfile" size="20" style="vertical-align: top;">
          </div>


          <!--4) content-->
          <div class="textarea_outline">
          <textarea class="textarea1" name="CONTENT" cols="200" rows="50" placeholder="리뷰를 입력해주세요"></textarea>
          </div>

          <!--등록버튼-->
          <div class="review_submit">
          <input type="button" name="review" value="등록하기" onclick="submit(1)">
          </div>

        
  </div>
  
  <!--//review form-->
  </form>
  </div>
<!--//review line-->
</div>
<!--content-->
</div>
                  

 

<script language="javascript">
 
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


function submit(index) {
   if(index == 1){
        event.stopImmediatePropagation();
        document.writereview.action = "reviewSave.php";
        document.writereview.submit();
   }
   if(index == 2){
   event.stopImmediatePropagation();
   location.replace("./review_list.php");
   }
}
 

   function button(){
    event.stopImmediatePropagation();
    document.searchmovie.action='search_movie.php';
    document.searchmovie.submit();
   }

</script>
 

</body>
</html>