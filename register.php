<?php include('functions.php');

$goto = $_GET['goto']; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Fata Streaming - Register</title>
	<link rel="stylesheet" type="text/css" href="style.css?v1.1.47">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<style>
	@media (min-width: 992px) { 
		.header {
			max-width: 970px;
		}
		.menu {
			max-width: 970px;
		}
		form {
			max-width: 970px;
		}
	</style>
	
</head>
<body>
	<div class="header">
		<img src="FATASlogo.png">	
	</div>
	<div class="menu">
		<ul>
 		 <li><a href="index.php">Home</a></li>
		</ul>
		
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
		
		<input type="text" name="goto" style="visibility: hidden" value="<?php echo $goto; ?>">
		
		<div class="input-group">
			<button type="submit" class="btn blue" name="register_btn">Register</button>
		</div>
		<p>
			Already a member? <a href="login.php?goto=<?php echo $goto; ?>">Sign in</a>
		</p>
	</form>
</body>
</html>