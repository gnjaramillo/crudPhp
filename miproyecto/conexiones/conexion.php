<?php

// conexion.php

class Conexion {

    // Las propiedades: variables que representan los 
    // datos asociados con la clase
    private $host;
    private $user;
    private $pwd;
    private $bd;
    private $conexion;

    // El constructor: método especial que se llama automáticamente 
    // cuando se crea un objeto de la clase.

    function __construct($hostaux, $useraux, $pwdaux, $bdaux) {
        $this-> host = $hostaux;
        $this-> user = $useraux;
        $this-> pwd = $pwdaux;
        $this-> bd = $bdaux;

    }

    // funciones que definen el comportamiento de la clase.

    public function  Conectar (){
        

        try {

            $this->conexion = new PDO("mysql:host={$this->host};dbname={$this->bd}", $this->user, $this->pwd);
            // echo 'Conexión exitosa';
            return $this->conexion;
        } 
        
        catch (PDOException $e) {
            echo 'Error de conexión'; $e->getMessage();
            return null;

        }
    }}

?>