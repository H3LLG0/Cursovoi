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

    $post = file_get_contents('php://input');

    $data = json_decode($post,true);

    $user->name = $data['name'];
    $user->lastname = $data['lastname'];
    $user->login = $data['login'];
    $user->pas = $data['pas'];
    $user->id_type_user = $data['id_type_user'];

    if ($user-> regster()) {
        http_response_code(201);
        echo json_encode(array("message" => "пользователь зарегистрирован"), JSON_UNESCAPED_UNICODE);
    }
    else {
        http_response_code(503);
        echo json_encode(array("message" => "неудалось зарегистрироваться"), JSON_UNESCAPED_UNICODE);
    }
?>