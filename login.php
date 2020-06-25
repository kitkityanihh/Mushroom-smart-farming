<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="img/logo.png" type="image/png">
<title>Oyster Mushroom Monitoring System
</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" href="css/w3.css">
<style>
	body {
  background-image: url("img/da.png");
   background-color: lightgreen;
    background-repeat: no-repeat;
    background-position: top;
   background-size:100vh;

}


</style>

</head>
<body>

	<div class="header w3-green" style="opacity: 0.8;">
		<h2>Login</h2>
	</div>
	
	<form method="post" action="login.php" style="opacity: 0.8;">

		<?php include('errors.php'); ?>

		<div class="input-group" style="opacity: 1;">
			<label>Username</label>
			<input type="text" name="username" >
		</div>
		<div class="input-group" style="opacity: 1;">
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<div class="input-group" >
			<button type="submit" class="btn w3-button w3-green w3-hover" name="login_user" style="opacity: 1;">Login</button>
		</div>
	</form>


</body>
</html>