import {mainpaje} from './requests/main.js';
import {guest} from './requests/guest.js'
$(window).on('load',function()
{
    $.ajax({
        url:'http://videosalon/api/session/CurrentUser.php',
        method:'get',
        dataType:'json',
        success: function(CurrentUserData)
        {
            if(CurrentUserData.status == 'unauthorised')
            {
                guest();
            }
            else
            {
                mainpaje();
            }
        }
    });
})