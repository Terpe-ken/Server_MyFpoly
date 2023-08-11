<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once("../database/connection.php");
    try{
        $cosos = $dbConn->query("SELECT `id`, `name` FROM `coso`");
        if($cosos->rowCount() > 0) {
        $allcoso = $cosos->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array(
            "status" => true,
            "allcoso" => $allcoso,
        ));
        }
    } catch(Exception $e){
        echo json_encode(array(
            "status"=>false,
        ));
    }
?>