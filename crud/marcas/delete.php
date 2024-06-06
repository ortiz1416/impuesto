<?php
include '../includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM marcas WHERE id=$id";
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
