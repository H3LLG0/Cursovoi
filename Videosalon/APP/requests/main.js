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
                                        <li><button class='name'>${data.name}</button><br>
                                                                <button class='exit-btn'>выход</button></li>
                                    </ul>
                                </nav>
                            `);
                            $('.exit-btn').on('click',function()
                            {
                                $.ajax({
                                    url:'http://videosalon/api/session/exit.php',
                                    method:'post',
                                    dataType:'json',
                                    body: 'exit',
                                    success:function(response)
                                    {
                                        if(response.status == 'unauthorised')
                                        {
                                            location.reload(true);
                                        }
                                    }
                                });
                            });
                            $.ajax({
                                url:'http://videosalon/api/entity/readFilms.php',
                                method:'get',
                                dataType: 'json',
                                success: function(response)
                                {
                                    let i = 0;
                                    $('main').append(`<div class='all-films'></div>`);
                                    response.forEach(film => {
                                        $('.all-films').append(`<div id='film${i}' class='film-container'>
                                                                    <img src='APP/images/posters/${film.poster}' class='film-picture'>
                                                                    <div class='film-info'>
                                                                        Название: ${film.title}<br>
                                                                        Режиссер: ${film.producer}<br>
                                                                        Описание: ${film.description}<br>
                                                                    </div>
                                                                </div>`);
                                        $('.film-container').append(`
                                                                        <div class='film-actions'>
                                                                            цена аренды: ${film.rentprice}р. за сутки <button class='film-rent' id='rent${i}'>арендовать</button><br>
                                                                            цена покупки: ${film.buyprice}р. <button class='film-buy' id='buy${i}'>купить</button>
                                                                        </div>
                                                                    `);
                                        if(data.role == 'admin')
                                            {
                                                $('.film-actions').append(`
                                                                            <br>
                                                                            <button class='film-rent' id='update${i}'>редактировать</button><br>
                                                                            <button class='film-buy' id='delete${i}'>удалить</button>
                                                                        `)
                                            }
                                            //тут обработчики кнопок начинаются (ненавижу фронтенд :/)

                                            $(`#rent${i}`).on('click',function()
                                            {
                                                $('main').empty();
                                                let price = Number(film.rentprice);
                                                let term = 1;
                                                let itog = Number(film.rentprice);
                                                $('main').append(`<div class='rent-form'>
                                                                    <button class='fuck-go-back'>назад</button>
                                                                    <div class='product'>
                                                                    <img src='APP/images/posters/${film.poster}' class='film-picture'>
                                                                        <div class='film-info'>
                                                                            Название: ${film.title}<br>
                                                                            Режиссер: ${film.producer}<br>
                                                                        </div>
                                                                    </div>
                                                                    <form id='rent-form'>
                                                                    <label>выберите количество дней аренды</label><br>
                                                                    <select class='term-select' name='term'>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="6">6</option>
                                                                        <option value="7">7</option>
                                                                    </select><br>
                                                                        <div class='price'>итого к оплате: ${price}р.</div>
                                                                        <button type='submit'>арендовать</button>
                                                                    </form>
                                                                </div>`);
                                                                $("select").change(function(){
                                                                    let value = Number($(this).val());
                                                                   itog = value * price;
                                                                   term = value;
                                                                   $('.price').empty();
                                                                   $('.price').append(`итого к оплате: ${itog}р.`);
                                                                   return term, itog;
                                                                });
                                                $('.fuck-go-back').on('click',function(){location.reload(true)});                    
                                                $('#rent-form').on('submit',function()
                                                {
                                                    event.preventDefault();
                                                    const rentBody = 
                                                    {
                                                        'client':data.id,
                                                        'product':film.id,
                                                        'term':term,
                                                        'price':itog
                                                    }
                                                    $.ajax({
                                                        url:'http://videosalon/api/entity/rentFilm.php',
                                                        method:'post',
                                                        dataType:'json',
                                                        data:rentBody,
                                                        success:function(message)
                                                        {
                                                            alert(message.message);
                                                            location.reload(true);
                                                        }
                                                    });
                                                });
                                            });
                                            $(`#buy${i}`).on('click',function()
                                            {
                                                $('main').empty();
                                                let price = Number(film.buyprice);
                                                $('main').append(`<div class='buy'>
                                                                    <button class='fuck-go-back'>назад</button>
                                                                    <div class='product'>
                                                                    <img src='APP/images/posters/${film.poster}' class='film-picture'>
                                                                        <div class='film-info'>
                                                                            Название: ${film.title}<br>
                                                                            Режиссер: ${film.producer}<br>
                                                                        </div>
                                                                        <div class='price'>итого к оплате: ${price}р.</div>
                                                                        <button class='buy-btn'>купить</button>
                                                                    </div>`);
                                                $('.fuck-go-back').on('click',function(){location.reload(true)});
                                                $('.buy-btn').on('click',function()
                                                {
                                                    const buyBody = {
                                                        'client':data.id,
                                                        'product':film.id,
                                                        'price':price
                                                    };
                                                    $.ajax({
                                                        url:'http://videosalon/api/entity/buyFilm.php',
                                                        method:'post',
                                                        dataType: 'json',
                                                        data: buyBody,
                                                        success: function(message)
                                                        {
                                                            alert(message.message);
                                                            location.reload(true);
                                                        }
                                                    });
                                                });

                                            });
                                            $(`#update${i}`).on('click',function()
                                            {
                                                $('main').empty();
                                                $('main').append(`<div class='update-form'>
                                                                    <button class='fuck-go-back'>назад</button>
                                                                    <form id='update-film-form'>
                                                                        <div class='update-film-form-container'>
                                                                        <input name='id' type="hidden" value="${film.id}">
                                                                            <label>название</label><br>
                                                                            <input name='title' type='text' placeholder='Название' value='${film.title}'><br>
                                                                            <label>постер</label><br>
                                                                            <img src='APP/images/posters/${film.poster}' class='film-picture'><br>
                                                                            <input name='poster' type='file' placeholder='загрузите постер'><br>
                                                                            <label>режиссёр</label><br>
                                                                            <input name='producer' type='text' placeholder='режиссер' value='${film.producer}'><br>
                                                                            <label>описание</label><br>
                                                                            <input name='description' type='text' placeholder='описание' value='${film.description}'><br>
                                                                            <label>цена аренды за 1 день</label><br>
                                                                            <input name='rentprice' type='number' placeholder='цена за 1 день' value='${film.rentprice}'><br>
                                                                            <label>цена за покупку</label><br>
                                                                            <input name='buyprice' type='number' placeholder='цена за покупку' value='${film.buyprice}'><br>
                                                                            <button type='submit'>сохранить изменение</button>
                                                                        </div>
                                                                    </form>
                                                                </div>`);
                                                $('.fuck-go-back').on('click',function(){location.reload(true)});
                                                $('#update-film-form').on('submit',function()
                                            {
                                                event.preventDefault();
                                                var $that = $(this),
                                                formData = new FormData($that.get(0));

                                                console.log(formData);

                                            $.ajax({
                                                url: 'http://videosalon/api/entity/updateFilm.php',
                                                method: 'post',
                                                contentType: false,
                                                processData: false,
                                                data: formData,
                                                success: function(message)
                                                {
                                                    alert(message.message);
                                                    location.reload(true);
                                                }
                                            });
                                            })
                                            });
                                            $(`#delete${i}`).on('click',function()
                                            {
                                                
                                            });
                                            
                                            //тут обработчики кнопок кончаются
                                        i++;
                                    });
                                }
                            });
        }
    });

    $('footer').append(`<div class='footcontent'>
                            это подвал
                        </div>`);
}