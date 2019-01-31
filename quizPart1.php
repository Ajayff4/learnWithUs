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