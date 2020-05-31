

<?php
include('functions.php');

$idfilm = $_GET["id"];

$query = "SELECT * FROM film WHERE id =$idfilm";
		$result = mysqli_query($db,$query);
		while($row = mysqli_fetch_assoc($result)) {
			
		$titolo = $row["titolo"];
		$descr = $row["descr"];
		$poster = $row["poster"];
		$link = $row["link"];
		$linksv = $row["linksv"];
		$linkverys = $row["linkverys"];
		$linkmd = $row["linkmd"];
		$linkgu = $row["linkgu"];
}
$pagetitle = "$titolo - Fata Streaming";

include('inc/sections/head.php');

$active = 0;
?>
<?php

include('inc/sections/header.php');
?>


	<form>
		<div class="container">

		<h1 class="stagname"><? echo $titolo ?></h1>
		
		<img class="poster animated fadeInDown" src="<?php echo $poster ?> " alt="<?php echo $titolo?> poster">
		<p class="descr animated fadeInDown"><?php echo $descr ?></p>
		
<?php	

	$linkarr = array();
	
	if(!empty($linksv)) { // YES SPEEDVIDEO
		
		array_push($linkarr, "<a href='view-film?sv=$linksv' target='__blank'>Speedvideo</a>");
	}
				
	if(!empty($linkmd)) {  // YES MIXDROP
		
		array_push($linkarr, "<a href='view-film?md=$linkmd' target='__blank'>MixDrop</a>");
	}
			
	if(!empty($linkgu)) {  // YES GOUNL
		
		array_push($linkarr, "<a href='view-film?gu=$linkgu' target='__blank'>GoUnlimited</a>");
	}
				
	if(!empty($link)) { // SUPERVIDEO SI
		
		array_push($linkarr, "<a href='view-film?v=$link' target='__blank'>Supervideo</a>");
	}
		
		
	echo "<div class='ep'><p class='info'><strong> " . $titolo . "</strong><br> <br></p><p class='link'> ";
			
		foreach ($linkarr as $linksing){
		  echo $linksing . '<br>';
		}	
			
			
		
	echo "</p></div>";
			
 ?>
		</div>
	</form>
<?php include('inc/sections/footer.php') ?>