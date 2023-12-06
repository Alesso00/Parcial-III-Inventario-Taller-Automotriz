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

  <title>Gestion de repuestos</title>
</head>
<ul class="nav nav-pills nav-fill">
<a class="navbar-brand">
      <img src="../img/icono.png" alt="" width="40" height="34" class="d-inline-block align-text-top">
      Inventario Taller Automotriz 
    </a>

  <li class="nav-item">
    <a class="btn btn-outline-primary" aria-current="page" href="Dashboard.php"">Ver inventario</a>
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
  <a class="btn btn-danger" aria-current="page" href="../Exit/salir.php">Cerrar sesion</a>
  <li> <br></li>
  </li>
</ul>
  <h1>Ver repuestos</h1>

<section style="width:666px; margin:0 auto;">
<br><br>
    <table class="table  table-hover" >
        <tr>
            <th>ID</th>
            <th>Repuesto</th>  
            <th>Opciones</th>
            <th></th>
        </tr>
        <tbody>
            <?php
            foreach ($repuesto as $repuestos) {
                echo "<tr>";
                echo "<td>".$repuestos['id_repuesto']."</td>";
                echo "<td>".$repuestos['tipo_repuesto']."</td>";
                
                echo "<td><form action='View_Update_repuesto.php' method='POST'>
                <input type='text' name='id' value='".$repuestos['id_repuesto']."' hidden >
               <input type='submit' class='btn btn-success' value='Modificar'>
               </form></td>";

                echo "<td><form action='../Delete/Delete_repuesto.php' method='POST'>
                        <input type='text' name='id' value='".$repuestos['id_repuesto']."' hidden >
                        <input type='text' name='opcion' value='3' hidden >
                       <input type='submit' class='btn btn-danger' value='Eliminar'>
                       </form></td>";
                echo "</tr>";

  }
  ?>
</tbody>
</table>
</section>
</body>
</html>