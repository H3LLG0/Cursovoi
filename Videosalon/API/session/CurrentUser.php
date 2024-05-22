<?php
     header('Content-Type: application/json');
     session_start();
     if(!empty($_SESSION['user_data']))
     {
        echo $_SESSION['user_data'];
     }
     else
     {
        echo json_encode(array("status" => "unauthorised"), JSON_UNESCAPED_UNICODE);
     }
?>