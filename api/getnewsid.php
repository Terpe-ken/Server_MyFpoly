<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once("../database/connection.php");
    try{
        $body = json_decode(file_get_contents("php://input"));
        $id = $body->id;
        $news = $dbConn->query("SELECT `id`, `title`, `content`, `date`, `resource` FROM `news` WHERE id=$id");
        if($news->rowCount() <= 0){
            echo json_encode(array(
                "status" => false,
            ));
        } else {
        $row = $news->fetch(PDO::FETCH_ASSOC);
        $id = $row['id']; 
        $title = $row['title'];
        $content = $row['content'];
        $date = $row['date'];
        $resource = $row['resource'];
        echo json_encode(array(
            "status" => true,
            "id" => $id,
            "title" => $title,
            "content" => $content,
            "date" => $date,
            "resource" => $resource,
        ));
        }
    } catch(Exception $e){
        echo json_encode(array(
            "status"=>false,
        ));
    }
?>