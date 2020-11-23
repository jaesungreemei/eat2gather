<?php
session_start();
$connect = mysqli_connect("localhost","root","jaesungpark97","project");
if ($connect == false) {
	echo "<script language='javascript'>alert('Not Connected!');history.go(-1);</script>";
}

$user_id = $_GET[user_id];
$password = $_GET[password];

/* Check if anything is filled in */
if (!isset($user_id) || trim($user_id) == '' || !isset($password) || trim($password) == '') {
	echo "<script language='javascript'>alert('Please fill in Username or Password.');history.go(-1);</script>";
}

else {
	/* Check if correct password has been inputted */
	$query = "select password from project.user where user_id = '$user_id'";
	$result = mysqli_query($connect,$query);
	$data = mysqli_fetch_array($result);
	$admin_pass = $data['password'];

	if ($password == $admin_pass) {
		$_SESSION["user_id"] = $user_id;
		$_SESSION["password"] = $password;
		echo "<script language='javascript'> location.replace('main.php');</script>";
	}
	else {
		echo "<script language='javascript'>alert('Invalid Username or Password. Please try again!');history.go(-1);</script>";
	}
}
