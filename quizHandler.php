<?php
	require 'bootstrap.php';
	require 'config.php';
	require 'quizPart1.php';
	$qCountQuery = "SELECT COUNT(*) FROM uploads;";
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

	$i=1;
			while ($i++ <= $qCount) {
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
	




?>