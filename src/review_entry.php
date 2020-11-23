<!DOCTYPE html>
<html>
	<head>
		<style type="text/css">
			body {
				font-family: Arial, Impact, sans-serif ;
			}
		</style>
	</head>
	<body>
	<?php
	session_start();
	$user_id = $_SESSION["user_id"];

	$connect = mysqli_connect("localhost","root","jaesungpark97","project");
	if ($connect == false) {
		echo "<script language='javascript'>alert('Not Connected!');history.go(-1);</script>";
	}

	$restaurant_name = $_GET[meeting_location];
	$restaurant_id = $_GET[restaurant_id];
	$review = $_GET[review];

	$review_query = "insert into project.review (review, restaurant_id) values ('$review', '$restaurant_id')";
	$review_result = mysqli_query($connect,$review_query);

	if ($review_result) {
		echo "
			You have successfully submitted your review for ' $restaurant_name ' <br>
			All reviews are anonymous
		";
	}
	else {
		echo "Something went wrong. Please try again";
		exit();
	}


	?>	
	</body>
</html>

