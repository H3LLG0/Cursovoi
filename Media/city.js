const url = 'http://media/api/products/readcity.php';

let xhr = new XMLHttpRequest();

xhr.open('GET',url);

xhr.responseType = 'json';

xhr.send();

xhr.onload = function()
{
    const city_place = document.querySelector('#database-town');
    const slogan_place = document.querySelector('#database-slogan');
    let result = xhr.response;
    for(let i = 0; i<result.length; i++)
    {
        city_place.innerHTML = result[i].name;
        slogan_place.innerHTML = result[i].slogan;
    }

    
}