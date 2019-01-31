<?php
	require 'config.php';
	session_start();
    $username=$question=$category=$option1=$option2=$option3=$option4=$answer="";
    $username=$_SESSION['username']; //Uploader's name will come from session variable.

    
    if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_POST['submit']))
    {
      $question=trim($_POST['question']);
      $category=trim($_POST['category']);
      $option1 =trim($_POST['option1']);
      $option2 =trim($_POST['option2']);
      $option3 =trim($_POST['option3']);
      $option4 =trim($_POST['option4']);
      $answer  =trim($_POST['answer']);
      $sql="INSERT INTO uploads(sr_no, username, question, opt1, opt2, opt3, opt4, answer) VALUES ('','$username','$question','$option1','$option2','$option3','$option4','$answer');";
      //echo $username.','.$password;
      if(strlen($question)!=0 and strlen($category)!=0 and strlen($option1)!=0 and strlen($option2)!=0 and strlen($option3)!=0 and strlen($option4)!=0 and strlen($answer)!=0)//checking all fields are not empty.
      {
      	if($answer===$option1 or $answer===$option2 or $answer===$option3 or $answer===$option4)//checking one of four match with answer.
      	{
      	  if(mysqli_query($conn, $sql))//firing query. 
      	  {
            header('Location:questionUpload.php');
            exit;
            echo '<script>alert("Question is uploaded successfully")</script>'; //NOT WORKING
            //To prevent duplicate submission these two lines are used.
      	  }
      	}
      	else
        {
          echo"<script>alert('Something in not correct, Upload failed!!!')</script>"; 
        }
      }
    }
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="favicon.jpg" />
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Question Upload Interface</title>
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
	<!------------------------------------------------------------------------------------------------------->

	<div class="box">
		<h1 style="font-size: 1em; top:6%; " class="neon" data-text="title"><?php echo "Question Upload"; ?></h1>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<div>
				<label style="color: white;">question</label>
				<textarea name="question" rows="4" cols="43" placeholder="Input question here" style="color: white; background: transparent;"></textarea>
			</div>
			<?php
				require 'config.php';
				$sql = "SELECT * FROM category;";
				$result = mysqli_query($conn, $sql);

				echo "<select name='category' background='transparent'><option value=''>Choose Category</option>";
				while ($row = mysqli_fetch_array($result)) {
				    echo "<option value='" . $row['title'] . "'>" . $row['title'] . "</option>";
				}
				echo "</select>";
			?>
			<hr>
			<div class="inputBox">
				<input type="text" name="option1" autocomplete="off" required="">
				<label>option1</label>
			</div>
			<div class="inputBox">
				<input type="text" name="option2" autocomplete="off" required="">
				<label>option2</label>
			</div>
			<div class="inputBox">
				<input type="text" name="option3" autocomplete="off" required="">
				<label>option3</label>
			</div>
			<div class="inputBox">
				<input type="text" name="option4" autocomplete="off" required="">
				<label>option4</label>
			</div>
			<div class="inputBox">
				<input type="text" name="answer"  autocomplete="off" required="">
				<label>answer</label>
			</div>
			<input type="submit" name="submit" value="Submit">
		</form>
	</div>
</body>
</html>