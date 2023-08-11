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
            $lichthi = $dbConn->query("SELECT l.id, c.name as idcourse, l.ca, l.address, l.date FROM lichthi l INNER JOIN course c WHERE c.id = l.idcourse and l.id = $id");
            if($lichthi->rowCount() > 0) {
                $row = $lichthi->fetch(PDO::FETCH_ASSOC);
                $id = $row['id'];
                $idcourse = $row['idcourse'];
                $ca = $row['ca'];
                $address = $row['address'];
                $date = $row['date'];
                echo json_encode(array(
                    "status" => true,
                    "id" => $id,
                    "idcourse" => $idcourse,
                    "ca" => $ca,
                    "address" => $address,
                    "date" => $date,
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