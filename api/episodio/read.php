<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


// include database.php and episodio.php in order to use them
include_once '../config/database.php';
include_once '../models/episodio.php';
// create a new DB object and connect to our DB
$database = new Database();
$db = $database->getConnection();
// Create a new Episode object
$ep = new Episodio($db);
// Query products
$stmt = $ep->read();
$num = $stmt->rowCount();
// If we find any episode 
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