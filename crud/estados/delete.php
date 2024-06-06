<?php include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM estados WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo '
        <script>
               alert("Registro borrado");
               window.location = "read.php";
           </script>
           ';    } else {
        echo "Error al eliminar el estado: " . $conn->error;
    }
} else {
    echo "ID del estado no especificado";
}
?>

<?php include '../includes/footer.php'; ?>
