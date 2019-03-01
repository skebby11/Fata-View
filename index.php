<?php
include('functions.php');

?>

<!DOCTYPE html>
<html>
<head>
	<title>Home - Fata Streaming</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css?1.2">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<style>
		.serie {
			align-self: flex-start;
			text-align: center;
		}
	</style>
	
</head>
<body>

	<div class="header">
		<img src="assets/img/FATASlogo.png">
	</div>
		<div class="menu">
		<ul>
 		 <li><a class="active" href="/">Home</a></li>
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
		
		<?php  if ($_SESSION['user']['id']== 3) : ?>  <!--   A lovely greeting to my girl    -->
		
			<h2 class="love">CIAO AMMMMMORE <span>❤❤❤❤❤</span></h2>
		
		<?php endif ?>
		
		
		<?php
			
		$serie1 = "SELECT * FROM epseen WHERE user='".$_SESSION['user']['id']."' ORDER BY id DESC, serie DESC LIMIT 1";
			$resultserie1 = mysqli_query($db,$serie1);
			while($row = mysqli_fetch_assoc($resultserie1)) {
			$idserie1 = $row["serie"];
			$epid1 = $row["epid"];}
		$serie2 = "SELECT * FROM epseen WHERE user='".$_SESSION['user']['id']."' AND serie!=".$idserie1." ORDER BY id DESC, serie  DESC LIMIT 1";
			$resultserie2 = mysqli_query($db,$serie2);
			while($row = mysqli_fetch_assoc($resultserie2)) {
			$idserie2 = $row["serie"];
			$epid2 = $row["epid"];}
		$serie3 = "SELECT * FROM epseen WHERE user='".$_SESSION['user']['id']."' AND serie!=".$idserie1." AND serie!=".$idserie2." ORDER BY id DESC, serie  DESC LIMIT 1";
			$resultserie3 = mysqli_query($db,$serie3);
			while($row = mysqli_fetch_assoc($resultserie3)) {
			$idserie3 = $row["serie"];
			$epid3 = $row["epid"];}
		$serie4 = "SELECT * FROM epseen WHERE user='".$_SESSION['user']['id']."' AND serie!=".$idserie1." AND serie!=".$idserie2." AND serie!=".$idserie3." ORDER BY id DESC, serie  DESC LIMIT 1";
			$resultserie4 = mysqli_query($db,$serie4);
			while($row = mysqli_fetch_assoc($resultserie4)) {
			$idserie4 = $row["serie"];
			$epid4 = $row["epid"];}
			
			
		$ep1query = "SELECT * FROM epseen WHERE user='".$_SESSION['user']['id']."' AND epid=".$epid1." LIMIT 1";
			
		$ep2query = "SELECT * FROM epseen WHERE user='".$_SESSION['user']['id']."' AND epid=".$epid2." LIMIT 1";
			
		$ep3query = "SELECT * FROM epseen WHERE user='".$_SESSION['user']['id']."' AND epid=".$epid3." LIMIT 1";
		
		$ep4query = "SELECT * FROM epseen WHERE user='".$_SESSION['user']['id']."' AND epid=".$epid4." LIMIT 1";
		
		$resultep1 = mysqli_query($db,$ep1query);
		$resultep2 = mysqli_query($db,$ep2query);
		$resultep3 = mysqli_query($db,$ep3query);
		$resultep4 = mysqli_query($db,$ep4query);
			
		if (mysqli_num_rows($resultep1) > 0) {	
			echo "<h3 class='lasttext'>Prossimi episodi da vedere</h3>
				<div class='lastseries'>";
		while($row = mysqli_fetch_assoc($resultep1)) {
			
			$epid = $row["epid"];
			$serieid = $row["serie"];
			
			$query1 = "SELECT * FROM `episodi` WHERE id > $epid1 AND serie= $idserie1 LIMIT 1 ";
			$result1 = mysqli_query($db,$query1);
			if (mysqli_num_rows($result1) > 0) {	
			while($row = mysqli_fetch_assoc($result1)) {
			$idep = $row["id"];
			$stagionen = $row["stagione"];
			$episodion = $row["episodio"];
			$serieid = $row["serie"];
			$titolo = $row["titolo"];
			if(!$row["link"]){
				$link = "p=".$row["linksv"];
			} else {
				$link = "v=".$row["link"];
			}
				
				$query2 = "SELECT nome, poster FROM serie WHERE id='". $serieid ."'";
				$result2 = mysqli_query($db,$query2);
				while($row = mysqli_fetch_assoc($result2)) {
				$idserie = $row["id"];
				$poster = $row["poster"];
				$nomeserie = $row["nome"];
				}	
			}
				
			
			echo "<div class='serie'><a href='view?". $link . "'><img src='" . $poster ."'><p>".$stagionen."X".$episodion." - ".$titolo."</p></a></div>";
			}
			}
			
			while($row = mysqli_fetch_assoc($resultep2)) {
			$epid = $row["epid"];
			$serieid = $row["serie"];
			
			$query1 = "SELECT * FROM `episodi` WHERE id > $epid2 AND serie= $idserie2 ORDER BY id LIMIT 1 ";
			$result1 = mysqli_query($db,$query1);
			if (mysqli_num_rows($result1) > 0) {
			while($row = mysqli_fetch_assoc($result1)) {
			$idep = $row["id"];
			$stagionen = $row["stagione"];
			$episodion = $row["episodio"];
			$serieid = $row["serie"];
			$titolo = $row["titolo"];
			if(!$row["link"]){
				$link = "p=".$row["linksv"];
			} else {
				$link = "v=".$row["link"];
			}
				
				$query2 = "SELECT nome, poster FROM serie WHERE id='". $serieid ."'";
				$result2 = mysqli_query($db,$query2);
				while($row = mysqli_fetch_assoc($result2)) {
				$idserie = $row["id"];
				$poster = $row["poster"];
				$nomeserie = $row["nome"];
				}

			}
			
			echo "<div class='serie'><a href='view?". $link . "'><img src='" . $poster ."'><p>".$stagionen."X".$episodion." - ".$titolo."</p></a></div>";
			}
		}
			
			while($row = mysqli_fetch_assoc($resultep3)) {
			$epid = $row["epid"];
			$serieid = $row["serie"];
			
			$query1 = "SELECT * FROM `episodi` WHERE id > $epid3 AND serie= $idserie3 ORDER BY id LIMIT 1 ";
			$result1 = mysqli_query($db,$query1);
			if (mysqli_num_rows($result1) > 0) {
			while($row = mysqli_fetch_assoc($result1)) {
			$idep = $row["id"];
			$stagionen = $row["stagione"];
			$episodion = $row["episodio"];
			$serieid = $row["serie"];
			$titolo = $row["titolo"];
			if(!$row["link"]){
				$link = "p=".$row["linksv"];
			} else {
				$link = "v=".$row["link"];
			}
				
				$query2 = "SELECT nome, poster FROM serie WHERE id='". $serieid ."'";
				$result2 = mysqli_query($db,$query2);
				while($row = mysqli_fetch_assoc($result2)) {
				$idserie = $row["id"];
				$poster = $row["poster"];
				$nomeserie = $row["nome"];
				}	
				
			}
			
			echo "<div class='serie'><a href='view?". $link . "'><img src='" . $poster ."'><p>".$stagionen."X".$episodion." - ".$titolo."</p></a></div>";
			}
		}
		
			while($row = mysqli_fetch_assoc($resultep4)) {
			$epid = $row["epid"];
			$serieid = $row["serie"];
			
			$query1 = "SELECT * FROM `episodi` WHERE id > $epid4 AND serie= $idserie4 ORDER BY id LIMIT 1 ";
			$result1 = mysqli_query($db,$query1);
			if (mysqli_num_rows($result1) > 0) {
			while($row = mysqli_fetch_assoc($result1)) {
			$idep = $row["id"];
			$stagionen = $row["stagione"];
			$episodion = $row["episodio"];
			$serieid = $row["serie"];
			$titolo = $row["titolo"];
			if(!$row["link"]){
				$link = "p=".$row["linksv"];
			} else {
				$link = "v=".$row["link"];
			}
				
				$query2 = "SELECT nome, poster FROM serie WHERE id='". $serieid ."'";
				$result2 = mysqli_query($db,$query2);
				while($row = mysqli_fetch_assoc($result2)) {
				$idserie = $row["id"];
				$poster = $row["poster"];
				$nomeserie = $row["nome"];
				}	
				
			}
			
			echo "<div class='serie'><a href='view?". $link . "'><img src='" . $poster ."'><p>".$stagionen."X".$episodion." - ".$titolo."</p></a></div>";
			}
		}
		
		}
		?>
		</div>
		
		<h3 class="lasttext">Ultime serie aggiunte:</h3>
		<div class="lastseries">
		<?php
		$query = "SELECT id, nome, descr, poster, stagioni FROM serie ORDER BY id DESC LIMIT 5";
		$result = mysqli_query($db,$query);
		while($row = mysqli_fetch_assoc($result)) {
			echo "<div class='serie'><a href='serie?id=". $row["id"] ."'><img src='" . $row["poster"] ."'><p>" . $row["nome"] ."</p></a></div>";
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
		if(!$row["link"]){
				$link = "p=".$row["linksv"];
			} else {
				$link = "v=".$row["link"];
			}
			
		$query1 = "SELECT id, nome, poster FROM serie WHERE id='". $serien ."'";
		$result1 = mysqli_query($db,$query1);
		while($row = mysqli_fetch_assoc($result1)) {
		$idserie = $row["id"];
		$poster = $row["poster"];
		$nomeserie = $row["nome"];
		}

			echo "<div class='serie'><a href='view?". $link . "'><img src='" . $poster ."'><p>".$stagn."X".$epn." - ".$nomeep."</p></a></div>";
		}
				
		?>
		</div>

		
	</form>
	
	<div class="footer">
	
	</div>

</body>
</html>