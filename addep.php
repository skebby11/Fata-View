
<?php

include('functions.php');

$stagione = $_POST["stagione"];
$episodio = $_POST["episodio"];
$idserie = $_POST["idserie"];
$titolo = $_POST["titolo"];
$link = $_POST["link"];
$linksv = $_POST["linksv"];

echo $stagioneid, $titolo, $link, $idserie;

$query = "INSERT INTO episodi (stagione, episodio, serie, titolo, link, linksv) 
						  VALUES('$stagione', '$episodio', '$idserie', '$titolo', '$link', '$linksv')";
mysqli_query($db, $query);

?>

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