<?php
include('auth.php');
require('db.php');
?>
	<html lang="en">

	<head>
		<title>Profile</title>
		<?php include "./head.html" ?>
	</head>

	<body>
	<?php include "./header.html" ?>
		<br><br>
	<nav>
		<div id="main">
		    <div style="margin-left:20px;"><button style="height:30px;" onclick="window.location='./Home.php' ">Home</button></div>
			
		</div>
	</nav><br><br><br>
		    <h2 style="color:red;margin-left:620px;">Profile</h2>
			<?php
            $username=$_SESSION['username'];
			if(isset($_POST["upload"])){
				$filename= $_FILES['uploadfile']['name'];
	            $tempname= $_FILES['uploadfile']['tmp_name'];
	            $folder= "Pics/".$filename;
	            move_uploaded_file($tempname,$folder);
	            $sql="UPDATE images SET Pic='$folder' WHERE username='$username'";
	            $result=mysqli_query($con,$sql);
			}
            $query2="SELECT * FROM users NATURAL JOIN images WHERE username='$username'";
            $result2=mysqli_query($con,$query2) or die(mysql_error());
            $row2=mysqli_fetch_assoc($result2);
        ?>
		<div class="card" style="width: 30rem;margin-left:520px;margin-top:50px;height:350px;">
        <img src="<?php echo $row2["Pic"] ?>" height="250" width="100" class="card-img-top">
        <div class="card-body">
         <ul class="list-group list-group-flush">
         <li class="list-group-item">Username:- <?php echo $row2["username"];?> </li>
          <li class="list-group-item">Email:- <?php echo $row2["email"];?></li>
         </ul>
         </div>
		 </div><br><br>
		 <form action="" style="margin-left:600px;" method="post" enctype="multipart/form-data">
		 <input type="file" name="uploadfile" value="" required />
		 <input type="submit" name="upload" value="Upload dp"/>
		 </form>
		 <form action="" style="margin-left:600px;" method="post" enctype="multipart/form-data">
		 <input type="file" name="uploadpic" value="" required />
		 <input type="text" name="title" placeholder="title of pic"/><br>
		 <input type="submit" name="uploadpost" value="Post pic"/>
		 </form>
		 <br><br><br>
		 <?php
		 if(isset($_POST["uploadpost"])){
			    $username=$_SESSION['username'];
				$filename1= $_FILES['uploadpic']['name'];
	            $tempname1= $_FILES['uploadpic']['tmp_name'];
	            $folder1= "Pics/".$filename1;
	            move_uploaded_file($tempname1,$folder1);
				$title = $_POST["title"];
				$sql1="INSERT into post(username,title,Pic) VALUES('$username','$title','$folder1')";
				$ql1 = mysqli_query($con,$sql1);
				$sql2="INSERT into like_dislike(username,title,Pic,like_count,dislike_count) VALUES('$username','$title','$folder1',0,0)";
				$ql2 = mysqli_query($con,$sql2);
		 } ?>
		 
		 <?php 
		 $user1 = $_SESSION["username"];
		 $sql3="SELECT * FROM followers WHERE follower_id='$user1'";
		 $query3 = mysqli_query($con,$sql3);
		 $result3 = mysqli_fetch_assoc($query3);
		 if($result3){
		 $num = mysqli_num_rows($query3);
		 }
		 else{
		 $num = 0;	 
		 }
		 $sql4="SELECT * FROM followers WHERE username='$user1'";
		 $query4 = mysqli_query($con,$sql4);
		 $result4 = mysqli_fetch_assoc($query4);
		 if($result4){
		 $num1 = mysqli_num_rows($query4);
		 }
		 else{
		 $num1 = 0;	 
		 }
		 ?>
		 <div class="container" style="margin-left:570px;background-color:white;width:200px;">
		 <ul class="pagination">
		 <li style="color:red;">Following</li>&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;
		 <li style="color:green;">Followers</li>
		 </ul>
		 
		 <ul class="pagination">
		 <li style="color:red;margin-left:25px;"><?php echo $num; ?></a></li>&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;
		 <li style="color:green;margin-left:50px;"><?php echo $num1; ?></a></li>
		 </ul>
		 
		 </div>
		 

		 <h2 style="color:red;margin-left:100px;">Post</h2><br><br>
         <div class="container">
		 <div class="row">
		 <?php
		 $qry = "SELECT * FROM users  NATURAL JOIN post WHERE username = '$username' ORDER BY ID DESC";
		 $qr1 = mysqli_query($con,$qry);
		 while($row6 = mysqli_fetch_assoc($qr1))
              {   
              ?>
			  <div class="col-sm-4">
			  <div class="card" style="width: 28rem;height:310px;">
              <div class="card-body">
			  <div><img src="<?php echo $row6['Pic']?>" style="height:250px;width:279.5px;margin-left:-13px;margin-top:-14px;"></div><br>
              <p class="card-text" style="margin-bottom:-30px;"><?php echo "<b style='color:green;'>".$row6['title']."</b>"?></p><br>
			  <a href="delete.php?id=<?php echo $row6['Pic'];?>" class="pa" style="margin-left:175px;">Delete</a>
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