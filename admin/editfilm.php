
<?php

include('../functions.php');

$idutente = $_SESSION['user']['id'];

if ($idutente != 2) {
	header('location: /login');
}

$action = $_GET["action"];


if (count($errors) == 0) {
$query = "INSERT INTO film (titolo, descr, poster, link, linksv, linkverys, linkmd, linkgu) 
						  VALUES('$titolo', '$descr', '$poster', '$link', '$linksv', '$linkverys', '$linkmd', '$linkgu')";
//mysqli_query($db, $query); 

}

if(isset($_POST['aggiornafilm'])){
	$selfilmid = $_POST['selfilmid'];
	$updescr = e($_POST["updescr"]);
	$upposter = $_POST['upposter'];
	$uptitolo = e($_POST['uptitolo']);
	$uplink = e($_POST['uplink']);
	$uplinksv = e($_POST['uplinksv']);
	$uplinkvery = e($_POST['uplinkvery']);
	$uplinkmd = e($_POST['uplinkmd']);
	$uplinkgu = e($_POST['uplinkgu']);
	
	$query = "UPDATE film SET titolo = '$uptitolo', descr = '$updescr' , poster = '$upposter', link = '$uplink', linksv = '$uplinksv', linkverys = '$uplinkvery', linkmd = '$uplinkmd', linkgu = '$uplinkgu' WHERE id = $selfilmid";
	mysqli_query($db, $query);
	$_SESSION['success']  = "Film aggiornato";
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
	
	<title>Modifica film</title>

<?php

echo "<script>  $( function() {
    var availableTags = [
	";

$query = "SELECT titolo, id FROM film";
			$results = mysqli_query($db, $query);
			if (mysqli_num_rows($results) > 0) {
				while($row = mysqli_fetch_assoc($results)) {
					echo "'" . $row['titolo'] . " - " . $row['id'] . "',
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
		<a class="menu_element product" href="editep.php?action=view">Modifica Episodi</a>
	</li>
	<li class="parent">
		<a class="menu_element product active" href="editfilm.php?action=view">Modifica Film</a>
	</li>
	<li class="parent">
		<a class="menu_element product " href="editserie.php?action=view">Modifica Serie</a>
	</li>
	</ul>	
</div>

<div class="dx">
		<div class="title">
			<div class="container">
				<h1>Modifica FILM</h1>
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
    <th>titolo</th>
    <th>descr</th>
    <th>poster</th>
    <th>supervideo</th>
    <th>speedvideo</th>
    <th>verystream</th>
	<th>mixdrop</th>
	<th>gounlimited</th>
    <th></th>
  </tr>
	
<?php $query="SELECT * FROM film ORDER BY id DESC";
	  $results = mysqli_query($db, $query);
			if (mysqli_num_rows($results) > 0) {
				while($row = mysqli_fetch_assoc($results)) {
					$selepid = $row['id'];
					echo "  <tr>
    <td><b>".$row['id']."</b></td>
    <td>".$row['titolo']."</td>
    <td>".substr($row["descr"], 0, 50)."</td>
    <td>".$row['poster']."</td>
    <td>".$row['link']."</td>
    <td>".$row['linksv']."</td>
	<td>".$row['linkverys']."</td>
    <td>".$row['linkmd']."</td>
    <td>".$row['linkgu']."</td>
    <td><a class='button_hover' href='editfilm.php?action=edit&id_film=".$row['id']."'>Modifica</a></td>
  </tr>
					";
				}
			}
?>
</table>
	
<?php elseif ($action=="edit") : ?>
	
	<?php
	$filmid = $_GET['id_film'];
	$query = "SELECT * FROM film WHERE id = $filmid";
	$results = mysqli_query($db, $query);
			if (mysqli_num_rows($results) > 0) {
				while($row = mysqli_fetch_assoc($results)) {
					$titolo = $row['titolo'];
					$descr = $row['descr'];
					$poster = $row['poster'];
					$link = $row['link'];
					$linksv = $row['linksv'];
					$linkverys = $row['linkverys'];
					$linkmd = $row['linkmd'];
					$linkgu = $row['linkgu'];
				}
			}
	?>
	<a class="button_hover" href="editfilm.php?action=view">Indietro</a><br><br><br>
	<form action="editfilm.php?action=view" method="post">
	<input value="<? echo $filmid ?>" name="selfilmid" style="display: none">
	<strong>Titolo</strong> <br><input id='editor2' name="uptitolo" value="<?php echo $titolo ?>"><br><br>
	<strong>Descrizione</strong> <br><input id='editor3' name="updescr" value="<?php echo $descr ?>"><br><br>
	<strong>Poster</strong> <br><input id='editor4' name="upposter" value="<?php echo $poster ?>"><br><br>
	<strong>Link Supervideo</strong> <br><input id='editor5' name="uplink" value="<?php echo $link ?>"><br><br>
	<strong>Link Speed Video</strong> <br><input id='editor6' name="uplinksv" value="<?php echo $linksv ?>"><br><br>
	<strong>Link VeryStream</strong> <br><input id='editor7' name="uplinkvery" value="<?php echo $linkverys ?>"><br><br>
	<strong>Link MixDrop</strong> <br><input id='editor6' name="uplinkmd" value="<?php echo $linkmd ?>"><br><br>
	<strong>Link GoUnl</strong> <br><input id='editor6' name="uplinkgu" value="<?php echo $linkgu ?>"><br><br><br>
	
	<button type="submit" name="aggiornafilm" value="Salva">Salva</button>
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