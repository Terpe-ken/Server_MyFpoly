<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once("../database/connection.php");
    try{
        $body = json_decode(file_get_contents("php://input"));
        $em = $body->username;
        if(strlen($em)==0){
            echo json_encode(
                array(
                    "status" => false,
                )
            );
        } else {
            $user = $dbConn->query("SELECT `id`,`username`,`avata` FROM `users` where username = '$em'");
            if($user->rowCount() > 0) {
                $row = $user->fetch(PDO::FETCH_ASSOC);
                $id = $row['id'];
                $username = $row['username'];
                $avata = $row['avata'];
                echo json_encode(array(
                    "status" => true,
                    "id" => $id,
                    "username" => $username,
                    "avata" => $avata,
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
