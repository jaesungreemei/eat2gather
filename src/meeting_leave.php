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

		$meeting_id = $_GET[meeting_id];
		$meeting_name = $_GET[meeting_name];

		/*Remove the user from the MEETING_MEMBERS tables for this particular meeting */
		$leave_query = "delete from project.meeting_members where meeting_id = '$meeting_id' and user_id = '$user_id'";
		$leave_result = mysqli_query($connect,$leave_query);

		$leave1_query = "delete from project.requests where upcoming_meeting_id = '$meeting_id' and user_id = '$user_id'";
		$leave1_result = mysqli_query($connect,$leave1_query);

		if ($leave_result && $leave1_result) {
			echo "
				You have successfully left the meeting ' $meeting_name ' <br>
				Go to Explore! and explore new meetings!
			";
		}
		else {
			echo "Something went wrong. Please try again.";
		}

		?>
	</body>
</html>

