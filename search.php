<?php
include('functions.php');


$keyword = $_POST["s"];

?>

<!DOCTYPE html>
<html>
<head>
	<title>Risultati ricerca - Fata Streaming</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css?1.3">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
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

	<form>
		<h3 class="lasttext">Risultati della ricerca</h3>
		<div class="allseriesrow">
		<?php
		$results_per_page = 10;
				
			if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
			$start_from = ($page-1) * $results_per_page;
				
			$query = "SELECT id, nome, descr, poster FROM serie WHERE nome LIKE '%" . 
           $keyword . "%'
           UNION
           SELECT id, titolo, descr, poster as type FROM film WHERE titolo LIKE '%" . 
           $keyword . "%'  ORDER BY ID DESC LIMIT $start_from, ".$results_per_page;


				
		$result = mysqli_query($db,$query);
		
		if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			echo "<div class='serierow'><a href='serie?id=". $row["id"] ."'><img src='" . $row["poster"] ."'><p><strong>" . $row["nome"] ."</strong><br><br>" . substr($row["descr"], 0, 500) ."...</p></a></div>";
		}
		} else {
			echo "Nessun risultato trovato :(";
		}
		?>
		</div>
		
	</form>
	
	<div class="footer">
		&copy <?php echo $year ?> | <a href="api">API</a> | This project is open source on <a href="https://github.com/skebby11/Fata-View/" target="_blank">GitHub</a> | Made by <a href="https://www.sebastianoriva.it" target="_blank">Sebastiano Riva</a>
	</div>

</body>
</html>