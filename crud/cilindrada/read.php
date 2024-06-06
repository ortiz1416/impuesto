<?php include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>
<link rel="stylesheet" href="../css/crudc.css">
<h2>Lista de Cilindradas</h2>
<style>
  /* Estilo para el encabezado */


 
</style>
<a href="create.php" class="green-button">crear</a>

<table>
    <tr>
        <th>ID</th>
        <th>Cilindrada</th>
        <th>Tipo de Vehículo</th>
        <th>Acciones</th>
    </tr>
    <?php
    $sql = "SELECT c.id, c.cilindrada, t.vehiculos AS vehiculo 
            FROM cilindrada c 
            JOIN tp_vehiculos t ON c.id_tp_vehiculo = t.id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["cilindrada"] . "</td>
                    <td>" . $row["vehiculo"] . "</td>
                    <td>
                        <a href='update.php?id=" . $row["id"] . "'>Editar</a>
                        <a href='delete.php?id=" . $row["id"] . "'>Eliminar</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No hay cilindradas</td></tr>";
    }
    ?>
</table>

<?php include '../includes/footer.php'; ?>
