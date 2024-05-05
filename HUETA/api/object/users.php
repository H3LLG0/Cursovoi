<?php
    header('Content-Type: application/json');
    include '../core/conectDB.php';

    $massage = json_encode(array(
        "massage"=>"Ошибка: Неверный логин или пароль"
    ),JSON_UNESCAPED_UNICODE);

    $sql = 'SELECT * FROM users';

    $query = $con->prepare($sql);

    $query->execute();

    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
    {
        session_start();
        $email = $_POST['email'];
        $password = $_POST['password'];
        $err = false;

        foreach($result as $row)
        {
            if($row['email'] == $email && $row['password'] == $password)
            {
                $_SESSION['token'] = password_hash(session_id(),PASSWORD_DEFAULT);
                $_SESSION['user_data'] = json_encode(array(
                    'id'=>$row['id'],
                    'name'=>$row['name'],
                    'surname'=>$row['surname'],
                    'email'=>$row['email'],
                    'password'=>$row['password'],
                    'role'=>$row['role']),JSON_UNESCAPED_UNICODE);
                print_r(json_encode(['token'=>"${_SESSION['token']}"]));
                $err = true;
            }
        }
        if($err == false)
        {
            print_r($massage);
        }
        exit;
    }
?>