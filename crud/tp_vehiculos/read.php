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
<h2>Lista de Tipos de Vehículos</h2>
<a href="create.php" class="green-button">crear</a>

<table>
    <tr>
        <th>ID</th>
        <th>Tipo de Vehículo</th>
        <th>Peso</th>

        
    </tr>
    <?php
    $sql = "SELECT * FROM tp_vehiculos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["vehiculos"] . "</td>
                    <td>" . $row["peso"] . "</td>

                   
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No hay tipos de vehículos</td></tr>";
    }
    ?>
</table>

<?php include '../includes/footer.php'; ?>
