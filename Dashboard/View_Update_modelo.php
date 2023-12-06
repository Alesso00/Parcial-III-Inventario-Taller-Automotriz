<?php
session_start();
if ($_SESSION['usuario'] === null) {
  header('Location:.index.php');
}

include_once '../Conexion/Conexion.php';
$conexion = new ConexionPDO($host, $dbname, $usernameServer, $passwordServer);
$conexion->conectar();
$query = "SELECT * FROM tipo_repuesto";
$statement = $conexion->getConnection()->query($query);
$repuesto = $statement->fetchAll(PDO::FETCH_ASSOC);

$query = "SELECT * FROM marca_vehiculo";
$statement = $conexion->getConnection()->query($query);
$marca = $statement->fetchAll(PDO::FETCH_ASSOC);

$query = "SELECT * FROM modelo_vehiculo";
$statement = $conexion->getConnection()->query($query);
$modelo = $statement->fetchAll(PDO::FETCH_ASSOC);

$id = $_POST['id'];
$query = "SELECT * FROM modelo_vehiculo  WHERE id_modelo=:id";
$statement = $conexion->getConnection()->prepare($query);
$statement->bindParam(':id', $id);
$statement->execute();
$modelo = $statement->fetch(PDO::FETCH_ASSOC);
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
  <a class="btn btn-primary" aria-current="page" href="View_modelo.php">Modelos</a>
  </li>
  <li class="nav-item">
  <a class="btn btn-outline-primary" aria-current="page" href="View_repuesto.php">Repuestos</a>
  </li>
  <li class="nav-item">
    <a class="btn btn-outline-primary" aria-current="page" href="View_User.php">Usuarios</a>
  </li>
  <li class="nav-item">
  <a class="btn btn-danger" aria-current="page" href="salir.php">Cerrar sesion</a>
  <li> <br></li>
  </li>
</ul>
  <h1>Modificar modelo</h1>

    <div class="form-container">
  <form action="../Update/Update_modelo.php" method="POST">
    <input type="text" name="opcion" value="5" hidden>
    <div class="input-group">
    <input type="text" name="id"  value="<?php echo $modelo['id_modelo'];?>" hidden >
      <label>Nombre del modelo:</label>
      <input type="text" name="nombremodelo"  required  value=" <?php echo $modelo['modelo'];?>">
    </div>
    <div class="input-group">
        <label>Marca:</label>
        <select class="form-control form-control-sm"  name= "marcamodelo">
        <?php
          foreach ($marca as $marcas) {
            if($marcas['id_marca']== $modelo['id_marca']){
              echo "<option value='".$marcas['id_marca']."' selected>".$marcas['marca']."</option>";
          }else{
            echo "<option value='" . $marcas['id_marca'] . "' >" . $marcas['marca'] . "</option>";
          }}
          ?>
        </select>
      </div>
    <div class="button-group">
      <input type="submit" value="Guardar" id="guardarmodelo">
    </div>
    </div>
  </form>
<br>
</body>

</html>