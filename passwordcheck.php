<?php
    $connect = mysqli_connect("127.0.0.1","root","54321","LoginTest");
 

    @session_start();

$PASSWORD=$_GET['PASSWORD'];



 $ID = $_SESSION['ID'];

 $query = "select * from Users where ID = '$ID'";
 $result = mysqli_query($connect,$query);

if(mysqli_num_rows($result)==1) {
	$row=mysqli_fetch_assoc($result);

    
    //PASSWORD을 입력하지 않았을 때 
    if($PASSWORD == ''){
?>
    <script>
                alert("비밀번호를 입력해주세요.");
                location.replace("./change_info.php");
        </script>

<?php
    exit;
    }

    //길이제한 ID(4~15자) 
    if($row['PASSWORD']==md5($PASSWORD)){
?>
    <script>
                alert("확인이 완료되었습니다.");
                location.replace(href="change_info.php?PASSWORD=<?php echo $PASSWORD;?>");
        </script>
<?php
    exit;
    }else{
?>
    <script>
                alert("비밀번호가 일치하지 않습니다.");
                location.replace("./change_info.php");
        </script>
<?php
    exit;
    }

}
else{?>
<script>
                alert("비밀번호가 일치하지 않습니다.");
                location.replace("./change_info.php");
        </script>
<?php
    }
?>
       