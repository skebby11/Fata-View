<?php
include('functions.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home - Fata Streaming</title>
	
	<script
    type="text/javascript"
    src="//code.jquery.com/jquery-2.1.0.js"></script>
	
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?0.0.1">
	
	
	<link rel="stylesheet" type="text/css" href="assets/css/style.css?1.3.5.25">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<style>
	/* modal */
		.close-modal {
			background-color: #00aeef;
			background: #00aeef;
			color: #fff;
		}
		.btn-telegram {
			
		}
	</style>
</head>
<body>
	
<!-- Modal -->
<div class="modal fade" id="memberModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                 <h4 class="modal-title" id="memberModalLabel">Grazie di essere un utente Fata Streaming</h4>

            </div>
            <div class="modal-body">
                <p>Stiamo continuando a lavorare per migliorare sempre di pi&ugrave; il servizio di Fata Streaming.</p>
                  <BR>   <p>Da oggi puoi entrare nel nostro canale Telegram per rimanere aggiornato con tutte le uscite del sito.</p> <br>
                <a href="https://t.me/fatastreaming" target="_blank" style="color: #00aeef"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/82/Telegram_logo.svg/1024px-Telegram_logo.svg.png" width="40px" alt=""> Entra ora</a>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn close-modal" data-dismiss="modal">Chiudi</button>
            </div>
        </div>
    </div>
</div>
	
	<div class="header">
		<img src="assets/img/FATASlogo.png">
	</div>
		<div class="menu">
		<ul>
 		 <li><a class="active" href="/">Home</a></li>
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
	  <div class="container">
		
		<?php  if ($_SESSION['user']['id']== 3) : ?>  <!--   A lovely greeting to my girl, registered with ID 3   -->
		
			<h2 class="love"><br> <!--<span>❤</span>--></h2>
		  	<img src="assets/img/french.png" alt="" width="250px">
		
		<?php endif ?>
		<style>
		/* Solve problem on a non-solid background */
		.serie img:hover { 
		  outline: 3px solid #00aeef; 
		} 

		/* Solve problem where border size changes on hover */
		.serie img { 
		  border: 0px solid ; 
		  border-color: #00aeef;
		} 
		.serie img:hover { 
		  outline: 2px solid #00aeef; 
		} 
		</style>
		
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
				
			if(!empty($link)){
				$link = "v=".$link;
			} elseif (!empty($linksv)){
				$link = "sv=".$linksv;
			} elseif (!empty($linkmd)) {
				$link = "md=".$linkmd;
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
			$link = $row["link"];
			$linksv = $row["linksv"];
			$linkverys = $row["linkverys"];
			$linkmd = $row["linkmd"];
			$linkgu = $row["linkgu"];
				
			if(!empty($link)){
				$link = "v=".$link;
			} elseif (!empty($linksv)){
				$link = "sv=".$linksv;
			} elseif (!empty($linkmd)) {
				$link = "md=".$linkmd;
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
			$link = $row["link"];
			$linksv = $row["linksv"];
			$linkverys = $row["linkverys"];
			$linkmd = $row["linkmd"];
			$linkgu = $row["linkgu"];
				
			if(!empty($link)){
				$link = "v=".$link;
			} elseif (!empty($linksv)){
				$link = "sv=".$linksv;
			} elseif (!empty($linkmd)) {
				$link = "md=".$linkmd;
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
			$link = $row["link"];
			$linksv = $row["linksv"];
			$linkverys = $row["linkverys"];
			$linkmd = $row["linkmd"];
			$linkgu = $row["linkgu"];
				
				
			if(!empty($link)){
				$link = "v=".$link;
			} elseif (!empty($linksv)){
				$link = "sv=".$linksv;
			} elseif (!empty($linkmd)) {
				$link = "md=".$linkmd;
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
		
		<h3 class="lasttext">Ultime serie aggiunte</h3>
		<div class="lastseries">
		<?php
		$query = "SELECT id, nome, descr, poster, stagioni FROM serie ORDER BY id DESC LIMIT 4";
		$result = mysqli_query($db,$query);
		while($row = mysqli_fetch_assoc($result)) {
			echo "<div class='serie'><a href='serie?id=". $row["id"] ."'><img src='" . $row["poster"] ."'><p>" . $row["nome"] ."</p></a></div>";
		}		
		?>
		</div>
		
		<h3 class="lasttext">Ultimi film aggiunti</h3>
		<div class="lastseries">
		<?php
		$query = "SELECT * FROM film ORDER BY id DESC LIMIT 4";
		$result = mysqli_query($db,$query);
		while($row = mysqli_fetch_assoc($result)) {
			echo "<div class='serie'><a href='film?id=". $row["id"] ."'><img src='" . $row["poster"] ."'><p>" . $row["titolo"] ."</p></a></div>";
		}		
		?>
		</div>
		
		<h3 class="lasttext">Ultimi episodi aggiunti</h3>
		<div class="lastseries">
		<?php
		$query = "SELECT * FROM episodi ORDER BY id DESC LIMIT 4";
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
	
	<div class="footer">
		<a href="admin">Admin</a> | &copy <?php echo $year ?> | <a href="api">API</a> | This project is open source on <a href="https://github.com/skebby11/Fata-View/" target="_blank">GitHub</a> | Made by <a href="https://www.sebastianoriva.it" target="_blank">Sebastiano Riva</a>
	</div>

	
	
	
	<script type="text/javascript">
    $(document).ready(function () {

    $('#memberModal').modal('show');

});
</script>
	
</body>
</html>