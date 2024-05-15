$(window).on('load',function()
{
    $.ajax({
        url:'http://videosalon/api/object/auth.php',
        method:'get',
        dataType:'json',
        success: function(responseData)
        {
            if(responseData.status == 'unauthorised')
            {
                $('.content').append(`<div class="login-container">
                <form id="loginform">
                    <div class="form-content">
                        <label for="email">
                            Email<br>
                            <input type="email" placeholder="email" name="email" id="email">
                        </label><br>
                        <label for="password">
                            Пароль<br>
                            <input type="password" placeholder="пароль" id="password" name="password">
                        </label><br>
                        <button type="submit">войти</button>
                    </div>
                </form>
                <div class="reg">нет аккаунта? - </div>
                <div class="error"></div>
            </div>`);
            $('#loginform').on('submit',function()
            {
                event.preventDefault();
                let dataform = $(this).serialize();
                console.log(dataform);

                $.ajax({
                    url:'http://Videosalon/api/object/login.php',
                    method:'post',
                    dataType:'json',
                    data: dataform,
                    success: function(data)
                    {
                        $('.error').empty();
                        $('.error').append(data.massage);
                        if(data.massage == undefined)
                        {
                            location.reload(true)
                        }
                    }
                });
            });
            }
            else
            {
                $.ajax({
                    url:'http://Videosalon/api/object/user.php',
                    method:'get',
                    dataType:'json',
                    success: function(data)
                    {
                        $('.content').append(data.name);
                    }
                });
            }
        }
    });
});