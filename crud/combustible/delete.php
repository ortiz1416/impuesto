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
    $sql = "DELETE FROM combustible WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo '
        <script>
               alert("Registro borrado");
               window.location = "read.php";
           </script>
           ';    } else {
        echo "Error: " . $conn->error;
    }
}

header("Location: read.php");
?>
