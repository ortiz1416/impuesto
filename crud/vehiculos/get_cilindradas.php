<?php
include '../includes/db.php';

if (isset($_POST['tp_vehiculo'])) {
    $tp_vehiculo = intval($_POST['tp_vehiculo']);

    // Consulta para obtener las cilindradas según el tipo de vehículo
    if ($tp_vehiculo) { 
  
        $sql = "SELECT * FROM cilindrada WHERE id_tp_vehiculo = $tp_vehiculo";
    

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // Mostrar la opción inicial una sola vez
        echo "<option value='' disabled selected>Seleccione una cilindrada</option>";
        
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "'>" . $row['cilindrada'] . "</option>";
        }
    } else {
        echo "<option>No hay cilindradas disponibles para ese tipo de vehículo</option>";
    }
}
}
?>
