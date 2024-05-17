<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include_once "C:/ospanel/domains/Media/api/config/database.php";
    include_once "C:/ospanel/domains/Media/api/objects/number.php";

    $database = new Database();
    $db = $database->getConnection();
    $number = new Number($db);

    $result = $number->read();

    $num = sizeof($result);

    if ($num > 0) {
    
        // устанавливаем код ответа - 200 OK
        http_response_code(200);
    
        // выводим данные о товаре в формате JSON
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
    }
    else {
        // установим код ответа - 404 Не найдено
        http_response_code(404);
    
        // сообщаем пользователю, что товары не найдены
        echo json_encode(array("message" => "номера не найдены."), JSON_UNESCAPED_UNICODE);
    }

?>