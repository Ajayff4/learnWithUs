<?php
	include 'config.php';
	
//	print_r($row);
	//echo $row['opt1'];
	if(isset($_POST['submit'])){
		echo $_POST['temp'];
	}
	else{
		$questionQuery = "SELECT * FROM uploads WHERE sr_no=1";
		$questionObj = mysqli_query($conn, $questionQuery);
		$row = mysqli_fetch_assoc($questionObj);
	
	
?>

<!DOCTYPE html>
<html>
<head>

	<title></title>
</head>
<body>
<form method="POST" action ="test.php">
	<input type="radio" name="temp" value="<?php echo $row['opt1']?>"><?php echo $row['opt1']?>
	<input type="radio" name="temp" value="<?php echo $row['opt2']?>"><?php echo $row['opt2']?>
	<input type="radio" name="temp" value="<?php echo $row['opt3']?>"><?php echo $row['opt3']?>
	<input type="radio" name="temp" value="<?php echo $row['opt4']?>"><?php echo $row['opt4']?>
	<input type="submit" name="submit">
</form>
<?php
}
?>
</body>
</html>