<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../scripts/requests/jquery-3.7.1.min.js"></script>
</head>
<body>
    <div>
        <form id="register-form">
            <div class="register-container">
                <label for="name">
                    Введите имя пользователя
                    <input type="text" placeholder="имя" id="name" name="name">
                </label>
                <label for="surname">
                    Введите фамилию пользователя
                    <input type="text" placeholder="фамилмя" id="surname" name="surname">
                </label>
                <label for="email">
                    Введите email пользователя
                    <input type="email" placeholder="email" id="email" name="email">
                </label>
                <label for="password">
                    Введите пароль пользователя
                    <input type="password" placeholder="пароль" id="password" name="password">
                </label>
                <label for="conf-password">
                    Введите пароль пользователя
                    <input type="password" placeholder="повторите пароль" id="conf-password" name="conf-password">
                </label>
                <input type="hidden" value="user" id="role" name="role">
                <button type="submit">зарегистрироваться</button>
            </div>
        </form>
    </div>
    <script>
         $('#register-form').on('submit',function()
        {
            event.preventDefault();
            let dataform = $(this).serialize();


            $.ajax({
                url:'http://hueta/api/object/register.php',
                method:'post',
                dataType:'json',
                data: dataform,
                success: function(data)
                {
                    console.log(data);
                }
            });
        });
    </script>
</body>
</html>