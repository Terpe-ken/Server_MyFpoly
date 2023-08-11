<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once("../database/connection.php");
    try{
        $news = $dbConn->query("SELECT `id`, `title`, `content`, `date`, `resource` FROM `news`");
        if($news->rowCount() > 0) {
        $allnews = $news->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array(
            "status" => true,
            "allnews" => $allnews,
        ));
        }
    } catch(Exception $e){
        echo json_encode(array(
            "status"=>false,
        ));
    }
?>