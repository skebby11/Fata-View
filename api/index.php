<?php
include('functions.php');

?>

<!DOCTYPE html>
<html>
<head>
	<title>API - Fata Streaming</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css?1.3.5eegh">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
</head>
<body>

	<div class="header">
		<img src="../assets/img/FATASlogo.png">
	</div>
		<div class="menu">
		<ul>
 		 <li><a href="../">Home</a></li>
 		 <li><a class="active" href="../lista-serie">Serie</a></li>
 		 <li><a href="../lista-film">Film</a></li>
		 <li class="search"><form action="../search" method="post"><input type="text" name="s" placeholder="Cerca film e serie..."></form></li>
		</ul>
		<!-- logged in user information -->
		<div class="profile_info" align="right"> 

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<a href="?logout='1'" style="color: red;">logout</a>
					</small>

				<?php else : ?>
				<ul class="login">
 		 		<li class="login"><a href="../login">Login</a></li>
  		 		<li class="login"><a href="../register">Signup</a></li>
				</ul>

				<?php endif ?>
			</div>
		</div>
	</div>

	<form>
		<h3 class="lasttext">Le nostre API</h3>
		<div align="center">
			<a href="serie/read.php"><h4>Serie</h4></a> <br>
			<a href="episodio/read.php"><h4>Episodi</h4></a>
		</div>
	</form>
	
	<div class="footer">
	
	</div>

</body>
</html>