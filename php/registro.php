<?php
include("../crud/includes/db.php");
// Obtener datos del formulario
$documento = $_POST['documento'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$password = $_POST['password'];

$password = hash('sha512', $password);

// Insertar datos en la tabla `usuarios`
$sql = "INSERT INTO usuarios (documento, nombres, apellidos, correo, Telefono, password, tp_user) 
        VALUES ('$documento', '$nombres', '$apellidos', '$correo', '$telefono', '$password', 2)";

if ($conn->query($sql) === TRUE) {
    echo '
    <script>
           alert("Admin Registrado");
           window.location = "../views/login.php";
       </script>
       ';} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
