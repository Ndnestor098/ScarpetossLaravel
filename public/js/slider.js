// ===================================SLIDER - 1===================================
const productos = document.querySelectorAll(".carrusel-content .producto-carrusel");
let sliderContar = 0;
let widthHTML = document.querySelector(".carrusel").clientWidth;
let valorContadorLeft = productos.length/4 -1;
let valorContadorRight = productos.length/4;

if(widthHTML >= 1130){
    widthHTML = 1130;
}else if (widthHTML < 1130 && widthHTML >= 800) {
    valorContadorLeft = productos.length/1 -2;
    valorContadorRight = productos.length/2 -1;
}else if (widthHTML < 800 && widthHTML >= 500) {
    valorContadorLeft = 4 -2;
    valorContadorRight = 3;
}else if (widthHTML < 500) {
    valorContadorLeft = 5 -2;
    valorContadorRight = 5 -1;
} 

window.addEventListener('resize', ()=>{
    widthHTML = document.querySelector(".carrusel").clientWidth;
    if(widthHTML >= 1130){
        widthHTML = 1130;
    }else if (widthHTML < 1130 && widthHTML >= 800) {
        valorContadorLeft = productos.length/2 -2;
        valorContadorRight = productos.length/2 -1;
    }else if (widthHTML < 800 && widthHTML >= 500) {
        valorContadorLeft = 4 -2;
        valorContadorRight = 3;
    }else if (widthHTML < 500) {
        valorContadorLeft = 5 -2;
        valorContadorRight = 5 -1;
    } 

});

function sliderLeft() {
    if(sliderContar <= 0) {sliderContar = valorContadorLeft;}     
    else {sliderContar--; console.log(sliderContar)};

    scroll();
}
function sliderRigth() {

    sliderContar++;
    if(sliderContar >= valorContadorRight) {sliderContar = 0};
    
    scroll();
}
function scroll() {
        
    productos.forEach((item)=>{
        item.style.transform = `translateX(${-sliderContar * widthHTML}px)`
    })
}