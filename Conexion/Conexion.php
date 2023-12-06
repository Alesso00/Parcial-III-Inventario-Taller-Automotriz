<?php
class ConexionPDO{

    private $host;
    private $dbname;
    private $usuario;
    private $contrasena;
    private $conexion;

public function __construct($host, $dbname,$usuario,$contrasena)
{
    $this -> host =$host;
    $this -> dbname =$dbname;
    $this -> usuario =$usuario;
    $this -> contrasena =$contrasena;

}

public function conectar(){
    try {
        $opciones = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        $this-> conexion = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname, $this->usuario,$this->contrasena, $opciones);

        if($this->conexion!=null){
//echo "Conexion exitosa :)";
        }
        else{//echo"Fallo la conexion :(";
        }
    } catch (PDOException $e) {
        echo "ERROR DE CONEXION".$e->getMessage();
        die();
    }
}

public function getConnection(){
    return $this-> conexion;
}

public function desconectar(){
$this ->conexion = null;
//echo "Base de datos desconectada";        
}
}

$host = "localhost";
$dbname = "inventario";
$usernameServer = "root";
$passwordServer = "";
?>
