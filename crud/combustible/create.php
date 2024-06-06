<?php include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>
<link rel="stylesheet" href="../css/editarc.css"> 
<h2>Crear Combustible</h2>
<form action="create.php" method="POST" class="centered-form" onsubmit="return validarCombustible()">
    <label for="combustibles">Combustible:</label>
    <input type="text" id="combustibles" name="combustibles" required>
    <input type="submit" name="submit" value="Crear" class="blue-button">
</form>

<script>
function validarCombustible() {
    var combustibleInput = document.getElementById("combustibles").value;
    // Verificar si la entrada contiene solo letras y tiene máximo 8 caracteres
    if (/^[a-zA-Z]{1,8}$/.test(combustibleInput)) {
        return true; // Envía el formulario si la validación es exitosa
    } else {
        alert("El combustible debe contener máximo 8 caracteres.");
        return false; // Detiene el envío del formulario si la validación falla
    }
}
</script>


<?php
if (isset($_POST['submit'])) {
    $combustibles = $_POST['combustibles'];

    $sql = "INSERT INTO combustible (combustibles) VALUES ('$combustibles')";
    if ($conn->query($sql) === TRUE) {
        echo "Nuevo combustible creado con éxito";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<?php include '../includes/footer.php'; ?>
