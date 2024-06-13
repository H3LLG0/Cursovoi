export let login = () =>
{
    $('#login').on('submit',function()
    {
        $('.msg').empty();
        event.preventDefault();
        let dataform = $(this).serialize();
        $.ajax({
            url:'http://cursovoi/api/session/login.php',
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
}