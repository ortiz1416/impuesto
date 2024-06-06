<?php include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>
<link rel="stylesheet" href="../css/crudusu.css">
<h2>Crear Usuario</h2>
<form action="create.php" method="POST" onsubmit="return validarFormulario()">
    <label for="documento">Documento:</label>
    <input type="text" id="documento" name="documento" required>
    
    <label for="nombres">Nombres:</label>
    <input type="text" id="nombres" name="nombres" required>
    
    <label for="apellidos">Apellidos:</label>
    <input type="text" id="apellidos" name="apellidos" required>
    
    <label for="correo">Correo:</label>
    <input type="email" id="correo" name="correo" required maxlength="18">
    
    <label for="telefono">Teléfono:</label>
    <input type="text" id="telefono" name="telefono" required>
    
    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>
    
    <label for="tp_user">Tipo de Usuario:</label>
    <select name="tp_user" id="tp_user" required>
        <?php
        $sql = "SELECT * FROM tp_usuario";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "'>" . $row['user'] . "</option>";
        }
        ?>
    </select>
    
    <input type="submit" name="submit" value="Crear">
</form>

<script>
function validarFormulario() {
    var documento = document.getElementById("documento").value;
    var nombres = document.getElementById("nombres").value;
    var apellidos = document.getElementById("apellidos").value;
    var correo = document.getElementById("correo").value;
    var telefono = document.getElementById("telefono").value;
    var password = document.getElementById("password").value;
    
    if (!/^\d{8,10}$/.test(documento)) {
        alert("El documento debe contener solo números y tener entre 8 y 10 caracteres.");
        return false;
    }
    
    if (!/^[a-zA-Z\s]{1,15}$/.test(nombres)) {
        alert("Los nombres deben contener solo letras.");
        return false;
    }
    
    if (!/^[a-zA-Z\s]{1,15}$/.test(apellidos)) {
        alert("Los apellidos deben contener solo letras.");
        return false;
    }
    
    if (correo.length > 30) {
        alert("El correo debe tener máximo 30 caracteres.");
        return false;
    }
    
    if (!/^\d{1,10}$/.test(telefono)) {
        alert("El teléfono debe contener solo números y tener máximo 10 caracteres.");
        return false;
    }
    
    if (password.length < 8 || password.length > 11) {
        alert("La contraseña debe tener entre 8 y 11 caracteres.");
        return false;
    }
    
    return true;
}
</script>


<?php
if (isset($_POST['submit'])) {
    $documento = $_POST['documento'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $Telefono = $_POST['Telefono'];
  $password = hash('sha512', $password);
    $tp_user = $_POST['tp_user'];

    $sql = "INSERT INTO usuarios (documento, nombres, apellidos, correo, Telefono, password, tp_user) VALUES ('$documento', '$nombres', '$apellidos', '$correo', '$Telefono', '$password', '$tp_user')";
    if ($conn->query($sql) === TRUE) {
        echo "Nuevo usuario creado con éxito";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<?php include '../includes/footer.php'; ?>
