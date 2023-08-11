<?php
     header("Access-Control-Allow-Origin: *");
     header("Content-Type: application/json; charset=UTF-8");
     header("Access-Control-Allow-Methods: GET");
     header("Access-Control-Max-Age: 3600");
     header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
     
     include_once("../database/connection.php");
     try {
        $course = $dbConn->query("SELECT c.id, c.name, c.teacher, t.name as typecourseid FROM course c INNER JOIN typecourse t where c.typecourseid = t.id");
        
        if($course->rowCount() > 0) {
            $allcourse = $course->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode(
                array(
                    "status" => true,
                    "allcourse" => $allcourse,
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