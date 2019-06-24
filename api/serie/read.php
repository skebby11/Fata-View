<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


// include database.php and episodio.php in order to use them
include_once '../config/database.php';
include_once '../models/serie.php';
// create a new DB object and connect to our DB
$database = new Database();
$db = $database->getConnection();
// Create a new Episode object
$serie = new Serie($db);
// Query products
$stmt = $serie->read();
$num = $stmt->rowCount();
// If we find any episode 
if($num>0){
    // array di episodi
    $serie_arr = array();
    $serie_arr["records"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $serie_item = array(
            "id" => $id,
            "nome" => $nome,
            "descr" => $descr,
            "poster" => $poster,
            "stagioni" => $stagioni
        );
        array_push($serie_arr["records"], $serie_item);
    }
    echo json_encode($serie_arr);
}else{
    echo json_encode(
        array("message" => "Nessuna serie trovata.")
    );
}
?>