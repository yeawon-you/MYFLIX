<?php
	$connect = mysqli_connect("127.0.0.1","root","54321","LoginTest");
 

   	@session_start(); 


//게시판 목록보기에 필요한 각종 변수 설정 

$page=$_GET['page']; //현재 페이지수를 가져옴 
$list_num = 10; //한 페이지에 보여줄 목록 갯수
$page_num = 10; //한 화면에 보여줄 페이지 링크(묶음) 갯수


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
	<input type="button" name="SEARCH" value="검색" onclick="button();">
</form>

<!--검색창에 적용되는 함수-->
<script>
   function button(){
    event.stopImmediatePropagation();
    document.searchreview.action='review_list.php';
    document.searchreview.submit();
   }
</script>

</body>
</html>
