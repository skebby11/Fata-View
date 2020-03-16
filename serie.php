

<?php
include('functions.php');

$idserie = $_GET["id"];
$idutente = $_SESSION['user']['id'];

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
	<link rel="stylesheet" type="text/css" href="assets/css/style.css?1.3.5.24.43">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<script
  src="http://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
	
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
	<div class="container">
	
	<script>
	$(".meter > span").each(function() {
	  $(this)
		.data("origWidth", $(this).width())
		.width(0)
		.animate({
		  width: $(this).data("origWidth") // or + "%" if fluid
		}, 1200);
	});
	</script>
		<h1 class="stagname"><? echo $nomestag ?></h1>
		
		<div class="info_wrapper">
		<img class="poster" src="<?php echo $poster ?> " alt="<?php echo $nomestag?> poster">
		<p class="descr"><?php echo $descrstag ?></p>
		
	<?php  // episode progress percentage - pure MATH! Don't know how I managed to accomplish this even if it's that easy.
	
	$query = "SELECT COUNT(*) FROM epseen WHERE serie = $idserie AND user = $idutente";
			$result = mysqli_query($db,$query);
			while($row = mysqli_fetch_assoc($result)) {
			$nepseen = $row['COUNT(*)'];}

			$query = "SELECT COUNT(*) FROM episodi WHERE serie = $idserie";
			$result = mysqli_query($db,$query);
			while($row = mysqli_fetch_assoc($result)) {

			$neptot = $row['COUNT(*)'];}
				
			$divison = $nepseen / $neptot;
			$perc = $divison * 100;
	?>
	<?php  if (isset($_SESSION['user'])) : ?>
		<div class="progress">
			<p><?php echo "Hai visto $nepseen episodi su $neptot."; ?></p>
			<div class="meter animate">
			  <span style="width: <?php echo $perc; ?>%"><span></span></span>
			</div>
		</div>
	<?php endif ?>
		</div>
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

$epquery = "SELECT * FROM episodi WHERE serie='$idserie' ORDER BY stagione ASC, episodio ASC";
$epresult = mysqli_query($db, $epquery);

    while($row = mysqli_fetch_assoc($epresult)) {
	$season = $row["stagione"];
	$ep = $row["episodio"];
	$titolo = $row["titolo"];
	$link = $row["link"];
	$linksv = $row["linksv"];
	$linkverys = $row["linkverys"];
	$linkmd = $row["linkmd"];
	$linkgu = $row["linkgu"];
	
	if(!empty($linksv)) {  // empty OL	
		
		$link = "<a href='view?sv=$linksv' target='__blank'>Speedvideo</a>";
		
		if(!empty($linkmd)) {
			$link = "<a href='view?sv=$linksv' target='__blank'>Speedvideo</a> / <a href='view?gu=$linkmd' target='__blank'>MixDrop</a>";	
		}
		
	} elseif (!empty($linkmd)) {  // md YES
		
		$link = "<a href='view?md=$linkmd' target='__blank'>MixDrop</a>";	
		
		if(!empty($linkgu)){    // md yes + gu yes
		$link = "<a href='view?md=$linkmd' target='__blank'>MixDrop</a> / <a href='view?gu=$linkgu' target='__blank'>GoUnlimited</a>";	
		}
	}
		
	elseif(!empty($link)) { // SUPERVIDEO SI
		$link = "<a href='view?sv=$link' target='__blank'>Supervideo</a>";
		
		if(!empty($linkmd)) {
			$link = "<a href='view?sv=$linksv' target='__blank'>Supervideo</a> / <a href='view?gu=$linkmd' target='__blank'>MixDrop</a>";	
		}
	}
	
		
		
		
	echo "<div class='ep'><p class='info'><strong> " . $season . "X" . $ep . "</strong> <br><br> " . $titolo . "</p><p class='link'> ".$link."</p></div>";
	
	} ?>
	</div>
	</div>
	</form>
	
	<div class="footer">
		<a href="admin">Admin</a> | &copy <?php echo $year ?> | <a href="api">API</a> | This project is open source on <a href="https://github.com/skebby11/Fata-View/" target="_blank">GitHub</a> | Made by <a href="https://www.sebastianoriva.it" target="_blank">Sebastiano Riva</a>
	</div>

</body>
</html>