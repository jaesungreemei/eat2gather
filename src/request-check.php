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

		/*Obtain Meeting ID */
		$meeting_id = $_GET[meeting_id];

		/*Obtain Meeting Name */
		$meeting_name = $_GET[meeting_name];

		/*Obtain Maximum Number of Participants */
		$max_participants = $_GET[max_participants];

		/*Obtain Array of Member Names */
		$member_name = $_GET[member_name];
		/*Obtain Number of Members in Meeting */
		$member_size = $_GET[member_size];

		/*Obtain Requesting Member IDs*/
		$applicant_query = "select * from project.requests where upcoming_meeting_id = '$meeting_id' and acceptance = 0";
		$applicant_result = mysqli_query($connect, $applicant_query);

		$i = 0;
		while ($row = mysqli_fetch_array($applicant_result)) {
			$applicant = $row['user_id'];
			$applicant_array[$i] = $applicant;

			$i++; 
		}

		/*Obtain Requesting Member Names */
		for ($j=0; $j < sizeof($applicant_array); $j++) { 
			$applicant = $applicant_array[$j];
			$applicant_name_query = "select name from project.user where user_id = '$applicant'";
			$applicant_name_result = mysqli_query($connect, $applicant_name_query);
			$applicant_name_array = mysqli_fetch_array($applicant_name_result);
			$applicant_name[$j] = $applicant_name_array[0];

			$k++;
		}

		/*Obtain the Corresponding Messages */
		for ($n=0; $n < sizeof($applicant_name); $n++) { 
			$app_id = $applicant_array[$n];

			$message_query = "select * from project.requests where user_id = '$app_id' and upcoming_meeting_id = '$meeting_id' and acceptance=0";
			$message_result = mysqli_query($connect,$message_query);

			while ($row = mysqli_fetch_array($message_result)) {
				$msg = $row["message"];
				$messages[$n] = $msg;
			}
		}


		/*Create a Table for the Meeting */
		echo "
			<table width='700' align='center' cellspacing='0' border='1'>	
				<tr>
					<td colspan='3' bgcolor='#00bfff' style='border-bottom: 1px solid;'' align='center' height='70'>
						<font color='#000080'>Requests for '$meeting_name' Meeting</font>
					</td>
				</tr> ";

				for ($z=0; $z < sizeof($applicant_name); $z++) { 
					$id = $applicant_array[$z];
					$name = $applicant_name[$z];
					$msg1 = $messages[$z];
					echo "
				<form method='get' action='request_confirm.php'>
				<tr>
					<td height='30'>
						<input type='hidden' name='applicant_name' value='$name'>
						<input type='hidden' name='applicant_id' value='$id'>
						($id) &nbsp; $name

						<input type='hidden' name = 'meeting_id' value='$meeting_id'>

						<input type='hidden' name = 'max_participants' value='$max_participants'>

						<input type='hidden' name = 'meeting_name' value='$meeting_name'>

						<input type='hidden' name = 'member_size' value='$member_size'>

					</td>

					<td height='30'>
						$msg1
					</td>

					<td height='30' align='center'>
						<button style='width:100%''><input type='submit' name='submit' value='Accept'></button> 

						<br> <br>

						<button style='width:100%'><input type='submit' name='submit' value='Reject'></button>	
					</td>
				</tr>
				</form>";
		echo "
			</table>
				";

				}

	?>

</body>
</html>