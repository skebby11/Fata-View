
<?php

include('../functions.php');

$activepage = "4";
	
$idutente = $_SESSION['user']['id'];

if ($idutente != 2) {
	header('location: /login');
}

$action = $_GET["action"];


if (count($errors) == 0) {
$query = "INSERT INTO serie (nome, descr, poster, stagioni ) 
						  VALUES('$nome', '$descr', '$poster', '$stagioni')";
mysqli_query($db, $query); 

}

if(isset($_POST['aggiornaserie'])){
	$selserieid = $_POST['selserieid'];
	$upnome = e($_POST["upnome"]);
	$updescr = e($_POST['updescr']);
	$upposter = e($_POST['upposter']);
	$upstag = e($_POST['upstag']);
	
	$query = "UPDATE serie SET nome = '$upnome', descr = '$updescr', poster = '$upposter', stagioni = '$upstag' WHERE id = $selserieid";
	mysqli_query($db, $query);
	$_SESSION['success']  = "Serie aggiornato";
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
	

	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
	<!--<script src="../ckeditor/ckeditor.js"></script>-->
	
	<title>Modifica serie</title>

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
	$activepage = "editserie";
	include('sections/leftbar.php'); ?>

<div class="dx">
		<div class="title">
			<div class="container">
				<h1>Modifica SERIE</h1>
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

<h2>Lista film</h2>

<table>
  <tr>
    <th>id</th>
    <th>nome</th>
    <th>descr</th>
    <th>poster</th>
    <th>stagioni</th>
    <th></th>
  </tr>
	
<?php $query="SELECT * FROM serie ORDER BY id DESC";
	  $results = mysqli_query($db, $query);
			if (mysqli_num_rows($results) > 0) {
				while($row = mysqli_fetch_assoc($results)) {
					$selepid = $row['id'];
					echo "  <tr>
    <td><b>".$row['id']."</b></td>
    <td>".$row['nome']."</td>
    <td>".substr($row["descr"], 0, 50)."</td>
    <td>".$row['poster']."</td>
    <td>".$row['stagioni']."</td>
    <td><a class='button_hover' href='editserie.php?action=edit&id_serie=".$row['id']."'>Modifica</a></td>
  </tr>
					";
				}
			}
?>
</table>
	
<?php elseif ($action=="edit") : ?>
	
	<?php
	$serieid = $_GET['id_serie'];
	$query = "SELECT * FROM serie WHERE id = $serieid";
	$results = mysqli_query($db, $query);
			if (mysqli_num_rows($results) > 0) {
				while($row = mysqli_fetch_assoc($results)) {
					$nome = $row['nome'];
					$descr = $row['descr'];
					$poster = $row['poster'];
					$stagioni = $row['stagioni'];
				}
			}
	?>
	<a class="button_hover" href="editserie.php?action=view">Indietro</a><br><br><br>
	<form action="editserie.php?action=view" method="post">
	<input value="<? echo $serieid ?>" name="selserieid" style="display: none">
	<strong>Nome</strong> <br><input id='editor2' name="upnome" value="<?php echo $nome ?>"><br><br>
	<strong>Descrizione</strong> <br><input id='editor3' name="updescr" value="<?php echo $descr ?>"><br><br>
	<strong>Poster</strong> <br><input id='editor4' name="upposter" value="<?php echo $poster ?>"><br><br>
	<strong>Stagioni</strong> <br><input id='editor5' name="upstag" value="<?php echo $stagioni ?>"><br><br><br>
	
	<button type="submit" name="aggiornaserie" value="Salva">Salva</button>
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