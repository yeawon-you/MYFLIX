<?php
//데이터베이스연결하기
$db=@ mysqli_connect('localhost','root','1234','myflix');
if (!$db) //연결오류확인 
  { $error = mysqli_connect_error(); 
    $errno = mysqli_connect_errno(); 
    print "$errno: $error\n"; exit(); 
  }

//변수전달받기
$id=$_POST["id"];
//md5이거는 비밀번호 그대로 드러나지 않게 하는거!
$pw=md5($_POST["password"]);
$pwconfirm=md5($_POST["password"]);
$nickname=$_POST["nickname"];

$query="select UserID from User where UserID = $id";
$res=mysqli_query($db,$query);
$exist=mysqli_num_rows($res);
echo $exist;
if($exist>0){
  echo "<script> alert('already user');</script>";
  echo "<script> window.history.back();</script>";
  exit();
}else{
  $query="INSERT INTO User VALUES (?,?,?)";
  $stmt=$db->prepare($query);
  $stmt->bind_param("ssd",$id,$nickname,$pw);
  $stmt->execute();

//쿼리결과 가져오기
  if($stmt->affected_rows>0){
    echo "<script> alert('success signup'); </script>";
  }else{
    echo "<script> alert('Error occured.'); </script>";
  }
//데이터베이스와 연결 끊기
  $db->close();
  
}
?>
<meta http-equiv="refresh" content="0, Main.html">