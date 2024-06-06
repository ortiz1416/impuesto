<?php include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM cilindrada WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $cilindrada = $_POST['cilindrada'];

    $sql = "UPDATE cilindrada SET cilindrada='$cilindrada' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('Cilindrada actualizado con éxito');
        window.location = 'read.php';
      </script>";    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<link rel="stylesheet" href="../css/editarc.css">    
<h2>Editar Cilindrada</h2>
<form action="update.php" method="POST" class="centered-form" onsubmit="return validarCilindrada()">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <label for="cilindrada">Cilindrada:</label>
    <input type="text" id="cilindrada" name="cilindrada" value="<?php echo $row['cilindrada']; ?>" required>
    <input type="submit" name="submit" value="Actualizar" class="blue-button">
</form>

<script>
function validarCilindrada() {
    var cilindradaInput = document.getElementById("cilindrada").value;
    // Verificar si la entrada contiene solo números, no tiene ceros al principio y tiene máximo 5 dígitos
    if (/^[1-9]\d{0,4}$/.test(cilindradaInput)) {
        return true; // Envía el formulario si la validación es exitosa
    } else {
        alert("La cilindrada debe tener máximo de 5 dígitos.");
        return false; // Detiene el envío del formulario si la validación falla
    }
}
</script>



<?php include '../includes/footer.php'; ?>
