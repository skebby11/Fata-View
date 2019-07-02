
<?php

include('../functions.php');

$idutente = $_SESSION['user']['id'];

if ($idutente != 2) {
	header('location: /login');
}


$stagione = $_POST["stagione"];
$episodio = $_POST["episodio"];
$idserie = $_POST["idserie"];
$titolo = e($_POST["titolo"]);
$link = e($_POST["link"]);
$linksv = e($_POST["linksv"]);
$linkverys = e($_POST["linkverys"]);


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
$query = "INSERT INTO episodi (stagione, episodio, serie, titolo, link, linksv, linkverys) 
						  VALUES('$stagione', '$episodio', '$idserie', '$titolo', '$link', '$linksv', '$linkverys')";
mysqli_query($db, $query); 

$_SESSION['success']  = "EPISODIO AGGIUNTO!";

}

?>

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	
	<link rel="stylesheet" type="text/css" href="css/admin.css">
	
	<style>
.ui-autocomplete { position: absolute; cursor: default; background:#CCC }   

/* workarounds */
html .ui-autocomplete { width:1px; } /* without this, the menu expands to 100% in IE6 */
.ui-menu {
    list-style:none;
    padding: 2px;
    margin: 0;
    display:block;
    float: left;
}
.ui-menu .ui-menu {
    margin-top: -3px;
}
.ui-menu .ui-menu-item {
    margin:0;
    padding: 0;
    zoom: 1;
    float: left;
    clear: left;
    width: 100%;
}
.ui-menu .ui-menu-item a {
    text-decoration:none;
    display:block;
    padding:.2em .4em;
    line-height:1.5;
    zoom:1;
}
.ui-menu .ui-menu-item a.ui-state-hover,
.ui-menu .ui-menu-item a.ui-state-active {
    font-weight: normal;
    margin: -1px;
}
	</style>
	

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
	<div class="head"><div class="logo">FATA STREAMING</div></div>

<div class="sx no-print">
	<ul class="sx_menu">
	<li class="parent">
		<a class="menu_element product active" href="addep.php">Aggiungi Episodio</a>
	</li>
	<li class="parent">
		<a class="menu_element category" href="addserie.php">Aggiungi Serie</a>
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
				<h1>Aggiungi EPISODIO</h1>
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

	Stagione: <input type="text" name="stagione"><br><br>
	Episodio: <input type="text" name="episodio"><br><br>
	ID serie: <input type="text" name="idserie" id="idserie"><br><br>
	Titolo: <input type="text" name="titolo"><br><br>
	OpenLoad: <input type="text" name="link"><br><br>
	SpeedVideo: <input type="text" name="linksv"><br><br>
	VeryStream: <input type="text" name="linkverys"><br><br><br>
	
	<button type="submit" name="Invia" value="Invia">Invia</button>

</form>
	
</div>
</div>
</div>
</div>
</body>