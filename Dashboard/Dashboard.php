<?php
session_start();

// Redirige a la página de inicio si el usuario no ha iniciado sesión
if ($_SESSION['usuario'] === null) {
    header('Location: index.php');
    exit(); // Agrega exit() después de header para detener la ejecución del script
}

include_once '../Conexion/Conexion.php';

$conexion = new ConexionPDO($host, $dbname, $usernameServer, $passwordServer);
$conexion->conectar();

$query = "SELECT inventario.id_inventario as id, tipo_repuesto.tipo_repuesto as repuesto, marca_vehiculo.marca as marca, modelo_vehiculo.modelo as modelo,
 year, entrada, salida, stock, costo, fecha FROM inventario 
 inner join tipo_repuesto on inventario.id_repuesto = tipo_repuesto.id_repuesto
 inner join marca_vehiculo on inventario.id_marca = marca_vehiculo.id_marca
 inner join modelo_vehiculo on inventario.id_modelo =modelo_vehiculo.id_modelo";
$statement = $conexion->getConnection()->query($query);
$inventarios = $statement->fetchAll(PDO::FETCH_ASSOC);

// Inicializar la variable $totalDinero
$totalDinero = 0;

// Calcular el total de dinero en inventario
foreach ($inventarios as $inventario) {
    $totalDinero += $inventario['costo'] * $inventario['stock'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../css/styles_dash.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
    <title>Productos</title>
</head>
<body>

<ul class="nav nav-pills nav-fill">
<a class="navbar-brand">
      <img src="../img/icono.png" alt="" width="40" height="34" class="d-inline-block align-text-top">
      Inventario Taller Automotriz 
    </a>

  <li class="nav-item">
    <a class="btn btn-primary" aria-current="page" href="Dashboard.php">Ver inventario</a>
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
  <a class="btn btn-outline-primary" aria-current="page" href="View_repuesto.php">Repuestos</a>
  </li>
  <li class="nav-item">
    <a class="btn btn-outline-primary" aria-current="page" href="View_User.php">Usuarios</a>
  </li>
  <a class="btn btn-danger" aria-current="page" href="../Exit/salir.php">Cerrar sesion</a>
  <li> <br></li>
  </li>

</ul>
<h1>Inventario</h1>


<section style="width:999px; margin:0 auto;">
<br><br>
    <table class="table  table-hover" >
        <tr>
            <th >ID</th>
            <th>Repuesto</th>
            <th>Vehiculo</th>
            <th>Modelo</th>
            <th>Año</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Fecha entrada</th>
            <th>Opciones</th>
            <th></th>
        </tr>
        <tbody>
            <?php
            $totalStock = 0;
        foreach ($inventarios as $inventario) {
                echo "<tr>";
                echo "<td>".$inventario['id']."</td>";
                echo "<td>".$inventario['repuesto']."</td>";
                echo "<td>".$inventario['marca']."</td>";
                echo "<td>".$inventario['modelo']."</td>";
                echo "<td>".$inventario['year']."</td>";
                echo "<td>$ ".$inventario['costo']."</td>";
                echo "<td>".$inventario['stock']."</td>";
                echo "<td>".$inventario['fecha']."</td>";
                
                echo "<td><form action='View_Update_inventario.php' method='POST'>
                <input type='text' name='id' value='".$inventario['id']."' hidden >
               <input type='submit' class='btn btn-success' value='Modificar'>
               </form></td>";

                echo "<td><form action='../Delete/Delete_inventario.php' method='POST'>
                        <input type='text' name='id' value='".$inventario['id']."' hidden >
                       <input type='submit' class='btn btn-danger' value='Eliminar'>
                       </form></td>";
                echo "</tr>";

                $totalStock += $inventario['stock'];
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="1"></td>
                <td>Total de productos:</td>
                <td><?php echo $totalStock; ?></td>
                </tr>
            <tr>
                <td colspan="6"></td>
                <td>Total de dinero en inventario:</td>
                <td>$ <?php echo number_format($totalDinero, 2); ?></td>
            </tr>
        </tfoot>
        
    </table>

</section>

<footer class="footer mt-5">

        <div class="text-center py-3">
            <p>&copy; 2023 Taller. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>