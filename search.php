<?php
include('functions.php');

$keyword = $_POST["s"];

$pagetitle = "Risultati ricerca - Fata Streaming";

include('inc/sections/head.php');

$active = 0;

include('inc/sections/header.php');
?>

	<form>
	  <div class="container">
		<h3 class="lasttext">Risultati della ricerca</h3>
		<div class="allseriesrow">
		<?php
		$results_per_page = 10;
				
			if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
			$start_from = ($page-1) * $results_per_page;
				
			$query1 = "SELECT id, nome, descr, poster FROM serie WHERE nome LIKE '%" . 
           $keyword . "%' ORDER BY ID DESC LIMIT $start_from, ".$results_per_page;
				
			$query2 = " SELECT id, titolo, descr, poster FROM film WHERE titolo LIKE '%" . 
           $keyword . "%' ORDER BY ID DESC LIMIT $start_from, ".$results_per_page;


				
		$result1 = mysqli_query($db,$query1);
		$result2 = mysqli_query($db,$query2);
		
		if (mysqli_num_rows($result1) > 0) {
		while($row = mysqli_fetch_assoc($result1)) {
			echo "<div class='serierow animated fadeInDown'><a href='serie?id=". $row["id"] ."'><img src='" . $row["poster"] ."'><p><strong>" . $row["nome"] ."</strong><br><br>" . substr($row["descr"], 0, 500) ."...</p></a></div>";
		}
		}
		elseif (mysqli_num_rows($result2) > 0) {
		while($row = mysqli_fetch_assoc($result2)) {
			echo "<div class='serierow animated fadeInDown'><a href='film?id=". $row["id"] ."'><img src='" . $row["poster"] ."'><p><strong>" . $row["titolo"] ."</strong><br><br>" . substr($row["descr"], 0, 500) ."...</p></a></div>";
		}
		} else {
			echo "Nessun risultato trovato :(";
		}
		?>
		</div>
	  </div>
	</form>
<?php include('inc/sections/footer.php') ?>