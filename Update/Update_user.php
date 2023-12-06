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

    if ($opcion == 6) { 
        try {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $nombre_usuario = $_POST['nombre_usuario'];
            $contrasena = $_POST['contrasena'];

            // Verificamos si se proporcionó una nueva contraseña
            if (!empty($contrasena)) {
                // Si hay una nueva contraseña, actualizamos también la contraseña
                $query = "UPDATE usuario SET Nombre = :nombre, Apellido = :apellido, usuario = :nombre_usuario, password = :contrasena WHERE id = :id";
            } else {
                // Si no hay nueva contraseña, actualizamos los demás campos sin afectar la contraseña
                $query = "UPDATE usuario SET Nombre = :nombre, Apellido = :apellido, usuario = :nombre_usuario WHERE id = :id";
            }

            $statement = $conexion->getConnection()->prepare($query);
            $statement->bindParam(':id', $id);
            $statement->bindParam(':nombre', $nombre);
            $statement->bindParam(':apellido', $apellido);
            $statement->bindParam(':nombre_usuario', $nombre_usuario);

            // Si hay una nueva contraseña, encriptamos y la actualizamos
            if (!empty($contrasena)) {
                $statement->bindParam(':contrasena', md5($contrasena)); // Utilizar MD5 para la contraseña
            }

            // Ejecutamos la actualización
            if ($statement->execute()) {
                header("Location: ../Dashboard/View_user.php?success=true");
                exit();
            } else {
                header("Location: ../Dashboard/View_user.php?success=false");
                exit();
            }
        } catch (PDOException $e) {
            error_log("Error al actualizar el usuario: " . $e->getMessage());
            header("Location: ../Dashboard/View_user.php?success=false");
            exit();
        }
    }
}

$conexion->desconectar();
?>
