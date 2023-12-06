<?php
session_start();
if ($_SESSION['usuario'] === null) {
  header('Location:.index.php');
}

include_once '../Conexion/Conexion.php';
$conexion = new ConexionPDO($host, $dbname, $usernameServer, $passwordServer);
$conexion->conectar();

$id = $_POST['id'];

try {
    $query = "DELETE FROM inventario  WHERE id_inventario=:id";
    $statement = $conexion->getConnection()->prepare($query);
    $statement->bindParam(':id', $id);
    $statement->execute();

    // Redireccionar o mostrar un mensaje de éxito
    header("Location: ..//Dashboard/Dashboard.php");
    exit();
} catch (PDOException $e) {
    echo "Error al eliminar: " . $e->getMessage();
}
$conexion->desconectar();

?>