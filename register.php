<?php include('functions.php');

$goto = $_GET['goto']; ?>


<?php

$pagetitle = "Registrati - Fata Streaming";

include('inc/sections/head.php');
?>


<body>
<?php


include('inc/sections/header.php');
?>
	
	<form method="post" action="register">
	<div class="container">
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
			Already a member? <a href="login?goto=<?php echo $goto; ?>">Sign in</a>
		</p>
		</div>
	</form>
	
<?php include('inc/sections/footer.php') ?>