<?php
include('../models/claseDAO.php');

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];

$clase = new ClaseDAO();
$agregar = $clase->agregarProducto($nombre, $descripcion);

echo json_encode($agregar);
?>

