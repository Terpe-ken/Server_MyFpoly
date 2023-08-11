<?php
     header("Access-Control-Allow-Origin: *");
     header("Content-Type: application/json; charset=UTF-8");
     header("Access-Control-Allow-Methods: POST");
     header("Access-Control-Max-Age: 3600");
     header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
     
     include_once("../database/connection.php");
     try {
        $body = json_decode(file_get_contents("php://input"));
        $id = $body->id;
        $course = $dbConn->query("SELECT c.id, c.name, c.teacher, t.name as typecourseid FROM course c INNER JOIN typecourse t WHERE c.typecourseid = t.id AND c.id ='$id'");
        if($course->rowCount() > 0) {
            $row = $course->fetch(PDO::FETCH_ASSOC);
            $id = $row['id'];
            $name = $row['name'];
            $teacher = $row['teacher'];
            $typecourseid = $row['typecourseid'];
            echo json_encode(
                array(
                    "status" => true,
                    "id" => $id,
                    "name" => $name,
                    "teacher" => $teacher,
                    "typecourseid" => $typecourseid,
                ));
        } else {
            echo json_encode(
                array(
                    "status" => false,
                ));
        }
     } catch(Exception $e) {
        echo json_encode(
            array(
                "status" => false + $e->getMessage(),
            ));
     }
?>