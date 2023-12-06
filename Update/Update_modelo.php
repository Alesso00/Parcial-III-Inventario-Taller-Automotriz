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

if ($opcion == 5) {
    try {
        $query = "UPDATE modelo_vehiculo
        SET id_marca=:id_marca, modelo=:modelo
        WHERE id_modelo=:id";
        $statement = $conexion->getConnection()->prepare($query);
        $statement->bindParam(':id_marca', $marcamodelo);
        $statement->bindParam(':modelo', $nombremodelo);
        $statement->bindParam(':id', $id);

       
        if ($statement->execute()) {
            
            header("Location: ../Dashboard/View_modelo.php?success=true");
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