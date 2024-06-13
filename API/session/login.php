<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include '../config/database.php';
    include '../object/user.php';

    $database = new Database();
    $db = $database->getConnection();
    $users = new User($db);

    $result = $users->readUser();

    $num = sizeof($result);

    if ($num > 0) {
        http_response_code(200);
        $userEmail = $_POST['email'];
        $userPassword = $_POST['password'];
        $errors = true;
        foreach($result as $row)
        {
            if($userEmail == $row['email'] && $userPassword == $row['password'])
            {
                session_start();
                $_SESSION['token'] = password_hash(session_id(),PASSWORD_DEFAULT);
                $_SESSION['user_data'] = json_encode(array(
                    'id'=>$row['id'],
                    'name'=>$row['name'],
                    'surname'=>$row['surname'],
                    'email'=>$row['email'],
                    'password'=>$row['password'],
                    'role'=>$row['role']),JSON_UNESCAPED_UNICODE);
                    $_SESSION['user_id'] = $row['id'];
                    echo json_encode(array("auth" => "success"), JSON_UNESCAPED_UNICODE);
                $errors = false;
            }
        }
        if( $errors == true)
        {
            echo json_encode(array("message" => "Данные не верны."), JSON_UNESCAPED_UNICODE);
        }
    }
    else {
        http_response_code(404);
        echo json_encode(array("message" => "пользователи не найдены."), JSON_UNESCAPED_UNICODE);
    }
?>