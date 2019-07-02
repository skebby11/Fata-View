
<?php

include('../functions.php');

$idutente = $_SESSION['user']['id'];

if ($idutente != 2) {
	header('location: ../login');
}

$id = $_POST["id"];
$nome = e($_POST["nome"]);
$descr = e($_POST["descr"]);
$poster = $_POST["poster"];
$stagioni = $_POST["stagioni"];

// form validation: ensure that the form is correctly filled

		if (empty($nome)) { 
			array_push($errors, "Nome is required"); 
		}
		if (empty($descr)) { 
			array_push($errors, "Descrizione is required"); 
		}
		if (empty($stagioni)) {
			array_push($errors, "Inserisci il numero di stagioni");
		}

if (count($errors) == 0) {
$query = "INSERT INTO serie (nome, descr, poster, stagioni) 
						  VALUES('$nome', '$descr', '$poster', '$stagioni')";
mysqli_query($db, $query);

$_SESSION['success']  = "SERIE AGGIUNTA!";
}

?>

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" type="text/css" href="css/admin.css">
		
	
	<title>Aggiungi serie</title>

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
		<a class="menu_element product " href="addep.php">Aggiungi Episodio</a>
	</li>
	<li class="parent">
		<a class="menu_element category active" href="addserie.php">Aggiungi Serie</a>
	</li>
	<li class="parent">
		<a class="menu_element " href="addfilm.php">Aggiungi Film</a>
	</li>
	<li class="parent">
		<a class="menu_element product " href="editep.php?action=view">Modifica Episodi</a>
	</li>
	<li class="parent">
		<a class="menu_element product " href="editfilm.php?action=view">Modifica Film</a>
	</li>
	</ul>	
</div>

<div class="dx">
		<div class="title">
			<div class="container">
				<h1>Aggiungi SERIE</h1>
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

<a class="button_hover" href="../admin">Indietro</a><br><br><br>
<form action="" method="post" style="padding-top: 40px;">

	ID (fac.): <input type="text" name="id"><br><br>
	Nome serie: <input type="text" name="nome" style="width:300px"><br><br>
	Descrizione: <input type="text" name="descr" style="height: 200px; width: 300px"><br><br>
	Poster: <input type="text" name="poster" style="width:300px"><br><br>
	N. stagioni: <input type="text" name="stagioni"><br><br><br>
	
	<button type="submit" name="Invia" value="Invia">Invia</button>

</form>
	
</div>
</div>
</div>
</div>
</body>