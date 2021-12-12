<?php
include('auth.php');
require('db.php');
$sql = "SELECT * FROM like_dislike ORDER BY id DESC";
$res = mysqli_query($con,$sql);
?>
<html lang="en">
<head>
<title>View post</title>
<?php include "./head.html" ?>
</head>
<body>
<?php include "./header.html" ?><br><br>	
<?php 
$title = mysqli_real_escape_string($con,$_GET["title"]);
?>
    <nav>
		<div id="main">
		    <div style="margin-left:20px;"><button style="height:30px;" onclick="window.location='./Home.php' ">Home</button></div>
			
		</div>
	</nav>
<br><br>
<?php
$query2 = "SELECT * FROM post WHERE title='$title' ORDER BY ID DESC";
$result2 = mysqli_query($con,$query2);
?>
		 <div class="container">
		 <div class="card-lists" id="card-lists">
		 <div class="row">
		 <?php
		 while($row2 = mysqli_fetch_assoc($result2))
              {   
		          
				  $user = $row2['username'];
		          $query3 = "SELECT * FROM users NATURAL JOIN images WHERE username='$user'";
				  $result3 = mysqli_query($con,$query3);
				  $row3 = mysqli_fetch_assoc($result3);

              ?>
			     
                
				<div class="col-sm-4">
				<?php $row4 = mysqli_fetch_assoc($res)?>
				
			    <div class="card">
				
				<a href='search.php?username=<?php echo $user?>'><img src="<?php echo $row3['Pic']?>" height="80" width="80" class="avatar" class="card-img-top"></a>
                <div class="card-body">
				<h5 class="card-title"><?php echo '<b style="color:red;">'.$row2["username"].'</b>'?></h5>
				<div><img src="<?php echo $row2['Pic']?>" style="height:250px;width:279.5px;margin-left:-13px;"></div><br>
				<div id="ct"><button id="btn" style="height:35px;width:100px;margin-left:140px;" name="button"><a class='pa' href="<?php echo $row2['Pic']?>"  download>Download</a></button></div>
                <p class="card-text" style="margin-bottom:-30px;"><?php echo "<b style='color:green;'>".$row2['title']."</b>"?></p><br>
                </div>
				
				
				</div>
				
				
				  
				<br>
				<br>
				
				</div>
				
		


				<?php
				  
                }
				 //}
		       
                ?>
	            </div>
				</div>
				</div>
				


</body>
</html>

