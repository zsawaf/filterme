<?php
//$mysqli = mysqli_connect("localhost","root","root","filterme");

$mysqli = mysqli_connect("us-cdbr-iron-east-04.cleardb.net", "b85df5d5b22d39", "9ad09236", "heroku_2d55da2d8fb1ece");

// Check connection
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>