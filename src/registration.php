<!DOCTYPE html>
<html>
	<head>
		<title>Register for Eat2Gather!</title>
		<style type="text/css">
			body {
				font-family: Arial, Impact, sans-serif ;
			}
		</style>
	</head>
	<body>
		<form enctype="multipart/form-data" method="post" action="registration_result.php">

			<table width="600" align="center" cellspacing="0" border="1">	
				<!-- Registration Headline -->
				<tr>
					<td colspan="2" bgcolor="#00bfff" style="border-bottom: 1px solid;" align="center" height="70">
						<font color="#000080">Register to <u>Eat2Gather</u>!</font>
					</td>
				</tr>

				<!-- Username -->
				<tr>
					<td height="30">
						User ID
					</td>

					<td align="center" height="30">
						<input type="text" name="user_id" maxlength="15">
					</td>
				</tr>

				<!-- Name -->
				<tr>
					<td height="30">
						Name
					</td>

					<td align="center" height="30">
						<input type="text" name="name" maxlength="50">
					</td>
				</tr>

				<!-- Password -->
				<tr>
					<td height="30">
						Password
					</td>

					<td align="center" height="30">
						<input type="password" name="password" maxlength="20">
					</td>
				</tr>

				<!-- Password Check -->
				<tr>
					<td height="30">
						Password Check
					</td>

					<td align="center" height="30">
						<input type="password" name="password_check" maxlength="20">
					</td>
				</tr>

				<!-- Student ID -->
				<tr>
					<td height="30">
						Student ID
					</td>

					<td align="center" height="30">
						<input type="number" name="student_id" min="0" max="99999999" size="10">
					</td>
				</tr>

				<!-- Bday -->
				<tr>
					<td height="30">
						Birthday
					</td>

					<td align="center" height="30">
						MM/DD/YYYY: &nbsp; <input type="date" name="bday">
					</td>
				</tr>

				<!-- Email Address -->
				<tr>
					<td height="30">
						KAIST Email
					</td>

					<td align="center" height="30">
						<input type="text" name="email" maxlength="50" size="8">
						@kaist.ac.kr
					</td>
				</tr>

				<!-- Phone Number -->
				<tr>
					<td height="30">
						Phone Number
					</td>

					<td align="center" height="30">
						<input type="number" name="phone" min="0" max="99999999999" size="10">
					</td>
				</tr>

				<!-- Brief Introduction -->
				<tr>
					<td height="120">
						Brief Introduction!
					</td>

					<td align="center" height="120">
						<textarea rows="4" cols="60" name="introduction">Give a Brief Introduction about Yourself!</textarea>
					</td>
				</tr>

				<!-- Submission -->
				<tr>
					<td colspan="2" align="center" height="30">
						<input type="submit" value="Register">
						<input type="reset" value="Clear">
						<input type="button" value="Back" onclick="history.back()">	
					</td>
				</tr>
			</table>

		</form>
	</body>
</html>