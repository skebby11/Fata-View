<?php
include('functions.php');
?>

<?php

$pagetitle = "Home - Fata Streaming";

$customadd = "<link rel='stylesheet' type='text/css' href='//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css'/>";

include('inc/sections/head.php');
?>

<body>
	
<?php

$active = 1;

include('inc/sections/header.php');
?>

	<form>
	  <div class="container">
		
		<?php  if ($_SESSION['user']['id']== 3) : ?>  <!--   A lovely greeting to my girl, registered with ID 3   -->
		
			<h2 class="love"><br> <!--<span>❤</span>--></h2>
		  	<img src="assets/img/french.png" alt="" width="250px">
		
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
			$link = $row["link"];
			$linksv = $row["linksv"];
			$linkverys = $row["linkverys"];
			$linkmd = $row["linkmd"];
			$linkgu = $row["linkgu"];
				
				
				$query2 = "SELECT nome, poster FROM serie WHERE id='". $serieid ."'";
				$result2 = mysqli_query($db,$query2);
				while($row = mysqli_fetch_assoc($result2)) {
				$idserie = $row["id"];
				$poster = $row["poster"];
				$nomeserie = $row["nome"];
				}	
			}
				
			
			echo "<div class='serie animated fadeInDown'><a href='serie?id=". $serieid . "#$idep'><img src='" . $poster ."'><p>".$stagionen."X".$episodion." - ".$titolo."</p></a></div>";
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
			$link = $row["link"];
			$linksv = $row["linksv"];
			$linkverys = $row["linkverys"];
			$linkmd = $row["linkmd"];
			$linkgu = $row["linkgu"];
				
				$query2 = "SELECT nome, poster FROM serie WHERE id='". $serieid ."'";
				$result2 = mysqli_query($db,$query2);
				while($row = mysqli_fetch_assoc($result2)) {
				$idserie = $row["id"];
				$poster = $row["poster"];
				$nomeserie = $row["nome"];
				}

			}
			
			echo "<div class='serie animated fadeInDown'><a href='serie?id=". $serieid . "#$idep'><img src='" . $poster ."'><p>".$stagionen."X".$episodion." - ".$titolo."</p></a></div>";
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
			$link = $row["link"];
			$linksv = $row["linksv"];
			$linkverys = $row["linkverys"];
			$linkmd = $row["linkmd"];
			$linkgu = $row["linkgu"];
				
				$query2 = "SELECT nome, poster FROM serie WHERE id='". $serieid ."'";
				$result2 = mysqli_query($db,$query2);
				while($row = mysqli_fetch_assoc($result2)) {
				$idserie = $row["id"];
				$poster = $row["poster"];
				$nomeserie = $row["nome"];
				}	
				
			}
			
			echo "<div class='serie animated fadeInDown'><a href='serie?id=". $serieid . "#$idep'><img src='" . $poster ."'><p>".$stagionen."X".$episodion." - ".$titolo."</p></a></div>";
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
			$link = $row["link"];
			$linksv = $row["linksv"];
			$linkverys = $row["linkverys"];
			$linkmd = $row["linkmd"];
			$linkgu = $row["linkgu"];
				
				$query2 = "SELECT nome, poster FROM serie WHERE id='". $serieid ."'";
				$result2 = mysqli_query($db,$query2);
				while($row = mysqli_fetch_assoc($result2)) {
				$idserie = $row["id"];
				$poster = $row["poster"];
				$nomeserie = $row["nome"];
				}	
				
			}
			
			echo "<div class='serie animated fadeInDown'><a href='serie?id=". $serieid . "#$idep'><img src='" . $poster ."'><p>".$stagionen."X".$episodion." - ".$titolo."</p></a></div></div>";
			}
		}
			
			if (mysqli_num_rows($resultep1) > 0) {
				
				echo "</div>";
			}
		
		}  
		?>
		
		<h3 class="lasttext">Ultime serie aggiunte</h3>
		<div class="lastseries serie-slider">
		<?php
		$query = "SELECT id, nome, descr, poster, stagioni FROM serie ORDER BY id DESC LIMIT 20";
		$result = mysqli_query($db,$query);
		while($row = mysqli_fetch_assoc($result)) {
			
			?>
			
			
			<?php
			
			echo "<div class='serie animated fadeInDown'><a href='serie?id=". $row["id"] ."'><img src='" . $row["poster"] ."'><p>" . $row["nome"] ."</p></a></div>";
		}		
		?>
		</div>
		
		
		
		
		<h3 class="lasttext">Ultimi film aggiunti</h3>
		<div class="lastseries serie-slider">
		<?php
		$query = "SELECT * FROM film ORDER BY id DESC  LIMIT 20";
		$result = mysqli_query($db,$query);
		while($row = mysqli_fetch_assoc($result)) {
			echo "<div class='serie animated fadeInDown'><a href='film?id=". $row["id"] ."'><img src='" . $row["poster"] ."'><p>" . $row["titolo"] ."</p></a></div>";
		}		
		?>
		</div>
		
		<h3 class="lasttext">Ultimi episodi aggiunti</h3>
		<div class="lastseries ultimi-episodi-slider">
		<?php
		$query = "SELECT * FROM episodi ORDER BY id DESC LIMIT 20";
		$result = mysqli_query($db,$query);
		while($row = mysqli_fetch_assoc($result)) {
			
		$idep = $row["id"];
		$stagn = $row["stagione"];
		$epn = $row["episodio"];
		$nomeep = $row["titolo"];
		$serien = $row["serie"];
		$link = $row["link"];
		$linksv = $row["linksv"];
		$linkverys = $row["linkverys"];
		$linkmd = $row["linkmd"];
		$linkgu = $row["linkgu"];
			
		
			
		$query1 = "SELECT id, nome, poster FROM serie WHERE id='". $serien ."'";
		$result1 = mysqli_query($db,$query1);
		while($row = mysqli_fetch_assoc($result1)) {
		$idserie = $row["id"];
		$poster = $row["poster"];
		$nomeserie = $row["nome"];
		}
			
		if(!empty($link)){
			$link = "v=".$link;
		} elseif (!empty($linksv)){
			$link = "sv=".$linksv;
		} elseif (!empty($linkmd)) {
			$link = "md=".$linkmd;
		}
		
			echo "<div class='serie'><a href='view?". $link . "'><img src='" . $poster ."'><p>".$stagn."X".$epn." - ".$nomeep."</p></a></div>";
		}
				
		?>
		</div>

	  </div>
	</form>
	
	<script src="/assets/js/home-slick.js"></script>
<?php $footeradd = "<script type='text/javascript' src='//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js'></script>" ?>
<?php include('inc/sections/footer.php') ?>
	