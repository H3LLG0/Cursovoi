let users;
let userCheck;
function getAllUsers()
{
    $.ajax({
        url:'http://videosalon/api/entity/readAllUsers.php',
        method: 'get',
        datatype: 'json',
        success: function(usersdata)
        {
            console.log(usersdata);
            // users = usersdata;
        }
    });
}

export let register = () =>
{
    $('#register-btn').on('click',function()
    {
        $('main').empty();
        $('main').append(`<div class="register">
                                <form id='register-form'>
                                    <div class='register-form'>
                                        <input type='hidden' value='user' name='role'>
                                        <label id='register-name'>Введите имя</label><br>
                                        <input type='text' placeholder='имя' required name='name'><br>
                                        <label>Введите фамилию</label><br>
                                        <input type='text' placeholder='фамилия' required name='surname'><br>
                                        <label>Введите email</label><br>
                                        <input type='email' placeholder='email' required name='email'><br>
                                        <label>Введите пароль</label><br>
                                        <input type='password' placeholder='пароль' required name='password'><br>
                                        <label>Повторите пароль</label><br>
                                        <input type='password' placeholder='пароль' required name='Сonfpassword'><br>
                                        <button type='submit'>Зарегистрироваться</button>
                                    </div>
                                </form>
                                <div class='error'></div>
                            </div>`);
        $('#register-form').on('submit',function()
        {
            getAllUsers();
            event.preventDefault();
            let dataform = $(this).serialize();
            users.forEach(entry,function()
            {
                if(dataform.email == entry.email)
                {
                    userCheck = false;
                }
            });
            if(userCheck == false)
            {
                $('.error').append(`Пользователь с таким Email уже существует`);
            }
            else
            {
                if(dataform.password == dataform.confpassword)
                {
                    $.ajax({
                        url:'http://videosalon/api/session/register.php',
                        method:'post',
                        datatype:'json',
                        data:dataform,
                        success: function(data)
                        {
                            if(data.auth == 'success')
                            {
                                location.reload(true);
                            }
                        }
                    });
                }
                else
                {
                    $('.error').append(`Пароли не совпадают`);
                }
            }
        });

    });
}