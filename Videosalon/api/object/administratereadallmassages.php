<?php
    header('Content-Type: application/json');
    include '../core/conectDB.php';
    session_start();
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
    {
        $sql = "SELECT users.id, users.name, users.surname, users.email, massage.id_msg, massage.title, massage.massage, massage.status FROM massage, users
        WHERE users.id = massage.user
        ORDER BY massage.status desc";

        $query = $con->prepare($sql);
                
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        print_r(json_encode($result,JSON_UNESCAPED_UNICODE));
    }
?>