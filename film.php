

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
}
 
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $titolo ?> - Fata Streaming</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css?v1.1.49">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<div class="header">
		<img src="assets/img/FATASlogo.png">
	</div>
		<div class="menu">
		<ul>
 		 <li><a href="/">Home</a></li>
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
		
	<style>
		.poster {
			margin: 20px 0;
			margin-right: 30px;
			width: 40%;
			height: auto;
			display: inline-block;
			vertical-align: top;
		}	
		.descr {
			display: inline-block;
			max-width: 50%;
		} 
		.epsds {
			margin-top: 50px;
			font-size: 110%;
			color: #fff;
			display: inline-block;
			max-width: 100%;
		}
		.ep a {
			color: #00aeef;
			text-decoration: none;
		}
		.stagname{
			font-size: 120%;
			margin-top: 40px;
			margin-bottom: 25px;
			text-transform: uppercase;
		}
		
		.ep {
			margin: 10px 5px;
			width: 100%;
			height: 150px;
			display: inline-block;
			text-align: center;
			vertical-align: middle;
			border-radius: 4px 4px 0px 0px;
		}
		
		.ep:hover {
			transition: opacity .15s ease-in-out;
			-moz-transition: opacity .15s ease-in-out;
			-webkit-transition: opacity .15s ease-in-out;
			background-color: rgba(0, 0, 0, 0.6);
			cursor: pointer;
		}
		
		.ep p.link {
		  visibility: hidden;
		}
		.ep:hover > p.link {
		  visibility: visible;
		}

		.ep:hover > p.info {
		  visibility: hidden;
		}
	</style>
		<h1 class="stagname"><? echo $titolo ?></h1>
		
		<img class="poster" src="<?php echo $poster ?> " alt="<?php echo $titolo?> poster">
		<p class="descr"><?php echo $descr ?></p>
		
<?php	

	
	if(empty($link)) {
		$link = "<a href='view-film?p=$linksv' target='__blank'>Speedvideo</a>";
		$sv='';
	} elseif (!empty($link)) {
		$link = "<a href='view-film?v=$link' target='__blank'>Openload</a>";
		if(!empty($linksv)){
		$sv = " / <a href='view-film?p=$linksv' target='__blank'>Speedvideo</a>";
		} else {
			$sv = '';
		}
	}
		
		
		
	echo "<div class='ep'><p class='info'><strong> " . $titolo . "</strong> <br></p><p class='link'> ".$link, $sv."</p></div>";
 ?>

	</form>
	
	<div class="footer">
	
	</div>

</body>
</html>