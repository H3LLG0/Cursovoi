<?php

use function PHPSTORM_META\type;

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    header("Access-Control-Allow-Methods: POST");

    include '../config/database.php';
    include '../object/rent.php';

    $database = new Database();
    $db = $database->getConnection();
    $rent = new Rent($db);

    if(!empty($_POST['client']) && !empty($_POST['product']) && !empty($_POST['term']) && !empty($_POST['price']))
    {
        $rent->client = (int)$_POST['client'];
        $rent->product = (int)$_POST['product'];
        $rent->term = (int)$_POST['term'];
        $rent->price = (int)$_POST['price'];
        
        if ($rent-> RentFilm()) {
            http_response_code(201);
            echo json_encode(array("message" => "Фильм арендован"), JSON_UNESCAPED_UNICODE);
        }
        else {
            http_response_code(503);
    
            echo json_encode(array("message" => "Аренда не успешна"), JSON_UNESCAPED_UNICODE);
        }
    }
    else
    {
        http_response_code(400);
        
            echo json_encode(array("message" => "Неизвестная ошибка :/"), JSON_UNESCAPED_UNICODE);
    }

?>