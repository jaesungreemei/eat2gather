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

		/* Obtain Meeting Name */
		$meeting_name = $_GET[meeting_name];

		/*Obtain Meeting Host*/
		$meeting_host = $_GET[meeting_host];

		/*Obtain Meeting ID*/
		$meeting_id = $_GET[meeting_id];

		/*Obtain Meeting Time*/
		$meeting_datetime = $_GET[time] + 61200;

		/*Obtain Message */
		$message = $_GET[message];

		$connect = mysqli_connect("localhost","root","jaesungpark97","project");
		if ($connect == false) {
			echo "<script language='javascript'>alert('Not Connected');history.go(-1);</script>";
			exit();
		}

		$count = 0;

		/* Check if the necessary inputs are filled in */
		if (empty($message)) {
			echo "<script language ='javascript'>alert('You did not fill out the required fields');history.go(-1);</script>";
			$count++;
			exit();
		}

		/* Check if the user has already sent a request to join this meeting */
		$request_query = "select * from project.requests where upcoming_meeting_id = '$meeting_id'";
		$request_result = mysqli_query($connect,$request_query);
		while ($row = mysqli_fetch_array($request_result)) {
			$requester = $row["user_id"];
			if ($requester == $user_id) {
				echo "<script language='javascript'>alert('You have already requested to join this meeting');history.go(-1);</script>";
				$count++;
				exit();
			}
		}

		/* Check if user already has a meeting in this timeframe */
		$meeting_query = "select * from project.meeting_members where user_id = '$user_id'";
		$meeting_result = mysqli_query($connect,$meeting_query);

		$x=0;
		while ($row = mysqli_fetch_array($meeting_result)) {
			$id_meetings[$x] = $row["meeting_id"];
			$x++;
		}

		for ($y=0; $y < sizeof($id_meetings); $y++) { 
			$meet = $id_meetings[$y];
			$time_query = "select meeting_datetime from project.meeting where meeting_id = '$meet'";
			$time_result = mysqli_query($connect,$time_query);
			$time_array = mysqli_fetch_array($time_result);
			$meeting_times[$y] = $time_array[0];
		}

		for ($i=0; $i < sizeof($meeting_times); $i++) { 
			$time = $meeting_times[$i];
			$convert = strtotime($time);
			if ($meeting_datetime >= ($convert-3600) && $meeting_datetime <= ($convert+3600)) {
				echo "<script language ='javascript'>alert('You already have a meeting in this timeframe');history.go(-1);</script>";
				$count++;
				exit();
			}
		}

		/* Send Request (insert User ID and Message into the REQUESTS entity, and set Acceptance boolean to "0") */
		if ($count == 0) {
			$insert_query = "insert into project.requests (message, upcoming_meeting_id, user_id) values ('$message', '$meeting_id', '$user_id')";
			$check = mysqli_query($connect,$insert_query);

			if ($check) {
				echo "You have successfully sent a request to $meeting_host <br>";
			}
			else {
				echo "Something went wrong. Please try again";
				exit();
			}

			$query = "select request_id from project.requests where user_id = '$user_id' order by request_id desc";
			$result = mysqli_query($connect,$query);
			$id = mysqli_fetch_array($result);

			echo "
				Request ID: ".$id[0]." <br>
				Meeting Name: $meeting_name <br>
				Your Message to the Host: $message <br>

				Check soon for acceptance!
			";
		}
		?>
	</body>
</html>


