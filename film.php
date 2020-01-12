

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
 
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $titolo ?> - Fata Streaming</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css?1.3.5.24.43">
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
		<div class="container">

		<h1 class="stagname"><? echo $titolo ?></h1>
		
		<img class="poster" src="<?php echo $poster ?> " alt="<?php echo $titolo?> poster">
		<p class="descr"><?php echo $descr ?></p>
		
<?php	

	
	if(!empty($linksv)) { // YES SPEEDVIDEO
		if(!empty($linkmd)) { // SV + MIXDROP
			$link = "<a href='view-film?sv=$linksv' target='__blank'>Speedvideo</a> / <a href='view-film?md=$linkmd' target='__blank'>MixDrop</a>";
		} elseif (!empty($linkgu)){  // MIXDROP + GOUNL
			$link = "<a href='view-film?sv=$linksv' target='__blank'>Speedvideo</a> / <a href='view-film?gu=$linkgu' target='__blank'>GoUnlimited</a>";
		} else { // JUST SV
			$link = "<a href='view-film?sv=$linksv' target='__blank'>Speedvideo</a>";
		}
	}
				
	if(!empty($linkmd)) {  // YES MIXDROP
		if(!empty($linksv)) {  // MIXDROP + SPEEDVIDEO
			$link = "<a href='view-film?md=$linkmd' target='__blank'>MixDrop</a> / <a href='view-film?sv=$linksv' target='__blank'>SpeedVideo</a>";
		} elseif (!empty($linkgu)){  // MIXDROP + GOUNL
			$link = "<a href='view-film?md=$linkmd' target='__blank'>MixDrop</a> / <a href='view-film?gu=$linkgu' target='__blank'>GoUnlimited</a>";
		} else {  // JUST MIXDROP
			$link = "<a href='view-film?md=$linkmd' target='__blank'>MixDrop</a>";
		}
	}
			
	if(!empty($linkgu)) {  // YES GOUNL
		if(!empty($linksv)) {  // GOUNL + SPEEDVIDEO
			$link = "<a href='view-film?gu=$linkgu' target='__blank'>GoUnlimited</a> / <a href='view-film?sv=$linksv' target='__blank'>SpeedVideo</a>";
		} elseif (!empty($linkgu)){  // GOUNL + MIXDROP
			$link = "<a href='view-film?gu=$linkgu' target='__blank'>GoUnlimited</a> / <a href='view-film?md=$linkmd' target='__blank'>MixDrop</a>";
		} else {  // JUST GOUNL
			$link = "<a href='view-film?gu=$linkgu' target='__blank'>GoUnlimited</a>";
		}
	}
		
		
	echo "<div class='ep'><p class='info'><strong> " . $titolo . "</strong><br> <br></p><p class='link'> ".$link, $sv."</p></div>";
 ?>
		</div>
	</form>
	
	<div class="footer">
	
	</div>

</body>
</html>