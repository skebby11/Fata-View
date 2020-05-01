
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
$linkmd = e($_POST["linkmd"]);
$linkgu = e($_POST["linkgu"]);


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
$query = "INSERT INTO episodi (stagione, episodio, serie, titolo, link, linksv, linkverys, linkmd, linkgu) 
						  VALUES('$stagione', '$episodio', '$idserie', '$titolo', '$link', '$linksv', '$linkverys', '$linkmd', '$linkgu')";
mysqli_query($db, $query); 
	
	echo $query;

$_SESSION['success']  = "EPISODIO AGGIUNTO!";
	echo $query;
	

?>

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
    <link rel="stylesheet" href="assets/chosen/docsupport/style.css">
    <link rel="stylesheet" href="assets/chosen/docsupport/prism.css">
    <link rel="stylesheet" href="assets/chosen/chosen.css">
	
	<link rel="stylesheet" type="text/css" href="css/admin.css?0.004">
	

	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
	<title>Aggiungi episodio</title>


	
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

<?php include('sections/head.php'); ?>
	
<?php
	$activepage = "addep";
	include('sections/leftbar.php'); ?>

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
	ID serie: <select data-placeholder="Seleziona la serie" class="chosen-select" tabindex="2" name="idserie">
				<option value=""></option>
				<?php
				$query = "SELECT nome, id FROM serie";
						$results = mysqli_query($db, $query);
						if (mysqli_num_rows($results) > 0) {
							while($row = mysqli_fetch_assoc($results)) {
								echo "<option value='" . $row['id'] . "'>" . $row['nome'] . "</option>',
								";
							}
						}
	
				?>
				</select>
					
					<br><br>
	Titolo: <input type="text" name="titolo"><br><br>
	Supervideo: <input type="text" name="link"><br><br>
	SpeedVideo: <input type="text" name="linksv"><br><br>
	VeryStream: <input type="text" name="linkverys"><br><br>
	MixDrop: <input type="text" name="linkmd"><br><br>
	GoUnlimited: <input type="text" name="linkgu"><br><br><br>
	
	<button type="submit" name="Invia" value="Invia">Invia</button>

</form>
	
</div>
</div>
</div>
</div>
	
  <script src="assets/chosen/docsupport/jquery-3.2.1.min.js" type="text/javascript"></script>
  <script src="assets/chosen/chosen.jquery.js" type="text/javascript"></script>
  <script src="assets/chosen/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
  <script src="assets/chosen/docsupport/init.js" type="text/javascript" charset="utf-8"></script>
	
</body>