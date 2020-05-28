
<?php

include('../functions.php');

$idutente = $_SESSION['user']['id'];

if ($idutente != 2) {
	header('location: ../login');
}

if(isset($_POST["addfilm"])) {
	
$titolo = e($_POST["titolo"]);
$descr = e($_POST["descr"]);
$link = e($_POST["link"]); // 
$linksv = e($_POST["linksv"]); // speedvideo
$linkverys = e($_POST["linkverys"]); // verystream
$linkmd = e($_POST["linkmd"]); // mix drop
$linkgu = e($_POST["linkgu"]); // goun
	

 // get file name (not including path)
$filename = @basename($_FILES["posterupload"]['name']);

// filename of temp uploaded file
$tmp_filename = $_FILES["posterupload"]['tmp_name'];

$file_ext = @strtolower(@strrchr($filename,"."));
if (@strpos($file_ext,'.') === false) { // no dot? strange
	array_push($errors, "Suspicious file name or could not determine file extension."); 
}

$file_ext = @substr($file_ext, 1); // remove dot

// destination filename, rename if set to
$dest_filename = $filename;
$dest_filename =  mt_rand(1000, 9999). '-' . $filename;

// get size
$filesize = filesize($tmp_filename); // filesize($tmp_filename);

	
// ingore empty input fields
if ($filename!="") {

// destination path - you can choose any file name here (e.g. random)
$path = "../poster/" . $dest_filename; 
	

if(move_uploaded_file($_FILES["posterupload"]['tmp_name'],$path)) {
	

// form validation: ensure that the form is correctly filled
		if (empty($titolo)) { 
			array_push($errors, "Title is required"); 
		}
		if (empty($descr)) { 
			array_push($errors, "Descrizione is required"); 
		}


if (count($errors) == 0) {
$query = "INSERT INTO film (titolo, descr, poster, link, linksv, linkverys, linkmd, linkgu) 
						  VALUES('$titolo', '$descr', '/poster/$dest_filename', '$link', '$linksv', '$linkverys', '$linkmd', '$linkgu')";
mysqli_query($db, $query); 

	
$_SESSION['success']  = "FILM AGGIUNTO!";
	
	
	
// Invia messaggio Telegram
	
	
  $nomefilm = "SELECT id, titolo, poster FROM film WHERE titolo='$titolo'";
  $result = mysqli_query($db, $nomefilm);
	
  while($row = mysqli_fetch_assoc($result)) {
  	$idfilm = $row["id"];
  	$titolofilm = $row["titolo"];
  	$poster = $row["poster"];
  }
	
  $botToken="1250602787:AAELRszwAOyJM2uKCt8TdNCdqfgQg81epJ4";

  $website="https://api.telegram.org/bot".$botToken;
  $chatId=-1001315498220;  //** ===>>>NOTE: this chatId MUST be the chat_id of a person, NOT another bot chatId !!!**
  $params=[
      'chat_id'=>$chatId, 
      'parse_mode' => 'markdown',
      'text'=>"[​​​​​​​​​​​](https://fatastreaming2.altervista.org$poster)E' appena stato aggiunto il film $titolofilm.
Guardalo ora su https://fatastreaming2.altervista.org/film?id=$idfilm",
  ];
  $ch = curl_init($website . '/sendMessage');
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $result = curl_exec($ch);
  curl_close($ch);
	
} else {
	echo "errore";
}
}
}
}

?>

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<link rel="stylesheet" type="text/css" href="css/admin.css?0.004">
	

	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
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

<?php include('sections/head.php'); ?>
<?php 
	$activepage = "addfilm";
	include('sections/leftbar.php'); ?>

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
	

<a class="button_hover" href="../admin">Indietro</a><br><br><br>
<form action="" method="post" style="padding-top: 40px;"  enctype="multipart/form-data">

	Titolo: <input type="text" name="titolo"><br><br>
	Descrizione: <input type="text" name="descr"><br><br>
	Poster: <input type="file" name="posterupload" id="posterupload"><br><br>
	Supervideo: <input type="text" name="link"><br><br>
	SpeedVideo: <input type="text" name="linksv"><br><br>
	VeryStream: <input type="text" name="linkverys"><br><br>
	MixDrop: <input type="text" name="linkmd"><br><br>
	GoUnlimited: <input type="text" name="linkgu"><br><br><br>
	
	<button type="submit" name="addfilm" value="Invia">Invia</button>

</form>
	
</div>
</div>
</div>
</div>
</body>