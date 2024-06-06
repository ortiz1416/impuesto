<?php include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>
<link rel="stylesheet" href="../css/crudc.css">
<h2>Lista de Tipos de Usuario</h2>
<a href="create.php" class="green-button">crear</a>

<table>
    <tr>
        <th>ID</th>
        <th>Tipo de Usuario</th>
        <th>Acciones</th>
    </tr>
    <?php
    $sql = "SELECT * FROM tp_usuario";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["user"] . "</td>
                    <td>
                        <a href='update.php?id=" . $row["id"] . "'>Editar</a>
                        <a href='delete.php?id=" . $row["id"] . "'>Eliminar</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No hay tipos de usuario</td></tr>";
    }
    ?>
</table>

<?php include '../includes/footer.php'; ?>