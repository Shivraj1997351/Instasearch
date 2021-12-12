<html>
<head>
<title>Registration</title>
<?php include "./head.html" ?>
</head>
<body>
<?php include "./header.html" ?>
		<br><br>
<?php
require('db.php');
if (isset($_REQUEST['username'])){
// removes backslashes
$username = stripslashes($_REQUEST['username']);
//escapes special characters in a string
$username = mysqli_real_escape_string($con,$username);
$email = stripslashes($_REQUEST['email']);
$email = mysqli_real_escape_string($con,$email);
$password = stripslashes($_REQUEST['password']);
$password = mysqli_real_escape_string($con,$password);
$query = "INSERT into users(username, password, email) VALUES ('$username', '$password', '$email')";
$result = mysqli_query($con,$query);
if($result){
	 header('Location: image.php');
}
else{
	echo"<b style='color:red'>Username or email already exist please use new one</b>";
     }
}else{
?>
<div class="form">
<h1>Registration</h1>
<form name="registration" action="" method="post">
<input type="text" name="username"  placeholder="Enter username" required /><br><br>
<input type="password" name="password" placeholder="Enter password" required /><br><br>
<input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="rahul1234@gmail.com" placeholder="Enter email" required /><br><br>
<input type="submit" name="submit" value="Submit" />
</form>
</div>
<?php } ?>
</body>
</html>