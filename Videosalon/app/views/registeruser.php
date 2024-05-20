<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Зарегистрироваться в системе</title>
    <script src="../scripts/requests/jquery-3.7.1.min.js"></script>
</head>
<body>
    <div>
        <form id="register-form">
            <div class="register-container">
                <label for="name">
                    Введите имя пользователя<br>
                    <input type="text" placeholder="имя" id="name" name="name" required minlength="2" pattern="^[А-Яа-яЁё]+$" title="Для ввода доступны только русские буквы">
                </label><br>
                <label for="surname">
                    Введите фамилию пользователя<br>
                    <input type="text" placeholder="фамилмя" id="surname" name="surname" required minlength="2" pattern="^[А-Яа-яЁё]+$" title="Для ввода доступны только русские буквы">
                </label><br>
                <label for="email">
                    Введите email пользователя<br>
                    <input type="email" placeholder="email" id="email" name="email" required minlength="3">
                </label><br>
                <label for="password">
                    Введите пароль пользователя<br>
                    <input type="password" placeholder="пароль" id="password" name="password" required minlength="8" pattern="^[A-Za-z0-9]+$">
                </label><br>
                <label for="conf-password">
                    Введите пароль пользователя<br>
                    <input type="password" placeholder="повторите пароль" id="confpassword" name="confpassword" required minlength="8" pattern="^[A-Za-z0-9]+$">
                </label><br>
                <input type="hidden" value="user" id="role" name="role" required>
                <button type="submit">зарегистрироваться</button>
            </div>
        </form>
        <div class="errors">
        </div>
    </div>
    <script>
         $('#register-form').on('submit',function()
        {
            event.preventDefault();
            let dataform = $(this).serialize();
            if(dataform.password == dataform.confpassword)
            {
                $.ajax({
                url:'http://Videosalon/api/object/register.php',
                method:'post',
                dataType:'json',
                data: dataform,
                success: function(data)
                {
                    $('.errors').empty();
                    $('.errors').append(data.massage);
                    if(data.massage == undefuned)
                    {
                        location.href = '/index.html';
                    }
                }
            });
            }
            else
            {
                $('.errors').empty();
                $('.errors').append('пароли не совпадают');
            }
        });
    </script>
</body>
</html>