<?php
   $connect = mysqli_connect("127.0.0.1","root","54321","LoginTest");

   @session_start();

    if(!$_SESSION['ID']){?>
	<script>
		alert('로그인 먼저 해주세요');
		location.replace("./main_logout.php");	
	</script>	
<?php    }

if(isset($_GET['PASSWORD'])) $PASSWORD=$_GET['PASSWORD'];

if(isset($_GET['NEWPASSWORD'])) $NEWPASSWORD=$_GET['NEWPASSWORD'];


if(isset($_GET['NEWNICKNAME'])) $NEWNICKNAME=$_GET['NEWNICKNAME'];


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
                  <a href="ranking.html">
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
                <input type="text" name="SEARCHTERM" class="searchTerm" size="100%" placeholder="검색어를 입력해주세요">
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

  <!--내용-->
  <div id="content" class="main">
    <div class="login">
    
      <div class="login-header">
        <p style="text-align: center;">
        <img src="https://github.com/yeawon-you/MYFLIX/blob/master/images/%ED%9A%8C%EC%9B%90%EA%B0%80%EC%9E%85.png?raw=true"/>
      </p>
      </div>

      <div class="login-form">
        <form name="join" method="get" action="passwordcheck.php">
        <h3>Password : </h3>
        <input type="password" value="<?php echo $PASSWORD;?>"size="30" name="PASSWORD" ></td>
        <input type="button" value="비밀번호확인" onclick="mysubmit(3)">
	</form> 

	<form name="join2" method="get">
        <h3>New Password : </h3>
        <input type="password" size="30" name="NEWPASSWORD" value="<?php echo $NEWPASSWORD;?>">
  
        <h3>New NickName : </h3>
        <input type="text" size="12" maxlength="8" name="NEWNICKNAME" value="<?php echo $NEWNICKNAME;?>">
      
        <input type="button" value="변경하기" onclick="mysubmit(4)">
        <input type="reset" value="다시쓰기"></form>
        </form>
      </div> 
  
    </div> 

  </div>

    <!--//내용-->
  
 

  <script = "text/javascript">


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


        function mysubmit(index){
    if(index == 1){
      document.join.action="idcheck2.php";
	document.join.submit();
    }
    if(index == 2){
      document.join.action="memberSave5.php";
	document.join.submit();
    }
    document.join.submit();
    if(index == 3){
	event.stopImmediatePropagation();
	document.join.action="passwordcheck.php";
	document.join.submit();

	}
    if(index == 4){
	document.join2.action="memberChange.php";
	document.join2.submit();
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