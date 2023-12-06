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

 if ($opcion == 2) {
    try {
        $query = "INSERT INTO modelo_vehiculo (id_marca, modelo) 
                  VALUES (:id_marca, :modelo)";
        $statement = $conexion->getConnection()->prepare($query);
        $statement->bindParam(':id_marca', $marcamodelo);
        $statement->bindParam(':modelo', $nombremodelo);
    
      
        if ($statement->execute()) {
            
            header("Location: ../Dashboard/New_marca_modelo_repuesto.php?success=true");
        } else {
         
            header("Location: error.php");
        }
    } catch (PDOException $e) {
      
        error_log("Error al insertar los datos: " . $e->getMessage());
    
        // Redireccionar a una página de error en caso de excepción
        header("Location: error.php");
    }
    $conexion->desconectar();

}
   ?>