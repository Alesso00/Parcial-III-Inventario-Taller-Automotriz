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


if($opcion == 3) {
        try {
            $query = "DELETE FROM usuario WHERE id=:id";
            $statement = $conexion->getConnection()->prepare($query);
            $statement->bindParam(':id', $id);
            $statement->execute();
        
            // Redireccionar o mostrar un mensaje de éxito
            header("Location: ../Dashboard/View_user.php");
            exit();
        } catch (PDOException $e) {
            echo '<script>alert("No se puede eliminar el usuario. El usuario esta activo. :(");</script>';
            echo "Error al eliminar: " . $e->getMessage();
            
            header("Location: ../Dashboard/View_user.php");
        }
        $conexion->desconectar();
        }
?>