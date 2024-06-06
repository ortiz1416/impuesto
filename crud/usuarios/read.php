<?php include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>
<link rel="stylesheet" href="../css/crudc.css">
<h2>Lista de Usuarios</h2>
<a href="create.php" class="green-button">crear</a>

<table>
    <tr>
        <th>Documento</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Correo</th>
        <th>Teléfono</th>
        <th>Tipo de Usuario</th>
        <th>Acciones</th>
    </tr>
    <?php
    $sql = "SELECT u.*, t.user FROM usuarios u INNER JOIN tp_usuario t ON u.tp_user = t.id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["documento"] . "</td>
                    <td>" . $row["nombres"] . "</td>
                    <td>" . $row["apellidos"] . "</td>
                    <td>" . $row["correo"] . "</td>
                    <td>" . $row["Telefono"] . "</td>
                    <td>" . $row["user"] . "</td>
                    <td>
                        <a href='update.php?documento=" . $row["documento"] . "'>Editar</a>
                        <a href='delete.php?documento=" . $row["documento"] . "'>Eliminar</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No hay usuarios</td></tr>";
    }
    ?>
</table>

<?php include '../includes/footer.php'; ?>
