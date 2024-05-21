<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include '../config/database.php';
    include '../object/film.php';

    $database = new Database();
    $db = $database->getConnection();
    $users = new Film($db);

    $result = $users->readFilms();
    $num = sizeof($result);

    if ($num > 0) {
        http_response_code(200);
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
    }
    else {
        http_response_code(404);
        echo json_encode(array("message" => "пользователи не найдены."), JSON_UNESCAPED_UNICODE);
    }
?>