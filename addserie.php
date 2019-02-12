
<?php

include('functions.php');

$id = $_POST["id"];
$nome = $_POST["nome"];
$descr = $_POST["descr"];
$poster = $_POST["poster"];
$stagioni = $_POST["stagioni"];


$query = "INSERT INTO serie (id, nome, descr, poster, stagioni) 
						  VALUES('$id', '$nome', '$descr', '$poster', '$stagioni')";
mysqli_query($db, $query);

?>

<a href="addep.php"><h2 style="padding-top: 50px">Aggiungi episodio</h2></a>


<form action="addserie.php" method="post" style="padding-top: 120px;">

	ID: <input type="text" name="id"><br><br>
	Nome serie: <input type="text" name="nome"><br><br>
	Descr: <input type="text" name="descr"><br><br>
	Poster: <input type="text" name="poster"><br><br>
	N. stagioni: <input type="text" name="stagioni"><br><br><br>
	
	<input type="submit" name="Invia" value="Invia">

</form>