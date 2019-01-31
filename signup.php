<?php
	  require 'config.php';

    $username=$password=$repeatPassword="";

    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
      $username=trim($_POST['username']);
      $password=trim($_POST['password']);
      $repeatPassword=trim($_POST['repeatPassword']);
      
      $check="SELECT username, password FROM users WHERE username='$username' AND password='$password';";
      $query = mysqli_query($conn,$check);
      if(mysqli_num_rows($query)>0)
      {
        echo "<script>alert('You are already registered here.')</script>";
      }
      if(!(($password===$repeatPassword) and (strlen($password)>=8)))
      {
      	echo"<script>alert('Some error while adding')</script>"; 
      }
      else
      {
        $password = md5($password);
        $sql="INSERT INTO users(username,password) VALUES ('$username','$password');";
        if(mysqli_query($conn,$sql))
        {
          echo"<script>alert('You are signed up successfully.')</script>";
          header('Location:signin.php');
        }
      }
    }
    mysqli_close($conn);
?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Home Page</title>
  <link rel="shortcut icon" href="favicon.ico" />
	<link rel="stylesheet" type="text/css" href="style.css">
  <link rel="shortcut icon" href="favicon.jpg" />
</head>
<body>
	<h1 style="font-size: 5em; top: 17%; right: 19%;" class="neon" data-text="Learn With Us"><?php echo "Learn With Us"; ?></h1>
	<div class="box">
		<h2>Sign up</h2>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<div class="inputBox">
				<input type="text" name="username" required="">
				<label>Username</label>
			</div>
			<div class="inputBox">
				<input type="password" name="password" required="">
				<label>Password</label>
			</div>
			<div class="inputBox">
				<input type="password" name="repeatPassword" required="">
				<label>Retype Password</label>
			</div>
			<input type="submit" name="submit" value="Submit">
			<a style="color:#3BA8F5; text-align: right;" href="signin.php">already have an account</a>
		</form>
	</div>
</body>
</html>