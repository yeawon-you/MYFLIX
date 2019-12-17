<?php
                $connect = mysqli_connect("127.0.0.1","root","54321","LoginTest");                

                @session_start();


      ?>


<html>
<head>
   <meta charset="UTF-8">
      <link rel="stylesheet" href="main.css">
</head>
<body>
<!--wrap-->
<div id="wrap">
   <!--헤더 : 이너 + 메뉴 -->
   <header class="header">
    <!--헤더 이너 : 1)로고, 2)검색창, 3)메뉴바,로그인-->
      <div class="inner">
         <!--이너 1) 로고-->
         <div class="logo">
            <a href="main_logout.php">
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
                  <form name="test1" method="POST">

                     

                    
                     <input type="button" value="로그인" onclick="sub(1)" id="btn1">
                
                     
   
               </li>


               <li class="gnb_list">
 

                      
                     <input type="button" value="회원가입" onclick="sub(2)" id="btn2">
                  </form>
                 
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
                <input type="text" name="SEARCHTERM" class="searchTerm" size="100%" placeholder="<?php echo $search_term;?>">
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

  <!--//내용-->
   <div id="content" class="main">
    <div class="login">
      <div class="login-header">
        <p style="text-align: center;">
          <img src="https://github.com/yeawon-you/MYFLIX/blob/master/images/%EB%A1%9C%EA%B7%B8%EC%9D%B8.png?raw=true"/>
        </p>
      </div>

    <div class="login-form">

    <form name="login" method="post" action='login_action.php'>

    <h3>ID : </h3>
    <input type="text" size="30" name="ID">
 
    <h3>Password : </h3>
    <input type="password" size="30" name="PASSWORD">
    <input type="submit" value="로그인">
   <input type="reset" value="다시쓰기">
    </form>
  </div>
  </div>
  </div>

</div>
<!--wrap-->



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

   function button(){
    event.stopImmediatePropagation(); //위의 div로 기능이 넘어가지 않게 하는 것 
    document.searchmovie.action='search_movie.php';
    document.searchmovie.submit();
   }


  </script>


  
</body>


</html>
