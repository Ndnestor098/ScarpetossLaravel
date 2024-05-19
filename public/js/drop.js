var form = document.querySelector(".enviar"); // Obtener el formulario
let imageData;
let imageName;


// Manejador para el evento dragover
function dragOverHandler(event) {
    event.preventDefault();
}

// Manejador para el evento drop
function dropHandle(event) {
    event.preventDefault();
    event.stopPropagation(); // Detener la propagación del evento

    var files = event.dataTransfer.files;
    
    if (files.length > 0) {
        // Obtener la primera imagen del drop
        var imageFile = files[0];

        document.querySelector(".name").value = files[0].name;

        
        // Convertir la imagen a base64 para enviarla a través de la conversación
        var reader = new FileReader();

        reader.onload = function(event) {
            imageData = event.target.result;
        };

        reader.readAsDataURL(imageFile);
    }
}

form.addEventListener('submit',(e)=>{
    e.preventDefault();
    let confirm = window.confirm("Desea actualizar los campos de este producto");

    if(confirm){
        let formData = new FormData(form);
        let method = form.getAttribute("method");
        let action = form.getAttribute("action");

        if(formData.get("img").name) formData.append('imgName', formData.get("img").name);

        if(imageData) formData.append('imageData', imageData);

        let encabezado = new Headers();

        let config = { 
            method: method,
            header: encabezado,
            mode:"cors",
            cache:'no-cache',
            body: formData,
        }

        fetch(action, config)
            .then(response => {
                return response.text();
            })
            .then(data => {
                if(data.includes('admin')) window.location.href = data;
                else document.querySelector(".error").innerHTML =  data;
            })
    }
});


// function sendImage(imageData) {
//     // Crear un objeto FormData para enviar la imagen al servidor
//     var formData = new FormData(form);
//     formData.append('image', imageData);

//     // Configurar la solicitud Fetch
//     var url = form.getAttribute("action"); // Reemplaza 'URL_DE_TU_CONTROLADOR' con la URL de tu controlador Laravel
//     var options = {
//         method: 'POST',
//         body: formData
//     };

//     // Realizar la solicitud Fetch
//     fetch(url, options)
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error('Ocurrió un error al enviar la imagen al servidor.');
//             }

//             return response.json();
//         })
//         .then(data => {
//             console.log('La imagen se envió correctamente al servidor:', data);
//         })
//         .catch(error => {
//             console.error('Error al enviar la imagen al servidor:', error);
//         });
// }

// Agregar eventos de drag and drop al elemento contenedor
var dropContainer = document.querySelector(".container-input");
dropContainer.addEventListener("dragover", dragOverHandler);
 