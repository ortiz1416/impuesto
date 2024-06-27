<?php
session_start();

if (!isset($_SESSION['id_us'])) {
    echo '
    <script>
        alert("Por favor inicie sesión e intente nuevamente");
        window.location = "../../php/login.php";
    </script>
    ';
    session_destroy();
    die();
}
include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>
<link rel="stylesheet" href="../css/editarc.css"> 
<h2>Crear Tipo de Usuario</h2>
<form action="create.php" method="POST" class="centered-form" onsubmit="return validarUsuario()">
    <label for="user">Tipo de Usuario:</label>
    <input type="text" id="user" name="user" required>
    <input type="submit" name="submit" value="Crear" class="blue-button">
</form>

<script>
function validarUsuario() {
    var usuarioInput = document.getElementById("user").value;
    // Verificar si la entrada contiene entre 1 y 10 letras y no contiene otros caracteres
    if (/^[a-zA-Z]{1,10}$/.test(usuarioInput)) {
        return true; // Envía el formulario si la validación es exitosa
    } else {
        alert("El tipo de usuario debe contener máximo 10 letras.");
        return false; // Detiene el envío del formulario si la validación falla
    }
}
</script>


<?php
if (isset($_POST['submit'])) {
    $user = $_POST['user'];

    $sql = "INSERT INTO tp_usuario (user) VALUES ('$user')";
    if ($conn->query($sql) === TRUE) {
        echo "Nuevo tipo de usuario creado con éxito";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<?php include '../includes/footer.php'; ?>
