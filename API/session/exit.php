<?php
    header('Content-Type: application/json');
    session_start();
    $_SESSION['user_data'] = '';
    session_destroy();
    echo json_encode(array("status" => "unauthorised"), JSON_UNESCAPED_UNICODE);
?>