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
            $lichhoc = $dbConn->query("SELECT l.id, c.name as courseid, l.ca, l.address, l.date FROM lichhoc l INNER JOIN course c WHERE c.id = l.courseid and l.id = $id");
            if($lichhoc->rowCount() > 0) {
                $row = $lichhoc->fetch(PDO::FETCH_ASSOC);
                $id = $row['id'];
                $courseid = $row['courseid'];
                $ca = $row['ca'];
                $address = $row['address'];
                $date = $row['date'];
                echo json_encode(array(
                    "status" => true,
                    "id" => $id,
                    "courseid" => $courseid,
                    "ca" => $ca,
                    "address" => $address,
                    "date" => $date,
                ));
            } else {
                echo json_encode(array(
                    "status" => false+"1",
                ));
            }
        }
    } catch(Exception $e){
        echo json_encode(array(
            "status"=>false+"2",
        ));
    }
?>