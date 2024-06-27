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
if (isset($_GET['documento'])) {
    $documento = $_GET['documento'];
    $sql = "SELECT * FROM usuarios WHERE documento=$documento";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
if (isset($_POST['submit'])) {
    $documento = $_POST['documento'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $Telefono = $_POST['Telefono'];
    $tp_user = $_POST['tp_user'];

    $sql = "UPDATE usuarios SET nombres='$nombres', apellidos='$apellidos', correo='$correo', Telefono='$Telefono', tp_user='$tp_user' WHERE documento=$documento";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('Usuario actualizado con éxito');
        window.location = 'read.php';
      </script>";    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>


<link rel="stylesheet" href="../css/crudusu.css"> 
<h2>Editar Usuario</h2>
<form action="update.php" method="POST" onsubmit="return validarFormulario()">
    <input type="hidden" name="documento" value="<?php echo $row['documento']; ?>">
    
    <label for="nombres">Nombres:</label>
    <input type="text" id="nombres" name="nombres" value="<?php echo $row['nombres']; ?>" required>
    
    <label for="apellidos">Apellidos:</label>
    <input type="text" id="apellidos" name="apellidos" value="<?php echo $row['apellidos']; ?>" required>
    
    <label for="correo">Correo:</label>
    <input type="email" id="correo" name="correo" value="<?php echo $row['correo']; ?>" required maxlength="18">
    
    <label for="Telefono">Teléfono:</label>
    <input type="text" id="telefono" name="Telefono" value="<?php echo $row['Telefono']; ?>" required>
    
    <label for="tp_user">Tipo de Usuario:</label>
    <select name="tp_user" required>
        <?php
        $sql = "SELECT * FROM tp_usuario";
        $result = $conn->query($sql);
        while($tp_row = $result->fetch_assoc()) {
            $selected = $tp_row['id'] == $row['tp_user'] ? 'selected' : '';
            echo "<option value='" . $tp_row['id'] . "' $selected>" . $tp_row['user'] . "</option>";
        }
        ?>
    </select>
    
    <input type="submit" name="submit" value="Actualizar">
</form>

<script>
function validarFormulario() {
    var nombres = document.getElementById("nombres").value;
    var apellidos = document.getElementById("apellidos").value;
    var correo = document.getElementById("correo").value;
    var telefono = document.getElementById("telefono").value;
    
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
    
    return true;
}
</script>


<?php include '../includes/footer.php'; ?>
