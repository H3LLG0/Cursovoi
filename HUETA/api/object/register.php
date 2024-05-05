<?php
    header('Content-Type: application/json');
    include '../core/conectDB.php';

    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
    {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confPass = $_POST['conf-password'];
        $role = $_POST['role'];
        $err = false;

        if ($name == '' && $surname== '' && $email == '' && $password  == '' && $confPass == '')
        {
            $massage = array(
                'massage'=>'поля не заполнены'
            );
            print_r(json_encode($massage,JSON_UNESCAPED_UNICODE));
        }
        else
        {
            $sql = 'SELECT email FROM users';

            $query = $con->prepare($sql);
    
            $query->execute();
    
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
    
            foreach($result as $row)
            {
                if($email == $row['email'])
                {
                    $err = true;
                }
            }
            if($err == true)
            {
                $massage = array(
                    'massage'=>'пользователь с таким email уже существует'
                );
                print_r(json_encode($massage,JSON_UNESCAPED_UNICODE));
            }
            else
            {     
                if($password != $confPass)
                {
                    $massage = array(
                        'massage'=>'пароли не совпадают'
                    );
                    print_r(json_encode($massage,JSON_UNESCAPED_UNICODE));
                }
                else
                {
                    $sql = "INSERT INTO `users` (`id`, `name`, `surname`, `email`, `password`, `role`) VALUES (?,?,?,?,?,?);";

                    $query = $con->prepare($sql);
    
                    $query->execute([NULL,$name,$surname,$email,$password,$role]);

                    $massage = array(
                        'massage'=>'Пользователь зарегистрирован'
                    );
                    print_r(json_encode($massage,JSON_UNESCAPED_UNICODE));
                }
            }
        }
        exit;
    }

?>