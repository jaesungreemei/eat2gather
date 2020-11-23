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

			$profile_query = "select * from user where user_id = '$user_id'";
			$profile_result = mysqli_query($connect,$profile_query);
			$profile_array = mysqli_fetch_array($profile_result);

			/* Obtain values for all attributes */
			$name = $profile_array["name"];
			$student_id = $profile_array["student_id"];
			$bday = $profile_array["bday"];
			$email = $profile_array["email"];
			$phone = $profile_array["phone"];
			$introduction = $profile_array["introduction"];

			echo "
				<table width='700' align='center' cellspacing='0' border='1'>
					<tr>
						<td colspan='2' bgcolor='#228B22' style='border-bottom: 1px solid;' align='center' height='70'>
							<font color='#000080'>My Profile</font>
						</td>
					</tr>

					<tr>
						<td height = '30'>
							User ID
						</td>

						<td align='center' height = '30'>
							<input type='hidden' name = 'user_id' value= '$user_id'> $user_id
						</td>
					</tr>

					<tr>
						<td height = '30'>
							Your Name
						</td>

						<td align='center' height = '30'>
							<input type='hidden' name = 'name' value='$name'> $name
						</td>
					</tr>
					<tr>
						<td height = '30'>
							KAIST Student ID
						</td>

						<td align='center' height = '30'>
							<input type='hidden' name = 'student_id' value='$student_id'> $student_id
						</td>
					</tr>

					<tr>
						<td height = '30'>
							Birthday
						</td>

						<td align='center' height = '30'>
							<input type='hidden' name = 'bday' value='$bday'> $bday
						</td>
					</tr>

					<tr>
						<td height = '30'>
							E-mail
						</td>

						<td align='center' height = '30'>
							<input type='hidden' name = 'email' value='$email'> $email @kaist.ac.kr
						</td>
					</tr>

					<tr>
						<td height = '30'>
							Phone Number
						</td>

						<td align='center' height = '30'>
							<input type='hidden' name = 'phone' value='$phone'> $phone
						</td>
					</tr>

					<tr>
						<td>
							Introduction
						</td>

						<td align = 'center'>
							<input type='hidden' name = 'introduction' value='$introduction'> $introduction 
						</td>
					</tr>	

					<tr>
						<td colspan='2' align='center' height='30'>
							<a href='edit.php' target='bottom'><button style='width:100%'>Edit Profile</button></a>
						</td>
					</tr>
				</table>

			";
		?>
	</body>
</html>