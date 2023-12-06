<?php
session_start();
if ($_SESSION['usuario'] === null) {
  header('Location:.index.php');
}

include_once '../Conexion/Conexion.php';
$conexion = new ConexionPDO($host, $dbname, $usernameServer, $passwordServer);
$conexion->conectar();

$query = "SELECT * FROM marca_vehiculo";
$statement = $conexion->getConnection()->query($query);
$marca = $statement->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../css/styles_insert.css">
  <link rel="stylesheet" type="text/css" href="../css/styles_dash.css">


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Nueva marca</title>
</head>

<body>
 
<ul class="nav nav-pills nav-fill">
<a class="navbar-brand">
      <img src="../img/icono.png" alt="" width="40" height="34" class="d-inline-block align-text-top">
      Inventario Taller Automotriz 
    </a>

  <li class="nav-item">
    <a class="btn btn-outline-primary" aria-current="page" href="Dashboard.php">Ver inventario</a>
  </li>
  <li class="nav-item">
  <a class="btn btn-outline-primary" aria-current="page" href="New_inventario.php">Agregar inventario</a>
  </li>
  <li class="nav-item">
  <a class="btn btn-primary" aria-current="page" href="New_marca_modelo_repuesto.php">Nueva Marca/Modelo/Repuesto</a>
  </li>
  <li class="nav-item">
  <a class="btn btn-outline-primary" aria-current="page" href="View_marca.php">Marcas</a>
  </li>
  <li class="nav-item">
  <a class="btn btn-outline-primary" aria-current="page" href="View_modelo.php">Modelos</a>
  </li>
  <li class="nav-item">
  <a class="btn btn-outline-primary" aria-current="page" href="View_repuesto.php">Repuestos</a>
  <li class="nav-item">
    <a class="btn btn-outline-primary" aria-current="page" href="View_User.php">Usuarios</a>
  </li>
  <li class="nav-item">
  <a class="btn btn-danger" aria-current="page" href="../Exit/salir.php">Cerrar sesion</a>
  <li> <br></li>
  </li>
</ul>
  <h1>Agregar marca</h1>

  <div class="form-container">
    <form action="../Insert/Insert_marca.php" method="POST">

      <input type="text" name="opcion" value="1" hidden>

      <div class="input-group">
        <label>Nombre de la marca:</label>
        <input type="text" name="nombremarca"  required>
      </div>
      <div class="button-group">
        <input type="submit" value="Guardar" id="guardarmarca">
      </div>
      </div>
    </form>

    <h1>Agregar modelo</h1>
    <div class="form-container">
  <form action="../Insert/Insert_modelo.php" method="POST">
    <input type="text" name="opcion" value="2" hidden>
    <div class="input-group">
      <label>Nombre del modelo:</label>
      <input type="text" name="nombremodelo"  required>
    </div>
    <div class="input-group">
        <label>Marca:</label>
        <select class="form-control form-control-sm"  name= "marcamodelo">
          <?php
          foreach ($marca as $marcas) {
            echo "<option value='" . $marcas['id_marca'] . "' >" . $marcas['marca'] . "</option>";
          }
          ?>
        </select>
      </div>
    <div class="button-group">
      <input type="submit" value="Guardar" id="guardarmodelo">
    </div>
    </div>
  </form>
<br>

<h1>Agregar repuestos</h1>
    <div class="form-container">
  <form action="../Insert/Insert_repuesto.php" method="POST">
    <input type="text" name="opcion" value="3" hidden>
    <div class="input-group">
      <label>Nombre del repuesto:</label>
      <input type="text" name="nombrerepuesto"  required>
    </div>
    <div class="button-group">
      <input type="submit" value="Guardar" id="guardarrepuesto">
    </div>
    </div>
  </form>
<br>
</body>
</html>