<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    session_start();
    if(!empty($_SESSION))
    {
        http_response_code(200);
        echo json_encode($_SESSION['user'],JSON_UNESCAPED_UNICODE);
    }
    else
    {
        echo json_encode(array('status'=>'unauthorised'),JSON_UNESCAPED_UNICODE);
    }
?>