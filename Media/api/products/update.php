<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once "C:/ospanel/domains/Media/api/config/database.php";
    include_once "C:/ospanel/domains/Media/api/objects/number.php";


    $database = new Database();
    $db = $database->getConnection();
    $product = new Number($db);
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->name) && !empty($data->area) && !empty($data->size) && !empty($data->price))
        {
         // устанавливаем значения свойств Номера
            $product->name = $data->name;
            $product->area = $data->area;
            $product->size = $data->size;
            $product->price = $data->price;

            if ($product->update()) {
                // установим код ответа - 201 создано
                http_response_code(201);
        
                // сообщим пользователю
                echo json_encode(array("message" => "Номер был создан."), JSON_UNESCAPED_UNICODE);
            }
            // если не удается создать Номер, сообщим пользователю
            else {
                // установим код ответа - 503 сервис недоступен
                http_response_code(503);
        
                // сообщим пользователю
                echo json_encode(array("message" => "Невозможно создать Номер."), JSON_UNESCAPED_UNICODE);
            }
        }
        // сообщим пользователю что данные неполные
        else {
            // установим код ответа - 400 неверный запрос
            http_response_code(400);
        
            // сообщим пользователю
            echo json_encode(array("message" => "Невозможно создать Номер. Данные неполные."), JSON_UNESCAPED_UNICODE);
        }
?>