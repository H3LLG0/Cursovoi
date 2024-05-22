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
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->name) && !empty($data->surname) && !empty($data->email) && !empty($data->password) && !empty($data->role))
        {
         // устанавливаем значения свойств Номера
            $users->name = $data->name;
            $users->surname = $data->surname;
            $users->email = $data->email;
            $users->password = $data->password;
            $users->role = $data->role;

            if ($users-> registerUser()) {
                // установим код ответа - 201 создано
                http_response_code(201);
        
                // сообщим пользователю
                echo json_encode(array("message" => "Регистрация успешна."), JSON_UNESCAPED_UNICODE);
            }
            // если не удается создать Номер, сообщим пользователю
            else {
                // установим код ответа - 503 сервис недоступен
                http_response_code(503);
        
                // сообщим пользователю
                echo json_encode(array("message" => "Невозможно зарегистрироваться."), JSON_UNESCAPED_UNICODE);
            }
        }
        // сообщим пользователю что данные неполные
        else {
            // установим код ответа - 400 неверный запрос
            http_response_code(400);
        
            // сообщим пользователю
            echo json_encode(array("message" => "Невозможно зарегистрироваться. Данные неполные."), JSON_UNESCAPED_UNICODE);
        }

?>