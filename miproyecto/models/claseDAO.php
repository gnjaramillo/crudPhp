<?php

// claseDAO.php

include ("../conexiones/conexion.php");

class ClaseDAO{    

    public $id;
    public $nombre;
    public $descripcion;    

    function __construct($id=null, $nom=null, $desc=null) {
        $this->id = $id;
        $this->nombre = $nom;
        $this->descripcion = $desc;
        
    }   

    function TraerProducto(){
        $conexion = new Conexion('localhost','root', 'root','prueba');

        try {
            $conn = $conexion-> Conectar();
            // echo 'Conexión exitosa'; 
            $stmt=$conn->query('SELECT * FROM productos');
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rows;        
            
        
        } catch (PDOException $e) {
            echo 'Falla en la conexión: ' . $e->getMessage();
        }        
    }



    function eliminarProducto($id){
        $conexion = new Conexion('localhost','root', 'root','prueba');

        try {
            $conn = $conexion-> Conectar();
            // echo 'Conexión exitosa';
            $query = "DELETE FROM productos WHERE id=$id";
            $stmt=$conn->prepare($query);
            $stmt->execute();
            return "producto eliminado";  

        
        } catch (PDOException $e) {
            echo 'Falla en la conexión: ' . $e->getMessage();
        }        
    }



    function agregarProducto($nombre, $descripcion){
        $conexion = new Conexion('localhost','root', 'root','prueba');

        try {

            $conn = $conexion-> Conectar(); 
            // Preparar la consulta SQL 
            $query = "INSERT INTO productos (nombre, descripcion) VALUES (:nombre, :descripcion)";
            $stmt = $conn->prepare($query);

            //parametros
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);

            //ejecutar
            $stmt->execute();

            return "agregado correctamente";


        } catch (PDOException $e) {
            echo 'Falla en la conexión: ' . $e->getMessage();
        }        
    }



}


?>

