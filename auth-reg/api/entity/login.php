<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once "../config/database.php";
    include_once "../object/user.php";

    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);

    $result = $user->readUsers();

    $post = file_get_contents('php://input');

    $data = json_decode($post,true);


    if(!empty($data['login']) && !empty($data['pas']))
    {
        foreach($result as $row)
        {
            if($row['login'] == $data['login'] && $row['pas'] == $data['pas'])
            {
                $user->login = $data['login'];
                $user->pas = $data['pas'];
                session_start();
                $_SESSION['user'] = $row;
                $_SESSION['token'] = password_hash($row['pas'],PASSWORD_DEFAULT);
            }
            if(empty($_SESSION))
            {
                http_response_code(404);
                echo json_encode(array('messege'=>'неверный логин или пароль'),JSON_UNESCAPED_UNICODE);
            }
        }
    }
    else
    {
        http_response_code(400);
        echo json_encode(array('messege'=>'поля пусты'),JSON_UNESCAPED_UNICODE);
    }

?>