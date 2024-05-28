<?php
include('../models/claseDAO.php'); 
header("Content-Type: application/json"); // Establece el tipo de contenido de la respuesta como JSON.

$method = $_SERVER['REQUEST_METHOD']; // Obtiene el método de la solicitud HTTP (GET, POST, PUT, DELETE).
$class = new ClaseDAO(); // Crea una instancia de la clase ClaseDAO para poder llamar a sus métodos.

switch($method) { 
    case 'GET': 
        $data = $class->traerProductosBD(); // Llama al método traerProductosBD() de la clase ClaseDAO para obtener los productos.
        echo(json_encode($data)); // Convierte los datos obtenidos a formato JSON y los imprime en la respuesta.
        break;

    case 'POST': 
        $data = json_decode(file_get_contents('php://input'), true); // Obtiene los datos del cuerpo de la solicitud y los convierte de JSON a un array asociativo al poner true, de lo contrario es false por defecto y devolveria un objeto.
        $resultado = $class->agregarProducto( $data['nombre'], $data['descripcion']); // Llama al método agregarProducto() de la clase ClaseDAO 
        echo(json_encode($resultado)); // Convierte el resultado a formato JSON y lo imprime en la respuesta.
        break;

    case 'DELETE': 
        $data = json_decode(file_get_contents('php://input'), true); 
        $resultado = $class->eliminarProducto($data['id']); 
        echo(json_encode($resultado)); 
        break;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true); 
        $id = $data['id']; 
        $descripcion = $data['descripcion']; 
        $nombre = $data['nombre']; 
        $resultado = $class->actualizarProducto($id, $nombre, $descripcion); 
        echo(json_encode($resultado)); 
        break;
}

?>
