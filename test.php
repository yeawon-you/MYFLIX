<?php
    $connect = mysqli_connect("localhost","root","1234","NAME");
 if($connect) 
      echo "db connected";
     else
      echo "db not connected"; 

?>