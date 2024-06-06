<?php include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $modelo = $_POST['modelo'];

    $sql = "INSERT INTO modelos (modelo) VALUES ('$modelo')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo modelo creado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<link rel="stylesheet" href="../css/editarc.css"> 
<h2>Crear Nuevo Modelo</h2>
<form method="post" class="centered-form" onsubmit="return validarModelo()">
    <label for="modelo">Modelo:</label>
    <input type="text" id="modelo" name="modelo" required>
    <input type="submit" value="Crear" class="blue-button">
</form>

<script>
function validarModelo() {
    var modeloInput = document.getElementById("modelo").value.trim();
    // Expresión regular que valida solo números y máximo 4 dígitos
    var regex = /^\d{1,4}$/;
    // Verificar si la entrada coincide con la expresión regular
    if (regex.test(modeloInput)) {
        return true; // Envía el formulario si la validación es exitosa
    } else {
        alert("El modelo debe contener solo números y tener máximo 4 dígitos.");
        return false; // Detiene el envío del formulario si la validación falla
    }
}
</script>


<?php include '../includes/footer.php'; ?>
