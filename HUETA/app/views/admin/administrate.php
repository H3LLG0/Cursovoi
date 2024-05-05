<?php
    session_start();
    if(!isset($_SESSION['token']))
    {
        header('location: http://hueta');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="/app/scripts/requests/jquery-3.7.1.min.js"></script>
</head>
<body>
<header>
        <nav class="navbar">
            <ul class="menu">
                <li><a href="/app/views/main.php">ФИЛЬМЫ</a></li>
                <li><a href="/app/views/promo.php">АКЦИИ</a></li>
                <li><a href="/app/views/about.php">О НАС</a></li>
                <li><a href="/app/views/contact.php">КОНТАКТЫ</a></li>
            </ul>
        </nav>
    </header>
    <script>
        $(window).on('load',function()
        {
            $.ajax({
                url:'http://hueta/api/object/user.php',
                method:'get',
                dataType:'json',
                success: function(data)
                {
                    if(data.role == 'admin')
                    {
                        $('.menu').append(`<li><a href="admin/administrate.php">АДМИНИСТРИРОВАНИЕ</a></li>`);
                    }
                    $('.menu').append(`<li><a class="profile-punkt" href="/app/views/profile.php">${data.name}</a></li>`);
                }
            });
        });
    </script>
    тут АДМИНИСТРИРОВАНИЕ
</body>
</html>