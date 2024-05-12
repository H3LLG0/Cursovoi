<?php
    header('Content-Type: application/json');
    include '../core/conectDB.php';
    session_start();
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
    {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $type = $_POST['type'];
        $producer = $_POST['producer'];
        $year = $_POST['year'];
        $duration = $_POST['duration'];
        $poster = $_FILES['poster']['name'];
        if ($_FILES && $_FILES["poster"]["error"]== UPLOAD_ERR_OK)
        {
            $name = "../../app/images/posters/$poster";
            move_uploaded_file($_FILES["poster"]["tmp_name"], $name);
            $sql = "INSERT INTO `films` (`id`, `title`, `description`, `type`, `producer`, `year`,`duration`, `picture`) VALUES (?,?,?,?,?,?,?,?);";

            $query = $con->prepare($sql);

            $query->execute([NULL,$title,$description,$type,$producer,$year,$duration,$poster]);

            $massage = array(
                'massage'=>'фильм добавлен'
            );
            print_r(json_encode($massage,JSON_UNESCAPED_UNICODE));
        }
    }
?>