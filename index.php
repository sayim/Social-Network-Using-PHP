<!DOCTYPE html>

<?php
session_start();
include ("functions/functions.php");
?>

<html>
<head>
	<title>My social network</title>
	<link rel="stylesheet" type="text/css" href="styles/style.css" media="all">
</head>
<body>
<!--container starts here-->
<div class="container">
<!--head_wap starts-->
<div id="head_wrap">
<!--header strats-->
<div id="header">
	<img src="images/logo.png" style="float: left;"alt="logo" />
	<form method="post" action="" id="form1">
	<strong style="color: white;">Email:</strong><input type="email" name="email" placeholder="Email" required="required" />
	<strong style="color: white;"> Password:</strong><input type="password" name="pass" placeholder="***********" required="required" />
	<button name="login">Log In</button>
		
	</form>
</div>
<!--header ends-->
	
</div>
<!--head_wap ends-->
<!--content area starts-->
<div id="content">
<div>
	<img src="images/bd.png" style="height: 600px;width: 500px; float: left; margin-left: -40px;">
</div>
<div id="form2">
	<form action="" method="post" >
	<h2>Sign Up Here</h2>
		<table>
			<tr>
			<td align="right">Name:</td>
			<td><input type="text" name="u_name" placeholder="Enter your name" required="required"></td>
			</tr>
			<tr>
			<td align="right">Password:</td>
			<td><input type="password" name="u_pass" placeholder="Enter your password" required="required"></td>
			</tr>
			<tr>
			<td align="right">Password:</td>
			<td><input type="password" name="u_pass_rep" placeholder="Re-enter your password" required="required"></td>
			</tr>
			<tr>
			<td align="right">Email:</td>
			<td><input type="email" name="u_email" placeholder="Enter your email" required="required"></td>
			</tr>
			<tr>
			<td align="right">Country:</td>
			<td>
				<select name="u_country" required="required">
					<option>Select a country</option>
					<option>Afganistan</option>
					<option>India</option>
					<option>Bangladesh</option>
					<option>Srilanka</option>
					<option>Pakistan</option>
					<option>United States</option>
					<option>United Arab Emirates</option>
				</select>
			</td>
			</tr>
			<tr>
			<td align="right">Gender:</td>
			<td>
				<select name="u_gender" required="required">
					<option>Male</option>
					<option>Female</option>
				</select>
			</td>
			</tr>
			<tr>
			<td align="right">Bithdate:</td>
			<td><input type="date" name="u_birthday" ></td>
			</tr>
			<tr>
				<td colspan="6">
					<button name="sign_up">Sign Up</button>
				</td>
			</tr>
		</table>
	</form>

</div>
	
</div>
<!--content ends-->

<div id="footer">
<h2>
	&copy;2017- ConnectBd Team
</h2>
	
</div>
	
</div>
<!--contaner ends-->

<?php
	include("user_insert.php");
	include("login.php");
	?>

</body>
</html>