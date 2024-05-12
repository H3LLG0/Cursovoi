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
    <title>все фильмы</title>
    <script src="/app/scripts/requests/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js" type="text/javascript"></script>
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
        <div class="create-form">
            <form id='create-film-form'>
                <label for="title">
                    Введите название фильма<br>
                    <input type="text" name="title" required placeholder="название">
                </label><br>
                <label for="description">
                    Описание фильма<br>
                    <input type="text" name="description" required placeholder="описание">
                </label><br>
                <label for="type">
                    Жанр<br>
                    <input type="text" name="type" required placeholder="жанр">
                </label><br>
                <label for="producer">
                    Режиссёр<br>
                    <input type="text" name="producer" required placeholder="режиссёр">
                </label><br>
                <label for="year">
                    Год выпуска<br>
                    <input type="text" placeholder="дата выпуска" required name="year">
                </label><br>
                <label for="duration">
                    Продолжительность фильма<br>
                    <input name="duration" type="text" id='duration-form'>
                </label><br>
                <label for="poster">
                    Постер<br>
                    <input type="file" name="poster" required>
                </label><br>
                <button type="submit">Создать</button>
            </form>
        </div>
    </main>
    <script>
        $('#duration-form').mask('9:99:99');
    </script>
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
        var files;
        $('input[type=file]').on('change', function(){
	        files = this.files;
        });
        $('#create-film-form').on('submit',function()
        {
            event.preventDefault();
            var $that = $(this),
            formData = new FormData($that.get(0));

            $.ajax({
                url: 'http://videosalon/api/object/admincreatefilm.php',
                method: 'post',
                contentType: false,
                processData: false,
                data: formData,
                success: function(data)
                {
                    console.log(data);
                    $('#create-film-form').trigger("reset");
                    location.reload(true);
                }
            });
        });
    </script>
</body>
</html>