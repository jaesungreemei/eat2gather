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
		$user_id = $_POST[user_id];
		$name = $_POST[name];
		$password = $_POST[password];
		$password_check = $_POST[password_check];
		$student_id = $_POST[student_id];
		$bday = $_POST[bday];
		$email = $_POST[email];
		$phone = $_POST[phone];
		$introduction = $_POST[introduction];

		$count = 0;

		$connect = mysqli_connect("localhost","root","jaesungpark97","project");
		if ($connect == false) {
			echo "<script language='javascript'>alert('Not Connected!');history.go(-1);</script>";
		}

		$username_query = "select * from project.user";
		$result_username = mysqli_query($connect, $username_query);

		#Must check if all necessary inputs are filled in
		if (empty($user_id) || empty($password) || empty($password_check) || empty($name) || empty($student_id) || empty($bday) || empty($email) || empty($phone) || empty($introduction)) {
			$count++;
			echo "<script language='javascript'>alert('You did not fill out the required fields');history.go(-1);</script>";
			exit(); 
		}

		#Must check whether the username is taken already
		while ($row = mysqli_fetch_array($result_username)) {
			$unavailable_id = $row["user_id"];
			if ($unavailable_id == $user_id) {
				$count++;
				echo "<script language='javascript'>alert('This username is already taken');history.go(-1);</script>";
				exit();
			}
		}

		#Must check if the Password Confirm is correct
		if ($password !== $password_check) {
			$count++;
			echo "<script language='javascript'>alert('Password Confirm does not match Password');history.go(-1);</script>";
			exit();
		}

		#Only once all those conditions are filled, enter all information into SQL
		if ($count == 0) {
			$insert_query = "insert into project.user (user_id, name, password, student_id, bday, email, phone, introduction) values ('$user_id', '$name', '$password', '$student_id', '$bday', '$email', '$phone', '$introduction')";
			$check = mysqli_query($connect,$insert_query);

			if ($check) {
				echo "You are successfully registered.<br>";
			}
			else {
				echo "Something went wrong";
				exit();
			}

			$query = "select user_id from project.user where name = '$name'";
			$result = mysqli_query($connect, $query);
			$id = mysqli_fetch_array($result);

			echo "
				Your ID: ".$id[0]."<br>
				Your Name: $name <br>
				Your Birth Date: $bday <br>
				Your Phone Number: $phone <br>
				Your Email Address: $email @ kaist.ac.kr <br>
				<a href = 'login.php'><input type = 'button' value = 'Go Back'>
			";
		}
		?>
	</body>
</html>

