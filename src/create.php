<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript">
			function populate1(s1,s2) {
				var s1 = document.getElementById(s1);
				var s2 = document.getElementById(s2);
				s2.innerHTML = "";

				if (s1.value == "Korean") {
					var optionArray = ["|", "restaurant|Restaurant", "cafeteria|Cafeteria"];
				} else if (s1.value == "Japanese") {
					var optionArray = ["|", "restaurant|Restaurant"];
				} else if (s1.value == "Chinese") {
					var optionArray = ["|", "restaurant|Restaurant"];
				} else if (s1.value == "Western") {
					var optionArray = ["|", "fastfood|Fast Food", "restaurant|Restaurant"];
				} else if (s1.value == "Mexican") {
					var optionArray = ["|", "restaurant|Restaurant"];
				} else if (s1.value == "Dessert") {
					var optionArray = ["|", "cafe|Cafe"];
				}

				for (var option in optionArray) {
					var pair = optionArray[option].split("|");
					var newOption = document.createElement("option");
					newOption.value = pair[0];
					newOption.innerHTML = pair[1];
					s2.options.add(newOption);
				}
			}

			function populate2(s1,s2,s3) {
				var s1 = document.getElementById(s1);
				var s2 = document.getElementById(s2);
				var s3 = document.getElementById(s3);
				s3.innerHTML = "";

				if (s1.value == "Korean") {
					if (s2.value == "restaurant") {
						var optionArray = ["|", "18|TTuk Bae Gi", "19|Hue Gimbap", "22|Secret"];
					} else if (s2.value == "cafeteria") {
						var optionArray = ["|", "15|East Cafeteria", "16|West Cafeteria", "17|Shinsegae Food (KAIMARU)"];
					}

				} else if (s1.value == "Japanese") {
					if (s2.value == "restaurant") {
						var optionArray = ["|", "20|Onigiri Gyudong"];
					}

				} else if (s1.value == "Chinese") {
					if (s2.value == "restaurant") {
						var optionArray = ["|", "21|MEILU"];
					}
				} else if (s1.value == "Western") {
					if (s2.value == "restaurant") {
						var optionArray = ["|", "12|Pepper"];
					} else if (s2.value == "fastfood") {
						var optionArray = ["|", "1|Subway", "4|DDDN Pizza", "5|Lotteria"];
					}

				} else if (s1.value == "Mexican") {
					if (s2.value == "restaurant") {
						var optionArray = ["|", "13|Pulbit Maru"];
					}

				} else if (s1.value == "Dessert") {
					if (s2.value == "cafe") {
						var optionArray = ["|", "2|Tous les Jours", "3|Dunkin Donuts", "6|Mangosix", "7|The Coffee Bean", "8|Cafe DropTop", "9|Cafe Gran", "10|Handel & Gretel", "11|A Twosome Place", "14|Smoothie King"];
					}
				}

				for (var option in optionArray) {
					var pair = optionArray[option].split("|");
					var newOption = document.createElement("option");
					newOption.value = pair[0];
					newOption.innerHTML = pair[1];
					s3.options.add(newOption);
				}
			}
		</script>
		<style type="text/css">
			body {
				font-family: Arial, Impact, sans-serif ;
			}
		</style>
	</head>

	<body>

		<?php  
		$connect = mysqli_connect("localhost","root","jaesungpark97","project");
		if ($connect == false) {
			echo "Not Connected";
			exit();
		}

		$foodtype_query = "select * from project.food_type";

		$foodtype_result = mysqli_query($connect, $foodtype_query);
		?>

		<!-- Create the Table -->
		<form method="get" action="create-check.php">
			<table width="600" align="center" cellspacing="0" border="1">	
				<!-- Create Meeting Headline -->
				<tr>
					<td colspan="2" bgcolor="#00bfff" style="border-bottom: 1px solid;" align="center" height="70">
						<font color="#000080">Create a Meeting! </font>
					</td>
				</tr>

				<!-- Meeting Name -->
				<tr>
					<td height="30">
						Meeting Name
					</td>

					<td align="center" height="30">
						<input type="text" name="meeting_name" maxlength="15"> &nbsp; (Create a Meeting Name!)
					</td>
				</tr>

				<!-- Meeting Date + Time -->
				<tr>
					<td height="30">
						Select a Meeting Date + Time
					</td>

					<td align="center" height="30">
						<input type="datetime-local" name="meeting_datetime" maxlength="50">
					</td>
				</tr>

				<!-- Maximum Number of Participants in Meeting -->
				<tr>
					<td height="30">
						Maximum Number of Participants
					</td>

					<td align="center" height="30">
						<input type="number" name="max_participants" min="2" max="8" size="4"> (2~8 people)
					</td>
				</tr>

				<!-- Type of Food -->
				<tr>
					<td height="30">
						Type of Food
					</td>

					<td align="center" height="30">
						&nbsp;
						<select id = "food_type" name = "food_type" onchange="populate1(this.id,'restaurant_type')">
							<?php
								echo "<option value = ''></option>";
								while ($row = mysqli_fetch_array($foodtype_result)) {
									$foodtype_name = $row["foodtype_name"];
									echo "<option value='$foodtype_name'> $foodtype_name</option>";
								}
							?>
						</select>
					</td>
				</tr>

				<!-- Restaurant Type -->
				<!-- Restaurant Type options should change depending on the Type of Food selected -->
				<tr>
					<td height="30">
						Restaurant Type
					</td>

					<td align="center" height="30">
						&nbsp;
						<select id = "restaurant_type" name="restaurant_type" onchange="populate2('food_type', this.id, 'restaurant')">
						</select>
					</td>
				</tr>

				<!-- Restaurant -->
				<!-- Restaurant options should change depending on the Type of food + Restaurant Type selected -->
				<tr>
					<td height="30">
						Restaurant
					</td>

					<td align="center" height="30">
						&nbsp;
						<select id = "restaurant" name = "restaurant">
						</select>
					</td>
				</tr>

				<!-- Meeting Description -->
				<tr>
					<td height="30">
						Meeting Description
					</td>

					<td align="center" height="30">
						<textarea rows="4" cols="60" name="meeting_description">Give a Brief Description about the Meeting!</textarea>
					</td>
				</tr>

				<!-- Submission -->
				<tr>
					<td colspan="2" align="center" height="30">
						<button class='button'><input type="submit" value="Register this Meeting"></button>
						<button class='button'><input type="reset" value="Clear"></button>
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>