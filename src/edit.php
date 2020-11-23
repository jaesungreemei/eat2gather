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

			/* Obtain values for fixed attributes */
			$name = $profile_array["name"];

			echo "
				<form method='get' action='edit_submit.php'>
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
							<input type='number' name='student_id' min='0' max='99999999' size='10'>
						</td>
					</tr>

					<tr>
						<td height = '30'>
							Birthday
						</td>

						<td align='center' height = '30'>
							MM/DD/YYYY: &nbsp; <input type='date' name='bday'>
						</td>
					</tr>

					<tr>
						<td height = '30'>
							E-mail
						</td>

						<td align='center' height = '30'>
							<input type='text' name='email' maxlength='50' size='8'> @kaist.ac.kr
						</td>
					</tr>

					<tr>
						<td height = '30'>
							Phone Number
						</td>

						<td align='center' height = '30'>
							<input type='number' name='phone' min='0' max='99999999999' size='10'>
						</td>
					</tr>

					<tr>
						<td>
							Introduction
						</td>

						<td align = 'center'>
							<textarea rows='4' cols='60' name='introduction'>Edit your Introduction</textarea>
						</td>
					</tr>	

					<tr>
						<td colspan='2' align='center' height='30'>
							<input type='submit' value='Submit my Edits'>
							<input type='reset' value='Clear'>
							<input type='button' value='Back' onclick='history.back()'>	
						</td>
					</tr>
				</table>
				</form>
			";
		?>
	</body>
</html>