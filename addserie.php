
<?php

<<<<<<< HEAD
include('../functions.php');
=======
include('functions.php');
>>>>>>> 6d6b8c59bfddf7ecde16650f5d5bbee2bfbb215f

$idutente = $_SESSION['user']['id'];

if ($idutente != 2) {
	header('location: index.php');
}

$id = $_POST["id"];
<<<<<<< HEAD
$nome = e($_POST["nome"]);
=======
$nome = $_POST["nome"];
>>>>>>> 6d6b8c59bfddf7ecde16650f5d5bbee2bfbb215f
$descr = e($_POST["descr"]);
$poster = $_POST["poster"];
$stagioni = $_POST["stagioni"];

// form validation: ensure that the form is correctly filled
<<<<<<< HEAD

=======
		if (empty($id)) { 
			array_push($errors, "ID is required"); 
		}
>>>>>>> 6d6b8c59bfddf7ecde16650f5d5bbee2bfbb215f
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
<<<<<<< HEAD
$query = "INSERT INTO serie (nome, descr, poster, stagioni) 
						  VALUES('$nome', '$descr', '$poster', '$stagioni')";
=======
$query = "INSERT INTO serie (id, nome, descr, poster, stagioni) 
						  VALUES('$id', '$nome', '$descr', '$poster', '$stagioni')";
>>>>>>> 6d6b8c59bfddf7ecde16650f5d5bbee2bfbb215f
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
<<<<<<< HEAD
		
=======
	

	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
	<?php
echo "<script>  $( function() {
    var availableTags = [
	";
$query = "SELECT nome, id FROM serie";
			$results = mysqli_query($db, $query);
			if (mysqli_num_rows($results) > 0) {
				while($row = mysqli_fetch_assoc($results)) {
					echo "'" . $row['nome'] . " - " . $row['id'] . "',
					";
				}
			}
echo "    ];
    $( '#idserie' ).autocomplete({
      source: availableTags
    });
  } );</script>";
?>
	
>>>>>>> 6d6b8c59bfddf7ecde16650f5d5bbee2bfbb215f
	
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
	
<<<<<<< HEAD
<h2 style="padding-top: 50px">SERIE</h2>

<form action="addserie.php" method="post" style="padding-top: 40px;">

	ID (fac.): <input type="text" name="id"><br><br>
	Nome serie: <input type="text" name="nome" style="width:300px"><br><br>
	Descrizione: <input type="text" name="descr" style="height: 200px; width: 300px"><br><br>
	Poster: <input type="text" name="poster" style="width:300px"><br><br>
=======
<a href="addep.php"><h2 style="padding-top: 50px">Aggiungi episodio</h2></a>

<form action="addserie.php" method="post" style="padding-top: 120px;">

	ID: <input type="text" name="id"><br><br>
	Nome serie: <input type="text" name="nome"><br><br>
	Descr: <input type="text" name="descr"><br><br>
	Poster: <input type="text" name="poster"><br><br>
>>>>>>> 6d6b8c59bfddf7ecde16650f5d5bbee2bfbb215f
	N. stagioni: <input type="text" name="stagioni"><br><br><br>
	
	<input type="submit" name="Invia" value="Invia">

</form>
	
</div>
</body>