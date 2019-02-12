<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Fata Streaming - Register</title>
	<link rel="stylesheet" type="text/css" href="style.css?v1.1.47">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<div class="header">
		<!--<img src="img/skedata1.png" width="80%">	-->
	</div>
	<div class="menu">
<!--		<ul>
 		 <li><a href="index.php">Home</a></li>
  		 <li><a href="myfiles.php">My files</a></li>
  		 <li><a href="settings.php">Settings</a></li>
		</ul>-->
		
		<!-- logged in user information -->
		<div class="profile_info" align="right"> 

			<div>
				<ul class="login">
 		 		<li class="login"><a href="login.php">Login</a></li>
  		 		<li class="login"><a class="active" href="register.php">Signup</a></li>
				</ul>
			</div>
		</div>
	</div>
	
	<form method="post" action="register.php">

		<?php echo display_error(); ?>

		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" value="<?php echo $username; ?>">
		</div>
		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email" value="<?php echo $email; ?>">
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group">
			<label>Confirm password</label>
			<input type="password" name="password_2">
		</div>
		<div class="input-group">
			<button type="submit" class="btn blue" name="register_btn">Register</button>
		</div>
		<p>
			Already a member? <a href="login.php">Sign in</a>
		</p>
	</form>
</body>
</html>