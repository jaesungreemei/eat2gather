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

			/* If the timepassed = 1 and the meeting_id is not already in the table, insert that meeting into the HAPPENED table */
			$timepassed_query = "select * from project.meeting where timepassed='1' and not meeting_id in (select meeting_id from project.happened)";
			$timepassed_result = mysqli_query($connect,$timepassed_query);
			while ($row = mysqli_fetch_array($timepassed_result)) {
				$id_meeting = $row["meeting_id"];
				$describe = $row["description"];
				$meet_datetime = $row["meeting_datetime"];
				$max = $row["max_participants"];

				$happened_query = "insert into project.happened (meeting_id, description, meeting_datetime, max_participants) values ('$id_meeting', '$describe', '$meet_datetime', '$max')";
				$happened_result = mysqli_query($connect,$happened_query);
			}

			/*Show tables of the meetings that the User has already taken a part of */
			$meeting_query = "select * from project.meeting where meeting_id in (select meeting_id from project.meeting_members where user_id = '$user_id' and meeting_id in (select meeting_id from project.happened)) ";
			$meeting_result = mysqli_query($connect, $meeting_query);
			$num_rows = mysqli_num_rows($meeting_result);

			echo "
				<p align = 'center'>Happened Meetings</p>
				<br>
				<br>
			";

			/* If there are no meetings, show 'You currently do not host any upcoming meetings' */
			if ($num_rows == 0) {
				echo "
					<p align='center'>You have not participated in any meeting</p>
				";
			}
			
			while ($row = mysqli_fetch_array($meeting_result)) {
				$meeting_id = $row["meeting_id"];
				$meeting_name = $row["meeting_name"];
				$meeting_datetime = $row["meeting_datetime"];
				$max_participants = $row["max_participants"];
				$description = $row["description"];
				$restaurant_id = $row["restaurant_id"];

				/* Obtain the Members ID that have in this meeting */
				$members_query = "select * from project.meeting_members where meeting_id = '$meeting_id'";
				$members_result = mysqli_query($connect, $members_query);

				$i = 0;
				while ($mem = mysqli_fetch_array($members_result)) {
					$member_id = $mem["user_id"];
					$member_array[$i] = $member_id;
					$i++;
				}

				/*Obtain Members Names that have participated in this meeting */
				$k = 0;
				$member_size = sizeof($member_array);
				for ($j=0; $j < sizeof($member_array); $j++) { 
					$member = $member_array[$j];
					$members_name_query = "select name from project.user where user_id = '$member'";
					$members_name_result = mysqli_query($connect, $members_name_query);
					$members_name_array = mysqli_fetch_array($members_name_result);
					$member_name[$k] = $members_name_array[0];
					$k++;
				}

				/*Obtain Restaurant Name for this particular meeting*/
				$restaurant_query = "select restaurant_name from project.restaurant where restaurant_id='$restaurant_id'";
				$restaurant_result = mysqli_query($connect, $restaurant_query);
				$restaurant_array = mysqli_fetch_array($restaurant_result);
				$meeting_location = $restaurant_array[0];

				echo "
				<form method='get' action='review_entry.php'>
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
								<input type='hidden' name = 'meeting_id' value= '$meeting_id'> $meeting_id
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
								Meeting Time
							</td>

							<td align='center' height = '30'>
								<input type='hidden' name = 'meeting_time' value='$meeting_datetime'> $meeting_datetime
							</td>
						</tr>

						<tr>
							<td height = '30'>
								Number of Participants
							</td>

							<td align='center' height = '30'>
								<input type='hidden' name = 'member_size' value='$member_size'> $member_size
							</td>
						</tr>

						<tr>
							<td>
								Participating Members
							</td>

							<td align = 'center'>
							";
								for ($z=0; $z < sizeof($member_name) ; $z++) { 
									echo "$member_name[$z] &nbsp; ,";			
								}
						echo "</td>	

						<tr bgcolor='#7EC0EE'>
							<td height = '30'>
								Meeting Location/Restaurant
							</td>

							<td align='center' height = '30'>
								<input type='hidden' name = 'meeting_location' value='$meeting_location'> 
								<input type='hidden' name='restaurant_id' value='$restaurant_id'>
								$meeting_location
							</td>
						</tr>

						<tr bgcolor='#7EC0EE'>
							<td height = '30'>
								Write your Review about the Restaurant here
							</td>

							<td align='center' height = '30'>
								<textarea rows='4' cols='60' name='review'>Write your Review about the Restaurant here</textarea>
							</td>
						</tr>

						<tr>
							<td colspan='2' align='center' height='30'>
								<button type='submit'>Submit My Review for this Restaurant</button> &nbsp;
							</td>
						</tr>
					</table>
				</form>
				<br>
				<br>
				<br>

				";
			}


			/*In each table, there should be a textarea in which the user can write reviews about the restaurant they went to and submit*/

		?>
	</body>
</html>