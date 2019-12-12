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

		$sql3 = "SELECT * FROM Users WHERE NICKNAME = '$NICKNAME'";
		$res3 = mysqli_query($connect,$sql3);	
		$row3 = mysqli_fetch_assoc($res3);


		$PROFILE_IMAGE = $row3['PROFILEIMAGE'];


?>
   <div id="feed_section">
	<div class="feed_article">
      
      <!--프로필 (사진, 닉네임)-->
      <div class="feed_profile">
            <div class="profile_img">
            <img src="<?php echo $PROFILE_IMAGE; ?>"/>
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
     
