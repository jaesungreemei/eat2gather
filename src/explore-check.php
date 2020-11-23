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

			/* Obtain Requesting User ID */
			session_start();
			$user_id = $_SESSION[user_id];

			/* Obtain Meeting ID */
			$meeting_id = $_GET[meeting_id];

			/*Obtain Meeting Name */
			$meeting_name = $_GET[meeting_name];

			/* Obtain Host User Name */
			$meeting_host = $_GET[meeting_host];

			/*Obtain Restaurant Name */
			$meeting_location = $_GET[meeting_location];

			/*Obtain Meeting Time */
			$meeting_time = $_GET[meeting_time];

			/*Obtain Unconverted Meeting Time */
			$time = $_GET[time];

			/*Obtain Max Participants */
			$max_participants = $_GET[max_participants];

			/* Obtain Names of all Participating Members */
			$members = $_GET[member_name];
			?>

		<form method="get" action="request_sent.php">
			<table width="600" align="center" cellspacing="0" border="1">	
				<!-- Request Headline -->
				<tr>
					<td colspan="2" bgcolor="#00bfff" style="border-bottom: 1px solid;" align="center" height="70">
						<font color="#000080">Send a request to join the Meeting!</font>

					<!-- Hidden Inputs to pass on -->
					<?php
					echo "
					<input type='hidden' name = 'meeting_id' value='$meeting_id'>

					<input type='hidden' name = 'time' value='$time'>

					<input type='hidden' name = 'meeting_host' value='$meeting_host'>

					<input type='hidden' name = 'meeting_name' value='$meeting_name'>
					";
					
					?>

					</td>
				</tr>

				<!-- Requesting User Name -->
				<tr>
					<td height="30">
						Requesting User ID
					</td>

					<td align="center" height="30">
						<?php  
							echo "$user_id";
						?>
					</td>
				</tr>

				<!-- Meeting Host Name -->
				<tr>
					<td height="30">
						Host Name
					</td>

					<td align="center" height="30">
						<?php  
							echo "$meeting_host";
						?>
					</td>
				</tr>

				<!-- Meeting Name -->
				<tr>
					<td height="30">
						Meeting Name
					</td>

					<td align="center" height="30">
						<?php  
							echo "$meeting_name";
						?>
					</td>
				</tr>

				<!-- Meeting Time -->
				<tr>
					<td height="30">
						Meeting Time
					</td>

					<td align="center" height="30">
						<?php  
							echo "$meeting_time";
						?>
					</td>
				</tr>

				<!-- Meeting Location -->
				<tr>
					<td height="30">
						Meeting Location
					</td>

					<td align="center" height="30">
						<?php  
							echo "$meeting_location";
						?>
					</td>
				</tr>

				<!-- Message -->
				<tr>
					<td height="30">
						Write a message to send to the host!
					</td>

					<td align="center" height="120">
						<textarea rows="4" cols="60" name="message">Please accept my request to join your meeting!</textarea>
					</td>
				</tr>


				<!-- Submission -->
				<tr>
					<td colspan="2" align="center" height="30">
						<input type="submit" value="Send Request">
						<input type="button" value="Back" onclick="history.back()">	
					</td>
				</tr>
			</table>
		</form>
		
	</body>
</html>