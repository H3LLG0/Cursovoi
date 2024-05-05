<?php
    header('Content-Type: application/json');
    include '../core/conectDB.php';
    session_start();
    print_r($_SESSION['user_data']);
?>