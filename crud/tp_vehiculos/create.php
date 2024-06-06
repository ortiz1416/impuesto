<?php include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>
<link rel="stylesheet" href="../css/editarc.css">
<h2>Crear Tipo de Vehículo</h2>
<form action="create.php" method="POST" class="centered-form" onsubmit="return validarFormulario()">
    <label for="vehiculos">Tipo de Vehículo:</label>
    <input type="text" id="vehiculos" name="vehiculos" required>

    <label for="peso">Peso del vehículo:</label>
    <input type="text" id="peso" name="peso">
    <input type="submit" name="submit" value="Crear" class="blue-button">
</form>

<script>
function validarFormulario() {
    // Obtener los valores de los campos
    var vehiculoInput = document.getElementById("vehiculos").value;
    var pesoInput = document.getElementById("peso").value;

    // Validar el tipo de vehículo
    if (!/^[a-zA-Z]{1,10}$/.test(vehiculoInput)) {
        alert("El tipo de vehículo debe contener solo letras.");
        return false; // Detiene el envío del formulario si la validación falla
    }

    // Validar el peso del vehículo
    if (!/^[\w.]{1,15}$/.test(pesoInput) || parseFloat(pesoInput) <= 0) {
        alert("El peso del vehículo debe tener máximo 15 caracteres.");
        return false; // Detiene el envío del formulario si la validación falla
    }

    return true; // Envía el formulario si todas las validaciones son exitosas
}
</script>






<?php
if (isset($_POST['submit'])) {
    $vehiculos = $_POST['vehiculos'];
    $peso = $_POST['peso'];


    $sql = "INSERT INTO tp_vehiculos (vehiculos, peso) VALUES ('$vehiculos','$peso')";
    if ($conn->query($sql) === TRUE) {
        echo '
        <script>
            alert("El tipo de vehículo ha sido creado correctamente");
            window.location = "read.php";
        </script>
        ';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<?php include '../includes/footer.php'; ?>