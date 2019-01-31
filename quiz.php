<?php
	require 'config.php';
	session_start();//Evoking previous session if it exists.
    $question=$answer="";
   
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
      $question=$_SESSION['question'];
      $answer  =$_POST['answer'];
      //SELECT question,answer FROM uploads WHERE question='Who was the father of C language?' AND answer='Dennis Ritchie';
      $sql="SELECT question, answer FROM uploads WHERE question='$question' AND answer='$answer';";
      echo $question."<->".$answer;
      $query = mysqli_query($conn,$sql);

      if(mysqli_num_rows($query)>0){
      	//header('Location:quiz.php');
        //exit;
        @$_SESSION['exp'] += 1;
        echo 'Correct';
      }else{
        //echo"<script>alert('Incorrect Answer')</script>"; 
        echo "Incorrect<br>";
        @$_SESSION['exp'] -= 0.5;
      }
      echo '<h1>'.@$_SESSION['exp'].'</h1>';
    }
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Question Access Page</title>
	<link rel="shortcut icon" href="favicon.jpg" />
	<link rel="stylesheet" type="text/css" href="style.css">
	<style type="text/css">
		.h2CSS{
			 border-bottom: 1px solid #fff;
			 font-size: 20px;
			 /*color:#4781EC;*/
			 color: lime;
		}
	</style>
</head>
<body onUnload="<script>alert('Working...')</script>"> 
	<a href="leaderboard.php"><button type="button" class="buttonCSS">LEADERBOARD</button></a>
	<h1 style="font-size: 5em; top: 17%; right: 19%;" class="neon" data-text="Quizzy"><?php echo "Quizzy"; ?></h1>
	<div class="box" style="width: 800px;">
		<h2>Question</h2>
		<?php
			require 'bootstrap.php';
			require 'config.php';
			/*$qCountQuery = "SELECT COUNT(*) FROM uploads;";
			$qCount = mysqli_query($conn, $qCountQuery);
			$row = mysqli_fetch_array($qCount);
			//print_r($row);
			$qCount = $row[0];
			$qFlag = array();
			for($i=0;$i<$qCount;$i++)
			{
				$qFlag[$i+1] = 'green';
			}
			print_r($qFlag);
			$rand = mt_rand(1,$qCount);
			//echo 'Random Number'.$rand.'<br>';

			while ($qFlag[$rand]=='red') {
				$rand = mt_rand(1,$qCount);
			}
			$qFlag[$rand]='red';
			*/
			$i=1;
			while ($i++ <= $qCount) {
				# code...
				$questionQuery = "SELECT * FROM uploads WHERE sr_no='$rand'";
				$questionObj = mysqli_query($conn, $questionQuery);
				$row = mysqli_fetch_assoc($questionObj);
				
				//print_r($row);
				$opt1 = $row['opt1'];
				$opt2 = $row['opt2'];
				$opt3 = $row['opt3'];
				$opt4 = $row['opt4'];

				include 'formText.php';/* contains <form  method="POST"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype='multipart/form-data'>*/
				
				echo '<h3 name="question" class="form-control" align="center">'.$row['question'].'</h3>'; 
				$_SESSION['question'] = $row['question'];
				echo '<table style="width:720px;"><tr>';
				echo '<td><input type="radio" name="answer" value="'.$opt1.'">'.'<h2 class="h2CSS" style="color:#4781EC;">'.$opt1.'</h2></td>';
				echo '<td><input type="radio" name="answer" value="'.$opt2.'">'.'<h2 class="h2CSS" style="color:#4781EC;">'.$opt2.'</h2></td></tr><tr>';
				echo '<td><input type="radio" name="answer" value="'.$opt3.'">'.'<h2 class="h2CSS" style="color:#4781EC;">'.$opt3.'</h2></td>';
				echo '<td><input type="radio" name="answer" value="'.$opt4.'">'.'<h2 class="h2CSS" style="color:#4781EC;">'.$opt4.'</h2></td></tr></table>';
				echo '<center><input type="submit" name="submit" value="Submit"></center></form>';
			}//end loop
	?>
</body>
</html>