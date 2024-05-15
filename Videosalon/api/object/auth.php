<?php
    header('Content-Type: application/json');
    include '../core/conectDB.php';
    session_start();
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
    {
        if(!isset($_SESSION['token']))
        {
            $status = array(
                'status'=>'unauthorised'
            );
            print_r(json_encode($status,JSON_UNESCAPED_UNICODE));
        }
        else
        {
            $status = array(
                'status'=>'authorised'
            );
            print_r(json_encode($status,JSON_UNESCAPED_UNICODE));
        }
    }
?>