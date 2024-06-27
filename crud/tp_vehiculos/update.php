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
    $sql = "SELECT * FROM tp_vehiculos WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $vehiculos = $_POST['vehiculos'];

    $sql = "UPDATE tp_vehiculos SET vehiculos='$vehiculos' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Tipo de vehículo actualizado con éxito";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<link rel="stylesheet" href="../css/editarc.css"> 
<h2>Editar Tipo de Vehículo</h2>
<form action="update.php" method="POST" class="centered-form">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <label for="vehiculos">Tipo de Vehículo:</label>
    <input type="text" name="vehiculos" value="<?php echo $row['vehiculos']; ?>" required>
    <input type="submit" name="submit" value="Actualizar" class="blue-button">
</form>

<?php include '../includes/footer.php'; ?>
