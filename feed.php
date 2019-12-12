<?php
                $connect = mysqli_connect("127.0.0.1","root","54321","LoginTest");                

 
                @session_start();

		$sql = "SELECT * FROM Comment ORDER BY COUNT DESC";
   		$res = mysqli_query($connect,$sql);	
		$row = mysqli_fetch_assoc($res);
		
		while($row = mysqli_fetch_assoc($res)){
		$NICKNAME = $row['WRITER'];
		$MOVIETITLE = $row['MOVIETITLE'];
		$CONTENTS = $row['CONTENTS'];
		$HASHTAG = $row['HASHTAG'];

		$sql2 = "SELECT * FROM Movie WHERE TITLE = '$MOVIETITLE'";
		$res2 = mysqli_query($connect,$sql2);	
		$row2 = mysqli_fetch_assoc($res2);

		$IMAGE = $row2['POSTER'];


?>
   <div id="feed_section">
	<div class="feed_article">
      
      <!--프로필 (사진, 닉네임)-->
      <div class="feed_profile">
            <div class="profile_img">
            <img src="https://postfiles.pstatic.net/MjAxOTEyMDNfMTg0/MDAxNTc1MzU5NjYxNTQ1.IpqIALXWKH8zWwLK4HFxmBYEc4GQ5u8BO16rP7EXMQIg.Ev7EcVDXbL_jjJO_NJfY80Vm1EI_pUTUb9J7AennZsAg.PNG.dellintel17/%EA%B7%B8%EB%A6%BC1.png?type=w966"/>
            </div>
            <div class="profile_name">
             <span style="display: table-cell;"><b><?php echo $NICKNAME;?></b></span>
             </div>
         </div>

         <div class="feed_title">
            <span> <?php echo $MOVIETITLE; ?></span>
      </div>

      <div class="feed_img">
            <img src ="<?php echo $IMAGE; ?>" />
      </div>
      <div class="feed_cometent">
         <p><b><?php echo $NICKNAME;?></b>  <?php echo $CONTENTS; ?> </p>
	 <p><?php echo $HASHTAG;?></p>
      </div>
</div>
   
   </div>


<?php

		}

?>

     