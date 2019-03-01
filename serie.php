

<?php
include('functions.php');

$idserie = $_GET["id"];

$query = "SELECT nome, descr, poster FROM serie WHERE id =$idserie";
		$result = mysqli_query($db,$query);
		while($row = mysqli_fetch_assoc($result)) {
			
		$nomestag = $row["nome"];
		$descrstag = $row["descr"];
		$poster = $row["poster"];
}
 
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $nomestag ?> - Fata Streaming</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css?v1.1.49">
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
		
	<style>
		.poster {
			margin: 20px 0;
			margin-right: 30px;
			width: 40%;
			height: auto;
			display: inline-block;
			vertical-align: top;
		}	
		.descr {
			display: inline-block;
			max-width: 50%;
		} 
		.epsds {
			margin-top: 50px;
			font-size: 110%;
			color: #fff;
		}
		.epsds a {
			color: #00aeef;
		}
		.stagname{
			font-size: 120%;
			margin-top: 40px;
			margin-bottom: 25px;
			text-transform: uppercase;
		}
		.ep {
			text-align: left;
			margin-top: 10px;
		}
	</style>
		<h1 class="stagname"><? echo $nomestag ?></h1>
		
		<img class="poster" src="<?php echo $poster ?> " alt="<?php echo $nomestag?> poster">
		<p class="descr"><?php echo $descrstag ?></p>
		
		<div class="epsds">
<?php	
$seriedetailsquery = "SELECT id, nome, descr, stagioni FROM serie where id='$idserie'";
$seriedetailsresult = mysqli_query($db, $seriedetailsquery);

    while($row = mysqli_fetch_assoc($seriedetailsresult)) {
	$seasonid = $row["id"];
	$seasonname = $row["nome"];
	$seasondesc = $row["desc"];
	$seasons = $row["stagioni"];
	}

$epquery = "SELECT stagione, episodio, titolo, link, linksv FROM episodi WHERE serie='$idserie' ORDER BY stagione ASC, episodio ASC";
$epresult = mysqli_query($db, $epquery);

    while($row = mysqli_fetch_assoc($epresult)) {
	$season = $row["stagione"];
	$ep = $row["episodio"];
	$titolo = $row["titolo"];
	$link = $row["link"];
	$linksv = $row["linksv"];
	
	if(!empty($linksv)) {
		$sv = " / <a href='view?p=$linksv' target='__blank'>Speedvideo</a>";
	} else {
		$sv = "";
	};
		
	echo "<div class='ep'><strong> " . $season . "X" . $ep . "</strong> - " . $titolo . " <a href='view?v=$link' target='__blank'>Openload</a>$sv</div>";
	
	} ?>
		</div>

	</form>
	
	<div class="footer">
	
	</div>

</body>
</html>