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

		/* Must only show meetings where time has not passed and the user is not a part of already */
		$meeting_query = "select * from project.meeting where timepassed=0 and meeting_id in (select distinct meeting_id from project.meeting_members where not user_id = '$user_id') order by meeting_datetime";
		$meeting_result = mysqli_query($connect,$meeting_query);

		/* Must obtain all members from the meeting */
		$members_query = "select * from project.meeting_members";
		$members_result = mysqli_query($connect, $members_query);
		?>

		<p align="center">Explore Other Meetings!</p>
		<br>
		<br>
		<br>

		<?php
			$num_rows = mysqli_num_rows($meeting_result);
			if ($num_rows == 0) {
				echo "
					<p align='center'>There are no currently available meetings </p>
				";
			}


			while ($row = mysqli_fetch_array($meeting_result)) {

				$meeting_id = $row["meeting_id"];

				/* Obtain the Members ID participating in this meeting */
				$members_query = "select * from project.meeting_members where meeting_id = '$meeting_id'";
				$members_result = mysqli_query($connect, $members_query);

				$i = 0;
				while ($mem = mysqli_fetch_array($members_result)) {
					$member_id = $mem["user_id"];
					$member_array[$i] = $member_id;
					$i++;
					$isHost = $mem["isHost"];

					/*Obtain Host ID for this particular meeting */
					if ($isHost == '1') {
						$host_id = $member_id;
					}
				}

				/*Obtain Members Names for this particular meeting */
				$k = 0;
				$member_size = sizeof($member_array);
				$member_name = array();
				for ($j=0; $j < sizeof($member_array); $j++) { 
					$member = $member_array[$j];
					$members_name_query = "select name from project.user where user_id = '$member'";
					$members_name_result = mysqli_query($connect, $members_name_query);
					$members_name_array = mysqli_fetch_array($members_name_result);
					$member_name[$k] = $members_name_array[0];
					$k++;
				}

				/*Obtain Host Name for this particular meeting */
				$name_query = "select name from project.user where user_id = '$host_id'";
				$name_result = mysqli_query($connect, $name_query);
				$name_array = mysqli_fetch_array($name_result);
				$meeting_host = $name_array[0];
			

				/*Obtain Restaurant Name for this particular meeting*/
				$restaurant_id = $row["restaurant_id"];
				$restaurant_query = "select restaurant_name from project.restaurant where restaurant_id='$restaurant_id'";
				$restaurant_result = mysqli_query($connect, $restaurant_query);
				$restaurant_array = mysqli_fetch_array($restaurant_result);
				$meeting_location = $restaurant_array[0];

				/*Obtain Meeting ID for this particular meeting*/
				$meeting_id = $row["meeting_id"];

				/*Obtain Meeting Name for this particular meeting*/
				$meeting_name = $row["meeting_name"];

				/* Obtain Meeting Time in correct format */
				$datetimeSQL = $row["meeting_datetime"];
				$time = strtotime($datetimeSQL);
				$meeting_time = date("m/d/y g:i A", $time);

				/*Obtain # of Max Participants */
				$max_participants = $row["max_participants"];

				/*Obtain Meeting Description */
				$description = $row["description"];
				
				/*Make sure that the current number of participants does not exceed the Maximum Participants limit*/
				if ($member_size < $max_participants) {
					echo "
						<form method='get' action='explore-check.php'>
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
									Meeting Host
								</td>

								<td align='center' height = '30'>
									<input type='hidden' name = 'meeting_host' value='$meeting_host'>
									<input type='hidden' name = 'host_id' value='$host_id'> $meeting_host &nbsp;
									<button type='submit' formaction='view_profile.php'>View Host Profile</button>
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
									<input type='hidden' name = 'time' value='$time'>
									<input type='hidden' name = 'meeting_time' value='$meeting_time'> $meeting_time
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
									Participating Members <br> (Current Number of Members)
								</td>

								<td align = 'center'>
									<input type='hidden' name = 'member_size' value='$member_size'> ($member_size) &nbsp;
								";
									for ($z=0; $z < sizeof($member_name) ; $z++) { 
										echo "$member_name[$z] &nbsp; ,";			
									}
							echo "</td>	

							<tr>
								<td>
									Meeting Description
								</td>

								<td align='center'>
									<input type='hidden' name = 'description' value='$description'> $description
								</td>
							</tr>

							<tr>
								<td colspan='2' align='center' height='30'>
									<input type='submit' value='Send a Request to Join this Meeting'>
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
		?>
	</body>
</html>