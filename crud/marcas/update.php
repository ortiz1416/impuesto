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
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM marcas WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $marca = $_POST['marca'];

    $sql = "UPDATE marcas SET marca='$marca' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('Marca actualizado con éxito');
        window.location = 'read.php';
      </script>";    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<link rel="stylesheet" href="../css/editarc.css"> 
<h2>Editar Marca</h2>
<form action="update.php" method="POST" class="centered-form" onsubmit="return validarMarca()">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <label for="marca">Marca:</label>
    <input type="text" id="marca" name="marca" value="<?php echo $row['marca']; ?>" required>
    <input type="submit" name="submit" value="Actualizar" class="blue-button">
</form>

<script>
function validarMarca() {
    var marcaInput = document.getElementById("marca").value;
    // Verificar si la entrada contiene solo letras y números y tiene exactamente 11 caracteres
    if (/^[a-zA-Z0-9]{1,11}$/.test(marcaInput)) {
        return true; // Envía el formulario si la validación es exitosa
    } else {
        alert("La marca debe contener solo letras y números.");
        return false; // Detiene el envío del formulario si la validación falla
    }
}
</script>


<?php include '../includes/footer.php'; ?>
