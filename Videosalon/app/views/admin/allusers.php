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
    <title>Список всех пользователей</title>
    <script src="/app/scripts/requests/jquery-3.7.1.min.js"></script>
</head>
<body>
<nav class="navbar">
            <ul class="menu">
                <li><a href="/app/views/main.php">ФИЛЬМЫ</a></li>
                <li><a href="/app/views/about.php">О НАС</a></li>
                <li><a href="/app/views/contact.php">КОНТАКТЫ</a></li>
            </ul>
        </nav>
    </header>
    <script>
        let current_user;
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
                    current_user = data;
                }
            });
        });
        $(window).on('load',function()
    {
        $.ajax({
            url: 'http://Videosalon/api/object/adminreadallusers.php',
            method: 'get',
            dataType: 'json',
            success: function(data)
            {
                data.forEach(function(entry)
            {
                $('.users-container').append(`<div class='user-container'>
                                                Имя: ${entry.name}<br>
                                                Фамилия: ${entry.surname}<br>
                                                Email: ${entry.email}<br>
                                                роль: ${entry.role}<br>
                                                <button id='delete${entry.id}'>удалить</button><br>
                                                <button id='uptoadmin${entry.id}'>сделать администратором</button><br>
                                                <span id="error${entry.id}" class='error'></span>
                                                <span id="success${entry.id}"></span>
                                            </div>`);
                    let user = {
                        'id':entry.id,
                        'name':entry.name,
                        'surname':entry.surname,
                        'email':entry.email,
                        'role':entry.role
                    };
                $(`#delete${entry.id}`).on('click',function()
                {
                        $.ajax({
                        url:'http://Videosalon/api/object/admindeleteuser.php',
                        method:'post',
                        dataType:'json',
                        data: user,
                        success: function(data)
                        {
                            location.reload(true);
                        }
                    });
                });
                $(`#uptoadmin${entry.id}`).on('click',function()
                {
                        $.ajax({
                        url:'http://Videosalon/api/object/adminuptoadminuser.php',
                        method:'post',
                        dataType:'json',
                        data: user,
                        success: function(data)
                        {
                            location.reload(true);
                        }
                    });
                });
            });
            }
        });
    });
    </script>
    <div class="users-container">
    </div>
</body>
</html>