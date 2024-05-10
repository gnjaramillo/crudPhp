<?php

// pasos: importar clase, creo una instancia de esa clase, llamar metodo
include('../models/claseDAO.php');

$clase = new ClaseDAO();
$productos = $clase->TraerProducto();

echo json_encode($productos);

?>
