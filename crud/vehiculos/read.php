<?php
session_start();

if (!isset($_SESSION['id_us'])) {
    echo '
    <script>
        alert("Por favor inicie sesión e intente nuevamente");
        window.location = "../../php/login.php";
    </script>
    ';
    session_destroy();
    die();
}
include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>
<link rel="stylesheet" href="../css/crudc.css">
<h2>Lista de Vehículos</h2>
<a href="create.php" class="green-button">crear</a>
<style>
    a[href^='../../php/impuestos.php'] {
  background-color:yellow;
  color: black;
  padding: 5px 10px;
  border-radius: 16px;
  text-decoration: none;
}
.green-button {
  background-color: green;
  color: white;
  padding: 10px 20px;
  text-decoration: none;
  border-radius: 5px;
  margin: 20px; /* Agrega margen alrededor del botón */
  
}

</style> 

<table>
    <tr>
        <th>Placa</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Propietario</th>
        <th>Cilindrada</th>
        <th>Número de Motor</th>
        <th>Número de Chasis</th>
        <th>Valor del vehiculo</th>
        <th>Tipo de Vehículo</th>
        <th>Capacidad</th>
        <th>Combustible</th>
        <th>Color</th>
        <th>Línea</th>
        <th>Fecha de Matrícula</th>
        <th>Porcentaje de avaluo</th> <!-- Cambiado el encabezado de la columna -->
        <th>crear impuesto</th>
        <th>editar</th>
        <th>eliminar</th>

    </tr>
    <?php
    $sql = "SELECT v.*, 
       m.marca AS marca_nombre, 
       mo.modelo AS modelo_nombre,
       u.nombres AS propietario_nombres, 
       u.apellidos AS propietario_apellidos, 
       c.cilindrada AS cilindrada_nombre, 
       t.vehiculos AS tipo_vehiculo_nombre, 
       co.combustibles AS combustible_nombre,
       col.color AS color_nombre,
       av.avaluo AS avaluo_porcentaje
    FROM vehiculos v 
    JOIN marcas m ON v.marca = m.id
    JOIN modelos mo ON v.modelo = mo.id
    JOIN usuarios u ON v.propietario = u.documento 
    JOIN cilindrada c ON v.cilindrada = c.id 
    JOIN tp_vehiculos t ON v.tp_vehiculo = t.id 
    JOIN combustible co ON v.combustible = co.id
    JOIN colores col ON v.id_color = col.id
    JOIN avaluos av ON v.id_avaluo = av.id"; // Se ha agregado el JOIN con la tabla de avalúos

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
            <td>" . $row["placa"] . "</td>
            <td>" . $row["marca_nombre"] . "</td>
            <td>" . $row["modelo_nombre"] . "</td>
            <td>" . $row["propietario_nombres"] . " " . $row["propietario_apellidos"] . "</td>
            <td>" . $row["cilindrada_nombre"] . "</td>
            <td>" . $row["n_motor"] . "</td>
            <td>" . $row["n_chasis"] . "</td>
            <td>" . $row["valor"] . "</td>
            <td>" . $row["tipo_vehiculo_nombre"] . "</td>
            <td>" . $row["capacidad"] . "</td>
            <td>" . $row["combustible_nombre"] . "</td>
            <td>" . $row["color_nombre"] . "</td>
            <td>" . $row["linea"] . "</td>
            <td>" . $row["f_matricula"] . "</td>
            <td> " . $row["avaluo_porcentaje"] . "%</td> <!-- Cambiado para mostrar el porcentaje de avalúo -->
            <td> <a href='../../php/impuestos.php?placa=" . $row["placa"] . " '>crear</a> </td>
            <td> <a href='update.php?placa=" . $row["placa"] . "'>Editar</a> </td>
            
            <td> <a href='delete.php?placa=" . $row["placa"] . "'>Eliminar</a> </td>
          </tr>";
        }
    } else {
        echo "<tr><td colspan='15'>No hay vehículos</td></tr>";
    }
    ?>

</table>

<?php include '../includes/footer.php'; ?>