<?php
                $connect = mysqli_connect("127.0.0.1","root","54321","LoginTest");                

 
                @session_start();
		
 
                if(isset($_SESSION['ID'])) {	
                        echo $_SESSION['NICKNAME'];?>님 안녕하세요
                        <br/>
			<input type="button" value="LOGOUT" onclick='location.replace("./logout_action.php")'>
			
			<br></br>
	<form name="searchmovie" action="search_movie.php" method="post">
		<select name="category">

                	<option value="TITLE">TITLE</option>

                	<option value="ACTOR">ACTOR</option>

			<option value="GENRE">GENRE</option>
            	</select> 
	<input type="text" size="50" name="SEARCHTERM">
	<input type="button" name="SEARCH" value="Search" onclick="mysub(1)">
	</form>

        <?php
                }
                else {
        ?>              
			<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"> 
<title>Join Us</title>

</head>
<body>
<form name="login" method="post" action='login_action.php'>
 <h1>LOGIN</h1>
 <table border="1">
  <tr>
   <td>ID</td>
   <td><input type="text" size="30" name="ID"></td>
  </tr>
  <tr>
   <td>PASSWORD</td>
   <td><input type="password" size="30" name="PASSWORD"></td>
  </tr>
   </table>
 <input type="button" value="INSERT" onclick="mysub(2)"><input type=reset value="REWRITE">
</form>

                        <br />
        <?php   }
        ?>

<script>

	function mysub(index){
		if(index==1){
			document.searchmovie.action="search_movie.php";
			document.searchmovie.submit();
		}
		if(index==2){									document.login.action="login_action.php";
			document.login.submit();
		}	
	}

</script>


</body>
</html>
