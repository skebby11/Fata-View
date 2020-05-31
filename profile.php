<?php
include('functions.php');
?>

<?php

$pagetitle = "Profilo - Fata Streaming";

include('inc/sections/head.php');
?>


<body>
	
	
<?php


include('inc/sections/header.php');
?>

	<div class="content">
	  <div class="container pagina-profilo">
		  
		  <h3>Le tue serie:</h3>
		  <ul class="mie-serie">
		  
			  <?php
			  
			  	$query = "SELECT DISTINCT serie FROM epseen WHERE user = " . $_SESSION['user']['id'] . " ORDER BY id DESC";
			  	$result1 = mysqli_query($db, $query);
			  
			  	while($row1 = mysqli_fetch_assoc($result1)) {
					
					$query = "SELECT * FROM serie WHERE id = " . $row1['serie'];
					$result = mysqli_query($db, $query);
					
					while($row = mysqli_fetch_assoc($result)) {
						$poster = $row['poster'];
						$nomeserie = $row['nome'];

					}
				?>
					
					<li class="mia-serie">
								<div class="mia-serie-img">
									<img src='<?php echo $poster ?>' height='150px' width='auto'> 
								</div>
								
								<div class='mia-serie-info'>
									<p><?php echo $nomeserie ?></p> <br>
									
									<form action="" method="post" class="nostyle-form">
										<input type="hidden" value="<?php echo $row1['serie'] ?>" name='serietodel'>
										<input type="hidden" value="<?php echo $_SESSION['user']['id'] ?>" name='requestinguser'>
										<input type="submit" class='remove-serie-btn' name='removeserie_btn' value='Rimuovi Serie'>
									</form>
									
									<form action='remove-episodes?serie=<?php echo $row1['serie'] ?>' method='post' class='nostyle-form'>
										<input type='submit' class='remove-eps-btn' name='removeeps_btn' value='Rimuovi Episodi'>
									</form>
								</div>
						  </li>
						
				<?php
					
				}
			  
			  ?>
			  
		  </ul>
		  
		</div>
		
	</div>
		  
		
<?php include('inc/sections/footer.php') ?>