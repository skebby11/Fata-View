
<?php

include('../functions.php');

$idutente = $_SESSION['user']['id'];

if ($idutente != 2) {
	header('location: /login');
}

$action = $_GET["action"];


if (count($errors) == 0) {
$query = "INSERT INTO episodi (stagione, episodio, serie, titolo, link, linksv, linkverys) 
						  VALUES('$stagione', '$episodio', '$idserie', '$titolo', '$link', '$linksv', '$linkverys')";
mysqli_query($db, $query); 

}

if(isset($_POST['aggiornaep'])){
	$selepid = $_POST['selepid'];
	$upstagione = $_POST["upstagione"];
	$epepisodio = $_POST['epepisodio'];
	$upserie = $_POST['upserie'];
	$uptitolo = e($_POST['uptitolo']);
	$uplink = e($_POST['uplink']);
	$uplinksv = e($_POST['uplinksv']);
	$uplinkvery = e($_POST['uplinkvery']);
	
	$query = "UPDATE episodi SET stagione = " . $upstagione . ", episodio = ".$_POST['upepisodio'].", serie = ".$_POST['upserie']." , titolo = '$uptitolo', link = '".$_POST['uplink']."', linksv = '".$_POST['uplinksv'].", linkverys = '".$_POST['uplinkvery']."' WHERE id = $selepid";
	mysqli_query($db, $query);
	$_SESSION['success']  = "Episodio aggiornato";
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
	
	<!--<script src="../ckeditor/ckeditor.js"></script>-->
	
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
		<a class="menu_element product" href="addep.php">Aggiungi Episodio</a>
	</li>
	<li class="parent">
		<a class="menu_element category" href="addserie.php">Aggiungi Serie</a>
	</li>
	<li class="parent">
		<a class="menu_element " href="addfilm.php">Aggiungi Film</a>
	</li>
	<li class="parent">
		<a class="menu_element product active" href="editep.php?action=view">Modifica Episodi</a>
	</li>
	</ul>	
</div>

<div class="dx">
		<div class="title">
			<div class="container">
				<h1>Modifica EPISODIO</h1>
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
	
<?php if ($action=="view") : ?>

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<h2>Lista episodi</h2>

<table>
  <tr>
    <th>id</th>
    <th>stagione</th>
    <th>episodio</th>
    <th>serie</th>
    <th>titolo</th>
    <th>link</th>
    <th>linksv</th>
    <th>linkverys</th>
    <th></th>
  </tr>
	
<?php $query="SELECT * FROM episodi ORDER BY id DESC";
	  $results = mysqli_query($db, $query);
			if (mysqli_num_rows($results) > 0) {
				while($row = mysqli_fetch_assoc($results)) {
					$selepid = $row['id'];
					echo "  <tr>
    <td>".$row['id']."</td>
    <td>".$row['stagione']."</td>
    <td>".$row['episodio']."</td>
    <td>".$row['serie']."</td>
    <td>".$row['titolo']."</td>
    <td>".$row['link']."</td>
    <td>".$row['linksv']."</td>
	<td>".$row['linkverys']."</td>
    <td><a href='editep.php?action=edit&id_ep=".$row['id']."'><input type='submit' value='Modifica'></td>
  </tr>
					";
				}
			}
?>
</table>
	
<?php elseif ($action=="edit") : ?>
	
	<?php
	$epid = $_GET['id_ep'];
	$query = "SELECT * FROM episodi WHERE id = $epid";
	$results = mysqli_query($db, $query);
			if (mysqli_num_rows($results) > 0) {
				while($row = mysqli_fetch_assoc($results)) {
					$stagione = $row['stagione'];
					$episodio = $row['episodio'];
					$serie = $row['serie'];
					$titolo = $row['titolo'];
					$link = $row['link'];
					$linksv = $row['linksv'];
					$linkverys = $row['linkverys'];
				}
			}
	?>
	
	<form action="editep.php?action=view" method="post">
	<input value="<? echo $epid ?>" name="selepid" style="display: none">
	<strong>Stagione</strong> <br><input id='editor1' name="upstagione" value="<?php echo $stagione ?>"><br><br>
	<strong>Episodio</strong> <br><input id='editor2' name="upepisodio" value="<?php echo $episodio ?>"><br><br>
	<strong>Serie</strong> <br><input id='editor3' name="upserie" value="<?php echo $serie ?>"><br><br>
	<strong>Titolo</strong> <br><input id='editor4' name="uptitolo" value="<?php echo $titolo ?>"><br><br>
	<strong>Link Open Load</strong> <br><input id='editor5' name="uplink" value="<?php echo $link ?>"><br><br>
	<strong>Link Speed Video</strong> <br><input id='editor6' name="uplinksv" value="<?php echo $linksv ?>"><br><br>
	<strong>Link VeryStream</strong> <br><input id='editor7' name="uplinkvery" value="<?php echo $linkverys ?>"><br><br>
	
	<input type="submit" name="aggiornaep" value="Salva">
	</form>
	
	
<?php endif ?>
	

	
</div>
</div>
</div>
</div>
<!--<script>
CKEDITOR.replace( 'editor1', { width: 700, height: 60 } );
CKEDITOR.add
CKEDITOR.replace( 'editor2', { width: 700, height: 60 } );
CKEDITOR.add
CKEDITOR.replace( 'editor3', { width: 700, height: 60 } );
CKEDITOR.add
CKEDITOR.replace( 'editor4', { width: 700, height: 60 } );
CKEDITOR.add
CKEDITOR.replace( 'editor5', { width: 700, height: 60 } );
CKEDITOR.add
CKEDITOR.replace( 'editor6', { width: 700, height: 60 } );
CKEDITOR.add
</script>-->
</body>