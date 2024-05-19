"use strict";
const formularios = document.querySelector(".form-carrello");

formularios.addEventListener('submit', function(e) {
    const select = document.getElementById('sizes');
    e.preventDefault();

    if (select.value === "") { 
        select.classList.add('alerta-talla');

    }else{
        select.classList.remove('alerta-talla');

        let data = new FormData(formularios);
        let method = formularios.getAttribute("method");
        let action = formularios.getAttribute("action");

        let encabezado = new Headers();

        let config = { 
            method:method,
            header:encabezado,
            mode:"cors",
            cache:'no-cache',
            body:data,
        }

        fetch(action, config)
            .then(res => res.text())
            .then(res => {
                try {
                    if(document.getElementById("contador-carrello").innerHTML = parseInt(document.getElementById('contador-carrello').textContent) + 1){
                        //
                    }
                } catch (error) {
                    document.getElementById("add-cart").innerHTML = `<i id="contador-carrello">1</i>`;
                }
                
            });
    }
});
