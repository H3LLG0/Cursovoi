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
        $film->title = $_POST['title'];
        $film->producer = $_POST['producer'];
        $film->description = $_POST['description'];
        $film->rentprice = $_POST['rentprice'];
        $film->buyprice = $_POST['buyprice'];

        if ($_FILES && $_FILES["poster"]["error"]== UPLOAD_ERR_OK)
        {
            $poster = $_FILES['poster']['name'];
            $film->poster = $poster;
            $name = "../../app/images/posters/$poster";
            move_uploaded_file($_FILES["poster"]["tmp_name"], $name);
            if ($film-> UpdateFilmWithPoster()) {
                http_response_code(201);
                echo json_encode(array("message" => "изменения сохранены"), JSON_UNESCAPED_UNICODE);
            }
            else {
                http_response_code(503);
        
                echo json_encode(array("message" => "Невозможно сохранить изменения."), JSON_UNESCAPED_UNICODE);
            }
        }
        else
        {
            if ($film-> UpdateFilm()) {
                http_response_code(201);
                echo json_encode(array("message" => "изменения сохранены"), JSON_UNESCAPED_UNICODE);
            }
            else {
                http_response_code(503);
        
                echo json_encode(array("message" => "Невозможно сохранить изменения."), JSON_UNESCAPED_UNICODE);
            }
        }
?>