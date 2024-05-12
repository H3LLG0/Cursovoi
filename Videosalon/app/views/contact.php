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
    <title>Контакты</title>
    <script src="../scripts/requests/jquery-3.7.1.min.js"></script>
</head>
<body>
    <header>
        <nav class="navbar">
            <ul class="menu">
                <li><a href="main.php">ФИЛЬМЫ</a></li>
                <li><a href="about.php">О НАС</a></li>
                <li><a href="contact.php">КОНТАКТЫ</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="contact">
            <form class="contact-form" id="massage-form">
                <div class="form-container">
                    <label for="title">
                        Тема сообщения<br>
                        <input type="text" name="title" required>
                    </label><br>
                    <label for="massage">
                        Текст сообщения<br>
                        <textarea name="massage" required></textarea>
                    </label><br>
                    <button type="submit">отправить</button>
                </div>
            </form>
            <div class="result">

            </div>
        </div>
    </main>
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
                        $('.menu').append(`<li><a href="admin/administrate.php">АДМИНИСТРИРОВАНИЕ</a></li>`);
                    }
                    $('.menu').append(`<li><a class="profile-punkt" href="profile.php">${data.name}</a></li>`);
                }
            });
        });
        $('#massage-form').on('submit',function()
        {
            event.preventDefault();
            let dataform = $(this).serialize();
            $.ajax({
                url:'http://Videosalon/api/object/sendmassage.php',
                method: 'post',
                dataType: 'json',
                data:dataform,
                success: function(data)
                {
                    $('#massage-form').trigger("reset");
                    $('.result').append(`${data.massage}`);
                }
            });
        });
    </script>
    <footer>
    </footer>
</body>
</html>