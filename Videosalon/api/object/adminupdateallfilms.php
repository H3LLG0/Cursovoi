<?php
    header('Content-Type: application/json');
    include '../core/conectDB.php';
    session_start();
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
    {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $opis = $_POST['opis'];
        $junr = $_POST['junr'];
        $producer = $_POST['producer'];
        $year = $_POST['year'];
        $duration = $_POST['duration'];
        if ($_FILES && $_FILES["poster"]["error"]== UPLOAD_ERR_OK)
        {
            $poster = $_FILES['poster']['name'];
            $name = "../../app/images/posters/$poster";
            move_uploaded_file($_FILES["poster"]["tmp_name"], $name);
            $sql = "UPDATE `films` SET `title` = '$title',`description` = '$opis',`type` = '$junr',`producer` = '$producer',`year` = '$year',`duration` = '$duration', `picture` = '$poster' WHERE `id` = $id";

            $query = $con->prepare($sql);
    
            $query->execute();
            $massage = json_encode(array(
                'massage'=>'обновлён'
            ),JSON_UNESCAPED_UNICODE);
            print_r($massage);
        }
        else
        {
            $sql = "UPDATE `films` SET `title` = '$title',`description` = '$opis',`type` = '$junr',`producer` = '$producer',`year` = '$year',`duration` = '$duration' WHERE `id` = $id";

            $query = $con->prepare($sql);
    
            $query->execute();
            $massage = json_encode(array(
                'massage'=>'обновлён'
            ),JSON_UNESCAPED_UNICODE);
            print_r($massage);
        }
    }
?>