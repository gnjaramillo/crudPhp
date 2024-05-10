<?php
include('../models/claseDAO.php');

$clase = new ClaseDAO();
$eliminar = $clase->eliminarProducto($_GET['id']);

echo json_encode($eliminar);
?>
