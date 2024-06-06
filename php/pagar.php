<?php
include("../crud/includes/db.php");

if (isset($_GET['id_impuesto']) && isset($_GET['placa'])) {
    // Recoger el ID del impuesto y la placa del vehículo del parámetro GET
    $id_impuesto = $_GET['id_impuesto'];
    $placa = $_GET['placa'];

    // Preparar la consulta SQL para actualizar el estado del impuesto
    $sql = "UPDATE impuesto SET id_estado = 2 WHERE id = ?";

    // Preparar la declaración SQL
    $stmt = $conn->prepare($sql);

    // Vincular el parámetro ID
    $stmt->bind_param("i", $id_impuesto);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo '
        <script>
            alert("Felicidades el impuesto se ha pagado correctamente");
            window.location = "detalle.php?placa=' . $placa . '"; // Redirigir a detalle.php con la placa
        </script>
        ';
    } else {
        echo "Error al actualizar el estado del impuesto: " . $conn->error;
    }

    // Cerrar la declaración
    $stmt->close();
} else {
    echo "No se proporcionó un ID de impuesto válido.";
}

// Cerrar la conexión a la base de datos
$conn->close();

?>
