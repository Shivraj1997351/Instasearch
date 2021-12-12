<!-- file for non following post -->
<?php
include('auth.php');
require('db.php');
$sql = "SELECT * FROM like_dislike";
$res = mysqli_query($con,$sql);
$user1 = $_SESSION["username"];
$sql3 = "SELECT username FROM followers WHERE follower_id='$user1'";
$query5 = mysqli_query($con,$sql3);
$result5 = mysqli_fetch_assoc($query5);
if(mysqli_num_rows($query5)!=0){
	header("Location:Home1.php");
}
?>
	<html lang="en">

	<head>
		<title>Insta pic search</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" href="http://assets.stickpng.com/images/580b57fcd9996e24bc43c521.png" type="image/gif" sizes="16x16">
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
	</head>

	<body>		
			<?php
			$username = $_SESSION["username"];
			$query = "SELECT * FROM users NATURAL JOIN images WHERE username='$username'";
			$result = mysqli_query($con,$query);
			$row = mysqli_fetch_assoc($result);
        ?>
		<div style="margin-left:20px;margin-top:20px;">
		<div class="row">
		<img src="http://assets.stickpng.com/images/580b57fcd9996e24bc43c521.png" height="100" width="100">
		<h2 style="margin-left:30px;margin-top:30px;color:dodgerblue">Insta search engine</h2>
		</div>
		</div>
		<div style="margin-left:1260px;margin-top:40px;">
        <a href='Profile.php' class='pa'><img src="<?php echo $row['Pic']?>" height="80" width="80" class="avatar"></a>
		<button class="fa fa-sign-out" style="font-size:18px;margin-left:107px;" onclick="window.location='./logout.php' "></button><br><br>
         </div><br><br><br>
		 
		 <h3 style="color:pink;margin-left:50px;">Search users</h3>
		 <div class="row">
		 <form method="post">
         <input type="text" name="str" style="margin-left:635px;width:260px;" placeholder="Type username for search..." required>
         <input type="submit" name="submit" value="search">
		 </form>
        </div>
		<?php 
		 if(isset($_POST["submit"])){
			 $str1 = mysqli_real_escape_string($con,$_POST['str']);
			 $sql4 = "SELECT * FROM users WHERE username like '%$str1%'";
			 $query6 = mysqli_query($con,$sql4);
			 if(mysqli_num_rows($query6)>0){
				 while($row6=mysqli_fetch_assoc($query6)){
					 echo "<a href='search.php?username=".$row6['username']."' style='margin-left:650px;text-decoration:none;'>".$row6['username']."</a>"."<br>";
				 }
			 }
			 else {
				 $status = "No users found";
				 echo "<b style='margin-left:650px;color:blue;'>".$status."</b>";
			 }
		 }
		 ?>
		 
		 
		 <h3 style="color:pink;margin-left:50px;">Trending</h3>
		<?php
		$query4 = "SELECT * FROM like_dislike ORDER BY like_count DESC LIMIT 8";
		$sql2 = mysqli_query($con,$query4);?>
		<div class="container">
		<ul class="pagination">
		<?php while($row5 = mysqli_fetch_assoc($sql2))
		   {?>
           <li><a class="pa" href="post.php?title=<?php echo $row5["title"];?>"><?php echo $row5['title'] ?></a></li>
		   <?php
		   }
		   ?>
		   </ul>
		</div><br><br><br>
		

<div class="row">
<input type="text" id="filter" style="margin-left:635px;width:260px;" class="filter" onkeyup="search()"  placeholder="Type event or username for search...">
<button style="height:35px;width:35px;margin-top:15px;margin-left:10px;background-color:red;" id="button"><i class="fa fa-search" style="font-size:24px"></i></button>
</div>
<h3 style="color:pink;margin-left:50px;">Feed section</h3><br>
<?php 
$query2 = "SELECT * FROM post ORDER BY ID DESC";
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
				
				<div class="row">
				<div class="col-sm-2" style="margin-left:30px;">
				<a href="" class="btn btn-info btn-lg">
				<span class="glyphicon glyphicon-thumbs-up" onclick="like_update('<?php echo $row4['id']?>')">(<span id="like_loop_<?php echo $row4['id']?>"><?php echo $row4['like_count']?></span>)</span>
				</a>
				</div>
				<div class="col-sm-2" style="margin-left:100px;">
				<a href="" class="btn btn-info btn-lg">
				<span class="glyphicon glyphicon-thumbs-down" onclick="dislike_update('<?php echo $row4['id']?>')">(<span id="dislike_loop_<?php echo $row4['id']?>"><?php echo $row4['dislike_count']?></span>)</span>
				</a>
				</div>
				
				</div>
				
				</div>
				
				
				  
				<br>
				<br>
				
				</div>
				
				<script>
				 var theParent = document.querySelector("#ct");
				 theParent.addEventListener("click", showCounter, false);
		         
				 function showCounter(e){
					 if(e.target !== e.currentTarget) {
						 var clickedItem = e.target.id;
					 }	
                   e.stopPropagation();					 
				 }

				</script>
				


				<?php
				  
                }
				 //}
		       
                ?>
	            </div>
				</div>
				</div>
				<script>
				function like_update(id){
					jQuery.ajax({
						url:'update_count.php',
						type:'post',
						data:'type=like&id='+id,
						success:function(result){
							var cur_count=jQuery('#like_loop_'+id).html();
					        cur_count++;
					        jQuery('#like_loop_'+id).html(cur_count);
						}
					});
				}
				function dislike_update(id){
					jQuery.ajax({
						url:'update_count.php',
						type:'post',
						data:'type=dislike&id='+id,
						success:function(result){
							var cur_count=jQuery('#dislike_loop_'+id).html();
					        cur_count++;
					        jQuery('#dislike_loop_'+id).html(cur_count);
						}
					});
				}
				</script>
			<script>
			function search() {
    const input = document.getElementById('filter').value.toUpperCase();
    const cardContainer = document.getElementById('card-lists');
    const cards = cardContainer.getElementsByClassName('card');
    for (let i = 0; i < cards.length; i++) {
        let title = cards[i].querySelector(".card-body p.card-text");
        let username = cards[i].querySelector(".card-body h5.card-title");
        if (title.innerText.toUpperCase().indexOf(input) > -1) {
            cards[i].style.display = "";
        } 
		else if (username.innerText.toUpperCase().indexOf(input) > -1) {
			cards[i].style.display = "";
		}
		else {
            cards[i].style.display = "none";
        }
    }
}
			</script>	
		</body>
	</html>
