<?php 

include('functions.php');

$goto = $_GET['goto'];
?>

<?php

$pagetitle = "Login - Fata Streaming";

include('inc/sections/head.php');
?>

<body>
<?php


include('inc/sections/header.php');
?>
	
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

<?php include('inc/sections/footer.php') ?>