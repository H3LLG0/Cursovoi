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
        $duration = $_POST['producer'];

        $sql = "UPDATE `films` SET `title` = '$title' `description` = '$opis' `type` = '$junr' `producer` = '$producer' `year` = '$year' `duration` = '$duration' WHERE `films`.`id` = 1";

        $query = $con->prepare($sql);

        $query->execute();
        $massage = json_encode(array(
            'massage'=>'обновлён'
        ),JSON_UNESCAPED_UNICODE);
        print_r($massage);
    }
?>