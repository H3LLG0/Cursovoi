<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    header("Access-Control-Allow-Methods: POST");

    include '../config/database.php';
    include '../object/user.php';

    $database = new Database();
    $db = $database->getConnection();
    $users = new User($db);

    if (!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['role']))
        {
            $users->name = $_POST['name'];
            $users->surname = $_POST['surname'];
            $users->email = $_POST['email'];
            $users->password = $_POST['password'];
            $users->role = $_POST['role'];

            if ($users-> registerUser()) {
                http_response_code(201);
        
                echo json_encode(array("message" => "Регистрация успешна."), JSON_UNESCAPED_UNICODE);
            }
            else {
                http_response_code(503);
        
                echo json_encode(array("message" => "Невозможно зарегистрироваться."), JSON_UNESCAPED_UNICODE);
            }
        }
        else {
            http_response_code(400);
        
            echo json_encode(array("message" => "Невозможно зарегистрироваться. Данные неполные."), JSON_UNESCAPED_UNICODE);
    }

?>