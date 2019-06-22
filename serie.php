

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
	<link rel="stylesheet" type="text/css" href="assets/css/style.css?v1.1.49">
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
			margin-top: 30px;
			font-size: 110%;
			color: #fff;
			display: inline-block;
			width: 100%;
		}
		.epsds a {
			color: #00aeef;
			text-decoration: none;
		}
		.stagname{
			font-size: 120%;
			margin-top: 40px;
			margin-bottom: 25px;
			text-transform: uppercase;
		}
		
		.ep {
			margin: 10px 5px;
			border: 1px solid white;
			width: 23%;
			height: 150px;
			display: inline-block;
			text-align: center;
			vertical-align: middle;
			border-radius: 4px 4px 0px 0px;
		}
		
		.ep:hover {
			transition: opacity .15s ease-in-out;
			-moz-transition: opacity .15s ease-in-out;
			-webkit-transition: opacity .15s ease-in-out;
			background-color: rgba(0, 0, 0, 0.6);
			cursor: pointer;
		}
		
		.ep p.link {
		  visibility: hidden;
		}
		.ep:hover > p.link {
		  visibility: visible;
		}

		.ep:hover > p.info {
		  visibility: hidden;
		}
		.progress{
			margin-top: 25px;
			text-align: center;
		}
		.meter { 
			display: block;
			margin-left: auto;
			margin-right: auto;
			max-width: 50%;
			height: 20px;  /* Can be anything */
			position: relative;
			background: rgb(218,218,218);
			-moz-border-radius: 25px;
			-webkit-border-radius: 25px;
			border-radius: 25px;
			padding: 5px;
			box-shadow: inset 0 -1px 1px rgba(255,255,255,0.3);
			margin-top: 15px;
		}
		.meter > span {
		  display: block;
		  height: 100%;
		  border-top-right-radius: 8px;
		  border-bottom-right-radius: 8px;
		  border-top-left-radius: 20px;
		  border-bottom-left-radius: 20px;
		  background-color: rgb(0,174,239);
		  background-image: linear-gradient(
			center bottom,
			rgb(0,174,239) 37%,
			rgb(84,240,84) 69%
		  );
		  box-shadow: 
			inset 0 2px 9px  rgba(255,255,255,0.3),
			inset 0 -2px 6px rgba(0,0,0,0.4);
		  position: relative;
		  overflow: hidden;
		}
		.meter > span:after, .animate > span > span {
		  content: "";
		  position: absolute;
		  top: 0; left: 0; bottom: 0; right: 0;
		  background-image: linear-gradient(
			-45deg, 
			rgba(255, 255, 255, .2) 25%, 
			transparent 25%, 
			transparent 50%, 
			rgba(255, 255, 255, .2) 50%, 
			rgba(255, 255, 255, .2) 75%, 
			transparent 75%, 
			transparent
		  );
		  z-index: 1;
		  background-size: 50px 50px;
		  animation: move 2s linear infinite;
		  border-top-right-radius: 8px;
		  border-bottom-right-radius: 8px;
		  border-top-left-radius: 20px;
		  border-bottom-left-radius: 20px;
		  overflow: hidden;
		  animation: move 2s linear infinite;
		}
		.animate > span:after {
		  display: none;
		}
		@keyframes move {
		  0% {
			background-position: 0 0;
		  }
		  100% {
			background-position: 50px 50px;
		  }
		}
	</style>
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

$epquery = "SELECT stagione, episodio, titolo, link, linksv, linkverys FROM episodi WHERE serie='$idserie' ORDER BY stagione ASC, episodio ASC";
$epresult = mysqli_query($db, $epquery);

    while($row = mysqli_fetch_assoc($epresult)) {
	$season = $row["stagione"];
	$ep = $row["episodio"];
	$titolo = $row["titolo"];
	$link = $row["link"];
	$linksv = $row["linksv"];
	$linkverys = $row["linkverys"];
	
	if(empty($link)) {  // empty OL
		
		
		$link = "<a href='view?p=$linksv' target='__blank'>Speedvideo</a>";
		$sv='';
		$vs='';
		
		if(empty($linksv)) {   // empty OL + empty SV = YES VERYSTREAM
			$link = "<a href='view?vs=$linkverys' target='__blank'>VeryStream</a>";
		}
		
		
	} elseif (!empty($link)) {  // OL YES
		
		
		$link = "<a href='view?v=$link' target='__blank'>Openload</a>";
		
		
		if(!empty($linksv)){    // OL yes + SP yes
		$sv = " / <a href='view?p=$linksv' target='__blank'>Speedvideo</a>";
		$vs = '';
			
			
		}else {   // OL yes + SP no
			$sv = '';
		}
	}
		
		
		
	echo "<div class='ep'><p class='info'><strong> " . $season . "X" . $ep . "</strong> <br><br> " . $titolo . "</p><p class='link'> ".$link, $sv."</p></div>";
	
	} ?>
	</div>

	</form>
	
	<div class="footer">
	
	</div>

</body>
</html>