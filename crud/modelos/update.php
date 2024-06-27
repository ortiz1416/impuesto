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

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $modelo = $_POST['modelo'];
    $id = $_POST['id'];

    $sql = "UPDATE modelos SET modelo='$modelo' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Modelo actualizado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM modelos WHERE id='$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>
<link rel="stylesheet" href="../css/editarc.css"> 
<h2>Editar Modelo</h2>
<form method="post" class="centered-form" onsubmit="return validarModelo()">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <label for="modelo">Modelo:</label>
    <input type="text" id="modelo" name="modelo" value="<?php echo $row['modelo']; ?>" required>
    <input type="submit" value="Actualizar" class="blue-button">
</form>

<script>
function validarModelo() {
    var modeloInput = document.getElementById("modelo").value.trim();
    // Verificar si el valor contiene solo números y tiene máximo 4 caracteres
    if (/^\d{1,4}$/.test(modeloInput)) {
        return true; // Envía el formulario si la validación es exitosa
    } else {
        alert("El modelo debe contener solo números y tener máximo 4 caracteres.");
        return false; // Detiene el envío del formulario si la validación falla
    }
}
</script>


<?php include '../includes/footer.php'; ?>
