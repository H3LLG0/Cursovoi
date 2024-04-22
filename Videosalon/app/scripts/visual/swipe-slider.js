const slider = document.querySelector('.swipe-slider-container');
let offset = 0;
window.onload = setInterval(function()
{
    offset = offset + 300;
    if(offset>1200)
    {
        offset = -1200;
    }
    slider.style.left = -offset + 'px';
},3000);