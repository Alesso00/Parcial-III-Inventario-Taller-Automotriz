<?php
session_start();
if ($_SESSION['usuario'] === null) {
    header('Location:index.php');
}

include_once '../Conexion/Conexion.php';

$conexion = new ConexionPDO($host, $dbname, $usernameServer, $passwordServer);
$conexion->conectar();
if($_SERVER["REQUEST_METHOD"]=="POST"){
   $opcion = $_POST['opcion'];
   $nombremarca = $_POST['nombremarca'];
  $nombremodelo = $_POST['nombremodelo'];
   $marcamodelo = $_POST['marcamodelo'];
   $repuesto = $_POST['nombrerepuesto'];
   $id= $_POST['id']; 
}



if ($opcion == 3) {
    try {
        $query = "INSERT INTO tipo_repuesto (tipo_repuesto) 
                  VALUES (:tipo_repuesto)";
        $statement = $conexion->getConnection()->prepare($query);
        $statement->bindParam(':tipo_repuesto', $repuesto);
      
    
     
        if ($statement->execute()) {
            
            header("Location: ../Dashboard/New_marca_modelo_repuesto.php?success=true");
        } else {
          
            header("Location: error.php");
        }
    } catch (PDOException $e) {
      
        error_log("Error al insertar los datos: " . $e->getMessage());
    
        
        header("Location: error.php");
    }
    $conexion->desconectar();

}

   ?>