
<?php

include('../functions.php');

$idutente = $_SESSION['user']['id'];

if ($_SESSION['user']['user_type'] != 'admin' ) {
	header('location: /login');
}

$action = $_GET["action"];


if (count($errors) == 0) {
$query = "INSERT INTO episodi (stagione, episodio, serie, titolo, link, linksv, linkmd, linkgu, fataplayer) 
						  VALUES('$stagione', '$episodio', '$idserie', '$titolo', '$link', '$linksv', '$linkmd', '$linkgu', '0')";
//mysqli_query($db, $query); 

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
	
	$uplinkfata = e($_POST['uplinkfata']);
	
		 if (!empty($uplinkfata)) {
	
			$unique = bin2hex(openssl_random_pseudo_bytes(4));
			
			$query1 = "UPDATE episodi SET stagione = " . $upstagione . ", episodio = '$upepisodio', serie = ".$_POST['upserie']." , titolo = '$uptitolo', link = '".$_POST['uplink']."', linksv = '$uplinksv', linkmd = '$uplinkmd', linkgu = '$uplinkgu', fataplayer = '$unique' WHERE id = $selepid";
								mysqli_query($db, $query1);

			$query2 = "INSERT INTO fataplayer (id, fpmp4, fpposter, fpwebm)
									  VALUES('$unique', '$uplinkfata', '$upfataposter', '')";
								mysqli_query($db, $query2); 
			 
		} elseif (empty($uplinkfata))  {

			$query = "UPDATE episodi SET stagione = " . $upstagione . ", episodio = '$upepisodio', serie = '$upserie' , titolo = '$uptitolo', link = '".$_POST['uplink']."', linksv = '$uplinksv', linkmd = '$uplinkmd', linkgu = '$uplinkgu', fataplayer = '' WHERE id = $selepid";
			mysqli_query($db, $query); 
		}
	
	$_SESSION['success']  = "Episodio aggiornato";
}



// DELETE EPISODES

if(isset($_POST['deleteep_btn'])){
	
	  $eptodel = e($_POST['eptodel']);
	
          $query = "DELETE FROM `episodi` WHERE `id` = $eptodel";
          mysqli_query($db, $query);
}

?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	
    <link rel="stylesheet" href="assets/chosen/docsupport/style.css">
	<link rel="stylesheet" type="text/css" href="css/admin.css?0.004">
	
    <link rel="stylesheet" href="assets/chosen/docsupport/prism.css">
    <link rel="stylesheet" href="assets/chosen/chosen.css">
	
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<title>Aggiungi episodio</title>
	
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
<h2>Lista episodi</h2>

<table>
  <tr>
    <th><strong>ID</strong></th>
    <th><strong>STAGIONE</strong></th>
    <th><strong>EPISODIO</strong></th>
    <th><strong>SERIE</strong></th>
    <th><strong>TITOLO</strong></th>
    <th><strong>SUPERVIDEO</strong></th>
    <th><strong>SPEEDVIDEO</strong></th>
    <th><strong>FATA</strong></th>
	<th><strong>MIXDROP</strong></th>
	<th><strong>GOUNL</strong></th>
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
	<!--<form action="editep.php?action=view" method="post">-->
	<form action="https://fatastreaming2.altervista.org/admin/editep.php?action=edit&id_ep=531" method="post">
	<input value="<?php echo $epid ?>" name="selepid" style="display: none">
	<strong>Stagione</strong> <br><input id='editor1' name="upstagione" value="<?php echo $stagione ?>"><br><br>
	<strong>Episodio</strong> <br><input id='editor2' name="upepisodio" value="<?php echo $episodio ?>"><br><br>
	<strong>Serie</strong> <br> <input name="upserie" value="<?php echo $serie ?>"><br><br>
	<strong>Titolo</strong> <br><input  name="uptitolo" value="<?php echo $titolo ?>"><br><br>
	<strong>Link Supervideo</strong> <br><input id='editor5' name="uplink" value="<?php echo $link ?>"><br><br>
	<strong>Link Speed Video</strong> <br><input id='editor6' name="uplinksv" value="<?php echo $linksv ?>"><br><br>
	<strong>Link MixDrop</strong> <br><input id='editor8' name="uplinkmd" value="<?php echo $linkmd ?>"><br><br>
	<strong>Link GoUnl</strong> <br><input id='editor9' name="uplinkgu" value="<?php echo $linkgu ?>"><br><br>
	<strong>Link Fata MP4</strong> <br><input name="uplinkfata" value="<?php echo $fataplayer ?>"><br><br><br>
	
	<button type="submit" name="aggiornaep" value="Salva">Salva</button>
	</form>
	
	<form action="editep.php?action=view" method="post">
	
		<input type="hidden" value="<?php echo $epid ?>" name="eptodel">
		<input type="submit" class="delete-serie-btn" name="deleteep_btn" value="Elimina Episodio">
		
	</form>
	
<?php endif ?>
	
	
</div>
</div>
</div>

  <script src="assets/chosen/docsupport/jquery-3.2.1.min.js" type="text/javascript"></script>
  <script src="assets/chosen/chosen.jquery.js" type="text/javascript"></script>
  <script src="assets/chosen/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
  <script src="assets/chosen/docsupport/init.js" type="text/javascript" charset="utf-8"></script>
	
	
</body>