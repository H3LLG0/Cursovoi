<?php
    session_start();
    if(!isset($_SESSION['token']))
    {
        header('location: http://Videosalon');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Администрирование</title>
    <script src="/app/scripts/requests/jquery-3.7.1.min.js"></script>
</head>
<body>
<header>
        <nav class="navbar">
            <ul class="menu">
                <li><a href="/app/views/main.php">ФИЛЬМЫ</a></li>
                <li><a href="/app/views/about.php">О НАС</a></li>
                <li><a href="/app/views/contact.php">КОНТАКТЫ</a></li>
            </ul>
        </nav>
    </header>
    <script>
        $(window).on('load',function()
        {
            $.ajax({
                url:'http://Videosalon/api/object/user.php',
                method:'get',
                dataType:'json',
                success: function(data)
                {
                    if(data.role == 'admin')
                    {
                        $('.menu').append(`<li><a href="administrate.php">АДМИНИСТРИРОВАНИЕ</a></li>`);
                    }
                    $('.menu').append(`<li><a class="profile-punkt" href="/app/views/profile.php">${data.name}</a></li>`);
                }
            });
        });
    </script>
    <div class="administrate-panel">
        <div class="user-operation">
            <h2>Действия с пользователями</h2>
            <a href="allusers.php">просмотреть список пользователей</a>
        </div>
        <div class="film-operation">
            <h2>Библиотека фильмов</h2>
            <ul>
                <li><a href="allfilms.php">просмотреть список фильмов</a></li>
                <li><a href="createfilm.php">добавить фильм</a></li>
            </ul>
        </div>
        <div class="massages">
            <h2>Сообщения</h2>
            <a href="massages.php">просмотреть сообщения</a>
        </div>
    </div>
</body>
</html>