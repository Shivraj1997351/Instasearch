<?php
error_reporting(0);
require('db.php');
?>
<html lang="en">
<head>
<title>Sign up</title>
<?php include "./head.html" ?>

</head>
<body>
<?php include "./header.html" ?>
		<br><br>
	
<?php
    
	if(isset($_POST['submit'])){
	$username=$_POST['username'];
	$filename= $_FILES['uploadfile']['name'];
	$tempname= $_FILES['uploadfile']['tmp_name'];
	$folder= "Pics/".$filename;
	move_uploaded_file($tempname,$folder);
	$sql="INSERT INTO images(username,Pic) VALUES('$username','$folder')";
	$result=mysqli_query($con,$sql);
	if($result)
	{
	  	echo "<div class='form'>
		<h3>You have registered successfully.</h3>
		<br/>Click here to <a href='login.php' style='text-decoration:none;'>Login</a></div>";
	}
 }
 else {?>
 
<form action="" method="post" enctype="multipart/form-data">
   <input type="text" name="username" placeholder="Enter username" required /><br><br>
   <input type="file" name="uploadfile" value=""/>Photo<br><br>
   <input type="submit" name="submit" value="Submit"/>
 </form>
 <?php }?>
 
 </body>
 </html>
