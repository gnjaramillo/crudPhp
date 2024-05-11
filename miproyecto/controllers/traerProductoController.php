<?php
include('../models/claseDAO.php');


$clase = new ClaseDAO();
$traerProductos = $clase->traerProductos($_GET['id']);

echo json_encode($traerProductos);
?>