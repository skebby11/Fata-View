
<?php

include('../functions.php');

$idutente = $_SESSION['user']['id'];

if ($idutente != 2) {
	header('location: ../login');
}

if(isset($_POST["addfilm"])) {
$titolo = e($_POST["nome"]);
$descr = e($_POST["descr"]);
$poster = e($_POST["poster"]);
$link = e($_POST["link"]);
$linksv = e($_POST["linksv"]);
$linkverys = e($_POST["linkverys"]);

	
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
			array_push($errors, "Titolo is required"); 
		}
		if (empty($descr)) { 
			array_push($errors, "Descrizione is required"); 
		}
		if (empty($poster)) {
			array_push($errors, "Poster e' necessario");
		}

if (count($errors) == 0) {
$query = "INSERT INTO film (titolo, descr, poster, link, linksv, linkverys) 
						  VALUES('$titolo', '$descr', '$poster', '$link', '$linksv', '$linkverys')";
mysqli_query($db, $query);
$_SESSION['success']  = "FILM AGGIUNTO!";
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

    <!-- Bootstrap CSS -->
	
	<link rel="stylesheet" type="text/css" href="css/admin.css">
		
	
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
	<div class="head"><div class="logo">FATA STREAMING</div></div>

<div class="sx no-print">
	<ul class="sx_menu">
	<li class="parent">
		<a class="menu_element product " href="addep.php">Aggiungi Episodio</a>
	</li>
	<li class="parent">
		<a class="menu_element category" href="addserie.php">Aggiungi Serie</a>
	</li>
	<li class="parent">
		<a class="menu_element active" href="addfilm.php">Aggiungi Film</a>
	</li>
	<li class="parent">
		<a class="menu_element product " href="editep.php?action=view">Modifica Episodi</a>
	</li>
	<li class="parent">
		<a class="menu_element product " href="editfilm.php?action=view">Modifica Film</a>
	</li>
	<li class="parent">
		<a class="menu_element product " href="editserie.php?action=view">Modifica Serie</a>
	</li>
	</ul>	
</div>

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
<form action="addfilm.php" method="post" style="padding-top: 30px;">

	Titolo: <input type="text" name="nome" style="width:300px"><br><br>
	Descrizione: <input type="text" name="descr" style="width: 500px"><br><br>
	Poster: <input type="text" name="poster" style="width:300px"><br><br>
	OpenLoad: <input type="text" name="link" style="width:300px"><br><br>
	SpeedVideo: <input type="text" name="linksv"><br><br>
	VeryStream: <input type="file" name="posterupload" id="posterupload"><br><br><br>
	
	<button type="submit" name="addfilm" value="Invia">Invia</button>

</form>
	
</div>			
</div>
</div>
</div>
</body>