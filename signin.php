<?php
	require 'config.php';

    $username=$password="";

    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
      $username=trim($_POST['username']);
      $password=md5(trim($_POST['password']));
      $sql="SELECT username, password FROM users WHERE username='$username' AND password='$password';";
      echo $username.','.$password;
      $query = mysqli_query($conn,$sql);

      if(mysqli_num_rows($query)>0)
      {
        echo"<script>alert('You are signed in successfully.')</script>";
        #header('Location:index.php');
      }
      else
      {
        echo"<script>alert('Username or Password is incorrect')</script>"; 
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
	<link rel="shortcut icon" href="ig.ico" />
	
</head>
<body>
	<h1 style="font-size: 5em; top: 17%; right: 19%;" class="neon" data-text="Instagram"><?php echo "Instagram"; ?></h1>
	<div class="box">
		<h2>Sign in</h2>
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
			<a style="color:#5844D8; text-align: right;" href="signup.php">for sign up click here</a>
		</form>
	</div>
</body>
</html>