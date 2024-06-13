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
    $err;

    if (!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['role']))
        {
            $users->name = $_POST['name'];
            $users->surname = $_POST['surname'];
            $users->email = $_POST['email'];
            $users->password = $_POST['password'];
            $users->role = $_POST['role'];
            $confpass = $_POST['confpassword'];

            $result = $users->readUser();

            foreach($result as $row)
            {
                if($row['email'] == $_POST['email'])
                {
                    $err = true;
                }
            }

            if(empty($err))
            {
                if($_POST['password'] == $_POST['confpassword'])
                {
                    if ($users-> registerUser()) {
                        http_response_code(201);
                        echo json_encode(array("message" => "success"), JSON_UNESCAPED_UNICODE);
                    }
                    else {
                        http_response_code(503);
                
                        echo json_encode(array("message" => "Невозможно зарегистрироваться."), JSON_UNESCAPED_UNICODE);
                    }
                }
                else
                {
                    echo json_encode(array("message" => "Невозможно зарегистрироваться, пароли не совпадают."), JSON_UNESCAPED_UNICODE);
                }
            }
            else
            {
                echo json_encode(array("message" => "Пользователь с таким email уже существует."), JSON_UNESCAPED_UNICODE);
            }
        }
        else {
            http_response_code(400);
        
            echo json_encode(array("message" => "Невозможно зарегистрироваться. Данные неполные."), JSON_UNESCAPED_UNICODE);
    }

?>