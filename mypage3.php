<?php
   $connect = mysqli_connect("127.0.0.1","root","54321","LoginTest");

   @session_start();

    if(!$_SESSION['ID']){?>
	<script>
		alert('로그인 먼저 해주세요');
		location.replace("./main_logout.php");	
	</script>	
<?php    }


		

		$MEME = $_GET['NICKNAME'];
		$q = "SELECT * FROM Users WHERE NICKNAME = '$MEME'";
		$re = mysqli_query($connect,$q);


			if(mysqli_num_rows($re)==1){
					$rr = mysqli_fetch_assoc($re);
					$ME = $rr['ID'];
			}

		$query = "SELECT * FROM Users WHERE ID = '$ME'";
		$result = mysqli_query($connect,$query);	
		
				if(mysqli_num_rows($result)==1){
					$my=mysqli_fetch_assoc($result);
					$NICK=$my['NICKNAME'];
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
   <!--//헤더끝--> 

<!--content시작-->
<div id="content" class="main">
   <!--my_line시작-->
   <div class="my_line">

<!--헤드시작 : my page-->
      <div class="my_head">
         <p style="text-align: center;">
            <img src="https://github.com/yeawon-you/MYFLIX/blob/master/images/%EC%A0%95%EB%B3%B4%EB%B3%B4%EA%B8%B0.png?raw=true">
         </p>
      </div>
<!--헤드끝-->

<?php

		
  

		$sql3 = "SELECT * FROM Users WHERE NICKNAME = '$NICK'";
		$res3 = mysqli_query($connect,$sql3);

		if(mysqli_num_rows($res3)==0){
			$PROFILE_IMAGE = "https://github.com/yeawon-you/MYFLIX/blob/master/images/%EC%9A%B0%EB%8A%94%EA%B0%90%EC%9E%90.png?raw=true";
			$NICK="탈퇴한 회원";
		}
		else{
		$row3 = mysqli_fetch_assoc($res3);

		$PROFILE_IMAGE = $row3['PROFILEIMAGE'];
		}

		
?>


<!--프로필 사진 시작 : 각자의 프로필 사진-->
      <div class="my_img">
         <p style="text-align: center;">
            <img src="<?php echo $PROFILE_IMAGE; ?>" width="50px" height="55px">
         </p>
      </div>
<!--프로필사진 끝-->

<!--my form 시작-->
      <div class="my_form">

	<!--프로필 닉네임-->
         <div class="my_title">
            <p style="font-size: 20px;"><b><?php echo $NICK;?></b><!--<?php?>--></p>
         </div>

	<!--프로필 닉네임 끝-->


	<!--내가 쓴 글 : 이미지 글-->

	 <div class="my_work_head">
            <img src="https://github.com/yeawon-you/MYFLIX/blob/master/images/%EA%B8%80%20%EB%AA%A9%EB%A1%9D.png?raw=true"/>
         </div>

	<!--내가 쓴 글 이미지 끝 -->

<!--피드 시작 -->


<!--feed section 시작 : 이게 신인류 코드에없음 ->재기시킴-->
<?php

		
   
   		$sql = "SELECT * FROM Comment WHERE WRITER = '$NICK' ORDER BY COUNT DESC";
   		$res = mysqli_query($connect,$sql);	
		
		if(mysqli_num_rows($res)==0){
			echo "탈퇴한 회원입니다.";

		}

		else{
		while($row = mysqli_fetch_assoc($res)){
		$SCORE=$row['SCORE'];
		$NICKNAME = $row['WRITER'];
		$MOVIETITLE = $row['MOVIETITLE'];
		$CONTENTS = $row['CONTENTS'];
		$HASHTAG = $row['HASHTAG'];

		$sql2 = "SELECT * FROM Movie WHERE TITLE = '$MOVIETITLE'";
		$res2 = mysqli_query($connect,$sql2);	
		$row2 = mysqli_fetch_assoc($res2);

		$IMAGE = $row2['POSTER'];

		$sql3 = "SELECT * FROM Users WHERE NICKNAME = '$NICK'";
		$res3 = mysqli_query($connect,$sql3);	
		$row3 = mysqli_fetch_assoc($res3);


		$PROFILE_IMAGE = $row3['PROFILEIMAGE'];


		
?>

<!--feed article시작-->
  <div class="my_feed_article">
      
      <!--프로필 (사진, 닉네임)-->
      <div class="my_feed_profile">
            <div class="my_profile_img">
            <img src="<?php echo $PROFILE_IMAGE; ?>"/>
            </div>
            <div class="my_profile_name">
             <span style="display: table-cell;"><b><?php echo $NICKNAME;?></b></span>
             </div>
             <div class="my_profile_star"><span style="display: table-cell; padding-bottom: 5px; color: #D32F2F;"><?php
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
<!--프로필 (사진, 닉네임) 끝 -->

         <div class="my_feed_title">
            <span> <?php echo $MOVIETITLE; ?></span>
      </div>

      <div class="my_feed_img">
            <img src ="<?php echo $IMAGE; ?>"/>
      </div>
      
      <div class="my_feed_comment">
         <p><b><?php echo $NICKNAME;?></b> <?php echo $CONTENTS; ?></p>
         <br>
        <p><?php echo $HASHTAG;?></p>
      </div>



</div>
<!--feed article끝-->

<?php
	 } //while end

	}
?>



</div>
   
 <!--my form end>


</div>
<!--my_line끝-->


</div>
<!--content 끝-->



</div>
<!--//wrap끝-->

<script type="text/javascript">

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
    event.stopImmediatePropagation();
    document.searchmovie.action='search_movie.php';
    document.searchmovie.submit();
   }

 

</script>





</body>
</html>