<?php
     header('Content-Type: application/json');
     session_start();
     if(!empty($_SESSION['user_data']))
     {
        echo json_encode($_SESSION['user_data'], JSON_UNESCAPED_UNICODE);
     }
     else
     {
        echo json_encode(array("status" => "unauthorised"), JSON_UNESCAPED_UNICODE);
     }
?>