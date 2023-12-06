<?php
session_start();

if ($_SESSION['usuario'] === null) {
    header('Location: index.php');
    exit();
}

include_once '../Conexion/Conexion.php';

$conexion = new ConexionPDO($host, $dbname, $usernameServer, $passwordServer);
$conexion->conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $opcion = $_POST['opcion'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $usuario = $_POST['nombre_usuario'];
    $contrasena = $_POST['contrasena'];
    $id = $_POST['id'];
}

if ($opcion == 1) {
    try {
        $query = "INSERT INTO usuario (Nombre, Apellido, usuario, password) VALUES (:nombre, :apellido, :nombre_usuario, :contrasena)";
        $statement = $conexion->getConnection()->prepare($query);
        $statement->bindParam(':nombre', $nombre);
        $statement->bindParam(':apellido', $apellido);
        $statement->bindParam(':nombre_usuario', $usuario);
        $statement->bindParam(':contrasena', md5($contrasena)); // Utilizar MD5 para la contraseña

        // Verificar si la consulta se ejecuta correctamente
        if ($statement->execute()) {
            // Redireccionar con un mensaje de éxito
            header("Location: ../Dashboard/View_user.php?success=true");
            exit();
        } else {
            // Mostrar un mensaje genérico al usuario en caso de error
            header("Location: ../Dashboard/View_user.php?success=false");
            exit();
        }
    } catch (PDOException $e) {
        // Registrar el error en un archivo de registro o en la base de datos
        error_log("Error al insertar los datos: " . $e->getMessage());

        // Mostrar un mensaje genérico al usuario en caso de error
        header("Location: ../Dashboard/new_user.php?success=false");
        exit();
    }
}

$conexion->desconectar();
?>
