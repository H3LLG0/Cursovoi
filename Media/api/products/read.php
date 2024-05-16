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
        // массив товаров
    //     $products_arr = array();
    //     $products_arr["records"] = array();
    
    //     // получаем содержимое нашей таблицы
    //     // fetch() быстрее, чем fetchAll()
    //    foreach($result as $row) {
    //         // извлекаем строку

    //         $product_item = array(
    //             "id" => $row['id'],
    //             "name" => $row['name'],
    //             "area" => $row['area'],
    //             "size" => $row['size'],
    //             "price" => $row['price']
    //         );
    //         array_push($products_arr["records"], $product_item);
    //     }
    
        // устанавливаем код ответа - 200 OK
        http_response_code(200);
    
        // выводим данные о товаре в формате JSON
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
    }

?>