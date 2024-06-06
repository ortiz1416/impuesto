<?php include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>
<link rel="stylesheet" href="../css/editarc.css"> 
<h2>Crear Marca</h2>
<form action="create.php" method="POST" class="centered-form" onsubmit="return validarMarca()">
    <label for="marca">Marca:</label>
    <input type="text" id="marca" name="marca" required>
    <input type="submit" name="submit" value="Crear" class="blue-button">
</form>

<script>
function validarMarca() {
    var marcaInput = document.getElementById("marca").value;
    // Verificar si la entrada contiene solo letras y números y tiene máximo 14 caracteres
    if (/^[a-zA-Z0-9]{1,11}$/.test(marcaInput)) {
        return true; // Envía el formulario si la validación es exitosa
    } else {
        alert("La marca debe contener solo letras y números.");
        return false; // Detiene el envío del formulario si la validación falla
    }
}
</script>


<?php
if (isset($_POST['submit'])) {
    $marca = $_POST['marca'];

    $sql = "INSERT INTO marcas (marca) VALUES ('$marca')";
    if ($conn->query($sql) === TRUE) {
        echo "Nueva marca creada con éxito";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<?php include '../includes/footer.php'; ?>
