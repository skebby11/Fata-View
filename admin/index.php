<?php

include('../functions.php');

$idutente = $_SESSION['user']['id'];

if ($idutente != 2) {
	header('location: ../login.php');
}



?>

<link rel="stylesheet" type="text/css" href="css/admin.css">



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
		<a class="menu_element" href="addfilm.php">Aggiungi Film</a>
	</li>
	<li class="parent">
		<a class="menu_element product " href="editep.php?action=view">Modifica Episodi</a>
	</li>
	</ul>	
</div>

<div class="dx">
		<div class="title">
			<div class="container">
				<h1>Aggiungi contenuti</h1>
			</div>
		</div>
		<div class="container">
				</div>
	</div>