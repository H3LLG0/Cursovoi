const url = 'http://media/api/products/read.php';
let xhr = new XMLHttpRequest();

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
                                        цена:${result[i].price}
                                </div>`;
        }
    };

xhr.send();