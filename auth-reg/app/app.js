import { login } from './modules/login.js';

const url = 'http://auth-reg:81/api/session/current_session.php';
let data;
await fetch(url)
 .then(function(response)
 {
     data = response.json();
     return data;
 })
 .then(function(data)
 {
     if(data.status == 'unauthorised')
     {
        login();
     }
     else
     {
        
     }
 })