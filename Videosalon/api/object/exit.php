<?php
    header('Content-Type: application/json');
    include '../core/conectDB.php';
    session_start();
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
    {
        $exit = $_POST['exit'];
        if($exit == true)
        {
            $_SESSION['token'] = null;
            $massage = array(
                'massage'=>'выход'
            );
            print_r(json_encode($massage, JSON_UNESCAPED_UNICODE));
        }
    }
?>