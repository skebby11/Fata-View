<?php
include('functions.php');
?>

<?php

$pagetitle = "Rimuovi Episodi - Fata Streaming";

include('inc/sections/head.php');
?>


<body>
	
	
<?php


include('inc/sections/header.php');
	

//get serie with episodes to remove
if(!empty($_GET["serie"])) {
    $serie = $_GET["serie"];
$query = "SELECT nome, poster FROM serie WHERE id = $serie";
							$result = mysqli_query($db, $query);
							while($row = mysqli_fetch_assoc($result)){
								$poster = $row["poster"];
								$nome = $row["nome"];
	
							}
}
?>

	<div class="content">
	  <div class="container rimuovi-episodi">
		  
		  <h3>I tuoi episodi di <?php echo $nome; ?></h3>
		  <ul class="mie-serie">
			  
			 
		<img src="<?php echo $poster; ?>" alt="<?php echo $nome; ?> poster">
		  
			  <?php
			  
			  	//get serie with episodes to remove
				if(!empty($_GET["serie"])) {
					$serie = $_GET["serie"];
					
					
			 ?>
			  <table class="seen-eps-list">
					  <tr>
						<th>Stagione</th>
						<th>Episodio</th>
						<th>Titolo</th>
						<th>Visto il</th>
						<th>Azioni</th>
					  </tr>
			  
			  <?php


					$query = "SELECT * FROM epseen WHERE serie = '$serie' AND user = " . $_SESSION['user']['id'];
					$result1 = mysqli_query($db, $query);
					while($row1 = mysqli_fetch_assoc($result1)) {
						$epid = $row1["epid"];
						$date = $row1["date"];
						
						$query = "SELECT * FROM episodi WHERE id = $epid";
						$result = mysqli_query($db, $query);
						while($row = mysqli_fetch_assoc($result)){
							$stagione = $row["stagione"];
							$episodio = $row["episodio"];
							$titolo = $row["titolo"];
							
						}
							
			?>
					
			  		
					<tr class="eps">
						<form action="" method="post">
							<input type="hidden" value="<?php echo $_SESSION['user']['id'] ?>" name="requestinguser">
							<input type="hidden" value="<?php echo $epid ?>" name="eptodel">
							<td><?php echo $stagione;?></td>
							<td><?php echo $episodio;?></td>
							<td><?php echo $titolo;?></td>
							<td><?php echo $date;?></td>
							<td><input type="submit" class="remove-serie-btn" value="Rimuovi" name="removeepisode_btn"></td>
						</form>

					</tr>
					
			  
					
				<?php 

					}
					
					echo "</table>";

				}
			  
				?>
			  
		  </ul>
		  
		</div>
		
	</div>
		  
		
<?php include('inc/sections/footer.php') ?>