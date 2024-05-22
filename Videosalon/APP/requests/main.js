export let mainpaje = () =>
{
    $.ajax({
        url:'',
        method:'',
        dataType:'',
        success: function(data)
        {
            $('header').append(`
                        <nav>
                            <ul>
                                <li>${data.name} $</li>
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