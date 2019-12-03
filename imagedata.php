<html>
<body>
	<h1>웹입니다.</h1>
	<?php
	$title="ironman";
	$query="select ADDRESS from image where title='$title'";
	$connect=mysqli_connect("localhost","root","1234","myflix");//연결
	$result = mysqli_query($connect,$query);
	$row=mysqli_fetch_assoc($result);//오브젝트 타입으로 반환된 것을 배열로 반환
	$string=implode('',$row);
	echo "<img src=$string>";
	?>
</body>
</html>