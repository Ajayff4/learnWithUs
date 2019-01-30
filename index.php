<?php
	include 'config.php';

    $username=$password="";

    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
      $username=trim($_POST['username']);
      $password=md5(trim($_POST['password']));
      $sql="INSERT INTO users(username,password) VALUES ('$username','$password');";
      if(mysqli_query($conn,$sql))
      {
        echo"<script>alert('You are signed in successfully.')</script>";
        header('Location:index.php');
      }
      else
      {
       echo"<script>alert('Some error while adding')</script>"; 
      }
    }
    mysqli_close($conn);
?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Home Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<h1 style="font-size: 5em; top: 17%; right: 19%;" class="neon" data-text="Learn With Us"><?php echo "Learn With Us"; ?></h1>
	<div class="box">
		<h2>Sign up</h2>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<div class="inputBox">
				<input type="text" name="username" autocomplete="off" required="">
				<label>Username</label>
			</div>
			<div class="inputBox">
				<input type="password" name="password" required="">
				<label>Password</label>
			</div>
			<input type="submit" name="submit" value="Submit">
		</form>
	</div>
</body>
</html>