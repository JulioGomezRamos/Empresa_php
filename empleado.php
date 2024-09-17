<?php
include("datos_conexion.php");

// Verificar si la conexión es exitosa
$db_conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_db);
if (!$db_conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Verificar qué botón ha sido presionado
if (isset($_POST['btn_crear'])) {
    // Opción para crear nuevo registro
    $codigo = $_POST['txt_codigo'];
    $nombre = $_POST['txt_nombres'];
    $apellido = $_POST['txt_apellidos'];
    $direccion = $_POST['txt_direccion'];
    $telefono = $_POST['txt_telefono'];
    $fecha_nacimiento = $_POST['txt_fn'];
    $puesto_id = $_POST['drop_puesto'];

    $query = "INSERT INTO empleados (codigo, nombre, apellido, direccion, telefono, fecha_nacimiento, puesto_id) 
              VALUES ('$codigo', '$nombre', '$apellido', '$direccion', '$telefono', '$fecha_nacimiento', '$puesto_id')";
    
    if (mysqli_query($db_conexion, $query)) {
        echo "Registro creado exitosamente.";
    } else {
        echo "Error al crear el registro: " . mysqli_error($db_conexion);
    }

} elseif (isset($_POST['btn_actualizar'])) {
    // Opción para actualizar un registro
    $id = $_POST['txt_id'];
    $codigo = $_POST['txt_codigo'];
    $nombre = $_POST['txt_nombres'];
    $apellido = $_POST['txt_apellidos'];
    $direccion = $_POST['txt_direccion'];
    $telefono = $_POST['txt_telefono'];
    $fecha_nacimiento = $_POST['txt_fn'];
    $puesto_id = $_POST['drop_puesto'];

    $query = "UPDATE empleados SET codigo='$codigo', nombre='$nombre', apellido='$apellido', 
              direccion='$direccion', telefono='$telefono', fecha_nacimiento='$fecha_nacimiento', puesto_id='$puesto_id' 
              WHERE id='$id'";
    
    if (mysqli_query($db_conexion, $query)) {
        echo "Registro actualizado exitosamente.";
    } else {
        echo "Error al actualizar el registro: " . mysqli_error($db_conexion);
    }

} elseif (isset($_POST['btn_borrar'])) {
    // Opción para borrar un registro
    $id = $_POST['txt_id'];

    $query = "DELETE FROM empleados WHERE id='$id'";
    
    if (mysqli_query($db_conexion, $query)) {
        echo "Registro borrado exitosamente.";
    } else {
        echo "Error al borrar el registro: " . mysqli_error($db_conexion);
    }
}

mysqli_close($db_conexion);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Empresa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script>
        // JavaScript para seleccionar una fila de la tabla y llenar el formulario
        function seleccionarEmpleado(id, codigo, nombre, apellido, direccion, telefono, puesto, fechaNacimiento) {
            document.getElementById('txt_id').value = id;
            document.getElementById('txt_codigo').value = codigo;
            document.getElementById('txt_nombres').value = nombre;
            document.getElementById('txt_apellidos').value = apellido;
            document.getElementById('txt_direccion').value = direccion;
            document.getElementById('txt_telefono').value = telefono;
            document.getElementById('drop_puesto').value = puesto;
            document.getElementById('txt_fn').value = fechaNacimiento;
        }
    </script>
</head>
<body>
<header>
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Inicio</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="https://umg.edu.gt/" target="_blank">UMG</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Menu
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="empleado.php">Empleado</a></li>
            <li><a class="dropdown-item" href="#">Nuevo</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Vacio</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
</header>

<h1>Formulario Empleado</h1>
<div class="container">     
    <form action="empleado.php" method="post" class="form-group needs-validation" novalidate>
        <label for="lbl_id" class="form-label"><b>ID</b></label>
        <input type="text" class="form-control" name="txt_id" id="txt_id" value="0" readonly>

        <label for="lbl_codigo" class="form-label"><b>Codigo</b></label>
        <input type="text" name="txt_codigo" id="txt_codigo" class="form-control" placeholder="Ejemplo: E001" pattern="[E]{1}[0-9]{3}" required>

        <label for="lbl_nombres" class="form-label"><b>Nombres</b></label>
        <input type="text" name="txt_nombres" id="txt_nombres" class="form-control" placeholder="Ejemplo: Nombre1 Nombre2" required>

        <label for="lbl_apellidos" class="form-label"><b>Apellidos</b></label>
        <input type="text" name="txt_apellidos" id="txt_apellidos" class="form-control" placeholder="Ejemplo: Apellido1 Apellido2" required>

        <label for="lbl_direccion" class="form-label"><b>Direccion</b></label>
        <input type="text" name="txt_direccion" id="txt_direccion" class="form-control" placeholder="Ejemplo: #casa calle avenida" required>

        <label for="lbl_telefono" class="form-label"><b>Telefono</b></label>
        <input type="tel" name="txt_telefono" id="txt_telefono" class="form-control" placeholder="Ejemplo: 55551234" pattern="[0-9]{8}" required>

        <label for="lbl_fn" class="form-label"><b>Fecha de Nacimiento</b></label>
        <input type="date" name="txt_fn" id="txt_fn" class="form-control" required>

        <label for="lbl_puesto" class="form-label"><b>Puesto</b></label>
        <select name="drop_puesto" id="drop_puesto" class="form-select" required>
            <option selected disabled value="">Seleccione</option>
            <?php 
            $db_conexion = mysqli_connect($db_host,$db_user,$db_pass,$db_db); 
            if ($db_conexion){
                $db_conexion->real_query("SELECT id, nombre FROM puestos");
                $resultado = $db_conexion->use_result();
                while($fila = $resultado->fetch_assoc()){
                    echo "<option value='". $fila['id'] ."'>". $fila['nombre'] ."</option>";
                }
            } 
            $db_conexion->close();
            ?>
        </select>
        <br>
        <button name="btn_crear" id="btn_crear" class="btn btn-primary" value="crear"><i class="bi bi-save-fill"></i> Crear</button>
        <button name="btn_actualizar" id="btn_actualizar" class="btn btn-warning" value="actualizar"><i class="bi bi-pencil-fill"></i> Actualizar</button>
        <button name="btn_borrar" id="btn_borrar" class="btn btn-danger" value="borrar"><i class="bi bi-trash-fill"></i> Borrar</button>
    </form>
    <div class="table-responsive">
    <table class="table table-striped table-inverse table-responsive">
        <thead class="table-inverse">
            <caption>Empleados y Puestos</caption>
            <tr>
                <th>ID</th>
                <th>Codigo</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Direccion</th>
                <th>Telefono</th>
                <th>Puesto</th>
                <th>Fecha de Nacimiento</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
            $db_conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_db);
            if ($db_conexion) {
                $query = "SELECT e.id, e.codigo, e.nombre, e.apellido, 
                                 e.direccion, e.telefono, p.id AS puesto_id, p.nombre AS puesto, e.fecha_nacimiento
                          FROM empleados e
                          JOIN puestos p ON e.puesto_id = p.id";
                $resultado = mysqli_query($db_conexion, $query);
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo "<tr class='table-primary' onclick=\"seleccionarEmpleado(
                            '{$fila['id']}', '{$fila['codigo']}', '{$fila['nombre']}', '{$fila['apellido']}', 
                            '{$fila['direccion']}', '{$fila['telefono']}', '{$fila['puesto_id']}', '{$fila['fecha_nacimiento']}')\">
                            <td>{$fila['id']}</td>
                            <td>{$fila['codigo']}</td>
                            <td>{$fila['nombre']}</td>
                            <td>{$fila['apellido']}</td>
                            <td>{$fila['direccion']}</td>
                            <td>{$fila['telefono']}</td>
                            <td>{$fila['puesto']}</td>
                            <td>{$fila['fecha_nacimiento']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='8'>Error al conectar a la base de datos</td></tr>";
            }
            $db_conexion->close();
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="8">Total de empleados: 
                <?php 
                echo isset($resultado) ? mysqli_num_rows($resultado) : 0; 
                ?>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq9K2dQjQmNQH2I9q5RV9i78kQgn5N9LPocSxT4Hl8R9d5Jxh5" crossorigin="anonymous"></script>
</body>
</html>
