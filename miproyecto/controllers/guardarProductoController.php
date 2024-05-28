<?php
    include('../models/claseDAO.php');
    $clase = new ClaseDAO();
    if($_REQUEST['id']==''){
        $clase->agregarProducto($_GET['id'], $_GET['nombre'], $_GET['descripcion']);
    }else{
        $clase->actualizarProducto($_REQUEST['id'],$_REQUEST['nombre'],$_REQUEST['descripcion']);
    }

?>