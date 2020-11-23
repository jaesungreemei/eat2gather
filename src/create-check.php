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

		$restaurant_id = $_GET[restaurant];
		$meeting_name = $_GET[meeting_name];

		$dateandtime = $_GET[meeting_datetime];
		$dateandtime1 = strtotime($dateandtime) - 57600;
		$meeting_datetime = date("Y-m-d H:i:s", ($dateandtime1 + 57600));

		$max_participants = $_GET[max_participants];
		$meeting_description = $_GET[meeting_description];
		$timepassed = 0;

		$count = 0;
		date_default_timezone_set('Asia/Seoul');
		$CurrentTime = time();

		$connect = mysqli_connect("localhost","root","jaesungpark97","project");
		if ($connect == false) {
			echo "<script language='javascript'>alert('Not Connected!');history.go(-1);</script>";
			exit();
		}

		#Must check if all the necessary inputs are filled in
		if (empty($restaurant_id) || empty($meeting_name) || empty($max_participants) || empty($meeting_description) || empty($meeting_datetime)) {
			$count++;
			echo "<script language='javascript'>alert('You did not fill out the required fields');history.go(-1);</script>";
			exit();
		}

		#Must check whether the current time has already passed the planned time of the meeting
		if ($CurrentTime > $dateandtime1) {
			$count++;
			echo "<script language='javascript'>alert('The date selected has passed already Please select another date');history.go(-1);</script>";
			exit();
		}

		#Must check whether the host has a meeting already planned in the specific time frame (both as a host or participant)
		#Meeting Time cannot be in within an hour of a meeting that the user is already participating in.
		$usermeetings_query = "select * from project.meeting_members where user_id='$user_id'";
		$usermeetings_result = mysqli_query($connect, $usermeetings_query);
		$num_rows = mysqli_num_rows($usermeetings_result);

		if ($num_rows > 0) {
			while ($row = mysqli_fetch_array($usermeetings_result)) {
				$meeting_id = $row["meeting_id"];
				$meet_query = "select * from project.meeting where meeting_id='$meeting_id'";
				$meet_result = mysqli_query($connect, $meet_query);
				while ($meet = mysqli_fetch_array($meet_result)) {
					$datetime = $meet["meeting_datetime"];
					$convert = strtotime($datetime);

					if ($dateandtime1 >= ($convert-3600) && $dateandtime1 <= ($convert + 3600)) {
						$count++;
						echo "<script language='javascript'>alert('You already have a meeting planned for this timeframe');history.go(-1);</script>";
						exit();
					}
				}
			}
		}

		#Only if all those conditions are satisfied can a new meeting be registered!
		if ($count == 0) {
			#Must get Restaurant Name
			$restaurant_query = "select restaurant_name from project.restaurant where restaurant_id = '$restaurant_id'";
			$restaurant_result = mysqli_query($connect,$restaurant_query);
			$restaurant_array = mysqli_fetch_array($restaurant_result);
			$restaurant_name = $restaurant_array[0];

			#Insert Query for MEETING table
			$insert_query = "insert into project.meeting (restaurant_id, meeting_name, meeting_datetime, max_participants, description) values ('$restaurant_id', '$meeting_name', '$meeting_datetime', '$max_participants', '$meeting_description')";
			$insert_result = mysqli_query($connect,$insert_query);

			#Must get the Meeting ID
			$query = "select meeting_id from project.meeting order by meeting_id desc";
			$result = mysqli_query($connect, $query);
			$id = mysqli_fetch_array($result);
			$meeting_id = $id[0];

			#Insert Query for MEETING_MEMBERS table
			#Must also change boolean value of isHost to True (1)
			$insert2_query = "insert into project.meeting_members (user_id, meeting_id, isHost) values ('$user_id', '$meeting_id', '1')";
			$insert2_result = mysqli_query($connect, $insert2_query);

			#Must also Insert to UPCOMING table
			$insert3_query = "insert into project.upcoming (meeting_id, meeting_datetime, description, max_participants) values ('$meeting_id', '$meeting_datetime', '$meeting_description', '$max_participants')";
			$insert3_result = mysqli_query($connect,$insert3_query);

			if ($insert_result && $insert2_result && $insert3_result) {
				echo "
				You are successfully registered. <br>
				Meeting ID: $meeting_id <br>
				Meeting Location: $restaurant_name ($restaurant_id) <br>
				Meeting Name: $meeting_name <br>
				Meeting Date and Time: $meeting_datetime <br>
				Maximum Participants: $max_participants <br>
				Meeting Description: $meeting_description <br>
				";
			}
			else {
				echo "<script language='javascript'>alert('Something went wrong');history.go(-1);</script>";
				exit();
			}
		}

		?>
	</body>
</html>

