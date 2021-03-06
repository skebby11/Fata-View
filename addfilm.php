
<?php

include('../functions.php');

$idutente = $_SESSION['user']['id'];

if ($idutente != 2) {
	header('location: ../login');
}

$titolo = e($_POST["nome"]);
$descr = e($_POST["descr"]);
$poster = e($_POST["poster"]);
$link = e($_POST["link"]);
$linksv = e($_POST["linksv"]);

// form validation: ensure that the form is correctly filled

		if (empty($titolo)) { 
			array_push($errors, "Titolo is required"); 
		}
		if (empty($descr)) { 
			array_push($errors, "Descrizione is required"); 
		}
		if (empty($poster)) {
			array_push($errors, "Poster e' necessario");
		}

if (count($errors) == 0) {
$query = "INSERT INTO film (titolo, descr, poster, link, linksv) 
						  VALUES('$titolo', '$descr', '$poster', '$link', '$linksv')";
mysqli_query($db, $query);

$_SESSION['success']  = "FILM AGGIUNTO!";
}


?>

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
	
	<link rel="stylesheet" type="text/css" href="css/admin.css">
		
	
	<title>Aggiungi film</title>

<style>

	.success {
		align-content: center;
		font-size: 120%;
		width: 450px;
		background-color: mediumseagreen;
	}
	
</style>
	
</head>

<body>
	<div class="head"><div class="logo">FATA STREAMING</div></div>

<div class="sx no-print">
	<ul class="sx_menu">
	<li class="parent">
		<a class="menu_element product " href="addep.php"> Episodio</a>
	</li>
	<li class="parent">
		<a class="menu_element category" href="addserie.php">Serie</a>
	</li>
	<li class="parent">
		<a class="menu_element active" href="addfilm.php"> Film</a>
	</li>
	</ul>	
</div>

<div class="dx">
		<div class="title">
			<div class="container">
				<h1>Aggiungi FILM</h1>
			</div>
		</div>
		<div class="container">
		<div class="content">
<div class="container">
	
	<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="success" align="center">
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
				<br>
			</div>
		<?php endif ?>

<form action="addfilm.php" method="post" style="padding-top: 30px;">

	Titolo: <input type="text" name="nome" style="width:300px"><br><br>
	Descrizione: <input type="text" name="descr" style="height: 200px; width: 300px"><br><br>
	Poster: <input type="text" name="poster" style="width:300px"><br><br>
	Link OL: <input type="text" name="link" style="width:300px"><br><br>
	Link SV: <input type="text" name="linksv"><br><br><br>
	
	<input type="submit" name="Invia" value="Invia">

</form>
	
</div>			
</div>
</div>
</div>
</body>