export let guest = () =>
{
            $('header').append(`
                                <nav>
                                    <ul class='menu-list'>
                                        <li><button id='login-btn'>вход</button></li>
                                    </ul>
                                </nav>
                            `);
                            $.ajax({
                                url:'http://videosalon/api/entity/readFilms.php',
                                method:'get',
                                dataType: 'json',
                                success: function(response)
                                {
                                    let i = 0;
                                    $('main').append(`<h2 class='films-ttl'>Все фильмы</h2><div class='all-films'></div>`);
                                    response.forEach(film => {
                                        $('.all-films').append(`<div id='film${i}' class='film-container'>
                                                                    <img src='APP/images/posters/${film.poster}' class='film-picture'>
                                                                    <div class='film-info'>
                                                                        Название: ${film.title}<br>
                                                                        Режиссер: ${film.producer}<br>
                                                                        Описание: ${film.description}<br>
                                                                    </div>
                                                                </div>`);
                                        i++;
                                    });
                                }
                            });
            $('#login-btn').on('click', function()
            {
                $('main').empty();
                $('header').empty();
                $('main').append(`
                                <section class="login">
                                    <div class="login-form-container">
                                        <h3>Добро пожаловать в Video-S0S</h3>
                                        <form id="login">
                                            <div class="login-fields">
                                                <input type="email" placeholder="email" name="email"><br>
                                                <input type="password" placeholder="password" name="password"><br>
                                                <button type="submit" class='login-btn'>войти</button>
                                            </div>
                                            <div class='reg-action'>
                                                Нет аккаунта - <button id='register-btn'>Зарегистрироваться</button>
                                            </div>
                                        </form>
                                        <span class='msg'></span>
                                    </div>
                                </section>
                                `);
                                $('#login').on('submit',function()
                                {
                                    $('.msg').empty();
                                    event.preventDefault();
                                    let dataform = $(this).serialize();
                                    $.ajax({
                                        url:'http://videosalon/api/session/login.php',
                                        method:'post',
                                        datatype:'json',
                                        data:dataform,
                                        success: function(data)
                                        {
                                            if(data.auth == 'success')
                                            {
                                                location.reload(true);
                                            }
                                            else
                                            {
                                                $('.msg').append(`неверный логин или пароль`);
                                            }
                                        }
                                    });
                                });
                                $('#register-btn').on('click',function()
                                {
                                    $('main').empty();
                                    $('main').append(`<section class="register">
                                                        <div class='register-form-container'>
                                                        <h3>Зарегистрируйтесь в системе</h3>
                                                            <form id='register-form'>
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
                                                                    <input type='password' placeholder='повторите пароль' required name='confpassword'><br>
                                                                    <button type='submit'>Зарегистрироваться</button>
                                                                <div class='reg-error'></div>
                                                            </form>
                                                        </div>
                                                    </section>`);
                                    $('#register-form').on('submit',function()
                                    {
                                        $('.reg-error').empty();
                                        event.preventDefault();
                                        let dataform = $(this).serialize();
                                        $.ajax({
                                            url:'http://videosalon/api/session/register.php',
                                            method: 'post',
                                            dataType:'json',
                                            data:dataform,
                                            success: function(response)
                                            {
                                                if(response.message == 'success')
                                                    {
                                                        location.reload(true);
                                                        $('.msg').append(`Регистрация успешна`);
                                                    }
                                                else
                                                {
                                                    $('.reg-error').append(`${response.message}`);
                                                }
                                            }
                                        });
                                        
                                    });
                            
                                });
            });
}