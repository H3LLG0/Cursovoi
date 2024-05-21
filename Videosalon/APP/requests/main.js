export let mainpaje = () =>
{
    $('header').append(`
                        <nav>
                            <ul>
                                <li>это навигация</li>
                            </ul>
                        </nav>
                    `);
    $('main').append('это основная часть');
    $('footer').append(`<div class='footcontent'>
                            это подвал
                        </div>`);
}