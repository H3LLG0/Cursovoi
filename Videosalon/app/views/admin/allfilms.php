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
                        $('.allfilms').append(`<div class='film-container'>
                                                Название: ${entry.title}<br>
                                                Описание: ${entry.description}<br>
                                                Жанр: ${entry.type}<br>
                                                Режиссёр: ${entry.year}<br>
                                                Продолжительность: ${entry.duration}<br>
                                                <img class src="${entry.picture}" alt="poster${entry.id}">
                                                <button id='delete${entry.id}'>удалить</button><br>
                                            </div>`);
                                        let film_id = {
                                           'id': entry.id
                                        };
                        // $(`#update${entry.id}`).on('click', function()
                        // {
                        //     $('.allfilms').empty();
                        //     $('.allfilms').append(`<form id='update-form'>
                        //                             <input name='id' type="hidden" value="${entry.id}">
                        //                             <div class='update-film-container'>
                        //                                 <label for='title'>
                        //                                 Навзвание
                        //                                     <input name='title' type='text' placeholder='название' value='${entry.title}' required minlength="2">
                        //                                 </label><br>
                        //                                 <label for='opis'>
                        //                                 Описание
                        //                                     <input name='opis' placeholder='описание' required minlength="2" value="${entry.description}">
                        //                                 </label><br>
                        //                                 <label for='junr'>
                        //                                 Жанр
                        //                                     <input name='junr' type='text' placeholder='жанр' value='${entry.type}' required minlength="2">
                        //                                 </label><br>
                        //                                 <label for='producer'>
                        //                                 Режиссёр
                        //                                     <input name='producer' type='text' placeholder='жанр' value='${entry.producer}' required minlength="2">
                        //                                 </label><br>
                        //                                 <label for='year'>
                        //                                 Год выпуска
                        //                                     <input name='year' type='year' placeholder='жанр' value='${entry.year}' required minlength="2">
                        //                                 </label><br>
                        //                                 <label for='duration'>
                        //                                 Продолжительность фильма
                        //                                     <input name='duration' type='time' placeholder='жанр' value='${entry.duration}' required minlength="2">
                        //                                 </label><br>
                        //                             </div>
                        //                             <button type='submit'>сохранить</button>
                        //                         </form>`);
                        //                     $('#update-form').on('submit',function()
                        //                 {
                        //                     event.preventDefault();
                        //                     let dataform = $(this).serialize();
                                            // $.ajax({
                                            //     url:'http://videosalon/api/object/adminupdateallfilms.php',
                                            //     method:'post',
                                            //     dataType:'json',
                                            //     data: dataform,
                                            //     success: function(data)
                                            //     {
                                            //         // location.reload(true);
                                            //     }
                                            // });
                        //                 });
                        // });
                        $(`#delete${entry.id}`).on('click', function(){
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