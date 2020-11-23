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


		/* Remove all the meeting members participating in this meeting from MEETING_MEMBERS table */
		$members_query = "delete from project.meeting_members where meeting_id = '$meeting_id'";
		$members_result = mysqli_query($connect,$members_query);

		if ($members_result) {
			/* Remove the meeting instance from the MEETING table */
			$meeting_query = "delete from project.meeting where meeting_id = '$meeting_id'";
			$meeting_result = mysqli_query($connect,$meeting_query);

			if ($meeting_result) {
				echo "You have successfully canceled your meeting";
			}
			else {
				echo "Something went wrong. Please try again";
				exit();
			}
		}
		else {
			echo "Something went wrong. Please try again";
			exit();
		}
		?>
	</body>
</html>

