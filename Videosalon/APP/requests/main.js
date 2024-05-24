export let mainpaje = () =>
{
    $.ajax({
        url:'http://videosalon/api/session/CurrentUser.php',
        method:'get',
        dataType:'json',
        success: function(data)
        {
            $('header').append(`
                        <nav>
                            <ul>
                                <li>${data.name}</li>
                            </ul>
                        </nav>
                    `);
            $('main').append('это основная часть');
            $('footer').append(`<div class='footcontent'>
                                    это подвал
                                </div>`);
        }
    });
}