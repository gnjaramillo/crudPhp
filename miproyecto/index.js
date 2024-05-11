// index.js

alert('hola'); // para verificar si esta activo el js

function cargarDatos(){
    fetch('./controllers/traerProductosBDController.php')
    .then(response =>response.json() )
    .then(data => {
        const tablaDatos = document.getElementById('tablaDatos');
        tablaDatos.innerHTML='';

        data.forEach(row => {
            const tr = document.createElement('tr');
            tr.innerHTML=`
            <td>${row.id}</td>
            <td>${row.nombre}</td>
            <td>${row.descripcion}</td>
            <td><button class="btn btn-danger" id=eliminar onClick='eliminarProducto(${row.id})'>Eliminar</button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarProducto" id=actualizar onClick='traerProductos(${row.id})'>Actualizar</button></td>`;

            tablaDatos.appendChild(tr);     
            
        });
    });    
}


// function eliminarProducto(id){

//     alert(id) // para verificar si esta activa la funcion

//      fetch('./controllers/eliminarProductosController.php? id='+id)
//      .then(response =>response.text() )
//      .then(data => { 
             
//         // alert('ok') // para verificar si hay una respuesta en el servidor

//     });
// }


  

function agregarProducto() {

    // Crear un objeto FormData y añadir los datos del formulario
    const formData = new FormData(document.getElementById('formAgregarProducto'));

    // Realizar una solicitud fetch para enviar los datos al controlador
    fetch('./controllers/agregarProductosController.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data) {
            cargarDatos();
            // Limpiar los campos del formulario después de agregar el producto
            document.getElementById('formAgregarProducto').reset();
        } else {
            console.error('Error al agregar el producto:', data);
        }
    })
    .catch(error => console.error('Fetch error:', error));
}




function eliminarProducto(id) {
    // Realizar una solicitud fetch para eliminar el producto
    fetch(`./controllers/eliminarProductosController.php?id=${id}`)
        .then(response => response.text())
        .then(data => {
            // Verificar si el producto se eliminó correctamente
            if (data.trim() === "producto eliminado") {
                // Obtener la fila correspondiente a través del id y eliminarla
                const filaEliminar = document.getElementById(`fila-${id}`);
                if (filaEliminar) {
                    filaEliminar.remove(); // Eliminar la fila
                } else {
                    console.error('No se encontró la fila correspondiente.');
                }
            } else {
                console.error('Error al eliminar el producto:', data);
            }
        })
        .catch(error => console.error('Fetch error:', error));
}




function traerProductos(id){
    fetch('./controllers/traerProductoController.php?id='+id)
    .then(response =>response.json() )
    .then(data => {

        
        const inputNombre= document.getElementById('nombre');
        const inputDescripcion= document.getElementById('descripcion');

        inputNombre.value=data.nombre
        inputDescripcion.value=data.descripcion


        

    });    
}

cargarDatos();