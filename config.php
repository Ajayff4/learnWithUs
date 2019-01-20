<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "instagram";

//Create connection
$conn = mysqli_connect($servername,$username,$password,$dbname);
if(!$conn){
  die("connection failed to connect".mysqli_connect_error());
}
echo "I'm config file and working perfectly.";
?>