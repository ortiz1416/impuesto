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
<link rel="stylesheet" href="../css/crudusu.css">
<h2>Crear Usuario</h2>
<style>
    .error-message {
    color: red;
}

.valid-message {
    color: green;
}

</style>
<form action="create.php" method="POST" onsubmit="return validarFormulario()">
    <label for="documento">Documento:</label>
    <input type="text" id="documento" name="documento" required oninput="validarDocumento()">
    <span id="documento-error" class="error-message"></span>
    <span id="documento-valido" class="valid-message"></span>
    
    <label for="nombres">Nombres:</label>
    <input type="text" id="nombres" name="nombres" required oninput="validarNombres()">
    <span id="nombres-error" class="error-message"></span>
    <span id="nombres-valido" class="valid-message"></span>
    
    <label for="apellidos">Apellidos:</label>
    <input type="text" id="apellidos" name="apellidos" required oninput="validarApellidos()">
    <span id="apellidos-error" class="error-message"></span>
    <span id="apellidos-valido" class="valid-message"></span>
    
    <label for="correo">Correo:</label>
    <input type="email" id="correo" name="correo" required maxlength="30" oninput="validarCorreo()">
    <span id="correo-error" class="error-message"></span>
    <span id="correo-valido" class="valid-message"></span>
    
    <label for="telefono">Teléfono:</label>
    <input type="text" id="telefono" name="Telefono" required oninput="validarTelefono()">
    <span id="telefono-error" class="error-message"></span>
    <span id="telefono-valido" class="valid-message"></span>
    
    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required oninput="validarPassword()">
    <span id="password-error" class="error-message"></span>
    <span id="password-valido" class="valid-message"></span>
    
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
function validarDocumento() {
    var documento = document.getElementById("documento").value;
    var documentoError = document.getElementById("documento-error");
    var documentoValido = document.getElementById("documento-valido");
    
    if (!/^\d{8,10}$/.test(documento)) {
        documentoError.textContent = "El documento debe contener solo números y tener entre 8 y 10 caracteres.";
        documentoError.style.color = "red";
        documentoValido.textContent = "";
    } else {
        documentoError.textContent = "";
        documentoValido.textContent = "Válido";
        documentoError.style.color = "";
        documentoValido.style.color = "green";
    }
}

function validarNombres() {
    var nombres = document.getElementById("nombres").value;
    var nombresError = document.getElementById("nombres-error");
    var nombresValido = document.getElementById("nombres-valido");
    
    if (!/^[a-zA-Z\s]{1,15}$/.test(nombres)) {
        nombresError.textContent = "Los nombres deben contener solo letras.";
        nombresError.style.color = "red";
        nombresValido.textContent = "";
    } else {
        nombresError.textContent = "";
        nombresValido.textContent = "Válido";
        nombresError.style.color = "";
        nombresValido.style.color = "green";
    }
}

function validarApellidos() {
    var apellidos = document.getElementById("apellidos").value;
    var apellidosError = document.getElementById("apellidos-error");
    var apellidosValido = document.getElementById("apellidos-valido");
    
    if (!/^[a-zA-Z\s]{1,15}$/.test(apellidos)) {
        apellidosError.textContent = "Los apellidos deben contener solo letras.";
        apellidosError.style.color = "red";
        apellidosValido.textContent = "";
    } else {
        apellidosError.textContent = "";
        apellidosValido.textContent = "Válido";
        apellidosError.style.color = "";
        apellidosValido.style.color = "green";
    }
}

function validarCorreo() {
    var correo = document.getElementById("correo").value;
    var correoError = document.getElementById("correo-error");
    var correoValido = document.getElementById("correo-valido");
    
    // Expresión regular para validar formato de correo electrónico
    var regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    if (!regexCorreo.test(correo)) {
        correoError.textContent = "Ingrese un correo electrónico válido.";
        correoError.style.color = "red";
        correoValido.textContent = "";
    } else {
        correoError.textContent = "";
        correoValido.textContent = "Válido";
        correoError.style.color = "";
        correoValido.style.color = "green";
    }
}

function validarTelefono() {
    var telefono = document.getElementById("telefono").value;
    var telefonoError = document.getElementById("telefono-error");
    var telefonoValido = document.getElementById("telefono-valido");
    
    if (!/^\d{1,10}$/.test(telefono)) {
        telefonoError.textContent = "El teléfono debe contener solo números y tener máximo 10 caracteres.";
        telefonoError.style.color = "red";
        telefonoValido.textContent = "";
    } else {
        telefonoError.textContent = "";
        telefonoValido.textContent = "Válido";
        telefonoError.style.color = "";
        telefonoValido.style.color = "green";
    }
}

function validarPassword() {
    var password = document.getElementById("password").value;
    var passwordError = document.getElementById("password-error");
    var passwordValido = document.getElementById("password-valido");
    
    if (password.length < 8 || password.length > 11) {
        passwordError.textContent = "La contraseña debe tener entre 8 y 11 caracteres.";
        passwordError.style.color = "red";
        passwordValido.textContent = "";
    } else {
        passwordError.textContent = "";
        passwordValido.textContent = "Válido";
        passwordError.style.color = "";
        passwordValido.style.color = "green";
    }
}

function validarFormulario() {
    validarDocumento();
    validarNombres();
    validarApellidos();
    validarCorreo();
    validarTelefono();
    validarPassword();
    
    var documentoError = document.getElementById("documento-error").textContent;
    var nombresError = document.getElementById("nombres-error").textContent;
    var apellidosError = document.getElementById("apellidos-error").textContent;
    var correoError = document.getElementById("correo-error").textContent;
    var telefonoError = document.getElementById("telefono-error").textContent;
    var passwordError = document.getElementById("password-error").textContent;
    
    if (documentoError || nombresError || apellidosError || correoError || telefonoError || passwordError) {
        return false;
    } else {
        return true;
    }
}
</script>



<?php
if (isset($_POST['submit'])) {
    $documento = $_POST['documento'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $Telefono = $_POST['Telefono'];
    $password = hash('sha512', $_POST['password']);
    $tp_user = $_POST['tp_user'];

    // Validar correo electrónico también en el lado del servidor
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo "El correo electrónico ingresado no es válido.";
    } else {
        $sql = "INSERT INTO usuarios (documento, nombres, apellidos, correo, Telefono, password, tp_user) VALUES ('$documento', '$nombres', '$apellidos', '$correo', '$Telefono', '$password', '$tp_user')";
        if ($conn->query($sql) === TRUE) {
            echo '
            <script>
                alert("Vehiculo registrado con exito");
                window.location = "read.php";
            </script>
            ';        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<?php include '../includes/footer.php'; ?>
