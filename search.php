<?php
include('auth.php');
require('db.php');
?>
	<html lang="en">

	<head>
		<title>viewpeople</title>
		<?php include "./head.html" ?>
	</head>

	<body>
	<?php include "./header.html" ?>
	<nav>
		<div id="main">
		    <div style="margin-left:20px;"><button style="height:30px;" onclick="window.location='./Home.php' ">Home</button></div>
		</div>
	</nav><br><br><br>

		    <h2 style="color:red;margin-left:700px;">Profile</h2>
			<?php
			//$usern = $_SESSION["usern"];
			$usern = mysqli_real_escape_string($con, $_GET['username']);
            $query2="SELECT * FROM users NATURAL JOIN images WHERE username='$usern'";
            $result2=mysqli_query($con,$query2) or die(mysql_error());
            $row2=mysqli_fetch_assoc($result2);
        ?>
		<div class="card" style="width: 30rem;height:310px;margin-left:600px;margin-top:50px;">
        <img src="<?php echo $row2["Pic"] ?>" height="250" width="100" class="card-img-top">
        <div class="card-body">
         <ul class="list-group list-group-flush">
         <li class="list-group-item" style="margin-bottom:-30px;">Username:- <?php echo $row2["username"];?> </li>
         </ul>
         </div>
		 </div>
		 <?php
		 $usern1 = $_GET["username"];
		 $usern2 = $_SESSION["username"];
		 if($usern1!=$_SESSION["username"]){
	
			if(isset($_POST["follow"])){
				
					$followstatus = "unfollow";
					$sql2 = "INSERT into followers(username, follower_id, follow_status) VALUES ('$usern1', '$usern2', '$followstatus')";
					$qry2 = mysqli_query($con,$sql2);
				
			}
			$sql1 = "SELECT * FROM followers WHERE username='$usern1' AND follower_id='$usern2'";
			$qry1 = mysqli_query($con,$sql1);
			$result1 = mysqli_fetch_assoc($qry1);
			if($result1){
				$followstatus = $result1["follow_status"];
			}
			else {
				$followstatus = "Follow";
			}
			
			
		 ?>
		 <form style="margin-left:700px;" action="" method="post">
		 <input type="submit" name="follow" value="<?php echo $followstatus;?>">
		 </form>
		 <?php 
			
		 } ?>
		 <br>
		 
		 
		 <?php 
		 $user2 = $_GET["username"];
		 $sql5="SELECT * FROM followers WHERE follower_id='$user2'";
		 $query5 = mysqli_query($con,$sql5);
		 $result5 = mysqli_fetch_assoc($query5);
		 if($result5){
		 $num2 = mysqli_num_rows($query5);
		 }
		 else{
		 $num2 = 0;	 
		 }
		 $sql6="SELECT * FROM followers WHERE username='$user2'";
		 $query6 = mysqli_query($con,$sql6);
		 $result6 = mysqli_fetch_assoc($query6);
		 if($result6){
		 $num3 = mysqli_num_rows($query6);
		 }
		 else{
		 $num3 = 0;	 
		 }
		 ?>
		 <div class="container" style="margin-left:650px;background-color:white;width:200px;">
		 <ul class="pagination">
		 <li style="color:red;">Following</li>&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;
		 <li style="color:green;">Followers</li>
		 </ul><br>
		 <ul class="pagination">
		 <li style="color:red;margin-left:25px;"><?php echo $num2;?></li>&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;
		 <li style="color:green;margin-left:50px;"><?php echo $num3;?></li>
		 </ul>
		 </div>
		 
		 <h2 style="color:red;margin-left:100px;">Feed</h2><br><br><br>
		 <div class="container">
		 <div class="row">
		 <?php
		 $qry = "SELECT * FROM users  NATURAL JOIN post WHERE username = '$usern' ORDER BY ID DESC";
		 $qr1 = mysqli_query($con,$qry);
		 while($row6 = mysqli_fetch_assoc($qr1))
              {   
              ?>
			  <div class="col-sm-4">
			  <div class="card" style="width: 28rem;height:300px;">
              <div class="card-body">
			  <div><img src="<?php echo $row6['Pic']?>" style="height:250px;width:279.5px;margin-left:-13px;margin-top:-14px;"></div><br>
              <p class="card-text" style="margin-bottom:-30px;"><?php echo "<b style='color:green;'>".$row6['title']."</b>"?></p><br>
			  </div>
			  </div>
			  <br>
			  <br>
			  </div>
			  <?php
			  }
			  ?>

		 </div>
		 </div>
		 
		 
	            
	</body>
	</html>