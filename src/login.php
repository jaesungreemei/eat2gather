<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to Eat2Gather!</title>
		<style type="text/css">
			body {
				font-family: Arial, Impact, sans-serif ;
			}
		</style>
	</head>

	<body align="center">
		<img src='Eat2Gather.jpg' border='0' alt='Eat2Gather Logo'>

		<br>
		<br>
		<br>
		<br>

		<form method="get" action="user_check.php">
			User ID: <input type = "text" name = "user_id" size = "15" maxlength="15"> 
			
			<br>
			<br>

			Password: <input type = "password" name = "password" size = "15" maxlength="50">
			
			<br>
			<br>

			<input type="submit" value="Login">
		</form>

		<br>
		<br>

		<a href="registration.php">Not a User? Sign Up!</a>

	</body>
</html>