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

//modificar 

if ($opcion == 4) {
    try {
        $query = "UPDATE marca_vehiculo
        SET marca=:nombremarca
        WHERE id_marca=:id";
        $statement = $conexion->getConnection()->prepare($query);
        $statement->bindParam(':nombremarca', $nombremarca);
        $statement->bindParam(':id', $id);
    
        
        if ($statement->execute()) {
            // Redireccionar o mostrar un mensaje de éxito
            header("Location: ../Dashboard/view_marca.php?success=true");
            exit(); 
        } else {
           
            header("Location: error.php");
            exit(); 
        }
    } catch (PDOException $e) {
        
        error_log("Error al insertar los datos: " . $e->getMessage());
    
       
        header("Location: error.php");
        exit(); 
    }
    
    $conexion->desconectar();

}

   ?>