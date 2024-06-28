<?php
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        header("Access-Control-Allow-Methods: POST");
    
        include '../config/database.php';
        include '../object/buy.php';

        $database = new Database();
        $db = $database->getConnection();
        $buy = new Buy($db);


        if(!empty($_POST['client']) && !empty($_POST['product']) && !empty($_POST['price']))
    {
        $buy->client = (int)$_POST['client'];
        $buy->product = (int)$_POST['product'];
        $buy->price = (int)$_POST['price'];
        
        if ($buy-> BuyFilm()) {
            http_response_code(201);
            echo json_encode(array("message" => "Фильм куплен"), JSON_UNESCAPED_UNICODE);
        }
        else {
            http_response_code(503);
    
            echo json_encode(array("message" => "покупка не успешна"), JSON_UNESCAPED_UNICODE);
        }
    }
    else
    {
        http_response_code(400);
        
            echo json_encode(array("message" => "Неизвестная ошибка :/"), JSON_UNESCAPED_UNICODE);
    }


?>