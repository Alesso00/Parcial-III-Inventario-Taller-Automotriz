<?php
session_start();
if ($_SESSION['usuario'] === null) {
  header('Location:.index.php');
}

include_once '../Conexion/Conexion.php';
$conexion = new ConexionPDO($host, $dbname, $usernameServer, $passwordServer);
$conexion->conectar();

$id = $_POST['id'];
$query = "SELECT * FROM tipo_repuesto  WHERE id_repuesto=:id";
$statement = $conexion->getConnection()->prepare($query);
$statement->bindParam(':id', $id);
$statement->execute();
$repuesto = $statement->fetch(PDO::FETCH_ASSOC);
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
  <a class="btn btn-outline-primary" aria-current="page" href="New_marca_modelo_repuesto.php">Nueva Marca/Modelo/Repuesto</a>
  </li>
  <li class="nav-item">
  <a class="btn btn-outline-primary" aria-current="page" href="View_marca.php">Marcas</a>
  </li>
  <li class="nav-item">
  <a class="btn btn-outline-primary" aria-current="page" href="View_modelo.php">Modelos</a>
  </li>
  <li class="nav-item">
  <a class="btn btn-primary" aria-current="page" href="View_repuesto.php">Repuestos</a>
  </li>
  <li class="nav-item">
    <a class="btn btn-outline-primary" aria-current="page" href="View_User.php">Usuarios</a>
  </li>
  <li class="nav-item">
  <a class="btn btn-danger" aria-current="page" href="salir.php">Cerrar sesion</a>
  <li> <br></li>
  </li>
</ul>
  <h1>Modificar repuesto</h1>

  <div class="form-container">
    <form action="../Update/Update_repuesto.php" method="POST">

      <input type="text" name="opcion" value="6" hidden>

      <input type="text" name="id"  value="<?php echo $repuesto['id_repuesto'];?>" hidden >
      <div class="input-group">
        <label>Nombre de la marca:</label>
        <input type="text" name="nombrerepuesto"  required  value=" <?php echo $repuesto['tipo_repuesto'];?>">
      </div>
      <div class="button-group">
        <input type="submit" value="Modificar" id="modificar">
      </div>
      </div>
    </form>
    </div>
    </form>
</body>

</html>