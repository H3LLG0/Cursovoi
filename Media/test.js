const url = 'http://media/api/products/read.php';
let xhr = new XMLHttpRequest();
let xhr2 = new XMLHttpRequest();

xhr.open('GET',url);

    xhr.responseType = 'json';
    xhr.onload = function() {
        let result = xhr.response;
        for(let i = 0; i<result.length; i++)
        {
            document.body.innerHTML += `<div>
                                        <h2>${result[i].name}</h2>
                                        площадь: ${result[i].area}<br>
                                        размер: ${result[i].size}<br>
                                        цена:${result[i].price} р.
                                </div>`;
        }
    };
xhr.send();

// const form = document.querySelector('.form');

// form.addEventListener("submit", function(event) {
//     event.preventDefault();
    const url2 = 'http://media/api/products/create.php';
    xhr2.open('POST', url2)

        xhr2.responseType = 'json';
        const body = 
        {
            'name':'Эконом',
            'area':'2',
            'size':'123x456x789',
            'price':'567'
        };
        let data = JSON.stringify(body);
    xhr2.send(data);
// });