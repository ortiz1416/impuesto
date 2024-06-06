<?php
include '../includes/db.php';

if (isset($_POST['tp_vehiculo'])) {
    $tp_vehiculo = intval($_POST['tp_vehiculo']);

    // Consulta para obtener los combustibles según el tipo de vehículo
    if ($tp_vehiculo == 1) { // Automóvil
        $sql = "SELECT * FROM combustible";
    } else {
        $sql = "SELECT * FROM combustible WHERE id = (
                    SELECT tp_combustible FROM tp_vehiculos WHERE id = $tp_vehiculo
                )";
    }

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // Mostrar la opción inicial una sola vez
        echo "<option value='' disabled selected>selecciona un tipo de combustible </option>";
        
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "'>" . $row['combustibles'] . "</option>";
        }
    } else {
        echo "<option>No hay combustibles aun disponibles para ese vehiculo</option>";
    }
}
?>