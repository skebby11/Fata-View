<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


// includiamo database.php e episodio.php per poterli usare
include_once '../config/database.php';
include_once '../models/episodio.php';
// creiamo un nuovo oggetto Database e ci colleghiamo al nostro database
$database = new Database();
$db = $database->getConnection();
// Creiamo un nuovo oggetto Episodio
$ep = new Episodio($db);
// query products
$stmt = $ep->read();
$num = $stmt->rowCount();
// se vengono trovati episodi nel database
if($num>0){
    // array di episodi
    $episodi_arr = array();
    $episodi_arr["records"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $episodio_item = array(
            "id" => $id,
            "stagione" => $stagione,
            "episodio" => $episodio,
            "serie" => $serie,
            "titolo" => $titolo,
            "link" => $link,
            "linksv" => $linksv
        );
        array_push($episodi_arr["records"], $episodio_item);
    }
    echo json_encode($episodi_arr);
}else{
    echo json_encode(
        array("message" => "Nessun episodio Trovato.")
    );
}
?>