<?php
require('db.php');
include('auth.php');
$id = $_GET['id'];
$username = $_SESSION['username'];
$del = mysqli_query($con,"delete from post where Pic = '$id' and username = '$username'");
if($del)
{
 header("location:Profile.php");
}
?>