"use strict";

// ===================================MENU===================================
const buttonMenu = document.getElementById("menu");
const menu = document.querySelector(".submenu");
const buttonCerrarMenu = document.getElementById("button-menu-cerrar");

buttonMenu.addEventListener("click",()=>{
    menu.style.opacity = "1";
    menu.style.transitionProperty = "width";
    menu.style.transitionDuration  = "0.5s";
    menu.style.width = "240px";
});

buttonCerrarMenu.addEventListener("click",()=>{
    menu.style.transitionProperty = "width";
    menu.style.transitionDuration  = "0.5s";
    menu.style.width = "0px";

    setTimeout(() => {
        menu.style.opacity = "0";
        
    }, 300);
});




