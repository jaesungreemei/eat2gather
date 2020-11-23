<?php
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Eat2Gather - Restaurant</title>
	</head>

	<frameset rows="12.5%, 87.5%" border = '0'>
		<frame src="top.php" name = "top" noresize>

		<frameset rows = "10%, 90%" border = '0'>
			<frame src="rest_middle.php" name = "middle" noresize>
			<frame src = "home.php" name = "bottom" noresize>
		</frameset>
		

	</frameset>
</html>