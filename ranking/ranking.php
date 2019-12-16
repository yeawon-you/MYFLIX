<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title>RANKING</title>
   <link rel="stylesheet" href="MainStyle.css">
   <style type="text/css">
      #float {float: left; padding-right: 15px;}

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
   <script>
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
   </script>
<?php
$select = isset($_GET['select']) ? $_GET['select'] : "";

$db = new mysqli('localhost', 'id', 'password', 'db');
if (mysqli_connect_errno()) {
	echo "connect error";
	exit;
}

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
<form name = "selectForm" action = "" method = "POST">
   <div id="wrapper">
      <section id="main_section">
         <p style="text-align: right">
            <select id = "select" name="select" onchange="change(this)">
               <option value="rating" onclick='.($select == 'rating' ? 'selected':'').'>별점 높은 순</option>
               <option value="rating_d"'.($select == 'rating_d' ? 'selected':'').'>별점 낮은 순</option>
               <option value="abc"'.($select == 'abc' ? 'selected':'').'>가나다 순</option>
               <option value="abc_d"'.($select == 'abc_d' ? 'selected':'').'>가나다 역순</option>
               
            </select>
         </p>
      </section>
   </div>
</form>

   <!--랭킹보여줄곳-->
   <div id="wrapper">
      <section id="main_section">
         <article>';
            


$query = "SELECT Title, Image FROM Movie ORDER BY Title DESC LIMIT $s_point,$list";

if ($select == "abc_d") {
		$query = "SELECT Title, Image, Rate FROM Movie ORDER BY Title DESC LIMIT $s_point,$list";
} elseif ($select == "rating_d") {
		$query = "SELECT Title, Image, Rate FROM Movie ORDER BY Rate ASC LIMIT $s_point,$list";
} elseif ($select == "abc") {
		$query = "SELECT Title, Image, Rate FROM Movie ORDER BY Title LIMIT $s_point,$list";
} else {
		$query = "SELECT Title, Image, Rate FROM Movie ORDER BY Rate DESC LIMIT $s_point,$list";
}

$result = $db->query($query);
$count = 0;

while($qq = $result->fetch_assoc()) {
	$title =  $qq['Title'];
	$file = $qq['Image'];
	$rate = $qq['Rate'];
	$count = $count + 1;
	echo '<div style="padding: 10px; padding-bottom: 20px"><p>
<img src='.$file.' height = "60" weight ="40" align="center" id="float">
               <font style="color: black">'.$title.'<br></font>
               <font color="red">★</font><font color="black" size="2px">('.$rate.')</font></p></div>';
	if($count != 10)
	            echo '<hr width="92%" color="black" size="1">';
  
}
$db->close();
?>
<br><br><div style="text-align: center"> <?php
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
</div>
<div style="text-align: center">
   <a class = "aa" style="font-weight: bold" href="<?=$_SERVER['PHP_SELF']?>?page=<?=$s_page-1?>&select=<?=$select?>"><<</a>
   <a class = "aa" style="font-weight: bold" href="<?=$_SERVER['PHP_SELF']?>?page=<?=$e_page+1?>&select=<?=$select?>">>></a>
</div>


         </article>
      </section>
   </div>
</body>
</html>
