<?php
                $connect = mysqli_connect("127.0.0.1","root","1234","LoginTest");                

 
                @session_start();
    
 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"> 
  <link rel="stylesheet" href="assets/css/main.css">

</head>
<body>

  <!--헤더 : 이너 + 메뉴 -->
  <header class="header">
    <!--헤더 이너 : 1)로고, 2)검색창, 3)메뉴바,로그인-->
    <div class="inner">
      <!--이너 1) 로고-->
      <div class="logo">
        <a href="main.php">
          <img src="https://github.com/yeawon-you/MYFLIX/blob/master/images/logo.png?raw=true"/>
        </a>
      </div>

      <!--이너3) 메뉴바,로그인-->
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


    
      <!--이너2) 검색창-->
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

  <!--내용-->
  <div id="content" class="main">
    <div class="login">
    
      <div class="login-header">
        <p style="text-align: center;">
        <img src="https://github.com/yeawon-you/MYFLIX/blob/master/images/%ED%9A%8C%EC%9B%90%EA%B0%80%EC%9E%85.png?raw=true"/>
      </p>
      </div>


      <div class="login-form">
        <form name="join" method="post">
        <h3>ID : </h3>
        <input type="text" size="30" name="ID"></td>
        <input type="button" value="중복확인" onclick="mysubmit(1)">
 
        <h3>Password : </h3>
        <input type="password" size="30" name="PASSWORD">
  
        <h3>NickName : </h3>
        <input type="text" size="12" maxlength="8" name="NICKNAME">
      
        <input type="button" value="가입하기" onclick="mysubmit(2)">
        <input type="reset" value="다시쓰기"></form>
        
      </div> 
  
    </div> 

  </div>

    <!--//내용-->
  
 

  <script = "text/javascript">


      function sub(index){
      if(index == 1){
         document.test1.action="LOGIN_PAGE.php"; //sub(1)은 로그인 기능을 하는 php로 연결
      }
      if(index == 2){
         document.test1.action="JOINUS_FINAL.php"; //sub(2)은 회원가입 기능을 하는 php로 연결
      }
      document.test1.submit();
      
   }



        function mysubmit(index){
    if(index == 1){
      document.join.action="idcheck2.php";
    }
    if(index == 2){
      document.join.action="memberSave5.php";
    }
    document.join.submit();
    
  }
  </script>

</body>
</html>