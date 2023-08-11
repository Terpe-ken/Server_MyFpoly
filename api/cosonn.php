<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once("../database/connection.php");
    try{
        $body = json_decode(file_get_contents("php://input"));
        $iduser = $body->iduser;
        $idcoso = $body->idcoso;
        if(strlen($iduser)==0 || strlen($idcoso)==0){
            echo json_encode(
                array(
                    "status" => false,
                )
            );
        } else {
            $user = $dbConn->query("SELECT `id`, `iduser`, `idcoso` FROM `cosonn` WHERE iduser = $iduser and idcoso = $idcoso");
            if($user->rowCount()<=0){
                echo json_encode(array(
                    "status" => false,
                ));
            }
            if($user->rowCount() > 0) {
                echo json_encode(array(
                    "status"=> true,
                ));
                
            }
        }
    } catch(Exception $e){
        echo json_encode(array(
            "status"=>false,
        ));
    }
?>