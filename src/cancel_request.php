<!DOCTYPE html>
<html>
	<head>
		<style type="text/css">
			body {
				font-family: Verdana, Impact, sans-serif ;
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

		$upcoming_meeting_id = $_GET[upcoming_meeting_id];
		$meeting_name = $_GET[meeting_name];

		/* Remove the request by this particular user for this particular meeting from the REQUEST table */
		$remove_query = "delete from project.requests where upcoming_meeting_id = '$upcoming_meeting_id' and user_id = '$user_id'";
		$remove_result = mysqli_query($connect,$remove_query);

		if ($remove_result) {
			echo "
				You have successfully canceled your request for the meeting ' $meeting_name ' <br>
			";
		}
		else {
			echo "Something went wrong. Please try again";
			exit();
		}

		?>
	</body>
</html>

