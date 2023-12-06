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
   
   $repuesto = $_POST['repuesto1'];
  $marca = $_POST['marca1'];
   $modelo = $_POST['modelo1'];
    $year = $_POST['year'];
    $entrada = $_POST['entrada'];
    $salida = $_POST['salida'];
    $costo = $_POST['costo'];
    $fecha = $_POST['fecha'];
    $id= $_POST['id']; }
    $stok = ($entrada - $salida);

if ($opcion == 2) {
    try {
        $query = "UPDATE inventario 
        SET id_repuesto=:repuesto, id_marca=:marca, id_modelo=:modelo, year=:year, entrada=:entrada, salida=:salida, stock=:stock, costo=:costo, fecha=:fecha 
        WHERE id_inventario=:id";
           $statement = $conexion->getConnection()->prepare($query);
           $statement->bindParam(':repuesto', $repuesto);
           $statement->bindParam(':marca', $marca);
           $statement->bindParam(':modelo', $modelo);
           $statement->bindParam(':year', $year);
           $statement->bindParam(':entrada', $entrada);
           $statement->bindParam(':salida', $salida);
           $statement->bindParam(':stock', $stok);
           $statement->bindParam(':costo', $costo);
           $statement->bindParam(':fecha', $fecha);
           $statement->bindParam(':id', $id);
           $statement->execute();
        header("Location: ..//Dashboard/dashboard.php");
        exit();
    } catch (PDOException $e) {
        echo "Error al insertar los datos: " . $e->getMessage();
    }

$conexion->desconectar();
}
?>