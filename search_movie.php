<?php
                $connect = mysqli_connect("127.0.0.1","root","1234","LoginTest");                

                @session_start();

                mysqli_query($connect, "set session character_set_connection=utf8;");

                mysqli_query($connect, "set session character_set_results=utf8;");

                mysqli_query($connect, "set session character_set_client=utf8;");

              	$category = $_POST['category'];
               $search_term = $_POST['SEARCHTERM'];


  $sql = "SELECT * FROM Movie WHERE $category = '$search_term'";
          $res = mysqli_query($connect,$sql); 
        $row=mysqli_fetch_assoc($res); //한번실행 -> 유사도 100퍼센트
        $_SESSION['TITLE']=$row['TITLE']; //유사도 100퍼센트가 메인으로 뜨게하기 위해 




        $sql = "SELECT * FROM Movie WHERE $category = '$search_term'";
          $res = mysqli_query($connect,$sql);
        $count = mysqli_num_rows($res);//sql까지 재실행 -> 첫번째나온 결과물으로 인식함 
?>



<html>
<head>
   <meta charset="UTF-8">
      <link rel="stylesheet" href="assets/css/main.css">
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
            <a href="main.php">
               <img src="https://github.com/yeawon-you/MYFLIX/blob/master/images/logo.png?raw=true"/>
            </a>
         </div>

         <!--이너 3) 메뉴바,로그인-->
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
                 
                 <form class="search_form"  name="searchmovie" action="search_movie.php" method="post" >
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

   <!--내용-->
   <div id="content" class="main">
   

   <!--result_line 1) 검색결과-->
   <div class="result_line">
    <!--1)result_head-->
    <div class="result_head">
      <p style="text-align: left;">
         <img src="https://github.com/yeawon-you/MYFLIX/blob/master/images/%EA%B2%80%EC%83%89%20%EA%B2%B0%EA%B3%BC.png?raw=true"/>
      </p>
    </div>
        
        <?php      if($count>=1){
        $row=mysqli_fetch_assoc($res); //mysqli_fetch_assoc만 재실행 했으므로 ->2번째껄로 넘어감

        $TITLE=$row['TITLE'];
        $POSTER=$row['POSTER'];
        $INTRO=$row['INTRO'];
        $ACTOR=$row['ACTOR'];
                

      ?>

    <!--2)result_form-->
    <div class="result_form">
      <div class="result_title">
        <?php echo "<b><u>$TITLE</b></u>"; ?>
      </div>

      <div class="result_actor">
        <b>출연진</b>&nbsp&nbsp<?php echo "$ACTOR"; ?>
      </div>

      <div class="result_intro">
         <b>줄거리</b>&nbsp&nbsp<?php echo "$INTRO"; ?>    
      </div>

      <div class="result_poster">
          <img src="<?php echo $POSTER; ?>" width="560" height="325">
      </div>

      <div class="result_comment_button">
          <form name="write" method="post">
          <input type="button" name="COMMENT" value="코멘트 작성" onclick="mysub(1)">
        </form>
      </div>

      <div class="result_comment_head">
          <img src="https://github.com/yeawon-you/MYFLIX/blob/master/images/%EC%BD%94%EB%A9%98%ED%8A%B8.png?raw=true">
      </div>

      <div class="result_comment_option"> 
         
        
          <input type="checkbox" name="checkbox" checked="checked" id="checkbox1" value="1" onclick="oneCheckbox(this)" />
          <span onclick="checkbox('1')" style="font-size:13.5px; color:black; vertical-align:top; margin-right: 20px;">스포일러 숨기기</span>
        

          <input type="checkbox" name="checkbox" id="checkbox1" value="2" onclick="oneCheckbox(this)"/>
          <span onclick="checkbox('2')" style="font-size:13.5px; color:black; vertical-align:top;">스포일러 포함하기</span></label>
     
      </div>



      <!--스포일러 숨기기-->
  

      <div id="comment" class="result_comment_other_out" style="display:block" >

      <?php
        $sql = "SELECT * FROM Comment WHERE MOVIETITLE = '{$_SESSION['TITLE']}' and SPOIL = '2'";
        $res = mysqli_query($connect,$sql);

  
        while($row=mysqli_fetch_assoc($res)){  
          $SCORE=$row['SCORE'];
          $WRITER=$row['WRITER'];
          $CONTENTS=$row['CONTENTS'];
      
      ?>  

        <div class="result_comment_other_in">
             <div class="result_comment_other_in_L">
             <?php echo "<b>$WRITER</b>"?> </div>

            <div class="result_comment_other_in_R"><?php
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
              
            ?>
            </div>

            <div class="result_comment_text">
            <?php   echo "$CONTENTS"; ?>
            </div>
        </div>
      <?php } ?> <!--while문 끝-->

      </div>
   
      <!--//스포일러 숨기기-->

      <!--스포일러 포함하기-->

 

      <div id="spoilcomment" class="result_comment_other_out" style="display:none">

    
      <?php
        $sql = "SELECT * FROM Comment WHERE MOVIETITLE = '{$_SESSION['TITLE']}'";
        $res = mysqli_query($connect,$sql);

  
      while($row=mysqli_fetch_assoc($res)){ 
        $SCORE=$row['SCORE'];
        $WRITER=$row['WRITER'];
        $CONTENTS=$row['CONTENTS'];

      ?>

        <div class="result_comment_other_in">
             <div class="result_comment_other_in_L">
             <?php echo "<b>$WRITER</b>"?> </div>

            <div class="result_comment_other_in_R"><?php
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
              
            ?>
            </div>
            <div class="result_comment_text">
            <?php   echo "$CONTENTS";?>
            </div>
        </div>
    	<?php } ?> 	
      </div> 
    </div>
    <!--result_form--> 
   </div>
   <!--//result_line-->

   <!--찾는 영화가 없음-->

	<?php
			    }
			else{ 

				echo "검색 결과가 없습니다.";
			}

			$sql = "SELECT * FROM Movie WHERE $category LIKE '%$search_term%' AND NOT $category = '$search_term'"; //검색어가 포함된 다른 영화를 가져오되 그 영화는 가져오지 않음 
	   		$res = mysqli_query($connect,$sql);
	?>


   <!--result_line2 2) 이런 영화를 찾고 계신가요?-->
   <div class="result_line">
    
    <div class="result_head">
      <p style="text-align: left;">
      <img src="https://github.com/yeawon-you/MYFLIX/blob/master/images/%EC%9D%B4%EC%9E%91%EC%B0%BE%EA%B3%84.png?raw=true"/>
      </p>
    </div>


    <!--2)result_form-->
    <div class="result_form">
      <div class="result_title">
      	<?php echo $search_term;?>이(가) 포함된 다른 작품
      </div>
      
      <div class="other_movies_out">

     		  	<?php				
			//연관검색들을 표시하는것->제목이랑 포스터만 
			while($row=mysqli_fetch_assoc($res)){
				
				//검색해서 나온 변수 저장 
				$TITLE=$row['TITLE'];
				$POSTER=$row['POSTER'];

								?>
      	<div class="other_movies_in">

      		<form name="search_relate_movie" method="post" action="search_movie3.php">
				<input type="image" name="FILE" src="<?php echo $POSTER; ?>" width="205" height="135" value="<?php echo $TITLE;?>" onclick="mysub(2)">
					<div id="title_name" style="display:none">
						<input type="text" name="SHOW" value="<?php echo $TITLE;?>">
					</div>
				</form>
				
				<div class="other_title">
				<?php echo "$TITLE"; ?>
				</div>
      	</div>
      		<?php } ?>
      	</div>
      </div>

    </div>
    <!--result_form-->
    </div>
  
   <!--//result_line-->

   </div>
   <!--//내용-->
   </div>
  <!--//wrap-->

<script>

  function mysub(index){
    if(index==1){
      document.write.action="write_comment.php";
      document.write.submit();
    }
    if(index==2){                                 
      document.search_relate_movie.action="search_movie3.php";
      document.search_relate_movie.submit();
    } 
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


  </body>
  </html>