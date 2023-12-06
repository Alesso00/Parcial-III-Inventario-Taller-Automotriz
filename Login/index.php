<?php
// Inicializar sesión
session_start();
include_once '../Conexion/Conexion.php';
include_once 'Login.php';

$conexion = new ConexionPDO($host, $dbname, $usernameServer, $passwordServer);
$conexion->conectar();

// Verificar si el usuario ya ha iniciado sesión
if (isset($_SESSION['usuario'])) {
    header("Location: ./Dashboard/Dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['user'];
    $password = MD5($_POST['pwd']);

    $login = new Login($conexion);

    if ($login->login($username, $password)) {
        // Iniciar sesión
        $_SESSION['usuario'] = $username;

        header("Location: ../Dashboard/Dashboard.php");
        exit();
    } else {
        $error_message = "Nombre de usuario o contraseña incorrectos";
        echo '<script>alert("Nombre de usuario o contraseña incorrectos")</script>';
    }
}

$conexion->desconectar();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css'>
  <link rel="stylesheet" type="text/css" href="../CSS/styles_login.css" />
</head>
<body>
  <div class="login-container">
    <img src="../img/icono.png" alt="" width="200" height="180">
    <div class="login-content">
      <h2>Iniciar sesión</h2>
      <form action="" method="POST">

        <div class="input-field">
          <label for="user">Nombre de usuario:</label>
          <input type="text" name="user" required placeholder="Ingrese su usuario">
        </div>

        <div class="view-password">
          <label for="pwd">Contraseña:</label>
          <div class="input-field">
            <input type="password" name="pwd" required placeholder="Ingrese su contraseña" class="cPassword"  id="Pwd" />
            <i class="bx bx-hide show-hide" onclick="showPassword('Pwd')"></i>
          </div>
        </div>

        <input type="submit" value="Entrar">
      </form>
    </div>
  </div>
  <script>
    function showPassword(fieldId) {
      var x = document.getElementById(fieldId);
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>




</body>
</html>
