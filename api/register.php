<?php
     header("Access-Control-Allow-Origin: *");
     header("Content-Type: application/json; charset=UTF-8");
     header("Access-Control-Allow-Methods: POST");
     header("Access-Control-Max-Age: 3600");
     header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
     
     include_once("../database/connection.php");
     try {
        $body = json_decode(file_get_contents("php://input"));
        $name = $body->name;
        $email = $body->username;
        $avata = $body->avata;
        if(strlen($name)==0) {
            echo json_encode(
                array(
                    "status" => false,
                ));
        }else {
            $users = $dbConn->query("SELECT id, username FROM users WHERE username = '$email'");
            if( $users->rowCount() > 0) {
                echo json_encode(
                    array(
                        "status" => false,
                    ));
            } else {
                $dbConn->query("INSERT INTO `users`( `username`, `name`, `avata`, `token`) VALUES ('$email','$name','$avata','token')");
                echo json_encode(
                    array(
                        "status" => true,
                    ));
            }
        }
     } catch(Exception $e) {
        echo json_encode(
            array(
                "status" => false,
            ));
     }

?>