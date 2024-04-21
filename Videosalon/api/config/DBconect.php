<?php

    $username = 'root';
    $password = '';


    try
    {
        $con = new PDO('mysql:host=localhost;dbname=videosalonDB',$username,$password);
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
?>