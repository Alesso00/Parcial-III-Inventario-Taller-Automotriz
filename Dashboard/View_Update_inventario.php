<?php
session_start();
if ($_SESSION['usuario'] === null) {
  header('Location:.index.php');
}

include_once '../Conexion/Conexion.php';
$conexion = new ConexionPDO($host, $dbname, $usernameServer, $passwordServer);
$conexion->conectar();

//
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
$query = "SELECT * FROM inventario  WHERE id_inventario=:id";
$statement = $conexion->getConnection()->prepare($query);
$statement->bindParam(':id', $id);
$statement->execute();
$inventario = $statement->fetch(PDO::FETCH_ASSOC);
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

  <title>Editar producto</title>
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
  <a class="btn btn-primary" aria-current="page" href="New_inventario.php">Agregar inventario</a>
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
  <h1>Modificar inventario</h1>

  <div class="form-container">
    <form action="../Update/Update_inventario.php" method="POST">

    <input type="text" name="id"  value="<?php echo $inventario['id_inventario'];?>" hidden >
    <input type="text" name="opcion" value="2" hidden>
      <div class="input-group">
        <label>Repuesto:</label>
        <select class="form-control form-control-sm"  name="repuesto1">
          <?php
          foreach ($repuesto as $repuestos) {
            if($repuestos['id_repuesto']== $inventario['id_repuesto']){
              echo "<option value='".$repuestos['id_repuesto']."' selected>".$repuestos['tipo_repuesto']."</option>";
          }else{
            echo "<option value='" . $repuestos['id_repuesto'] . "' >" . $repuestos['tipo_repuesto'] . "</option>";
          }
        }
          
          ?>
        </select>
      </div>

      <div class="input-group">
        <label>Marca:</label>
        <select class="form-control form-control-sm"  name= "marca1">
          <?php
          foreach ($marca as $marcas) {
            if($marcas['id_marca']== $inventario['id_marca']){
              echo "<option value='".$marcas['id_marca']."' selected>".$marcas['marca']."</option>";
          }else{
            echo "<option value='" . $marcas['id_marca'] . "' >" . $marcas['marca'] . "</option>";
          }}
          ?>
        </select>
      </div>

      <div class="input-group">
        <label>Modelo:</label>
        <select class="form-control form-control-sm"  name="modelo1">
          <?php
          foreach ($modelo as $modelos) {
            if($modelos['id_modelo']== $inventario['id_modelo']){
              echo "<option value='".$modelos['id_modelo']."' selected>".$modelos['modelo']."</option>";
          }else{
            echo "<option value='" . $modelos['id_modelo'] . "' >" . $modelos['modelo'] . "</option>";
          }}
          ?>
        </select>
      </div>
      <div class="input-group">
        <label>Año del vehiculo:</label>
        <input type="number" name="year" min="0" required value="<?php echo $inventario['year'];?>">
      </div>

      <div class="input-group">
        <label>Cantidad de entrada:</label>
        <input type="number" name="entrada" min="0" required value="<?php echo $inventario['entrada'];?>">
      </div>

      <div class="input-group">
        <label>Cantidad de salida:</label>
        <input type="number" name="salida" required value="<?php echo $inventario['salida'];?>">
      </div>

      <div class="input-group "aria-label="Dollar amount (with dot and two decimal places)">
        <label>Costo del repuesto: </label>
        <span class="input-group-text">$</span>
        <input type="number" name="costo" required value="<?php echo $inventario['costo'];?>">
      </div>
      <div class="input-group">
        <label>Fecha de ingreso:</label>
        <input type="date" name="fecha" required value="<?php echo $inventario['fecha'];?>">
      </div>
      <div class="button-group">
        <input type="submit" value="Editar" id="editar">
      </div>
    </form>
</body>

</html>