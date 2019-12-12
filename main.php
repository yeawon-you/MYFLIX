
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
                     if(isset($_SESSION['ID'])){
                           echo $_SESSION['NICKNAME'];?>님</span>
                           
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
		<form name="searchmovie" action="search_movie.php" method="post">
           	<select name="category" class="searchType">
                	<option value="TITLE">제목</option>
                	<option value="ACTOR">배우</option>
                	<option value="GENRE">장르</option>
            	</select> 
				<input type="text" name="SEARCHTERM" class="searchTerm" size="100%" placeholder="검색어를 입력해주세요">
				<input type="image" name="SEARCH" src="https://github.com/yeawon-you/MYFLIX/blob/master/images/search.png?raw=true" onclick="sub(3)" class="searchButton" >
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
		$row = mysqli_fetch_assoc($res);
		
		while($row = mysqli_fetch_assoc($res)){
		$NICKNAME = $row['WRITER'];
		$MOVIETITLE = $row['MOVIETITLE'];
		$CONTENTS = $row['CONTENTS'];
		$HASHTAG = $row['HASHTAG'];

		$sql2 = "SELECT * FROM Movie WHERE TITLE = '$MOVIETITLE'";
		$res2 = mysqli_query($connect,$sql2);	
		$row2 = mysqli_fetch_assoc($res2);

		$IMAGE = $row2['POSTER'];

		$sql3 = "SELECT * FROM Users WHERE NICKNAME = '$NICKNAME'";
		$res3 = mysqli_query($connect,$sql3);	
		$row3 = mysqli_fetch_assoc($res3);


		$PROFILE_IMAGE = $row3['PROFILEIMAGE'];
		
		


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
         </div>

         <div class="feed_title">
            <span> <?php echo $MOVIETITLE; ?></span>
      </div>

      <div class="feed_img">
            <img src ="<?php echo $IMAGE; ?>"/>
      </div>
      <div class="feed_cometent">
         <p><b><?php echo $NICKNAME;?></b>  <?php echo $CONTENTS; ?> </p>
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
   
   <!--footer-->
   <footer class="footer">
      Copyright &copy; 2019 / OpenSW platform
   </footer>
   <!--//footer-->
   
</div>

<script = "text/javascript">
    
    function sub(index){
      if(index == 1){
         document.test1.action="LOGIN_PAGE.php"; //sub(1)은 로그인 기능을 하는 php로 연결
	 document.test1.submit();
      }
      if(index == 2){
         document.test1.action="JOINUS_FINAL.html"; //sub(2)은 회원가입 기능을 하는 php로 연결
	 document.test1.submit();
      }
      if(index == 3){
         document.searchmovie.action="search_movie.php";
	 document.searchmovie.submit();
      }      
   }
  
		
</script>


</body>
</html>
