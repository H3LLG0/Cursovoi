export let register = () =>
{
    $('#register-btn').on('click',function()
    {
        $('main').empty();
        $('main').append(`<div class="register">
                                <form id='register-form'>
                                    <div class='register-form'>
                                        <input type='hidden' value='user'>
                                        <label id='register-name'>Введите имя</label><br>
                                        <input type='text' placeholder='имя' required name='name'><br>
                                        <label>Введите фамилию</label><br>
                                        <input type='text' placeholder='фамилия' required name='surname'><br>
                                        <label>Введите email</label><br>
                                        <input type='email' placeholder='email' required name='email'><br>
                                        <label>Введите пароль</label><br>
                                        <input type='password' placeholder='пароль' required name='password'><br>
                                        <button type='submit'>Зарегистрироваться</button>
                                    </div>
                                </form>
                            </div>`);
        $('#register-form').on('click',function()
        {
            event.preventDefault();
            let dataform = $(this).serialize();
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
        });

    });
}