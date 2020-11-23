<!DOCTYPE html>
<html>
	<head>
		<title>Eat2Gather</title>
		<style type="text/css">
			body {
				font-family: Arial, Impact, sans-serif ;
			}

			img {
				max-width: 100%;
				max-height: 100%;
			}
			.landscape {
				height: 45px;
				width: 325px;
			}
		</style>
	</head>

	<body>
		<?php  
			session_start();
			$user_id = $_SESSION["user_id"];
			$connect = mysqli_connect("localhost","root","jaesungpark97","project");
			$query = "select name from project.user where user_id = '$user_id'";
			$result = mysqli_query($connect,$query);
			$fetch = mysqli_fetch_array($result);
			$name = $fetch["name"];
		?>


		<table width='100%' align='center' cellspacing='0' cellpadding='0' border='0'>
			<tr>
				<td align='left' width="25%">
					Welcome <?php echo "$name!"; ?>
				</td>
				<td align='center' width="50%">
					<img class="landscape" src='Eat2Gather.jpg' border='0' alt='Eat2Gather Logo'>
				</td>
				<td align='right' width="25%">
					<a href = 'logout.php'>[Log Out]</a>
				</td>
			</tr>
		</table>
	</body>
</html>