
<?php

include('../functions.php');

$idutente = $_SESSION['user']['id'];

if ($_SESSION['user']['user_type'] != 'admin' ) {
	header('location: /login');
}

if(isset($_POST["addserie"])) {
$id = $_POST["id"];
$nome = e($_POST["nome"]);
$descr = e($_POST["descr"]);
$stagioni = $_POST["stagioni"];



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
						  VALUES('$nome', '$descr', '/poster/$dest_filename', '$stagioni')";
mysqli_query($db, $query);

$_SESSION['success']  = "SERIE AGGIUNTA!";
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

    <link rel="stylesheet" href="assets/chosen/docsupport/style.css">
    <link rel="stylesheet" href="assets/chosen/docsupport/prism.css">
    <link rel="stylesheet" href="assets/chosen/chosen.css">
	<link rel="stylesheet" type="text/css" href="css/admin.css?0.004">
		
	
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

<?php include('sections/head.php'); ?>
<?php 
	$activepage = "addserie";
	include('sections/leftbar.php'); ?>

<div class="dx">
		<div class="title">
			<div class="container">
				<h1>Aggiungi SERIE</h1>
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
<form action="addserie.php" method="post" style="padding-top: 40px;" enctype="multipart/form-data">

	ID (fac.): <input type="text" name="id"><br><br>
	Nome serie: <input type="text" name="nome" style="width:300px"><br><br>
	Descrizione: <input type="text" name="descr" style="height: 200px; width: 300px"><br><br>
	N. stagioni: <input type="text" name="stagioni"><br><br>
	Poster: <input type="file" name="posterupload" id="posterupload"><br><br><br>
	
	<button type="submit" name="addserie" value="Invia">Invia</button>

</form>
	
</div>
</div>
</div>
</div>
</body>