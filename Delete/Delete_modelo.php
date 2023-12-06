<?php
session_start();
if ($_SESSION['usuario'] === null) {
  header('Location:.index.php');
}

include_once '../Conexion/Conexion.php';
$conexion = new ConexionPDO($host, $dbname, $usernameServer, $passwordServer);
$conexion->conectar();
$opcion = $_POST['opcion'];
$id = $_POST['id'];


if($opcion == 2) {
    try {
        $query = "DELETE FROM modelo_vehiculo  WHERE id_modelo=:id";
        $statement = $conexion->getConnection()->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->execute();
    
        // Redireccionar o mostrar un mensaje de éxito
        header("Location: ../Dashboard/View_modelo.php");
        exit();
    } catch (PDOException $e) {
        echo '<script>alert("No se puede eliminar el modelo. Hay stock registrado en inventario. :(");</script>';
        echo "Error al eliminar: " . $e->getMessage();
        
        header("Location: ../Dashboard/View_modelo.php");
    }
    $conexion->desconectar();
    }

?>