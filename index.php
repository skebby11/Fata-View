<?php
include('functions.php');

//header('location: login.php');

?>

<!DOCTYPE html>
<html>
<head>
	<title>Fata Streaming</title>
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
				
				
			}
			.lastseries {
				max-width: 100%;
				display: flex;
				align-items: flex-end;
			}
			.lasttext{
				margin-top: 40px;
				margin-bottom: 25px;
				text-transform: uppercase;
			}
			.serie {
				/*float: left;*/
  				flex: 18%;
 				padding: 0 8px;
			}
			
			.serie img{
				width: 100%;
				height: auto;
			}
			
			.serie p{
				max-width: 100%;
			}
			.serie a{
				text-decoration: none;
				color: white;
			}
			.lastseries::after {
				content: "";
				clear: both;
				display: table;
			}
			
			.footer {
				height: 50px;
			}
		</style>
	
</head>
<body>

	<div class="header">
		<img src="FATASlogo.png">
	</div>
		<div class="menu">
		<ul>
 		 <li><a class="active" href="index.php">Home</a></li>
		</ul>
		<!-- logged in user information -->
		<div class="profile_info" align="right"> 

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<a href="index.php?logout='1'" style="color: red;">logout</a>
					</small>

				<?php else : ?>
				<ul class="login">
 		 		<li class="login"><a href="login.php">Login</a></li>
  		 		<li class="login"><a href="register.php">Signup</a></li>
				</ul>

				<?php endif ?>
			</div>
		</div>
	</div>

	<form>
		

		
		
		<h3 class="lasttext">Ultime serie aggiunte:</h3>
		<div class="lastseries">
		<?php
		$query = "SELECT id, nome, descr, poster, stagioni FROM serie ORDER BY id DESC LIMIT 5";
		$result = mysqli_query($db,$query);
		while($row = mysqli_fetch_assoc($result)) {
			echo "<div class='serie'><a href='/?p=". $row["id"] . "&?id=". $row["id"] . "'><img src='" . $row["poster"] ."'><p>" . $row["nome"] ."</p></a></div>";
		}
		
				
		?>
		</div>
		
		
		<h3 class="lasttext">Ultimi episodi aggiunti:</h3>
		<div class="lastseries">
		<?php
		$query = "SELECT id, stagione, episodio, titolo, serie, link FROM episodi ORDER BY id DESC LIMIT 5";
		$result = mysqli_query($db,$query);
		while($row = mysqli_fetch_assoc($result)) {
			
		$idep = $row["id"];
		$stagn = $row["stagione"];
		$epn = $row["episodio"];
		$nomeep = $row["titolo"];
		$serien = $row["serie"];
		$link = $row["link"];
			
		$query1 = "SELECT id, nome, poster FROM serie WHERE id='". $serien ."'";
		$result1 = mysqli_query($db,$query1);
		while($row = mysqli_fetch_assoc($result1)) {
		$idserie = $row["id"];
		$poster = $row["poster"];
		$nomeserie = $row["nome"];
		}

			echo "<div class='serie'><a href='view.php?v=". $link . "'><img src='" . $poster ."'><p>".$stagn."X".$epn." - ".$nomeep."</p></a></div>";
		}
				
		?>
		</div>
		
	</form>
	
	<div class="footer">
	
	</div>

</body>
</html>