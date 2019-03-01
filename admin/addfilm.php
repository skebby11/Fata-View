
<?php

include('../functions.php');

$idutente = $_SESSION['user']['id'];

if ($idutente != 2) {
	header('location: index.php');
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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
		
	
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
	
<a href="addep.php"><h2 style="padding-top: 50px">Aggiungi episodio</h2></a>

<form action="addserie.php" method="post" style="padding-top: 120px;">

	ID (fac.): <input type="text" name="id"><br><br>
	Nome serie: <input type="text" name="nome" style="width:300px"><br><br>
	Descrizione: <input type="text" name="descr" style="height: 200px; width: 300px"><br><br>
	Poster: <input type="text" name="poster" style="width:300px"><br><br>
	N. stagioni: <input type="text" name="stagioni"><br><br><br>
	
	<input type="submit" name="Invia" value="Invia">

</form>
	
</div>
</body>