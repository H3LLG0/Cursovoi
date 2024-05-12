<?php
    header('Content-Type: application/json');
    include '../core/conectDB.php';
    session_start();
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
    {
        $title = $_POST['title'];
        $mass = $_POST['massage'];
        $user = $_SESSION['user_id'];
        $status = 'unread';
        $sql = 'INSERT INTO `massage` (`id_msg`, `user`, `massage`, `title`, `status`) VALUE (?,?,?,?,?);';
        
        $query = $con->prepare($sql);

        $query->execute([NULL,$user,$mass,$title,$status]);
        $massage = json_encode(array(
            'massage'=>'сообщение отправлено'
        ),JSON_UNESCAPED_UNICODE);
        print_r($massage);
    }
?>