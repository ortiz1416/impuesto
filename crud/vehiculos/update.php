<?php
include '../includes/header.php';
include '../includes/db.php';

$row = null;
$marca_nombre = "";

if (isset($_GET['placa'])) {
    $placa = $conn->real_escape_string($_GET['placa']);
    $sql = "SELECT v.*, m.marca as marca_nombre FROM vehiculos v LEFT JOIN marcas m ON v.marca = m.id WHERE v.placa='$placa'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $marca_nombre = $row['marca_nombre'];
    } else {
        echo "No se encontró el vehículo.";
    }
}

if (isset($_POST['submit'])) {
    $placa = $conn->real_escape_string($_POST['placa']);
    $propietario = $conn->real_escape_string($_POST['propietario']);
    $cilindrada = $conn->real_escape_string($_POST['cilindrada']);
    $capacidad = $conn->real_escape_string($_POST['capacidad']);
    $id_color = $conn->real_escape_string($_POST['id_color']);

    $sql = "UPDATE vehiculos SET 
                propietario='$propietario', 
                cilindrada='$cilindrada', 
                capacidad='$capacidad', 
                id_color='$id_color' 
            WHERE placa='$placa'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Vehículo actualizado con éxito');
                window.location = 'read.php';
              </script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<link rel="stylesheet" href="../css/crudusu.css">
<h2>Editar Vehículo</h2>
<form action="update.php" method="POST">
    <?php if ($row) : ?>
        <label for="placa">Placa:</label>
        <input type="text" name="placa" value="<?php echo htmlspecialchars($row['placa']); ?>" readonly>

        <label for="marca">Marca:</label>
        <input type="text" name="marca" value="<?php echo htmlspecialchars($marca_nombre); ?>" readonly>

        <label for="modelo">Modelo:</label>
        <input type="text" name="modelo" value="<?php echo htmlspecialchars($row['modelo']); ?>" readonly>

        <label for="propietario">Propietario:</label>
        <select name="propietario" required>
            <?php
            $sql = "SELECT documento, CONCAT(nombres, ' ', apellidos) AS nombre_completo FROM usuarios";
            $result = $conn->query($sql);
            while ($usuario_row = $result->fetch_assoc()) {
                $selected = $usuario_row['documento'] == $row['propietario'] ? 'selected' : '';
                echo "<option value='" . htmlspecialchars($usuario_row['documento']) . "' $selected>" . htmlspecialchars($usuario_row['nombre_completo']) . "</option>";
            }
            ?>
        </select>

        <label for="cilindrada">Cilindrada:</label>
        <select name="cilindrada" required>
            <?php
            $sql = "SELECT id, cilindrada FROM cilindrada";
            $result = $conn->query($sql);
            while ($cilindrada_row = $result->fetch_assoc()) {
                $selected = $cilindrada_row['id'] == $row['cilindrada'] ? 'selected' : '';
                echo "<option value='" . htmlspecialchars($cilindrada_row['id']) . "' $selected>" . htmlspecialchars($cilindrada_row['cilindrada']) . "</option>";
            }
            ?>
        </select>

        <label for="capacidad">Capacidad:</label>
        <input type="text" name="capacidad" value="<?php echo htmlspecialchars($row['capacidad']); ?>" required>

        <label for="combustible">Combustible:</label>
        <select name="combustible" readonly>
            <?php
            $sql = "SELECT id, combustibles FROM combustible";
            $result = $conn->query($sql);
            while ($combustible_row = $result->fetch_assoc()) {
                $selected = $combustible_row['id'] == $row['combustible'] ? 'selected' : '';
                echo "<option value='" . htmlspecialchars($combustible_row['id']) . "' $selected>" . htmlspecialchars($combustible_row['combustibles']) . "</option>";
            }
            ?>
        </select>

        <label for="color">Color:</label>
        <select name="id_color" required>
            <?php
            $sql = "SELECT id, color FROM colores";
            $result = $conn->query($sql);
            while ($color_row = $result->fetch_assoc()) {
                $selected = $color_row['id'] == $row['color'] ? 'selected' : '';
                echo "<option value='" . htmlspecialchars($color_row['id']) . "' $selected>" . htmlspecialchars($color_row['color']) . "</option>";
            }
            ?>
        </select>

        <label for="linea">Línea:</label>
        <input type="text" name="linea" value="<?php echo htmlspecialchars($row['linea']); ?>" readonly>

        <label for="f_matricula">Fecha de Matrícula:</label>
        <input type="date" name="f_matricula" value="<?php echo htmlspecialchars($row['f_matricula']); ?>" readonly>

        <input type="submit" name="submit" value="Actualizar">
    <?php else : ?>
        <p>No se ha encontrado el vehículo. Por favor, verifica la placa.</p>
    <?php endif; ?>
</form>

<?php
$conn->close();
include '../includes/footer.php';
?>
