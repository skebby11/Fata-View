
<!DOCTYPE html>
<html>
<head>
	<title>404 - Fata Streaming</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css?1.3">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<div class="header">
		<img src="assets/img/FATASlogo.png">
	</div>
		<div class="menu">
		<ul>
 		 <li><a  href="/">Home</a></li>
 		 <li><a href="lista-serie">Serie</a></li>
 		 <li><a href="lista-film">Film</a></li>
		 <li class="search"><form action="search" method="post"><input type="text" name="s" placeholder="Cerca film e serie..."></form></li>
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
 		 		<li class="login"><a href="login">Login</a></li>
  		 		<li class="login"><a href="register">Signup</a></li>
				</ul>

				<?php endif ?>
			</div>
		</div>
	</div>

	<form style="text-align: center">
		
		
		<h1><strong>404</strong></h1><br><br>
		<h3>Un caro e vecchio errore 404 <br> Non &egrave; stato trovato nulla :/</h3>
		<a href="/"><p style="margin: 50px 0">Forse vuoi tornare alla homepage?</p></a>

		
	</form>
	
	<div class="footer">
	
	</div>

</body>
</html>