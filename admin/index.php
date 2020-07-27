<?php

include('../functions.php');

$idutente = $_SESSION['user']['id'];

if ($_SESSION['user']['user_type'] != 'admin' ) {
	header('location: /login');
}



?>
<head>
    <link rel="stylesheet" href="assets/chosen/docsupport/style.css">
    <link rel="stylesheet" href="assets/chosen/docsupport/prism.css">
    <link rel="stylesheet" href="assets/chosen/chosen.css">
	<link rel="stylesheet" type="text/css" href="css/admin.css?0.004">
	
	<title>Bacheca</title>

</head>

<body>
<?php include('sections/head.php'); ?>

<?php
	$activepage = "index"; include('sections/leftbar.php'); ?>

<div class="dx">
		<div class="title">
			<div class="container">
				<h1>Aggiungi contenuti</h1>
			</div>
		</div>
		<div class="container">
				</div>
	</div>