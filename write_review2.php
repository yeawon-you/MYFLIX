<?php
    $connect = mysqli_connect("127.0.0.1","root","54321","LoginTest");
 

    @session_start();
?>


<html>
<head>
<title>PHP 게시판 프로젝트 - 쓰기</title>
 

 
<script language="javascript">
 
function submit(index) {
	if(index == 1){
        document.writereview.action = "reviewSave.php";
        document.writereview.submit();
	}
	if(index == 2){
	location.replace("./review_list.php");
	}
}
 
</script>
 
</head>
 
<body bgcolor=white>
<br>
<form name='writereview' method='post' ENCTYPE='multipart/form-data' action='reviewSave.php'>
<!-- 파일 첨부를 위해 ENCTYPE='multipart/form-data'를 추가함 -->
 

 
<table border=0 bgcolor=#CCCCF><tr><td>
 
<table border=0 width=670 cellspacing=0 cellpadding=0 bgcolor=#F0F0F0>
 
    <col width=100></col><col width=></col>
 
    <tr>
     <td align=right><b>제목&nbsp;</b></td>
     <td> <input type=text name="TITLE" size=87 maxlength=200> </td>
    </tr>
    
    <tr>
     <td align=right><b>영화제목&nbsp;</b></td>
     <td> <input type=text name="MOVIETITLE" size=87 maxlength=200> </td>
    </tr>
 
    <tr><td bgcolor=white height=1 colspan=2></td></tr>
 
    <tr>
     <td align=right><b>내용&nbsp;</b></td>
     <td valign=top>
     <textarea name="CONTENT" cols=85 rows=20></textarea>
     </td>
    </tr>
 
</table>
 
<br>
 
<table border=0 width=670>
<!-- 파일 첨부를 위해 추가한 부분 : 시작 -->
    <tr>
        <td align=center>파일첨부 : <input type="file" name="upfile" size="20"></td>
    </tr>
<!-- 파일 첨부를 위해 추가한 부분 : 끝-->


<tr><td>
<center>
<!-- 입력하기버튼 -->
<input type="button" name="review" value="등록" onclick="submit(1)">
<input type="button" name="goback" value="취소" onclick="submit(2)">
</center>
</td></tr>
</table>
</td></tr></table>
 
</form>
 
</body>
</html>
