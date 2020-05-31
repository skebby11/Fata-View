<?php
include('functions.php');

$pagetitle = "Lista film - Fata Streaming";

include('inc/sections/head.php');

$active = 3;

include('inc/sections/header.php');
?>

	<form>
	  <div class="container">
		<h3 class="lasttext">Tutti i film</h3>
		<div class="allseriesrow">

		<?php
		$results_per_page = 4;
				
			if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
			$start_from = ($page-1) * $results_per_page;
			$query = "SELECT * FROM film ORDER BY ID DESC LIMIT $start_from, ".$results_per_page;

				
		$result = mysqli_query($db,$query);
		while($row = mysqli_fetch_assoc($result)) {
			echo "<div class='serierow animated fadeInDown'><a href='film?id=". $row["id"] ."'><img src='" . $row["poster"] ."'><p><strong>" . $row["titolo"] ."</strong><br><br>" . substr($row["descr"], 0, 500) ."...</p></a></div>";
		}
		echo "<div class='pages'>";
		$sql = "SELECT COUNT(ID) AS total FROM film";
		$result = mysqli_query($db,$sql);
		while($row = mysqli_fetch_assoc($result)) {
		$total_pages = ceil($row["total"] / $results_per_page); // calculate total pages with results
		}
		for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages
					echo "<a href='lista-film?page=".$i."'";
					if ($i==$page)  echo " class='curPage'";
					echo "><span>".$i."</span></a> "; 
		};
		echo "</div>";
		
				
		?>
		</div>
	  </div>
	</form>
<?php include('inc/sections/footer.php') ?>