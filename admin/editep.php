
<?php

include('../functions.php');

$idutente = $_SESSION['user']['id'];

if ($idutente != 2) {
	header('location: /login');
}

$action = $_GET["action"];


if (count($errors) == 0) {
$query = "INSERT INTO episodi (stagione, episodio, serie, titolo, link, linksv, linkmd, linkgu, fataplayer) 
						  VALUES('$stagione', '$episodio', '$idserie', '$titolo', '$link', '$linksv', '$linkmd', '$linkgu', , '0')";
mysqli_query($db, $query); 

}

if(isset($_POST['aggiornaep'])){
	$selepid = $_POST['selepid'];
	$upstagione = $_POST["upstagione"];
	$upepisodio = $_POST['upepisodio'];
	$upserie = $_POST['upserie'];
	$uptitolo = e($_POST['uptitolo']);
	$uplink = e($_POST['uplink']);
	$uplinksv = e($_POST['uplinksv']);
	$uplinkmd = e($_POST['uplinkmd']);
	$uplinkgu = e($_POST['uplinkgu']);
	
	
	$query = "UPDATE episodi SET stagione = " . $upstagione . ", episodio = '$upepisodio', serie = ".$_POST['upserie']." , titolo = '$uptitolo', link = '".$_POST['uplink']."', linksv = '$uplinksv', linkmd = '$uplinkmd', linkgu = '$uplinkgu', fataplayer = 0 WHERE id = $selepid";
	mysqli_query($db, $query);
	$_SESSION['success']  = "Episodio aggiornato";
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
	

	
    <link rel="stylesheet" href="assets/chosen/docsupport/prism.css">
    <link rel="stylesheet" href="assets/chosen/chosen.css">
	<!--<script src="../ckeditor/ckeditor.js"></script>-->
	
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

<?php include('sections/head.php'); ?>
<?php 
	$activepage = "editep";
	include('sections/leftbar.php'); ?>

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
    <th>supervideo</th>
    <th>speedvideo</th>
    <th>fata</th>
	<th>mixdrop</th>
	<th>gounlimited</th>
    <th></th>
  </tr>
	
<?php $query="SELECT * FROM episodi ORDER BY id DESC";
	  $results = mysqli_query($db, $query);
			if (mysqli_num_rows($results) > 0) {
				while($row = mysqli_fetch_assoc($results)) {
					$selepid = $row['id'];
					echo "  <tr>
    <td><b>".$row['id']."</b></td>
    <td>".$row['stagione']."</td>
    <td>".$row['episodio']."</td>
    <td>".$row['serie']."</td>
    <td>".$row['titolo']."</td>
    <td>".$row['link']."</td>
    <td>".$row['linksv']."</td>
	<td>".$row['fataplayer']."</td>
    <td>".$row['linkmd']."</td>
    <td>".$row['linkgu']."</td>
    <td><a class='button_hover' href='editep.php?action=edit&id_ep=".$row['id']."'>Modifica</a></td>
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
					$linkmd = $row['linkmd'];
					$linkgu = $row['linkgu'];
					$fataplayer = $row['fataplayer'];
				}
			}
	?>
	<a class="button_hover" href="editep.php?action=view">Indietro</a><br><br><br>
	<form action="editep.php?action=view" method="post">
	<input value="<? echo $epid ?>" name="selepid" style="display: none">
	<strong>Stagione</strong> <br><input id='editor1' name="upstagione" value="<?php echo $stagione ?>"><br><br>
	<strong>Episodio</strong> <br><input id='editor2' name="upepisodio" value="<?php echo $episodio ?>"><br><br>
	<strong>Serie</strong> <br> <select data-placeholder="<?php echo $serie ?>" class="chosen-select" tabindex="2" name="idserie" value="<?php echo $serie ?>">
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
				</select><br><br>
	<strong>Titolo</strong> <br><input id='editor4' name="uptitolo" value="<?php echo $titolo ?>"><br><br>
	<strong>Link Supervideo</strong> <br><input id='editor5' name="uplink" value="<?php echo $link ?>"><br><br>
	<strong>Link Speed Video</strong> <br><input id='editor6' name="uplinksv" value="<?php echo $linksv ?>"><br><br>
	<strong>Link MixDrop</strong> <br><input id='editor8' name="uplinkmd" value="<?php echo $linkmd ?>"><br><br>
	<strong>Link GoUnl</strong> <br><input id='editor9' name="uplinkgu" value="<?php echo $linkgu ?>"><br><br>
	<strong>Link GoUnl</strong> <br><input id='editor9' name="uplinkfata" value="<?php echo $fataplayer ?>"><br><br><br>
	
	<button type="submit" name="aggiornaep" value="Salva">Salva</button>
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


  <script src="assets/chosen/docsupport/jquery-3.2.1.min.js" type="text/javascript"></script>
  <script src="assets/chosen/chosen.jquery.js" type="text/javascript"></script>
  <script src="assets/chosen/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
  <script src="assets/chosen/docsupport/init.js" type="text/javascript" charset="utf-8"></script>
	
	
</body>