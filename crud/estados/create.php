<?php include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $estado = $_POST['estado'];

    $sql = "INSERT INTO estados (estado) VALUES ('$estado')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo estado creado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<link rel="stylesheet" href="../css/editarc.css"> 
<h2>Crear Nuevo Estado</h2>
<form method="post" class="centered-form" onsubmit="return validarEstado()">
    <label for="estado">Estado:</label>
    <input type="text" id="estado" name="estado" required>
    <input type="submit" value="Crear" class="blue-button">
</form>

<script>
function validarEstado() {
    var estadoInput = document.getElementById("estado").value.trim();
    // Expresión regular que valida letras y espacios y máximo 13 caracteres
    var regex = /^[a-zA-Z\s]{1,13}$/;
    // Verificar si la entrada coincide con la expresión regular
    if (regex.test(estadoInput)) {
        return true; // Envía el formulario si la validación es exitosa
    } else {
        alert("El estado debe contener solo letras.");
        return false; // Detiene el envío del formulario si la validación falla
    }
}
</script>


<?php include '../includes/footer.php'; ?>
