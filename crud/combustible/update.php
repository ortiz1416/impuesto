<?php include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM combustible WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $combustibles = $_POST['combustibles'];

    $sql = "UPDATE combustible SET combustibles='$combustibles' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('Combustible actualizado con éxito');
        window.location = 'read.php';
      </script>";    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<link rel="stylesheet" href="../css/editarc.css"> 
<h2>Editar Combustible</h2>
<form action="update.php" method="POST" class="centered-form" onsubmit="return validarCombustible()">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <label for="combustibles">Combustible:</label>
    <input type="text" id="combustibles" name="combustibles" value="<?php echo $row['combustibles']; ?>" required>
    <input type="submit" name="submit" value="Actualizar" class="blue-button">
</form>

<script>
function validarCombustible() {
    var combustibleInput = document.getElementById("combustibles").value;
    // Verificar si la entrada contiene solo letras y tiene entre 1 y 8 caracteres
    if (/^[a-zA-Z]{1,8}$/.test(combustibleInput)) {
        return true; // Envía el formulario si la validación es exitosa
    } else {
        alert("El combustible debe contener solo 8 caracteres.");
        return false; // Detiene el envío del formulario si la validación falla
    }
}
</script>



<?php include '../includes/footer.php'; ?>
