<?php include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tp_usuario WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $user = $_POST['user'];

    $sql = "UPDATE tp_usuario SET user='$user' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('Tipo de usuario actualizado con éxito');
        window.location = 'read.php';
      </script>";    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<link rel="stylesheet" href="../css/editarc.css"> 
<h2>Editar Tipo de Usuario</h2>
<form action="update.php" method="POST" class="centered-form" onsubmit="return validarUsuario()">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <label for="user">Tipo de Usuario:</label>
    <input type="text" id="user" name="user" value="<?php echo $row['user']; ?>" required>
    <input type="submit" name="submit" value="Actualizar" class="blue-button">
</form>

<script>
function validarUsuario() {
    var usuarioInput = document.getElementById("user").value;
    // Verificar si la entrada contiene solo letras y tiene entre 1 y 10 caracteres
    if (/^[a-zA-Z]{1,10}$/.test(usuarioInput)) {
        return true; // Envía el formulario si la validación es exitosa
    } else {
        alert("El tipo de usuario debe contener solo letras.");
        return false; // Detiene el envío del formulario si la validación falla
    }
}
</script>


<?php include '../includes/footer.php'; ?>
