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
                                    <ul class='menu-list'>
                                        <li><button class='profile-btn'>${data.name}</button><br>
                                                                <button class='exit-btn'>выход</button></li>
                                    </ul>
                                </nav>
                            `);
            $('.profile-btn').on('click',function()
            {

                $('main').empty();
                $('main').append(`<section class='profile'>
                                    <button class='fuck-go-back'>назад</button>
                                        <div class='user-info'>
                                            <h2>${data.name} ${data.surname}</h2>
                                            <div class='rented-films'>
                                                <h3>Арендованые фильмы</h3>
                                            </div>
                                            <div class='buyed-films'>
                                                <h3>Купленые фильмы</h3>
                                                <div class='buyed-film-container'></div>
                                            </div>
                                        </div>
                                    </section>`);
                $('.fuck-go-back').on('click',function(){location.reload(true)});
                $.ajax({
                    url:'http://videosalon/api/entity/readRent.php',
                    method:'post',
                    dataType:'json',
                    data: {
                        'client':data.id
                    },
                    success: function(rented)
                    {
                        if(rented.message == 'Вы не арендовывали ни один фильм')
                            {
                                $('.rented-films').append(`${rented.message}`);
                            }
                        else
                        {
                            rented.forEach(film => {
                                $('.rented-films').append(`<div class='rented-film-container'>
                                                                <img src='APP/images/posters/${film.poster}' class='film-picture'>
                                                                <div class='film-info'>
                                                                    Название: ${film.title}<br>
                                                                    Арендован на ${film.term} дней<br>
                                                                </div>
                                                            </div>`);
                            });
                        }
                    }
                });
                $.ajax({
                    url:'http://videosalon/api/entity/readBuy.php',
                    method:'post',
                    dataType:'json',
                    data: {
                        'client':data.id
                    },
                    success: function(buyed)
                    {
                        if(buyed.message == 'Вы не купили ни один фильм')
                            {
                                $('.buyed-films').append(`${buyed.message}`);
                            }
                        else
                        {
                            buyed.forEach(film => {
                                $('.buyed-films').append(`<div class='buyed-films-container'>
                                <img src='APP/images/posters/${film.poster}' class='film-picture'>
                                <div class='film-info'>
                                    Название: ${film.title}<br>
                                </div>
                            </div>`);
                            });
                        }
                    }
                });
            });
            if(data.role == 'admin')
                {
                    $('.menu-list').append(`<li><button class='add-film'>добавить фильм</button></li>`);
                }
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
                                        $(`#film${i}`).append(`
                                                                        <div class='film-actions' id='film-actions${i}'>
                                                                            цена аренды: ${film.rentprice}р. за сутки <button class='film-rent' id='rent${i}'>арендовать</button><br>
                                                                            цена покупки: ${film.buyprice}р. <button class='film-buy' id='buy${i}'>купить</button>
                                                                        </div>
                                                                    `);
                                        if(data.role == 'admin')
                                            {
                                                $(`#film-actions${i}`).append(`
                                                                            <div class='admin-actions'>
                                                                                <button class='film-update' id='update${i}'>редактировать</button>
                                                                                <button class='film-delete' id='delete${i}'>удалить</button>
                                                                            </div>
                                                                        `);
                                                $('.add-film').on('click',function()
                                                    {
                                                        $('main').empty();
                                                        $('main').append(`<div class='update-form'>
                                                        <button class='fuck-go-back'>назад</button>
                                                        <form id='create-film-form'>
                                                            <div class='update-film-form-container'>
                                                                <label>название</label><br>
                                                                <input name='title' type='text' placeholder='Название' required><br>
                                                                <label>постер</label><br>
                                                                <input name='poster' type='file' placeholder='загрузите постер' required><br>
                                                                <label>режиссёр</label><br>
                                                                <input name='producer' type='text' placeholder='режиссер' required><br>
                                                                <label>описание</label><br>
                                                                <input name='description' type='text' placeholder='описание' required><br>
                                                                <label>цена аренды за 1 день</label><br>
                                                                <input name='rentprice' type='number' placeholder='цена за 1 день' required><br>
                                                                <label>цена за покупку</label><br>
                                                                <input name='buyprice' type='number' placeholder='цена за покупку' required><br>
                                                                <button type='submit'>Добавить фильм</button>
                                                            </div>
                                                        </form>
                                                    </div>`);
                                    $('.fuck-go-back').on('click',function(){location.reload(true)});
                                    $('#create-film-form').on('submit',function()
                                {
                                    event.preventDefault();
                                    var $that = $(this),
                                    formData = new FormData($that.get(0));
                                $.ajax({
                                    url: 'http://videosalon/api/entity/createFilm.php',
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
                                                $.ajax({
                                                    url: 'http://videosalon/api/entity/deleteFilm.php',
                                                    method: 'post',
                                                    dataType: 'json',
                                                    data: {
                                                        'id':film.id
                                                    },
                                                    success: function(message)
                                                    {
                                                        alert(message.message);
                                                        location.reload(true);
                                                    }
                                                });
                                            });
                                            
                                            //тут обработчики кнопок кончаются
                                        i++;
                                    });
                                }
                            });
        }
    });
}