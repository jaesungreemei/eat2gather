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

			/* Get the Food Type of this Restaurant */
			$restaurant_query = "select foodtype_id from project.restaurant where restaurant_id = '$restaurant_id'";
			$restaurant_result = mysqli_query($connect,$restaurant_query);
			$restaurant_array = mysqli_fetch_array($restaurant_result);
			$foodtype_id = $restaurant_array[0];

			/*Get all pertaining info for this Food Type*/
			$foodtype_query = "select * from project.food_type where foodtype_id = '$foodtype_id'";
			$foodtype_result = mysqli_query($connect,$foodtype_query);
			$foodtype_array = mysqli_fetch_array($foodtype_result);

			$foodtype_name = $foodtype_array["foodtype_name"];
			$tastes = $foodtype_array["tastes"];
			$region = $foodtype_array["region"];


			/* Get all the dishes pertaining to this Food Type and Restaurant */
			$dish_query = "select * from project.dish where foodtype_id = '$foodtype_id' and restaurant_id = '$restaurant_id'";
			$dish_result = mysqli_query($connect,$dish_query);

			echo "
				<table width='700' align='center' cellspacing='0' border='1'>
					<tr>
						<td colspan='2' bgcolor='#ffa500' style='border-bottom: 1px solid;' align='center' height='70'>
							<font color='#000080'>$restaurant_name Menu</font>
						</td>
					</tr>

					<tr>
						<td height = '30' bgcolor='#ffa500'>
							Restaurant ID
						</td>

						<td align='center' height = '30' bgcolor='#ffa500'>
							$restaurant_id
						</td>
					</tr>

					<tr>
						<td height = '30' bgcolor='#ffa500'>
							Restaurant Name
						</td>

						<td align='center' height = '30' bgcolor='#ffa500'>
							$restaurant_name
						</td>
					</tr>
					<tr>
						<td height = '30' bgcolor='#ffa500'>
							Food Type
						</td>

						<td align='center' height = '30' bgcolor='#ffa500'>
							$foodtype_name
						</td>
					</tr>

					<tr>
						<td height = '30' bgcolor='#ffa500'>
							Main Taste of this Restaurant
						</td>

						<td align='center' height = '30' bgcolor='#ffa500'>
							$tastes
						</td>
					</tr>

					<tr>
						<td height = '30' bgcolor='#ffa500'>
							Region of the World from which the food comes from
						</td>

						<td align='center' height = '30' bgcolor='#ffa500'>
							$region
						</td>
					</tr>";

			while ($menu = mysqli_fetch_array($dish_result)) {
				$dish_name = $menu["dish_name"];
				$price = $menu["price"];
				echo "
					<tr>
						<td align='center' height = '30'>
							$dish_name
						</td>

						<td align='center' height = '30'>
							$price Won
						</td>
					</tr>
				";
			}

			echo "
					<tr>
						<td colspan='2' align='center' height='30'>
							<input type='button' value='Back' onclick='history.back()'>
						</td>
					</tr>
				</table>
			";
		?>
	</body>
</html>