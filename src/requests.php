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

			date_default_timezone_set('Asia/Seoul');
			$CurrentTime = time();

			/* Check whether the Current Time > Meeting Time. If so, do not show in this page, and update the value of "timepassed" in MEETING table to "1" */
			$query = "select * from project.meeting";
			$result_query = mysqli_query($connect, $query);
			while ($row = mysqli_fetch_array($result_query)) {
				$datetime = $row["meeting_datetime"];
				$time = strtotime($datetime);
				$meeting_id = $row["meeting_id"];

				if ($CurrentTime > $time) {
					$update_query = "update project.meeting set timepassed = 1 where meeting_id = '$meeting_id'";
					$update_result = mysqli_query($connect,$update_query);
				}
			}


			$request_query = "select * from project.requests where user_id = '$user_id'";
			$request_result = mysqli_query($connect,$request_query);
			$num_rows = mysqli_num_rows($request_result);

			echo "
				<p align = 'center'>Meetings that I have Requested to Join</p>
				<br>
				<br>
			";

			/* If the user has not made any requests, there should be a 'You have made no requests' */
			if ($num_rows == 0) {
				echo "<p align = 'center'> You have made no requests to join any meeting. Go to the explore section and explore new meetings! </p>";
				exit();
			}

			/* Go through REQUESTS table and show all the meetings that the User has requested to */
			while ($row = mysqli_fetch_array($request_result)) {
				$request_id = $row["request_id"];
				$message = $row["message"];
				$acceptance = $row["acceptance"];
				$upcoming_meeting_id = $row["upcoming_meeting_id"];

				/* Obtain all meeting information */
				$meeting_query = "select * from project.meeting where meeting_id = '$upcoming_meeting_id'";
				$meeting_result = mysqli_query($connect,$meeting_query);
				while ($meet = mysqli_fetch_array($meeting_result)) {
					$meeting_name = $meet["meeting_name"];
					$meeting_datetime = $meet["meeting_datetime"];
					$max_participants = $meet["max_participants"];
					$description = $meet["description"];
					$restaurant_id = $meet["restaurant_id"];

					/*Obtain Restaurant Name for this particular meeting*/
					$restaurant_query = "select restaurant_name from project.restaurant where restaurant_id='$restaurant_id'";
					$restaurant_result = mysqli_query($connect, $restaurant_query);
					$restaurant_array = mysqli_fetch_array($restaurant_result);
					$meeting_location = $restaurant_array[0];
				}

				/*Obtain whether the request has been accepted, rejected, or not responded to yet */
				if ($acceptance == 0) {
				 	$response = "<b>Null</b>: <br> The host has not yet responded to your request";
				 }
				 elseif ($acceptance == 1) {
				  	$response = "<b>Accepted</b>: <br> Your request has been accepted";
				 }
				 else {
				 	$response = "<b>Rejected</b>: <br> Your request has been rejected";
				 } 

				/* Form action will be different depending on whether request hasn't been responded to or accepted. No form action for if the request has been rejected */
				if ($acceptance == 0) {
					echo "<form method='get' action='cancel_request.php'>";
				}
				elseif ($acceptance == 1) {
					echo "<form method='get' action='guest_meetings.php'>";
				}
				echo "
					<table width='700' align='center' cellspacing='0' border='1'>
						<tr>
							<td colspan='2' bgcolor='#00bfff' style='border-bottom: 1px solid;' align='center' height='70'>
								<font color='#000080'>$meeting_name</font>
							</td>
						</tr>

						<tr>
							<td height = '30'>
								Meeting ID
							</td>

							<td align='center' height = '30'>
								<input type='hidden' name = 'upcoming_meeting_id' value= '$upcoming_meeting_id'> $upcoming_meeting_id
							</td>
						</tr>

						<tr>
							<td height = '30'>
								Meeting Name
							</td>

							<td align='center' height = '30'>
								<input type='hidden' name = 'meeting_name' value='$meeting_name'> $meeting_name
							</td>
						</tr>
						<tr>
							<td height = '30'>
								Meeting Location/Restaurant
							</td>

							<td align='center' height = '30'>
								<input type='hidden' name = 'meeting_location' value='$meeting_location'> $meeting_location
							</td>
						</tr>

						<tr>
							<td height = '30'>
								Meeting Time
							</td>

							<td align='center' height = '30'>
								<input type='hidden' name = 'meeting_time' value='$meeting_datetime'> $meeting_datetime
							</td>
						</tr>

						<tr>
							<td height = '30'>
								Maximum Number of Participants
							</td>

							<td align='center' height = '30'>
								<input type='hidden' name = 'max_participants' value='$max_participants'> $max_participants
							</td>
						</tr>

						<tr>
							<td>
								Meeting Description
							</td>

							<td align='center'>
								<input type='hidden' name = 'description' value='$description'> $description
							</td>
						</tr>

						<tr>
							<td height = '50'>
								Request Status
							</td>

							<td align='center' height = '50'>
								<input type='hidden' name = 'acceptance' value='$acceptance'> $response
							</td>
						</tr>";

				/* Form action will be different depending on whether request hasn't been responded to or accepted. No form action for if the request has been rejected */
				if ($acceptance == 0) {
					echo "

						<tr>
							<td colspan='2' align='center' height='30'>
								<button type='submit'>Cancel this Request</button> &nbsp;
							</td>
						</tr>
					</table>
				</form>
				<br>
				<br>
				<br>
				";
				}
				elseif ($acceptance == 1) {
					echo "

						<tr>
							<td colspan='2' align='center' height='30'>
								<button type='submit'>View the Meeting Details!</button> &nbsp;
							</td>
						</tr>
					</table>
				</form>
				<br>
				<br>
				<br>
				";
				}
			}
			echo "<p align = 'center'><input type='button' value='Back' onclick='history.back()'></p>";
		?>
	</body>
</html>