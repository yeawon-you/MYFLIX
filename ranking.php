<?php
   $db = mysqli_connect("127.0.0.1","root","54321","LoginTest");      




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
<title>MYFLIX</title>
<link rel="stylesheet" href="main.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript">
function change(e) {
         if (e.value == "abc_d") {
            location.href ="<?=$_SERVER['PHP_SELF']?>?page=1&select=abc_d";
         } else if (e.value == "rating_d") {
          location.href ="<?=$_SERVER['PHP_SELF']?>?page=1&select=rating_d";
         } else if (e.value == "abc") {
            location.href ="<?=$_SERVER['PHP_SELF']?>?page=1&select=abc";
         } else {
            location.href ="<?=$_SERVER['PHP_SELF']?>?page=1&select=rating";
         }
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
<style type="text/css">
      #float {float: left; padding: 0px 15px 0px 0px; margin:-10px;}

      .aa {
         text-decoration: none;
         text-align: center;
         color: #000000;
      }

      .aa_selected {
         text-decoration: none;
         text-align: center;
         color: red;
         font-weight: bold;
      }
   </style>
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
                 <button type="button" class="searchButton" id="search_button" name="SEARCH" onclick="button();"><img src="https://github.com/yeawon-you/MYFLIX/blob/master/images/search.png?raw=true"></button>

                   <?php } 

                  else{
                  ?>     

                   <button type="button" class="searchButton" id="search_button" name="SEARCH" onclick="button();" ><img src="https://github.com/yeawon-you/MYFLIX/blob/master/images/search.png?raw=true"> <?php }?></button>


              </form>
         </div>
      </div>
      <!--헤더 이너-->  
    

   </header>
   <!--//헤더--> 

<!--랭킹-->

<?php
$select = isset($_GET['select']) ? $_GET['select'] : "";


$num = 2813; // 총 데이터 개수

$page = isset($_GET['page']) ? $_GET['page'] : 1; // 최초 페이지에서 1 값 가지도록
$list = 10; // 페이지 당 데이터 수
$block = 10; // 블록 당 페이지 수 

$pageNum = ceil($num/$list); // 총 페이지 ceil은 올림처리
$blockNum = ceil($pageNum/$block); // 총 블록
$nowBlock = ceil($page/$block); // 현재 위치한 블록 번호

// 각 블록 당 시작 페이지, 종료 페이지 설정
$s_page = ($nowBlock * $block) - ($block - 1);
if ($s_page <= 1) { // 페이치 최소 범위 넘지 않도록
  $s_page = 1;
}

$e_page = $nowBlock*$block;
if ($pageNum <= $e_page) { // 페이지 최대 범위 넘지 않도록
  $e_page = $pageNum;
}


$s_point = ($page-1) * $list;
echo   '<!--select-->
<div id="content" class="main">
<div class="result_line">

<div class="result_head">
 <p style="text-align: center;">
         <img src="https://github.com/yeawon-you/MYFLIX/blob/master/images/%EB%9E%AD%ED%82%B9.png?raw=true"/>
 </p>
</div>

<div class="result_form" style="text-align:center;">
<div class="result_title"
  <form name = "selectForm" action = "">
         <p style="text-align: right">
            <select id = "select" name="select" onchange="change(this)">
               <option value="rating" onclick='.($select == 'rating' ? 'selected':'').'>별점 높은 순</option>
               <option value="rating_d"'.($select == 'rating_d' ? 'selected':'').'>별점 낮은 순</option>
               <option value="abc"'.($select == 'abc' ? 'selected':'').'>가나다 순</option>
               <option value="abc_d"'.($select == 'abc_d' ? 'selected':'').'>가나다 역순</option>
               
            </select>
         </p>    
  </form>
  </div>
  


   <!--랭킹보여줄곳-->
    
    <div id ="comment" class="result_commnet_other_out">';
            


$query = "SELECT TITLE, POSTER FROM Movie ORDER BY TITLE DESC LIMIT $s_point,$list";

if ($select == "abc_d") {
    $query = "SELECT TITLE, POSTER, RATE FROM Movie ORDER BY TITLE DESC LIMIT $s_point,$list";
} else if ($select == "rating_d") {
    $query = "SELECT TITLE, POSTER, RATE FROM Movie ORDER BY RATE ASC LIMIT $s_point,$list";
} else if ($select == "abc") {
    $query = "SELECT TITLE, POSTER, RATE FROM Movie ORDER BY TITLE LIMIT $s_point,$list";
} else {
    $query = "SELECT TITLE, POSTER, RATE FROM Movie ORDER BY RATE DESC LIMIT $s_point,$list";
}

$result = mysqli_query($db,$query);
$count = 0;

while($qq = mysqli_fetch_assoc($result)) {
  $title =  $qq['TITLE'];
  $file = $qq['POSTER'];
  $rate = $qq['RATE'];
  $count = $count + 1;
  echo '<div class = "result_title" style="padding:40px"><div style="color:black; vertical-align:middle"><div style="display:inlind-block">
<img src='.$file.' height = "60" weight ="40"  id="float">
              <font>'.$title.'<br></font>
               <span style="color:red">★</span><font color="black" size="2px">('.$rate.')</font></div></div></div>';
}
$db->close();
if ($s_page-1 == 0) {$ss = 2;} 
  else $ss=$s_page;
?>
</div>
<br><br><div id="comment" class="result_comment_out" style="padding-bottom:40px;text-align: center;width:auto;">
 <a class = "aa" style="font-weight: bold;" href="<?=$_SERVER['PHP_SELF']?>?page=<?=$ss-1?>&select=<?=$select?>">◀</a>
<?php
for ($p = $s_page; $p <= $e_page; $p++) {
   if ($p == $page) {
?>
      <a class = "aa_selected" href = "<?=$_SERVER['PHP_SELF']?>?page=<?=$p?>&select=<?=$select?>"><?=$p?></a> 
<?php
   } else {
?>
      <a class = "aa" href = "<?=$_SERVER['PHP_SELF']?>?page=<?=$p?>&select=<?=$select?>"><?=$p?></a>
<?php
   }
}
if ($s_page-1 == 0) $s_page = 2;
?>
<a class = "aa" style="font-weight: bold;" href="<?=$_SERVER['PHP_SELF']?>?page=<?=$e_page+1?>&select=<?=$select?>">▶</a>
  
</div>
</div>





<!—검색창에 적용되는 함수—>
<script>

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

  function button2(){
    event.stopImmediatePropagation();
    document.searchreview.action='review_list.php';
    document.searchreview.submit();
   }
</script>

</body>
</html>