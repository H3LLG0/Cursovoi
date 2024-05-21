import {login} from './requests/login.js';
import {mainpaje} from './requests/main.js';
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
                                        <form id="login">
                                            <div class="login-fields">
                                                <input type="email" placeholder="email" name="email"><br>
                                                <input type="password" placeholder="password" name="password"><br>
                                                <button type="submit">войти</button>
                                            </div>
                                        </form>
                                    </div>
                                </section>
                                `);
                login();
            }
            else
            {
                mainpaje();
            }
        }
    });
})