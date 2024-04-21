let url = 'http://videosalon/api/objects/read_film.php';
let films_list = document.querySelector('.films-list');
let xhr = new XMLHttpRequest();

xhr.responseType = 'json';

xhr.open('GET',url);

xhr.send();

xhr.onload = function()
{
    for(let i = 0; i<xhr.response.length;i++)
    {
        films_list.innerHTML += `<li><a>${xhr.response[i].product_type}</a></li>`;
    }
}