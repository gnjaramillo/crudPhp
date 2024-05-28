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
    
/* stmt ES UNA CONVENCION EN PHP variable que se usa para representar una consulta SQL preparada o ejecutada.
 Este objeto se utiliza luego para ejecutar la consulta, pasar parámetros y obtener resultados.


La variable $rows en el contexto de las consultas a la base de datos generalmente se utiliza para almacenar los resultados 
obtenidos de la consulta. pero podría tener cualquier otro nombre descriptivo que indique su propósito, como $results, $data, $records
 */

    // Método para obtener todos los productos de la base de datos
    function traerProductosBD() {
        $conexion = new Conexion('localhost', 'root', 'root', 'prueba');
        try {
            $conn = $conexion->Conectar(); 
            $stmt = $conn->query('SELECT * FROM productos'); // Ejecuta la consulta SQL (la variable query almacena una consulta )
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtiene todos los resultados como un array asociativo
            return $rows; 
        } catch (PDOException $e) {
            echo 'Falla en la conexión: ' . $e->getMessage(); 
        }
    }




    function agregarProducto($nombre, $descripcion){
        $conexion = new Conexion('localhost','root', 'root','prueba');

        try {

            $conn = $conexion-> Conectar(); 
            
            $query = "INSERT INTO productos (nombre, descripcion) VALUES (:nombre, :descripcion)";
            // se utiliza prepare() porque la consulta SQL contiene parámetros // Preparar la consulta SQL 
            $stmt = $conn->prepare($query);

            //parametros La función bindParam en PDO (PHP Data Objects) se utiliza para vincular una variable de PHP a un parámetro de una consulta SQL preparada. 
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);

            //ejecutar
            $stmt->execute();

            return "agregado correctamente";


        } catch (PDOException $e) {
            echo 'Falla en la conexión: ' . $e->getMessage();
        }        
        
    }


   


    
    /* En PDO, los marcadores de posición como :id (id=:id) se utilizan para representar valores 
    que serán vinculados más tarde a través del método bindParam() o bindValue() */

    function eliminarProducto($id){
        $conexion = new Conexion('localhost','root', 'root','prueba');

        try {
            $conn = $conexion->Conectar();
            $query = "DELETE FROM productos WHERE id=:id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return "producto eliminado";  
        } catch (PDOException $e) {
            echo 'Falla en la conexión: ' . $e->getMessage();
        }        
    }

    
    

       function actualizarProducto($id, $nombre, $descripcion){
        $conexion = new Conexion('localhost','root', 'root','prueba');
        try {
            $conn = $conexion->Conectar();
            $query = "UPDATE productos SET nombre=:nombre, descripcion=:descripcion WHERE id=:id";
            $actualizar = $conn->prepare($query);
            $actualizar->bindParam(':nombre', $nombre);
            $actualizar->bindParam(':descripcion', $descripcion);
            $actualizar->bindParam(':id', $id);
            $actualizar->execute();
            return "Actualizado Exitosamente";
        } catch (PDOException $e) {
            echo "Error al conectarse: " . $e->getMessage();
        }
    }
    

}


?>

