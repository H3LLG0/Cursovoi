export let register = () =>
{
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
}