<?php
    header('Content-Type: application/json');
    include '../core/conectDB.php';
    session_start();
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $role = $_POST['role'];

        $sql = "UPDATE users SET `role` = 'admin' WHERE id = $id";

        $query = $con->prepare($sql);

        $query->execute();
        $massage = json_encode(array(
            'massage'=>'обновлён'
        ),JSON_UNESCAPED_UNICODE);
        print_r($massage);
    }
?>