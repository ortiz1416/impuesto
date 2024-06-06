<?php include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $estado = $_POST['estado'];
    $id = $_POST['id'];

    $sql = "UPDATE estados SET estado='$estado' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Estado actualizado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM estados WHERE id='$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>
<link rel="stylesheet" href="../css/editarc.css"> 
<h2>Editar Estado</h2>
<form method="post" class="centered-form">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <label for="estado">Estado:</label>
    <input type="text" id="estado" name="estado" value="<?php echo $row['estado']; ?>" required>
    <input type="submit" value="Actualizar" class="blue-button">
</form>

<?php include '../includes/footer.php'; ?>
