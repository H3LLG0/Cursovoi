import {login} from './requests/login.js';
import {mainpaje} from './requests/main.js';
import {register} from './requests/register.js';
$(window).on('load',function()
{
    $.ajax({
        url:'http://videosalon/api/session/CurrentUser.php',
        method:'get',
        dataType:'json',
        success: function(CurrentUserData)
        {
            if(CurrentUserData.status == 'unauthorised')
            {
                $('main').empty();
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
                register();
                login();

            }
            else
            {
                mainpaje();
            }
        }
    });
})