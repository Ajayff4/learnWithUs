<?php 
	require 'bootstrap.php';
	require 'config.php';
	if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_POST['submit']))
    {
        $GLOBALS['category']=trim($_POST['category']);
    }
?>

<!DOCTYPE html>
<html>
<head>
	<link href='https://fonts.googleapis.com/css?family=Andika' rel='stylesheet'>
	<title>Welcome to Leaderboard</title>
	<style type="text/css">
		input[type="submit"]{
	      background: transparent;
		  border: none;
		  outline: none;
		  color: #fff;
	      background: #03a9f4;
		  padding: 10px 20px;
	      cursor: pointer;
		  border-radius: 5px; 
		}
		body{
		  background: url('leaderboardBG.jpg');
		  background-repeat: no-repeat;
		  background-size: cover;
		  font-family: 'Andika';/*Nunito*/
		  color: white;
		}
	</style>
	<link rel="shortcut icon" href="favicon.jpg" />
</head>
<body>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<?php
		require 'config.php';

		$sql = "SELECT * FROM statesofindia;";
		$result = mysqli_query($conn, $sql);
		echo "<select name='category'><option value=''>Global</option>";
		while ($row = mysqli_fetch_array($result)) {
		    echo "<option value='" . $row['stateName'] . "'>" . $row['stateName'] . "</option>";
		}
		echo '</select>';
		?>
		<input type="submit" name="submit" value="submit">
	</form>
	
	<div class="container">
		<?php
			require 'config.php';
			$i=1;
			@$state = $GLOBALS['category'];
			//echo "Printing ".$state;
			if(strlen($state)<=0)
			{
				$sql = "SELECT * FROM profile ORDER BY exp DESC";
			}
			else
			{
				$sql = "SELECT * FROM profile WHERE state='$state' ORDER BY exp DESC";
			}
			
			$result = mysqli_query($conn, $sql);

			echo '<table class="table table-dark table-striped" style="color: #03a9f4; font-size :20px;">';
			echo '<tr style="color: white;"><th>Rank</th><th>Username</th><th>Photo</th><th>EXP</th></tr>';
			while ($row = mysqli_fetch_array($result)) {
				$path = "profile.php?username=$row[username]";
			    echo "<tr><td>" . '#' .$i++ . "</td><td>" . "<a href=".$path.">".$row['username'].'</a></td><td>' . $row['fullname'] .  "</td><td>" . $row['exp'] . "</td></tr>";//Not Working
			}
			echo "</table>";
		?>
	</div>
	
</body>
</html>