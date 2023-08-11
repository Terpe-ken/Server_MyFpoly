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
            $user = $dbConn->query("SELECT `username`, `name`, `avata`, `token` FROM `users` WHERE id=$id");
            if($user->rowCount()<=0){
                echo json_encode(array(
                    "status" => false,
                ));
            }
            if($user->rowCount() > 0) {
                $row = $user->fetch(PDO::FETCH_ASSOC);
                $id = $row['id']; 
                $username = $row['username'];
                $avata = $row['avata'];
                $token = $row['token'];
                echo json_encode(array(
                    "id" => $id,
                    "username" => $username,
                    "avata" => $avata,
                    "token" => $token,
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