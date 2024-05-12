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
    <title>Сообщения пользователей</title>
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
    <main>
        <div class="buttons">
            <button id="unread">непрочитанные</button>
            <button id='read'>прочитанные</button>
        </div>
        <div class="result-container">
            
        </div>
    </main>
    <footer>

    </footer>
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
            $.ajax({
                    url:'http://Videosalon/api/object/administratereadallmassages.php',
                    method: 'get',
                    dataType: 'json',
                    success: function(data)
                    {
                        data.forEach(function(entry)
                        {
                            if(entry.status == 'read')
                            {
                                $('.result-container').append(`<div class='massage'>
                                    <div class='massage-head'>
                                        <h3>${entry.title}</h3>
                                        <div class='user'>
                                            пользователь: ${entry.name} ${entry.surname}
                                            <br>${entry.email}
                                        </div>
                                    </div>
                                    <div class='massage-body'>
                                        <div class='massage-text'>
                                            ${entry.massage}
                                        </div>
                                    </div>
                                `);
                            }
                            else
                            {
                                    $('.result-container').append(`<div class='massage'>
                                        <div class='massage-head'>
                                            <h3>${entry.title}</h3>
                                            <div class='user'>
                                                пользователь: ${entry.name} ${entry.surname}
                                                <br>${entry.email}
                                            </div>
                                        </div>
                                        <div class='massage-body'>
                                            <div class='massage-text'>
                                                ${entry.massage}
                                            </div>
                                            <button id='read${entry.id_msg}'>прочитано</button>
                                        </div>
                                    `);
                                    $(`#read${entry.id_msg}`).on('click', function()
                                {
                                    const data = {
                                        'id_msg':entry.id_msg
                                    };
                                    $.ajax({
                                        url:'http://Videosalon/api/object/adminreadmassage.php',
                                        dataType:'json',
                                        method:'post',
                                        data:data,
                                        success: function(data)
                                        {
                                            console.log(data.massage);
                                            location.reload(true);
                                        }
                                    });
                                });
                            }
                        });
                        $('#unread').on('click',function()
                        {
                            $('.result-container').empty();
                            data.forEach(function(entry){
                                if(entry.status == 'unread')
                                {
                                    $('.result-container').append(`<div class='massage'>
                                        <div class='massage-head'>
                                            <h3>${entry.title}</h3>
                                            <div class='user'>
                                                пользователь: ${entry.name} ${entry.surname}
                                                <br>${entry.email}
                                            </div>
                                        </div>
                                        <div class='massage-body'>
                                            <div class='massage-text'>
                                                ${entry.massage}
                                            </div>
                                            <button id='read${entry.id_msg}'>прочитано</button>
                                        </div>
                                    `);
                                }
                                $(`#read${entry.id_msg}`).on('click', function()
                                {
                                    const data = {
                                        'id_msg':entry.id_msg
                                    };
                                    $.ajax({
                                        url:'http://Videosalon/api/object/adminreadmassage.php',
                                        dataType:'json',
                                        method:'post',
                                        data:data,
                                        success: function(data)
                                        {
                                            console.log(data.massage);
                                            location.reload(true);
                                        }
                                    });
                                });
                            });
                        });
                    $('#read').on('click',function()
                    {
                        $('.result-container').empty();
                        data.forEach(function(entry)
                        {
                            if(entry.status == 'read')
                            {
                                $('.result-container').append(`<div class='massage'>
                                    <div class='massage-head'>
                                        <h3>${entry.title}</h3>
                                        <div class='user'>
                                            пользователь: ${entry.name} ${entry.surname}
                                            <br>${entry.email}
                                        </div>
                                    </div>
                                    <div class='massage-body'>
                                        <div class='massage-text'>
                                            ${entry.massage}
                                        </div>
                                    </div>
                                `);
                            }
                        });
                    });
                }
            });
        });
    </script>
</body>
</html>