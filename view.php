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
 
<html>
<head>
<title>보기</title>
<STYLE TYPE="text/css">
BODY,TD,SELECT,input,DIV,form,TEXTAREA,center,option,pre,blockquote {font-family:굴림;font-size:9pt;color:#555555;}
A:link {color:black;text-decoration:none;}
A:visited {color:black;text-decoration:none;}
A:active {color:black;text-decoration:none;}
A:hover {color:gray;text-decoration:none;}
</STYLE>
</head>
<body bgcolor=white>
<table border=0 cellspacing=1 cellpadding="3" width=670>
<tr>
<td align=center>
<font color=green><b>내용 보기 화면입니다.</b></font>
</td>
</tr>
<tr>
<td bgcolor="#EAC3EA">
<table border=0 cellspacing=1 cellpadding=0 width=670 bgcolor="white">
<tr>
<td width="100">
<p align="right"><b>이름 &nbsp;</b></p>
 
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
<p><?php echo $array['CONTENT']; ?></p>
</td>
</tr>
</table>
<p align="center"><a href="review_list.php?page=<? echo $page; ?>">[목록]</a> &nbsp;<a href="write.php">[쓰기]</a> &nbsp;<a href="modify.php?number=<? echo $number; ?>&page=<? echo $page; ?>">[수정]</a> &nbsp;<a href="delete.php?number=<? echo $number; ?>&page=<? echo $page; ?>">[삭제]</a></p>
</td>
</tr>
</table>
</body>
</html>