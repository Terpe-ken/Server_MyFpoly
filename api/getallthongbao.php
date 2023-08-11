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
            $thongbaos = $dbConn->query("SELECT `id`, `title`, `content`, `date`, `iduser` FROM `thongbao` WHERE iduser = $id");
            if($thongbaos->rowCount() > 0) {
                $allthongbao = $thongbaos->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode(array(
                    "status" => true,
                    "allthongbao" => $allthongbao,
                ));
            } else {
                echo json_encode(array(
                    "status" => false,
                ));
            }
        }
    } catch(Exception $e){
        echo json_encode(array(
            "status"=>false + 2,
        ));
    }
?>