<?php
                $connect = mysqli_connect("127.0.0.1","root","54321","LoginTest");                

                @session_start();

       if($_SESSION['ID']){
?>
	<script>
		location.replace("./main.php");	
	</script>	
<?php    }


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
                 
                 <form class="search_form"  name="searchmovie" action="search_movie_logout.php" method="get" >
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
   

<!--//여기서부터 피드 코드입니다-->
   
   <?php
    $sql = "SELECT * FROM Comment ORDER BY COUNT DESC";
    $res = mysqli_query($connect,$sql); 

    
    while($row = mysqli_fetch_assoc($res)){
    $SCORE=$row['SCORE'];
    $NICKNAME = $row['WRITER'];
    
    $query = "SELECT * FROM Users WHERE NICKNAME = '$NICKNAME'";
    $result = mysqli_query($connect,$query);
    $my = mysqli_fetch_assoc($result);
    $ID = $my['ID'];


    $MOVIETITLE = $row['MOVIETITLE'];
    $CONTENTS = $row['CONTENTS'];
    $HASHTAG = $row['HASHTAG'];
    $sql2 = "SELECT * FROM Movie WHERE TITLE = '$MOVIETITLE'";
    $res2 = mysqli_query($connect,$sql2); 
    $row2 = mysqli_fetch_assoc($res2);
    $IMAGE = $row2['POSTER'];


    $sql3 = "SELECT * FROM Users WHERE ID = '$ID'";


    $res3 = mysqli_query($connect,$sql3); 
    if(mysqli_num_rows($res3)==0){
    $PROFILE_IMAGE = "https://github.com/yeawon-you/MYFLIX/blob/master/images/profile%ED%81%B0%20%EB%B2%84%EC%A0%BC.png?raw=true";

    }
    else{
    $row3 = mysqli_fetch_assoc($res3);
    $PROFILE_IMAGE = $row3['PROFILEIMAGE'];
    }
    
    
?>


<div id="feed_section">
  <div class="feed_article">
      
      <!--프로필 (사진, 닉네임)-->
      <div class="feed_profile">
            <div class="profile_img">
            <img src="<?php echo $PROFILE_IMAGE; ?>"/>
            </div>
            <div class="profile_name">
             <span style="display: table-cell;"><b><?php echo $NICKNAME;?></b></span>
             </div>
             <div class="profile_star"><span style="display: table-cell; padding-bottom: 5px; color: #D32F2F;"><?php
                if($SCORE=="1"){
                  echo "★☆☆☆☆";
                }
                else if($SCORE=="2"){
                  echo "★★☆☆☆";
                }
                else if($SCORE=="3"){
                  echo "★★★☆☆";
                }
                else if($SCORE=="4"){
                  echo "★★★★☆";
                }
                else if($SCORE=="5"){
                  echo "★★★★★";
                }
              
            ?></span>

             </div>
         </div>

         <div class="feed_title">
            <span> <?php echo $MOVIETITLE; ?></span>
      </div>

      <div class="feed_img">
            <img src ="<?php echo $IMAGE; ?>"/>
      </div>
      
      <div class="feed_comment">
         <p><b><?php echo $NICKNAME;?></b> <?php echo $CONTENTS; ?></p>
         <br>
        <p><?php echo $HASHTAG;?></p>
      </div>
</div>
   
   </div>


<?php
    }
?>


<!--//여기까지 피드 코드입니다-->



   </div> 

   <!--//내용-->



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
    document.searchmovie.action='search_movie_logout.php';
    document.searchmovie.submit();
   }

 


  </script>


</body>
</html>