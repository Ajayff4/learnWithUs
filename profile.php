<?php 	session_start();    ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
	<title>Home Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="shortcut icon" href="favicon.jpg" />
	<link href='http://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet' type='text/css'>
	<style type="text/css">
		button
		{
			background: transparent;
			border: none;
			outline: none;
			color: #fff;
			background: #03a9f4;
			padding: 10px 20px;
			cursor: pointer;
			border-radius: 5px; 
		}
	</style>
</head>
<body>
	<!-----------------------LOGIC TO PREVENT USERS ENTERING INTO PAGES WITHOUT LOGIN------------------------>
	<a href="signin.php">
		<button type="button"
		onclick="alert('successfully logging out')">logout 
		<?php if(isset($_SESSION['username']))
		  { 
		  	echo $_SESSION['username'];
		  } 
		  else 
		  {
		  	header('Location:signin.php');
		  } ?>
		</button>
	</a>
	<a href="leaderboard.php"><button type="button" value="leaderboard" style="float: right;">leaderboard</button></a>
	<!------------------------------------------------------------------------------------------------------->
	<h1 style="font-size: 3em; font-family: 'Aldrich'; top: 5%; right: 19%;" class="neon" data-text="neon"><?php echo "<center>".$_SESSION['username']."'s Page"."</center>"; ?></h1>
	<div class="box" style="width: 1200px; height: 520px; transform: translate(-50%,-60%);">
		<br>
			<?php       
        		require 'bootstrap.php';
				require 'config.php';        
                $user = $_SESSION['username'];

                $getRank = "SELECT * FROM profile ORDER BY exp DESC";
				$result = mysqli_query($conn, $getRank);
				$i=1;
				while($profile = mysqli_fetch_assoc($result)){
					if($profile['username']==$user){
						$rank = $i;
						break;
					}else{
						$i++;
					}
				}


                $getUser = "SELECT * FROM profile WHERE username='$user'";
				$result = mysqli_query($conn, $getUser);
				$res = mysqli_fetch_assoc($result);


				echo '<img src="data:image/jpeg;base64,'.base64_encode($res['photo'] ).'" height="400" width="320" class="img-thumnail" />';
				echo "<div class=box style='width:600px; transform:translate(-30%,-60%);'>";
				echo "<table cellpadding=5 style='color:#4781EC; font-family: Aldrich; font-size: 20px;'>";
				echo "<tr>";
				echo "<td>Username</td><td>".$res['username']."</td></tr>";
				echo "<td>Fullname</td><td>".$res['fullname']."</td></tr>";
				echo "<td>Email ID</td><td>".$res['email']."</td></tr>";
				echo "<td>Institute</td><td>".$res['institute']."</td></tr>";
				echo "<td>State</td><td>".$res['state']."</td></tr>";
				echo "<td>City</td><td>".$res['city']."</td></tr>";
				echo "<td>Weapons</td><td>".$res['weapons']."</td></tr>";
				echo "<td>EXP Points</td><td>".$res['exp']."</td></tr>";
				echo "<td>About Me</td><td>".$res['bio']."</td></tr>";
				echo "<td>Global Rank</td><td>#".$rank."</td></tr></table>";
				echo "</div></div>";
            ?>
	</div>
</body>
</html>