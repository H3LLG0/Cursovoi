<?php
    header('Content-Type:application/json');
    include '/ospanel/domains/Videosalon/api/config/DBconect.php';


    $sql = 'SELECT * FROM users';
    
    $query = $con->prepare($sql);

    $query->execute();

    $result = $query ->fetchAll(PDO::FETCH_ASSOC);

    $result_json = json_encode($result,JSON_UNESCAPED_UNICODE);

    print_r($result_json);
?>