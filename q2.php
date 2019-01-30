<?php
	require 'config.php';
	session_start();//Evoking previous session if it exists.
    $question=$answer="";
    //print_r($_POST);
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
      $question=$_POST['question'];
      $answer  =$_POST['answer'];
      //SELECT question,answer FROM uploads WHERE question='Who was the father of C language?' AND answer='Dennis Ritchie';
      $sql="SELECT question, answer FROM uploads WHERE question='$question' AND answer='$answer';";
      echo $question."<->".$answer;
      $query = mysqli_query($conn,$sql);

      if(mysqli_num_rows($query)>0){
      	//echo "Correct<br>";
      	//header('Location:q2.php');
        //exit;
        
        echo"<script>alert('Correct Answer')</script>";
      }else{
        echo"<script>alert('Incorrect Answer')</script>"; 
        //echo "Incorrect<br>";
      }
    }
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Question Access Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	
</head>
<body style="color: white;">
	<a href="leaderboard.php"><button type="button">LEADERBOARD</button></a>
	<!-- style="background: white; border: 2px solid #4CAF50; color: blue;" removed css from LEADERBOARD BUTTON-->
	<h1 style="font-size: 5em; top: 17%; right: 19%;" class="neon" data-text="Quizzy"><?php echo "Quizzy"; ?></h1>
	<div class="box" style="width: 800px;">
		<h2>Question</h2>
		<?php
			require 'bootstrap.php';
			require 'config.php';
			
			$qCountQuery = "SELECT COUNT(*) FROM uploads;";
			$qCount = mysqli_query($conn, $qCountQuery);
			$row = mysqli_fetch_array($qCount);
			//print_r($row);
			$qCount = $row[0];
			/*$qFlag = array();
			for($i=0;$i<$qCount;$i++)
			{
				$qFlag[$i+1] = 'green';
			}*/
			$rand = mt_rand(1,$qCount);
			//echo 'Random Number'.$rand.'<br>';

			/*while ($qFlag[$rand]=='red') {
				$rand = mt_rand(1,$qCount);
			}
			$qFlag[$rand]='red';
			*/
			$questionQuery = "SELECT * FROM uploads WHERE sr_no='$rand'";
			$questionObj = mysqli_query($conn, $questionQuery);
			$row = mysqli_fetch_assoc($questionObj);
			//print_r($row);
			$opt1 = $row['opt1'];
			$opt2 = $row['opt2'];
			$opt3 = $row['opt3'];
			$opt4 = $row['opt4'];
		//	echo $row['opt1'];
		//	echo "manoj";
		include 'formText.php';/* contains <form  method="POST"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype='multipart/form-data'>*/
		
		echo '<h3 name="question" class="form-control" cols="30" rows="5" value='.$row['question'].'>'.$row['question'].'</h3>'; 
		echo '<table style="width:1000px;"><tr>';
		echo '<td><input type="radio" name="answer" value="'.$opt1.'">'.$row['opt1'].'</td>';
		echo '<td><input type="radio" name="answer" value="'.$opt2.'">'.$row['opt2'].'</td></tr><tr>';
		echo '<td><input type="radio" name="answer" value="'.$opt3.'">'.$row['opt3'].'</td>';
		echo '<td><input type="radio" name="answer" value="'.$opt4.'">'.$row['opt4'].'</td></tr></table>';
		echo '<center><input type="submit" name="submit" value="Submit"></center></form>';
	?>
</body>
</html>