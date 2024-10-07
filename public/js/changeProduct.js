"use strict";

const imagePrincipal = document.getElementById('principal');
const allImages = document.querySelectorAll('.alls-images'); 

allImages.forEach((item) => {
    if(item.src == imagePrincipal.src){
        item.classList.add('active-image')
    } else {
        item.classList.remove('active-image')
    }


    item.addEventListener('mouseover', () => {
        if (item.src === imagePrincipal.src) {
            return;
        }
        
        allImages.forEach((img) => {
            img.classList.remove('active-image'); 
        });

        imagePrincipal.src = item.src; 
        item.classList.add('active-image');
    });
});
