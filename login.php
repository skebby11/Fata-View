<?php 

include('functions.php');

$goto = $_GET['goto'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Fata Streaming - Login</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css?1.3.5.24.43">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--	<style>
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
	</style>-->
</head>
<body>

	<div class="header">
		<img src="assets/img/FATASlogo.png">
	</div>
		<div class="menu">
		<ul>
 		 <li><a href="/">Home</a></li>
 		 <li><a href="lista-serie">Serie</a></li>
 		 <li><a href="lista-film">Film</a></li>
		</ul>
		<!-- logged in user information -->
		<div class="profile_info" align="right"> 

				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<a href="index.php?logout='1'" style="color: red;">logout</a>
					</small>

				<?php else : ?>
				<ul class="login">
 		 			<li class="login"><a class="active" href="login">Login</a></li>
  		 			<li class="login"><a href="register">Signup</a></li>
				</ul>
				<?php endif ?>
		</div>
	</div>
	
	<form method="post" action="login.php">
	  <div class="container">

		<?php echo display_error(); ?>

		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" >
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>

			<input type="text" name="goto" style="visibility: hidden" value="<?php echo $goto; ?>">

		<div class="input-group">
			<button type="submit" class="btn blue" name="login_btn">Login</button>
		</div>
		
		<p>
			Not yet a member? <a href="register?goto=<?php echo $goto; ?>">Sign up</a>
		</p>
	</form>

		</div>
</body>
</html>