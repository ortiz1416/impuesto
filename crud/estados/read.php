<?php include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>
<link rel="stylesheet" href="../css/crudc.css">
<h2>Estados</h2>
<a href="create.php" class="green-button">crear</a>

<table>
    <tr>
        <th>ID</th>
        <th>Estado</th>
        <th>Acciones</th>
    </tr>
    <?php
    $sql = "SELECT * FROM estados";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["estado"] . "</td>";
            echo "<td><a href='update.php?id=" . $row["id"] . "'>Editar</a> | <a href='delete.php?id=" . $row["id"] . "'>Eliminar</a></td>";
            echo "</tr>";
        }
    } else {
        echo "No se encontraron estados";
    }
    ?>
</table>

<?php include '../includes/footer.php'; ?>
