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

			$host_id = $_GET[host_id];

			/* Obtain Host Information */
			$host_query = "select * from project.user where user_id = '$host_id'";
			$host_result = mysqli_query($connect,$host_query);
			$host_array = mysqli_fetch_array($host_result);

			$host_name = $host_array["name"];
			$host_student_id = $host_array["student_id"];
			$host_bday = $host_array["bday"];
			$host_email = $host_array["email"];
			$host_phone = $host_array["phone"];
			$host_introduction = $host_array["introduction"];

			echo "
				<table width='700' align='center' cellspacing='0' border='1'>
					<tr>
						<td colspan='2' bgcolor='#228B22' style='border-bottom: 1px solid;' align='center' height='70'>
							<font color='#000080'>Meeting Host Profile</font>
						</td>
					</tr>

					<tr>
						<td height = '30'>
							User ID
						</td>

						<td align='center' height = '30'>
							$host_id
						</td>
					</tr>

					<tr>
						<td height = '30'>
							Host Name
						</td>

						<td align='center' height = '30'>
							$host_name
						</td>
					</tr>
					<tr>
						<td height = '30'>
							KAIST Student ID
						</td>

						<td align='center' height = '30'>
							$host_student_id
						</td>
					</tr>

					<tr>
						<td height = '30'>
							Birthday
						</td>

						<td align='center' height = '30'>
							$host_bday
						</td>
					</tr>

					<tr>
						<td height = '30'>
							E-mail
						</td>

						<td align='center' height = '30'>
							$host_email @kaist.ac.kr
						</td>
					</tr>

					<tr>
						<td height = '30'>
							Phone Number
						</td>

						<td align='center' height = '30'>
							$host_phone
						</td>
					</tr>

					<tr>
						<td>
							Introduction
						</td>

						<td align = 'center'>
							$host_introduction
						</td>
					</tr>	

					<tr>
						<td colspan='2' align='center' height='30'>
							<input type='button' value='Back' onclick='history.back()'>
						</td>
					</tr>
				</table>

			";


		?>
	</body>
</html>