

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

$pagetitle = "$nomestag - Fata Streaming";

include('inc/sections/head.php');

$active = 0;

include('inc/sections/header.php');
?>

<button onclick="topFunction()" id="topBtn" title="Go to top"> 

<img src="assets/img/top-button.png" alt="">
	
</button>

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
		<h1 class="stagname animated fadeInDown"><? echo $nomestag ?></h1>
		
		<div class="info_wrapper animated fadeInDown">
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
				$nstagionion = "SELECT COUNT(stagione) FROM episodi WHERE serie = $idserie GROUP BY stagione";
				$result = mysqli_query($db, $nstagionion);
			
				$num_stagionion = mysqli_num_rows($result);
			
				$stagionipresenti = "SELECT stagione FROM `episodi` WHERE serie = $idserie GROUP BY stagione";
				$result = mysqli_query($db, $stagionipresenti);
			
			
				while( $row = mysqli_fetch_assoc( $result)){
					$arr_stagioni[] = $row["stagione"]; // Inside while loop
				}
			
				echo "<div class='container-stagioni'>
				<h4>Stagioni Disponibili</h4>";
				foreach ($arr_stagioni as $a) {
						echo "<div class='box-stagioni'><a href='#stagione$a'>$a</a></div>";
				}
				echo "</div>";
			
				foreach ($arr_stagioni as $a) {
					echo "<div id='stagione$a'><h2>Stagione $a</h2></div>";
					
						
				$seriedetailsquery = "SELECT id, nome, descr, stagioni FROM serie where id='$idserie'";
				$seriedetailsresult = mysqli_query($db, $seriedetailsquery);

					while($row = mysqli_fetch_assoc($seriedetailsresult)) {
					$seasonid = $row["id"];
					$seasonname = $row["nome"];
					$seasondesc = $row["desc"];
					$seasons = $row["stagioni"];

						$epquery = "SELECT * FROM episodi WHERE serie='$idserie' AND stagione = '$a' ORDER BY stagione ASC, episodio ASC ";
				$epresult = mysqli_query($db, $epquery);

					while($row = mysqli_fetch_assoc($epresult)) {
					$iduniep = $row["id"];
					$season = $row["stagione"];
					$ep = $row["episodio"];
					$titolo = $row["titolo"];
					$link = $row["link"];
					$linksv = $row["linksv"];
					$linkverys = $row["linkverys"];
					$linkmd = $row["linkmd"];
					$linkgu = $row["linkgu"];
					$fataplayer = $row["fataplayer"];


					$linkarr = array();


					if(!empty($linksv)) { // YES SPEEDVIDEO

						array_push($linkarr, "<a href='view?sv=$linksv' target='__blank'>Speedvideo</a>");
					}

					if(!empty($linkmd)) {  // YES MIXDROP

						array_push($linkarr, "<a href='view?md=$linkmd' target='__blank'>MixDrop</a>");
					}

					if(!empty($linkgu)) {  // YES GOUNL

						array_push($linkarr, "<a href='view?gu=$linkgu' target='__blank'>GoUnlimited</a>");
					}

					if(!empty($link)) { // SUPERVIDEO SI

						array_push($linkarr, "<a href='view?v=$link' target='__blank'>Supervideo</a>");
					}
					
					if(!empty($fataplayer)) { // FATAPLAYER SI

							array_push($linkarr, "<a href='view?fp=$fataplayer' target='__blank'>FataPlayer</a>");
						}



					echo "<div class='ep' id='$iduniep'><p class='info'><strong> " . $season . "X" . $ep . "</strong> <br><br> " . $titolo . "</p><p class='link'> ";

						foreach ($linkarr as $linksing){
						  echo $linksing . '<br>';
						}

					echo "</p></div>";

					} 
					}

					echo "<hr class='stag-spacer'>";
					
				}
	
	?>
			



	</div>
	</div>
	</form>
	<script src="assets/js/topbtn.js"></script>
<?php include('inc/sections/footer.php') ?>