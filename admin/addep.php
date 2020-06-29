
<?php

include('../functions.php');



$idutente = $_SESSION['user']['id'];


if ($_SESSION['user']['user_type'] != 'admin' ) {
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

//Fata Player

$fpmp4 = e($_POST["fpmp4"]);
$fpwebm = e($_POST["fpwebm"]);
$fpposter = e($_POST["fpposter"]);

$unique = bin2hex(openssl_random_pseudo_bytes(4));


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
	
	if (empty($fpmp4)) {

		$query = "INSERT INTO episodi (stagione, episodio, serie, titolo, link, linksv, linkmd, linkgu, fataplayer) 
								  VALUES('$stagione', '$episodio', '$idserie', '$titolo', '$link', '$linksv', '$linkmd', '$linkgu', '0')";
				
					
					mysqli_query($db, $query); 
		
	} elseif (!empty($fpmp4)) {
		$query = "INSERT INTO episodi (stagione, episodio, serie, titolo, link, linksv, linkmd, linkgu, fataplayer) 
								  VALUES('$stagione', '$episodio', '$idserie', '$titolo', '$link', '$linksv', '$linkmd', '$linkgu', '$unique')";
		
							mysqli_query($db, $query);
		
		$query = "INSERT INTO fataplayer (id, fpmp4, fpposter, fpwebm)
								  VALUES('$unique', '$fpmp4', '$fpposter', '$fpwebm')";

							mysqli_query($db, $query); 
	}
	
	

$_SESSION['success']  = "EPISODIO AGGIUNTO!";
	
	
// Invia messaggio Telegram
	
  $nomeserie = "SELECT nome, poster FROM serie WHERE id=$idserie";
  $result = mysqli_query($db, $nomeserie);
	
  while($row = mysqli_fetch_assoc($result)) {
  	$nomeserie = $row["nome"];
  	$poster = $row["poster"];
  }
	
  //$botToken="1250602787:AAELRszwAOyJM2uKCt8TdNCdqfgQg81epJ4";

  $website="https://api.telegram.org/bot".$botToken;
  $chatId=-1001315498220;  //** ===>>>NOTE: this chatId MUST be the chat_id of a person, NOT another bot chatId !!!**
  $params=[
      'chat_id'=>$chatId, 
      'parse_mode' => 'markdown',
      'text'=>"[​​​​​​​​​​​](https://fatastreaming2.altervista.org$poster)E' appena stato aggiunto l'episodio $stagione X $episodio della serie $nomeserie.
Guardalo ora su https://fatastreaming2.altervista.org/serie?id=$idserie",
  ];
  $ch = curl_init($website . '/sendMessage');
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $result = curl_exec($ch);
  curl_close($ch);

}

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
				$query = "SELECT nome, id FROM serie ORDER BY nome ASC";
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
	MixDrop: <input type="text" name="linkmd"><br><br>
	GoUnlimited: <input type="text" name="linkgu"><br><br>
	FataPlayer Mp4: <input type="text" name="fpmp4" style="width: 25%"> WebM: <input type="text" name="fpwebm" style="width: 25%"> Poster: <input type="text" name="fpposter" style="width: 25%"><br><br><br>
	
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