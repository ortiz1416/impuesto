<?php include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM modelos WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo '
        <script>
               alert("Registro borrado");
               window.location = "read.php";
           </script>
           ';
    } else {
        echo "Error al eliminar el modelo: " . $conn->error;
    }
} else {
    echo "ID del modelo no especificado";
}
?>

<?php include '../includes/footer.php'; ?>
