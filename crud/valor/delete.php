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
include '../includes/db.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM valor WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

header("Location: read.php");
exit();
?>
