<?php
//DB에 연결하는 부분입니다. 항상 반복되는 부분이니 꼭 암기!!!
    $connect = mysqli_connect("127.0.0.1","root","54321","LoginTest");
 


    @session_start(); 
 
//PHP버전 변화에 따른 매개변수(파라미터)값을 받아보자.
extract($_POST);
extract($_GET);
 
//변수 설정합니다.
$tablename="Review"; //테이블 이름
 
//테이블에서 글을 가져옵니다.
$query = "select * from $tablename where COUNT='$COUNT'"; // 글 번호를 가지고 조회를 합니다.
$result = mysqli_query($connect,$query);
$array = mysqli_fetch_array($result);
 
//백슬래쉬 제거, 특수문자 변환(HTML용), 개행(<br>)처리 등
$array['WRITER'] = stripslashes($array['WRITER']);
$array['TITLE'] = stripslashes($array['TITLE']);
$array['CONTENT'] = stripslashes($array['CONTENT']);
 
$array['TITLE'] = htmlspecialchars($array['TITLE']);
$array['CONTENT'] = htmlspecialchars($array['CONTENT']);
 
$array['CONTENT'] = nl2br($array['CONTENT']);
 
 

 
?>
 
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="main.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
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

<!--여기서부터 게시판-->

<!--content-->
<div id="content" class="main">
  <div class="list_line">

   <div class="list_head">
      <p style="text-align: center;">
      <img src="https://github.com/yeawon-you/MYFLIX/blob/master/images/%EB%82%B4%EC%9A%A9%EB%B3%B4%EA%B8%B0.png?raw=true"/>
      </p>
    </div>
<!--table_outer-->
    <div class="table_outer">
        <table bgcolor="white" cellspacing="0" width="100%">
	
        <tr>
        <td bgcolor=#dadada>
        <table border=0 cellspacing=1 cellpadding=0 width=670 bgcolor="white">
	 <tr>
        <td width="100">
        <p align="right"><b>작품 &nbsp;</b></p>
         
        </td>
        <td width="400">
        <p><b><?php echo $array['MOVIETITLE']; ?></b></p>
        </td>
        <tr>
        <td width="100">
        <p align="right"><b>닉네임 &nbsp;</b></p>
         
        </td>
        <td width="400">
        <p><?php echo $array['WRITER']; ?></p>
        </td>

        <!-- 첨부파일 보기 추가 -->
                        <?

                        if ($array['file_name1'] != '') {

                            echo "
                         <tr>
                             <td width=100>
                         <p align=right><b>첨부파일 &nbsp;</b></p>
                             </td>
                             <td colspan=3>
                         <p><a href={$array['file_name1']}>{$array['s_file_name1']}</a>({$file_size}KB)</p>
                             </td>
                         </tr>
                                ";
                        }
                        ?>
                        <!-- 첨부파일 보기 추가 끝.-->
        <tr>
        <td width="100">
        <p align="right"><b>제목 &nbsp;</b></p>
        </td>
        <td colspan="3">
        <p><?php echo $array['TITLE']; ?></p>
        </td>
        </tr>
        <tr>
        <td width="100">
        <p align="right"><b>내용 &nbsp;</b></p>
        </td>
        <td colspan="3">
        <p align="justify"><?php echo $array['CONTENT']; ?></p>
        </td>
        </tr>
        </table>
        <p align="center"><a href="review_list.php">[목록]</a> &nbsp;<a href="write_review2.php">[쓰기]</a></p>

        </td>
        </tr>
        </table>
  </div>
  <!--//table_outer-->
  </div>
  <!--//list_line-->
</div>
<!--//cotent-->
</div>
<!--//wrap-->
</body>
</html>