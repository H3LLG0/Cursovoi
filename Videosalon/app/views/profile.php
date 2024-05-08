<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Проофиль</title>
    <script src="../scripts/requests/jquery-3.7.1.min.js"></script>
</head>
<body>
    <header>
        <nav class="navbar">
            <ul class="menu">
                <li><a href="main.php">ФИЛЬМЫ</a></li>
                <li><a href="promo.php">АКЦИИ</a></li>
                <li><a href="about.php">О НАС</a></li>
                <li><a href="contact.php">КОНТАКТЫ</a></li>
            </ul>
        </nav>
    </header>
    <div class="user">
        <div class="user-data">

        </div>
    </div>
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
                    $('.user').append(`Здравствуйте ${data.name}`);
                }
            });
        });
    </script>
</body>
</html>