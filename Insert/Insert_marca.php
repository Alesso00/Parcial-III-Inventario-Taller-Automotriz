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

if ($opcion == 1) {
    try {
        $query = "INSERT INTO marca_vehiculo (marca) VALUES (:nombremarca)";
        $statement = $conexion->getConnection()->prepare($query);
        $statement->bindParam(':nombremarca', $nombremarca);
    
        
        if ($statement->execute()) {
          
            header("Location: ../Dashboard/New_marca_modelo_repuesto.php ?success=true");
        } else {
            
            header("Location: ../Dashboard/New_marca_modelo_repuesto.php?success=false");
        }
    } catch (PDOException $e) {
    
        error_log("Error al insertar los datos: " . $e->getMessage());
    
        
        header("Location: ../Dashboard/New_marca_modelo_repuesto.php?success=false");
    }
    $conexion->desconectar();

}
   ?>