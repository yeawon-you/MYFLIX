<?php
   $connect = mysqli_connect("127.0.0.1","root","54321","LoginTest");

   @session_start();

    if(!$_SESSION['ID']){?>
	<script>
		alert('로그인 먼저 해주세요');
		location.replace("./main_logout.php");	
	</script>	
<?php    }



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

<!--여기서부터 게시판-->
//게시판 목록보기에 필요한 각종 변수 설정 
<?php



$list_num = 10; //한 페이지에 보여줄 목록 갯수
$page_num = 10; //한 화면에 보여줄 페이지 링크(묶음) 갯수

$page=$_GET['page']; //현재 페이지수를 가져옴
 
$tablename="Review"; //테이블 이름
if($page == '') $page = 1; //페이지 번호가 없으면 1(첫페이지를 기본으로 설정)



$offset = $list_num*($page-1); //한 페이지의 시작 글 번호(listnum 수만큼 나누었을 때 시작하는 글의 번호)


//검색기능을 시행했을 때 초기변수값들 
if(isset($_GET['SEARCHTERM2'])){ //검색변수가 넘어오면 
	$search_term = $_GET['SEARCHTERM2']; //검색한 값
	$category = $_GET['category2']; //카테고리 값
	$status = $category;//현 카테고리 저장 

	$query="select COUNT(*) from $tablename WHERE $category LIKE '%$search_term%'"; // 검색결과로 나오는 결과 
	$result=mysqli_query($connect,$query); // 위의 쿼리문을 실제로 실행하여 결과를 result에 대입
	$row=mysqli_fetch_row($result); //위 결과 값을 하나하나 배열로 저장합니다 .
	$total_no=$row[0]; //배열의 첫번째 요소의 값, 즉 테이블의 전체 글 수를 저장합니다. -> 검색한 글의 총 수 

	$total_page=ceil($total_no/$list_num); // 전체글수를 페이지당글수로 나눈 값의 올림 값을 구합니다.
	$cur_num=$total_no - $list_num*($page-1); //현재 글번호
 
	//Review테이블에서 보여줄 목록 가져오기
	$query = "SELECT * FROM $tablename WHERE $category LIKE '%$search_term%' order by COUNT desc limit $offset, $list_num"; // SQL 쿼리문
	$result=mysqli_query($connect,$query); // 쿼리문을 실행 결과

}
else{ //검색기능을 하지않았을 때 (일반 게시판리스트보기) 


	//전체 글 수를 구합니다. (쿼리문을 사용하여 결과를 배열로 저장하는 일반적 인 방법)
	$query="select COUNT(*) from $tablename"; // SQL 쿼리문을 문자열 변수에 일단 저장하고
	$result=mysqli_query($connect,$query); // 위의 쿼리문을 실제로 실행하여 결과를 result에 대입
	$row=mysqli_fetch_row($result);
	$total_no=$row[0]; //배열의 첫번째 요소의 값, 즉 테이블의 전체 글 수를 저장합니다.

	//전체 페이지 수와 현재 글 번호를 구합니다.
	$total_page=ceil($total_no/$list_num); // 전체글수를 페이지당글수로 나눈 값의 올림 값을 구합니다.
	$cur_num=$total_no - $list_num*($page-1); //현재 글번호
 
	//Review테이블에서 목록을 가져옵니다. (위의 쿼리문 사용예와 비슷합니다 .)
	$query="select * from $tablename order by COUNT desc limit $offset, $list_num"; // SQL 쿼리문
	$result=mysqli_query($connect,$query); // 쿼리문을 실행 결과
	
}


//데이터베이스에서 가져온 결과값들을 표로 보여줌(아래 html)
?>
 



<html>
<head>
<meta http-equiv=content-type content=text/html; charset=euc-kr>
<title>글목록보기</title>
<STYLE TYPE=text/css>
BODY,TD,SELECT,input,DIV,form,TEXTAREA,center,option,pre,blockquote {font-family:굴림;font-size:9pt;color:#555555;}
A:link {color:black;text-decoration:none;}
A:visited {color:black;text-decoration:none;}
A:active {color:black;text-decoration:none;}
A:hover {color:gray;text-decoration:none;}
</STYLE>
</head>
<body>
<table border=1 cellspacing=0 width=680 bordercolordark=white bordercolorlight=#999999>
<tr>
<td width=30 bgcolor=#CCCCCC>
<p align=center>no</p>
</td>
<td bgcolor=#CCCCCC width=490>
<p align=center>subject</p>
</td>
<td width=60 bgcolor=#CCCCCC>
<p align=center>name</p>
</td>
<td width=70 bgcolor=#CCCCCC>
<p align=center>date</p>
</td>
</tr>
 
<?php
while($array=mysqli_fetch_array($result)){ //결과값 하나하나 가져오는 와일문 
 


$date=date("Y/m/d", $array['DATE']);
 

echo '';?>

<!--1)글번호 2)글제목 3)작성자 닉네임 4)작성일자 표로 보여짐-->

<tr>
<td width=30>
<p align=center><?php echo $cur_num;?></p> 
</td>
<td width=490>
<a href='view.php?page=$page&COUNT=<?php echo $array['COUNT']?>'><?php echo $array['TITLE'];?></a> 
</td>
<td width=60>
<p align=center><?php echo $array['WRITER'];?></p> 
</td>
<td width=70>
<p align=center><?php echo $array['DATE'];?></p> 
</td>
</tr> 

<?php
$cur_num--; //글번호 1씩감소

 
}
?>
<tr>
<td width=100% colspan=5>
 
<?php
//여기서부터 각종 페이지 넘기는것들 
//먼저, 한 화면에 보이는 블록($page_num 기본값 이상일 때 블록으로 나뉘어짐 )



$total_block=ceil($total_page/$page_num);
$block=ceil($page/$page_num); //현재 블록
 
$first=($block-1)*$page_num; // 페이지 블록이 시작하는 첫 페이지
$last=$block*$page_num; //페이지 블록의 끝 페이지
 
if($block >= $total_block) {
$last=$total_page;
}
 
echo "&nbsp; <p align=center>";

if(isset($search_term)){ //검색했을 경우 검색값이 다음페이지로 넘어가면서 누락되지않게 하는 코드 

//[이전]
if($page > 1) {
$go_page=$page-1;
echo " <a href='review_list.php?SEARCHTERM2=$search_term&category2=$category&page=$go_page'>[이전 ]</a>&nbsp; ";
}
 
//페이지 링크
for ($page_link=$first+1;$page_link<=$last;$page_link++) {
if($page_link==$page) {
echo "<font color=green><b>$page_link</b></font>";
}
else {
echo "<a href='review_list.php?SEARCHTERM2=$search_term&category2=$category&page=$page_link'>[$page_link]</a>";
}
}
 
//[다음]
if($total_page > $page) {
$go_page=$page+1;
echo "&nbsp;<a href='review_list.php?SEARCHTERM2=$search_term&category2=$category&page=$go_page'>[다음]</a>";
}



}

else{ //검색아닐경우 그냥 보여지는 코드
//[처음][*개앞]
if($block > 1) {
$prev=$first-1;
echo "<a href='review_list.php?page=1'>[처음 ]</a>&nbsp; ";
echo "<a href='review_list.php?page=$prev'>[$page_num 개 앞]</a>";
}
 
//[이전]
if($page > 1) {
$go_page=$page-1;
echo " <a href='review_list.php?page=$go_page'>[이전 ]</a>&nbsp; ";
}
 
//페이지 링크
for ($page_link=$first+1;$page_link<=$last;$page_link++) {
if($page_link==$page) {
echo "<font color=green><b>$page_link</b></font>";
}
else {
echo "<a href='review_list.php?page=$page_link'>[$page_link]</a>";
}
}
 
//[다음]
if($total_page > $page) {
$go_page=$page+1;
echo "&nbsp;<a href='review_list.php?page=$go_page'>[다음]</a>";
}
 
//[*개뒤][마지막]
if($block < $total_block) {
$next=$last+1;
echo "<a href='review_list.php?page=$next'>[$page_num 개 뒤]</a>&nbsp;";
echo "<a href='review_list.php?page=$total_page'>[마지막]</a></p>";
}
 

}
?>
</td>
</tr>
<tr>
<td width=100% colspan=5>
<p align=center><a href='write_review2.php'>[글쓰기]</a></p>
</td>
</tr>
</table>

<!--검색창-->

<form name="searchreview" action="review_list.php" method="get">
		<select name="category2">

                	<option value="TITLE">제목</option>

                	<option value="WRITER">닉네임</option>

			<option value="MOVIETITLE">영화제목</option>
            	</select> 
	<input type="text" size="50" name="SEARCHTERM2">
	<input type="button" name="SEARCH" value="검색" onclick="button2();">
</form>

<!--검색창에 적용되는 함수-->
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