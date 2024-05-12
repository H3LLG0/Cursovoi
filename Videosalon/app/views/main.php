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
    <title>Video-S0S</title>
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
        <section class="film-types">
            <div class="types-container">
                <h2>Жанры фильмов</h2>
                <ul class="types-list">

                </ul>
            </div>
        </section>
        <section class="all-films">
            <div class="films-container">
            </div>
        </section>
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
                        $('.menu').append(`<li><a href="admin/administrate.php">АДМИНИСТРИРОВАНИЕ</a></li>`);
                    }
                    $('.menu').append(`<li><a class="profile-punkt" href="profile.php">${data.name}</a></li>`);
                }
            });
            $.ajax({
                url: 'http://Videosalon/api/object/readalljunrs.php',
                method:'get',
                dataType:'json',
                success: function(data)
                {
                    let i = 1;
                    data.forEach(function(entry)
                    {
                        $('.types-list').append(`<li><button id='junr${i}'>${entry.type}</button></li>`);
                        $(`#junr${i}`).on('click',function()
                        {
                            const type = {
                                'junr' : entry.type
                            };
                            $.ajax({
                                url: 'http://Videosalon/api/object/readfilmbyjunr.php',
                                method:'post',
                                dataType:'json',
                                data: type,
                                success: function(data)
                                {
                                    $('.films-container').empty();
                                    data.forEach(function(entry)
                                    {
                                        $('.films-container').append(`<div class="film-item">
                                            <div class='poster'>
                                                <img src='../images/posters/${entry.picture}'>
                                            </div>
                                            <div class='item-body'>
                                                <h3>${entry.title}</h3>
                                                Режиссёр: ${entry.producer}<br>
                                                Продолжительность: ${entry.duration}<br>
                                                Год выпуска: ${entry.year}<br>
                                                Жанр: ${entry.type}
                                            </div>
                                        </div>`);
                                    });
                                }
                            });
                        });
                        i++;
                    });
                }
            });
            $.ajax({
                url: 'http://Videosalon/api/object/readallfilms.php',
                method:'get',
                dataType:'json',
                success: function(data)
                {
                    data.forEach(function(entry)
                                    {
                                        $('.films-container').append(`<div class="film-item">
                                            <div class='poster'>
                                                <img src='../images/posters/${entry.picture}'>
                                            </div>
                                            <div class='item-body'>
                                                <h3>${entry.title}</h3>
                                                Режиссёр: ${entry.producer}<br>
                                                Продолжительность: ${entry.duration}<br>
                                                Год выпуска: ${entry.year}<br>
                                                Жанр: ${entry.type}
                                            </div>
                                        </div>`);
                                    });
                }
            });
        });
    </script>
</body>
</html>