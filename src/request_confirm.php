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
		$max_participants = $_GET[max_participants];
		$member_size = $_GET[member_size];

		$applicant_name = $_GET[applicant_name];
		$applicant_id = $_GET[applicant_id];

		/*Was the person accepted or rejected */
		$host_react = $_GET[submit];

		if ($host_react == 'Accept') {
			/*If the number of people in this meeting exceeds that of max_participants, an alert must be shown */
			if ($member_size >= $max_participants) {
				echo "<script language ='javascript'>alert('This meeting has already reached its maximum number of people');history.go(-1);</script>";
				exit();
			}

			/* Insert new instance to MEETING_MEMBERS table with the accepted User, with isHost = 0 */
			$insert_query = "insert into project.meeting_members (user_id, meeting_id, isHost) values ('$applicant_id', '$meeting_id', '0')";
			$insert_result = mysqli_query($connect,$insert_query);

			/*Change the value of acceptance = 1 */
			$update_query = "update project.requests set acceptance = 1 where upcoming_meeting_id = '$meeting_id' and user_id = '$applicant_id'";
			$update_result = mysqli_query($connect,$update_query);

			if ($insert_result && $update_result) {
				$member_size++;
				echo "
				You have accepted $applicant_name 's request to join your meeting ' $meeting_name '<br>
				Applicant ID = $applicant_id <br>
				Applicant Name = $applicant_name <br>
				You currently have $member_size participants in your meeting, out of a possible $max_participants
				";
			}
			else {
				echo "Something went wrong. Please try again";
				exit();
			}
		}
		else {
			/* Change the value of acceptance = 0 */
			$update1_query = "update project.requests set acceptance = 2 where upcoming_meeting_id = '$meeting_id' and user_id = '$applicant_id'";
			$update1_result = mysqli_query($connect,$update1_query);

			if ($update1_result) {
				echo "
				You have successfully rejected the $applicant_name from joining your meeting ' $meeting_name ' 
				";
			}
			else {
				echo "Something went wrong. Please try again";
				exit();
			}
		}
		?>
	</body>
</html>

