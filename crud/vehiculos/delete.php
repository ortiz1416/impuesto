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
if (isset($_GET['placa'])) {
    $placa = $_GET['placa'];
    $sql = "DELETE FROM vehiculos WHERE placa='$placa'";
    if ($conn->query($sql) === TRUE) {
        echo '
        <script>
               alert("Registro borrado");
               window.location = "read.php";
           </script>
           ';    } else {
        echo "Error al eliminar el vehículo: " . $conn->error;
    }
} else {
    echo "No se especificó la placa del vehículo a eliminar";
}
?>

<?php include '../includes/footer.php'; ?>
