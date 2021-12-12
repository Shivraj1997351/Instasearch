<html lang="en">
<head>
<title>Login</title>
<?php include "./head.html" ?>

</head>
<body>
<?php include "./header.html" ?>	
<?php
require('db.php');
session_start();
if (isset($_POST['username'])){
$username = stripslashes($_REQUEST['username']);
$username = mysqli_real_escape_string($con,$username);
$password = stripslashes($_REQUEST['password']);
$password = mysqli_real_escape_string($con,$password);
$query = "SELECT * FROM users WHERE username='$username'
and password='$password'";
$result = mysqli_query($con,$query) or die(mysql_error());
$rows = mysqli_num_rows($result);
if($rows==1){
$_SESSION['username'] = $username;
header("Location: Home.php");
}
else{
	header("Location: registration.php");
}
}
else{
?>
<div class="form" style="margin-top:130px;">
<h1 style="color:green;">Sign in/Sign up</h1>
<form action="" method="post" name="login">
<div class="imgcontainer">
<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRRMMvktNrU0p6IMp3Jq79ebNeedXbdJQQQbA&usqp=CAU" class="avatar">
</div>
<input type="text" name="username" placeholder="Enter username" required />
<p style="color:red;"><span id="username"></span></p>
<input type="password" name="password" placeholder="Enter password" required /><br><br>
<input name="submit" type="submit" value="Login" />
</form>
<p style="color:red;">New User?<a class='pa' href='registration.php'><b>Sign up</b></a></p>
</div>
<?php } ?>
</body>
</html>