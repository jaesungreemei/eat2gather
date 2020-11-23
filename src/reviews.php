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

			$restaurant_id = $_GET[restaurant_id];
			$restaurant_name = $_GET[restaurant_name];

			/* Get all the reviews for this particular restaurant */
			$review_query = "select * from project.review where restaurant_id = '$restaurant_id'";
			$review_result = mysqli_query($connect,$review_query);
			$num_rows = mysqli_num_rows($review_result);

			if ($num_rows > 0) {
				echo "
					<table width='700' align='center' cellspacing='0' border='1'>
						<tr>
							<td colspan='2' bgcolor='#ffa500' style='border-bottom: 1px solid;' align='center' height='70'>
								<font color='#000080'>REVIEWS FOR $restaurant_name</font>
							</td>
						</tr>

						<tr>
							<td align='center' height = '30'>
								<b><u>Review ID</u></b>
							</td>

							<td align='center' height = '30'>
								<b><u>Review</u></b>
							</td>
						</tr>
						";
				while ($row = mysqli_fetch_array($review_result)) {
					$review_id = $row["review_id"];
					$review = $row["review"];

					echo "
						<tr>
							<td height = '30'>
								$review_id
							</td>

							<td align='center' height = '30'>
								$review
							</td>
						</tr>
					";
				}
				echo "
					</table>
				";
			}
			else {
				echo "
					<p align='center'>There are no reviews for this restaurant</p>
				";
			}
		?>
	</body>
</html>