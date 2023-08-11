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
            $lichthi = $dbConn->query("SELECT l.id, c.name as courseid, l.ca, l.address, c.teacher as teacher, date FROM lichthi l INNER JOIN course c WHERE l.idcourse = c.id and l.id IN(SELECT idlichthi from lichthinn WHERE iduser = $id)");
            if($lichthi->rowCount() > 0) {
                $alllichthi = $lichthi->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode(array(
                    "status" => true,
                    "alllichthi" => $alllichthi,
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