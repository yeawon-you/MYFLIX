<!DOCTYPE html>
<html>
<head>
	<title>피드테스트</title>
</head>
<body>
<?php
$user="yeawon";//일단 친구의 글을 모두 피드에 띄우는 코드임
$connect=mysqli_connect("localhost","root","1234","myflix");
$reviewq="select REVIEW from review where REVIEWER='$user'";
$titleq="select TITLE from review where REVIEWER='$user'";
$movieq="select MOVIE from review where REVIEWER='$user'";

$review = mysqli_query($connect,$reviewq);
$title= mysqli_query($connect,$titleq);
$movie= mysqli_query($connect,$movieq);

$review_r=mysqli_fetch_assoc($review);
$title_r=mysqli_fetch_assoc($title);
$movie_r=mysqli_fetch_assoc($movie);

$review_s=implode('',$review_r);
$title_s=implode('',$title_r);
$movie_s=implode('',$movie_r);

echo "<p><h1>제목:$title_s</h1></p>";
echo "<p><h2>-$movie_s 에 대한 리뷰</h2></p>";
echo "<p>$review_s<p>";
?>
</body>
</html>
