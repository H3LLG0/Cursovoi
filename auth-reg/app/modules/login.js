export function login()
{
    let paje;
    let data;
    const loginpaje = 'http://auth-reg:81/app/wievs/login.html';
    const url = 'http://auth-reg:81/api/entity/login.php';
    fetch(loginpaje)
        .then(function(response)
        {
            paje = response.text();
            return paje;
        })
        .then(function(paje)
        {
            document.querySelector('main').innerHTML = paje;
        })
        .then(function()
        {
            const form = document.querySelector('#login-form');
            form.addEventListener('submit',(event) =>
            {
                event.preventDefault();
                const body = JSON.stringify({
                    'login': document.querySelector('#login').value,
                    'pas': document.querySelector('#pas').value
                });
                fetch(url,{
                    method:'post',
                    headers: {
                        'Content-Type': 'application/json;charset=utf-8'
                      },
                    body: body
                })
                .then(function(response)
                {
                    data = response.json();
                    return data;
                })
                .then(function(data)
                {
                    console.log(data);
                })
            })
        });
}