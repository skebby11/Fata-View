
<?php

include('../functions.php');

$idutente = $_SESSION['user']['id'];

if ($idutente != 2) {
	header('location: index.php');
}


$stagione = $_POST["stagione"];
$episodio = $_POST["episodio"];
$idserie = $_POST["idserie"];
$titolo = $_POST["titolo"];
$link = $_POST["link"];
$linksv = $_POST["linksv"];

// form validation: ensure that the form is correctly filled
		if (empty($stagione)) { 
			array_push($errors, "Stagione is required"); 
		}
		if (empty($episodio)) { 
			array_push($errors, "Episodio is required"); 
		}
		if (empty($idserie)) { 
			array_push($errors, "ID serie is required"); 
		}
		if (empty($titolo)) {
			array_push($errors, "Inserisci il titolo");
		}


if (count($errors) == 0) {
$query = "INSERT INTO episodi (stagione, episodio, serie, titolo, link, linksv) 
						  VALUES('$stagione', '$episodio', '$idserie', '$titolo', '$link', '$linksv')";
mysqli_query($db, $query); 

$_SESSION['success']  = "EPISODIO AGGIUNTO!";

}

?>

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	

	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
	<title>Aggiungi episodio</title>

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
	
	
<a href="addserie.php"><h2 style="padding-top: 50px">Aggiungi serie</h2></a>


<form action="addep.php" method="post" style="padding-top: 120px;">

	Stagione: <input type="text" name="stagione"><br><br>
	Episodio: <input type="text" name="episodio"><br><br>
	ID serie: <input type="text" name="idserie" id="idserie"><br><br>
	Titolo: <input type="text" name="titolo"><br><br>
	Link OL: <input type="text" name="link"><br><br>
	Link SV: <input type="text" name="linksv"><br><br><br>
	
	<input type="submit" name="Invia" value="Invia">

</form>
	
</div>
</body>