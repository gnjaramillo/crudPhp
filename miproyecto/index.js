alert('hola'); // para verificar si esta activo el js

function cargarDatos() {
    fetch('./controllers/traerProductosBDController.php')
        .then(response => response.json())
        .then(data => {
            const tablaDatos = document.getElementById('tablaDatos');
            tablaDatos.innerHTML = '';

            data.forEach(row => {
                const tr = document.createElement('tr');
                tr.setAttribute('id', `fila-${row.id}`);
                tr.innerHTML = `
                    <td>${row.id}</td>
                    <td>${row.nombre}</td>
                    <td>${row.descripcion}</td>
                    <td>
                        <button class="btn btn-danger" id="eliminar" onClick='eliminarProducto(${row.id})'>Eliminar</button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarProducto" id="actualizar" onClick='traerProductos(${row.id})'>Actualizar</button>
                    </td>`;
                tablaDatos.appendChild(tr);
            });
        });
}

function agregarProducto() {
    // Obtener los valores de los campos de nombre y descripción
    const nombre = document.getElementById('nombre').value.trim();
    const descripcion = document.getElementById('descripcion').value.trim();

    // Verificar si los campos están vacíos
    if (nombre === '' || descripcion === '') {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Por favor, complete todos los campos.',
        });
        return; // Salir de la función si los campos están vacíos
    }

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
    Swal.fire({
        title: '¿Estás seguro de eliminar el registro?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`./controllers/eliminarProductosController.php?id=${id}`)
                .then(response => response.text())
                .then(data => {
                    if (data.trim() === "producto eliminado") {
                        const filaEliminar = document.getElementById(`fila-${id}`);
                        if (filaEliminar) {
                            filaEliminar.remove();
                            Swal.fire('El producto ha sido eliminado.', 'success');
                        } else {
                            console.error('No se encontró la fila correspondiente.');
                        }
                    } else {
                        console.error('Error al eliminar el producto:', data);
                        Swal.fire('Hubo un problema al eliminar el producto.');
                    }
                })
                .catch(error => console.error('Fetch error:', error));
        }
    });
}

function traerProductos(id) {
    fetch(`./controllers/traerProductoController.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            const inputNombre = document.getElementById('nombre');
            const inputDescripcion = document.getElementById('descripcion');
            const inputId = document.getElementById('productoId'); // Añadir un campo oculto para almacenar el ID del producto

            inputNombre.value = data.nombre;
            inputDescripcion.value = data.descripcion;
            inputId.value = data.id; // Establecer el valor del campo oculto
        });
}

function guardarProducto(id, nombre, descripcion) {
    fetch(
      `./controllers/guardarProductoController.php?id=${id}&nombre=${nombre}&descripcion=${descripcion}`
    )
      .then((response) => response.text())
      .then((data) => {
        limpiarFormulario();
        cargarDatos();
      });
  }
