<?php
// Iniciar sesión
session_start();
include("../crud/includes/db.php");

// Obtener datos del formulario
$documento = $_POST['documento'];
$password = $_POST['password'];
$password = hash('sha512', $password);

// Preparar y ejecutar la consulta segura
$sql = $conn->prepare("SELECT * FROM usuarios WHERE documento = ? AND password = ?");
$sql->bind_param("ss", $documento, $password);
$sql->execute();
$result = $sql->get_result();

if ($result->num_rows > 0) {
    // Obtener los datos del usuario
    $row = $result->fetch_assoc();

    // Guardar datos del usuario en la sesión
    $_SESSION['id_us'] = $row['documento'];

    // Redireccionar a la página principal o dashboard
    header("Location: ../crud/includes/header.php");
    exit(); // Asegurarse de que el script se detenga después de la redirección
} else {
    echo '
    <script>
           alert("Error en la introduccion de datos");
           window.location = "../views/login.php";
       </script>
       ';
}

// Cerrar la conexión
$conn->close();
?>
