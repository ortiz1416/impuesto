<?php
include '../includes/db.php';
include '../includes/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valor = $_POST['valor'];
    $id_tp_vehiculos = $_POST['id_tp_vehiculos'];
    $id_modelo = $_POST['id_modelo'];
    $id_modelo_hasta = $_POST['id_modelo_hasta'];

    $stmt = $conn->prepare("INSERT INTO valor (valor, id_tp_vehiculos, id_modelo, id_modelo_hasta) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siii", $valor, $id_tp_vehiculos, $id_modelo, $id_modelo_hasta);
    $stmt->execute();
    $stmt->close();

    echo '
    <script>
        alert("El vehículo ha sido creado correctamente");
        window.location = "read.php";
    </script>
    ';
       exit();
}

$stmt = $conn->prepare("SELECT id, vehiculos, peso FROM tp_vehiculos WHERE peso IS NOT NULL");
$stmt->execute();
$result = $stmt->get_result();
$tp_vehiculos = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<form method="post" action="">
    Valor: <input type="text" name="valor" required><br>
    Tipo de Vehículo:
    <select name="id_tp_vehiculos" required>
        <?php foreach ($tp_vehiculos as $vehiculo): ?>
            <option value="<?php echo $vehiculo['id']; ?>">
                <?php echo $vehiculo['vehiculos'] . ($vehiculo['peso'] ? ' - ' . $vehiculo['peso'] : ''); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <label for="modelo">Modelo:</label>
    <select name="id_modelo" required>
        <?php
        $stmt = $conn->prepare("SELECT * FROM modelos");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "'>" . $row['modelo'] . "</option>";
        }
        $stmt->close();
        ?>
    </select>
    <br>
    <label for="modelo">Modelo hasta:</label>
    <select name="id_modelo_hasta" required>
        <?php
        $stmt = $conn->prepare("SELECT * FROM modelos");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "'>" . $row['modelo'] . "</option>";
        }
        $stmt->close();
        ?>
    </select>
    <input type="submit" value="Guardar">
</form>

<?php include '../includes/footer.php'; ?>
