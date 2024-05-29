<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    header("Access-Control-Allow-Methods: POST");

    include '../config/database.php';
    include '../object/film.php';

    $database = new Database();
    $db = $database->getConnection();
    $film = new Film($db);

    $film->id = $_POST['id'];

    if ($film-> DeleteFilm()) {
        http_response_code(201);
        echo json_encode(array("message" => "фильм удалён"), JSON_UNESCAPED_UNICODE);
    }
    else {
        http_response_code(503);

        echo json_encode(array("message" => "фильм не удалён"), JSON_UNESCAPED_UNICODE);
    }
?>