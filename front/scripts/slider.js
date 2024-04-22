let offset = 0;
const slider = document.querySelector('.slider-line');
window.onload = setInterval(function()
{
    offset += 300;
    slider.style.left = -offset + "px";
    if(offset>2100)
    {
        offset = 0;
    }
    
},3000);