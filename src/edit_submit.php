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

		$name = $_GET[name];
		$student_id = $_GET[student_id];
		$bday = $_GET[bday];
		$email = $_GET[email];
		$phone = $_GET[phone];
		$introduction = $_GET[introduction];

		$count = 0;

		#Must check if all necessary inputs are filled in
		if (empty($student_id) || empty($bday) || empty($email) || empty($phone) || empty($introduction)) {
			$count++;
			echo "<script language='javascript'>alert('You did not fill out the required fields');history.go(-1);</script>";
			exit(); 
		}


		#Only once all those conditions are filled, enter all information into SQL
		if ($count == '0') {
			$id_query = "update project.user set student_id='$student_id' where user_id='$user_id'";

			$bday_query = "update project.user set bday='$bday' where user_id='$user_id'";

			$email_query = "update project.user set email='$email' where user_id='$user_id'";

			$phone_query = "update project.user set phone='$phone' where user_id='$user_id'";

			$introduction_query = "update project.user set introduction='$introduction' where user_id='$user_id'";

			$id_result = mysqli_query($connect,$id_query);

			$bday_result = mysqli_query($connect,$bday_query);

			$email_result = mysqli_query($connect,$email_query);

			$phone_result = mysqli_query($connect,$phone_query);

			$introduction_result = mysqli_query($connect,$introduction_query);

			if ($id_result && $bday_result && $email_result && $phone_result && $introduction_result) {
				echo "You have successfully updated your information.<br>";
			}
			else {
				echo "Something went wrong";
				exit();
			}

			echo "
				Your ID: $user_id <br>
				Your Name: $name <br>
				Your Birth Date: $bday <br>
				Your Phone Number: $phone <br>
				Your Email Address: $email @ kaist.ac.kr <br>
			";
		}
		?>
	</body>
</html>

