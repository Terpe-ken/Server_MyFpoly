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
        if(strlen($id)==0){
            echo json_encode(
                array(
                    "status" => false,
                )
            );
        } else {
            $lichhoc = $dbConn->query("SELECT l.id, c.name as courseid, l.ca, l.address, c.teacher as teacher, date FROM lichhoc l INNER JOIN course c WHERE l.courseid = c.id and l.id IN(SELECT idlichhoc from lichhocnn WHERE iduser  = $id)");
            if($lichhoc->rowCount() > 0) {
                $alllichhoc = $lichhoc->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode(array(
                    "status" => true,
                    "alllichhoc" => $alllichhoc,
                ));
            } else {
                echo json_encode(array(
                    "status" => false,
                ));
            }
        }
    } catch(Exception $e){
        echo json_encode(array(
            "status"=>false,
        ));
    }
?>