<?php
    header('Content-Type: application/json');
    include '../core/conectDB.php';
    session_start();
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
    {
        $id = $_POST['id_msg'];

        $sql = "UPDATE massage SET `status` = 'read' WHERE id_msg = $id";

        $query = $con->prepare($sql);

        $query->execute();
        $massage = json_encode(array(
            'massage'=>'сообщение прочитано'
        ),JSON_UNESCAPED_UNICODE);
        print_r($massage);
    }
?>