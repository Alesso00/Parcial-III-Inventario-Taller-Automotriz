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

if ($opcion == 6) {
    try {
        $query = "UPDATE tipo_repuesto
        SET tipo_repuesto=:tipo_repuesto
        WHERE id_repuesto=:id";
        $statement = $conexion->getConnection()->prepare($query);
        $statement->bindParam(':tipo_repuesto', $repuesto);
        $statement->bindParam(':id', $id);

        // Verificar si la consulta se ejecuta correctamente
        if ($statement->execute()) {
            
            header("Location: ../Dashboard/View_repuesto.php?success=true");
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