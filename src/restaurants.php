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

			$restaurant_query = "select * from project.restaurant";
			$restaurant_result = mysqli_query($connect,$restaurant_query);

			echo "
				<p align = 'center'>Restaurants</p>
				<br>
				<br>
			";

			while ($row = mysqli_fetch_array($restaurant_result)) {
				$restaurant_id = $row["restaurant_id"];
				$restaurant_name = $row["restaurant_name"];
				$restaurant_email = $row["restaurant_email"];
				$restaurant_location = $row["restaurant_location"];
				$restaurant_phone = $row["restaurant_phone"];
				$restaurant_type = $row["restaurant_type"];
				$foodtype_id = $row["foodtype_id"];

				/*Obtain Food Type Information */ 
				$foodtype_query = "select * from project.food_type where foodtype_id = '$foodtype_id'";
				$foodtype_result = mysqli_query($connect,$foodtype_query);
				
				while ($food = mysqli_fetch_array($foodtype_result)) {
					$foodtype_name = $food["foodtype_name"];
					$tastes = $food["tastes"];
					$region = $food["region"];
				}

				echo "
				<form method='get' action='reviews.php'>
					<table width='700' align='center' cellspacing='0' border='1'>
						<tr>
							<td colspan='2' bgcolor='#ffa500' style='border-bottom: 1px solid;' align='center' height='70'>
								<font color='#000080'>$restaurant_name</font>
							</td>
						</tr>

						<tr>
							<td height = '30'>
								Restaurant ID
							</td>

							<td align='center' height = '30'>
								<input type='hidden' name = 'restaurant_id' value= '$restaurant_id'> $restaurant_id
							</td>
						</tr>

						<tr>
							<td height = '30'>
								Restaurant Name
							</td>

							<td align='center' height = '30'>
								<input type='hidden' name = 'restaurant_name' value='$restaurant_name'> $restaurant_name
							</td>
						</tr>
						<tr>
							<td height = '30'>
								Email
							</td>

							<td align='center' height = '30'>
								<input type='hidden' name = 'restaurant_email' value='$restaurant_email'> $restaurant_email
							</td>
						</tr>

						<tr>
							<td height = '30'>
								Location
							</td>

							<td align='center' height = '30'>
								<input type='hidden' name = 'restaurant_location' value='$restaurant_location'> $restaurant_location
							</td>
						</tr>

						<tr>
							<td height = '30'>
								Phone Number
							</td>

							<td align='center' height = '30'>
								<input type='hidden' name = 'restaurant_phone' value='$restaurant_phone'> $restaurant_phone
							</td>
						</tr>

						<tr>
							<td>
								Restaurant Type
							</td>

							<td align = 'center'>
								<input type='hidden' name = 'restaurant_type' value='$restaurant_type'> $restaurant_type 
							</td>
						</tr>	

						<tr>
							<td colspan='2' bgcolor='#ffa500' style='border-bottom: 1px solid;' align='center' height='45'>
								<font color='#000080'>Type of Food Offered</font>
							</td>
						</tr>

						<tr>
							<td>
								Food Type
							</td>

							<td align = 'center'>
								<input type='hidden' name = 'foodtype_name' value='$foodtype_name'> $foodtype_name 
							</td>
						</tr>	

						<tr>
							<td>
								Main Taste
							</td>

							<td align = 'center'>
								<input type='hidden' name = 'tastes' value='$tastes'> $tastes 
							</td>
						</tr>	

						<tr>
							<td>
								Region of the World from which the food comes from
							</td>

							<td align = 'center'>
								<input type='hidden' name = 'region' value='$region'> $region 
							</td>
						</tr>	

						<tr>
							<td colspan='2' align='center' height='30'>
								<button type='submit'>Show the Reviews of this Restaurant</button> &nbsp;
								<button type='submit' formaction='menu.php'>Menu</button> &nbsp;
							</td>
						</tr>
					</table>
				</form>
				<br>
				<br>
				<br>

				";
			}
		?>
	</body>
</html>