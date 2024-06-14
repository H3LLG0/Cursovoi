export function register()
{
    let paje;
    const loginpaje = 'http://auth-reg:81/app/wievs/register.html';

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
}