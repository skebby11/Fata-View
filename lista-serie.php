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
 		 <li><a href="/">Home</a></li>
 		 <li><a class="active" href="lista-serie">Serie</a></li>
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
			.allseriesrow {
				width: 100%;
			}
			.serierow {
				width: 100%;
				max-height: 250px;;
				vertical-align: top;
				margin: 25px 0;
			}
			.serierow img{
				width: 18%;
				height: auto;
				display: inline-block;
			}
			.serierow p{
				width: 70%;
				display: inline-block;
				vertical-align: top;
				margin: 0 17px;
			}
		</style>
		
		<h3 class="lasttext">Tutte le serie</h3>
		<div class="allseriesrow">
			
		<style>
			.pages span{
				    background-color: #00aeef;
					border: none;
					color: white;
					padding: 5px 13px;
					text-align: center;
					text-decoration: none;
					display: inline-block;
					font-size: 16px;
					margin: 4px 2px;
					border-radius: 8px;
			}	
		</style>
		<?php
		$results_per_page = 4;
				
			if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
			$start_from = ($page-1) * $results_per_page;
			$query = "SELECT * FROM serie ORDER BY ID DESC LIMIT $start_from, ".$results_per_page;

				
		$result = mysqli_query($db,$query);
		while($row = mysqli_fetch_assoc($result)) {
			echo "<div class='serierow'><a href='serie?id=". $row["id"] ."'><img src='" . $row["poster"] ."'><p><strong>" . $row["nome"] ."</strong><br><br>" . substr($row["descr"], 0, 500) ."...</p></a></div>";
		}
		echo "<div class='pages'>";
		$sql = "SELECT COUNT(ID) AS total FROM serie";
		$result = mysqli_query($db,$sql);
		while($row = mysqli_fetch_assoc($result)) {
		$total_pages = ceil($row["total"] / $results_per_page); // calculate total pages with results
		}
		for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages
					echo "<a href='lista-serie?page=".$i."'";
					if ($i==$page)  echo " class='curPage'";
					echo "><span>".$i."</span></a> "; 
		};
		echo "</div>";
		
				
		?>
		</div>
		
	</form>
	
	<div class="footer">
	
	</div>

</body>
</html>