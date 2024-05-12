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
        <div class="allfilms" id="allfilms">
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
                        $('.menu').append(`<li><a href="administrate.php">АДМИНИСТРИРОВАНИЕ</a></li>`);
                    }
                    $('.menu').append(`<li><a class="profile-punkt" href="/app/views/profile.php">${data.name}</a></li>`);

                }
            });
        });
        $(window).on('load',function()
        {
            $.ajax({
                url: 'http://videosalon/api/object/adminreadallfilms.php',
                method: 'get',
                dataType: 'json',
                success: function(data)
                {
                    data.forEach(function(entry)
                    {
                        $('.allfilms').append(`<div class='film-container' id ='film${entry.id}'>
                                                Название: ${entry.title}<br>
                                                Описание: ${entry.description}<br>
                                                Жанр: ${entry.type}<br>
                                                Режиссёр: ${entry.producer}<br>
                                                Продолжительность: ${entry.duration}<br>
                                                Год выпуска ${entry.year}<br>
                                                <img class src="/app/images/posters/${entry.picture}" alt="poster${entry.id}"><br>
                                                <button id='update${entry.id}'>изменить</button><br>
                                                <button id='delete${entry.id}'>удалить</button><br>
                                            </div>`);
                                        let film_id = {
                                           'id': entry.id
                                        };
                        $(`#update${entry.id}`).on('click', function()
                        {
                            $('.allfilms').empty();
                            $('.allfilms').append(`<form id='update-form'>
                                                    <input name='id' type="hidden" value="${entry.id}">
                                                    <div class='update-film-container'>
                                                        <label for='title'>
                                                        Навзвание
                                                            <input name='title' type='text' placeholder='название' value='${entry.title}' required minlength="2">
                                                        </label><br>
                                                        <label for='opis'>
                                                        Описание
                                                            <input name='opis' placeholder='описание' required minlength="2" value="${entry.description}">
                                                        </label><br>
                                                        <label for='junr'>
                                                        Жанр
                                                            <input name='junr' type='text' placeholder='жанр' value='${entry.type}' required minlength="2">
                                                        </label><br>
                                                        <label for='producer'>
                                                        Режиссёр
                                                            <input name='producer' type='text' placeholder='жанр' value='${entry.producer}' required minlength="2">
                                                        </label><br>
                                                        <label for='year'>
                                                        Год выпуска
                                                            <input name='year' type='year' placeholder='жанр' value='${entry.year}' required minlength="2">
                                                        </label><br>
                                                        <label for='duration'>
                                                        Продолжительность фильма
                                                            <input name='duration' type='text' placeholder='жанр' value='${entry.duration}' required minlength="2">
                                                        </label><br>
                                                        <label for="poster">
                                                            Постер<br>
                                                            <img class src="/app/images/posters/${entry.picture}" alt="poster${entry.id}"><br>
                                                            <input type="file" name="poster">
                                                        </label><br>
                                                    </div>
                                                    <button type='submit'>сохранить</button>
                                                </form>`);
                                            $('#update-form').on('submit',function()
                                        {
                                            event.preventDefault();
                                            var $that = $(this),
                                            formData = new FormData($that.get(0));

                                            $.ajax({
                                                url: 'http://videosalon/api/object/adminupdateallfilms.php',
                                                method: 'post',
                                                contentType: false,
                                                processData: false,
                                                data: formData,
                                                success: function(data)
                                                {
                                                    $('form').trigger("reset");
                                                    location.reload(true);
                                                }
                                            });
                                        });
                        });
                        $(`#delete${entry.id}`).on('click', function()
                        {
                            $.ajax({
                                    url:'http://videosalon/api/object/admindelerfilms.php',
                                    method:'post',
                                    dataType:'json',
                                    data: film_id,
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
</body>
</html>