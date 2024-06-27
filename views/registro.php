<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Administrador</title>
    <link rel="stylesheet" href="css/regis.css"> <!-- Enlazar archivo de estilos CSS -->
    
</head>

<body>
<div style="display: flex; flex-direction: row; position: fixed; top: 0; left: 0;">
</div>

<div class="container">
    <h2>Registro de Administrador</h2>
    <form id="registroForm" action="../php/registro.php" method="post"  autocomplete="off" onsubmit="return validarRegistro()">
        <label for="documento">Número de Documento:</label>
        <input type="text" id="documento" name="documento">

        <label for="nombres">Nombres:</label>
        <input type="text" id="nombres" name="nombres" >

        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos">

        <label for="correo">Correo Electrónico:</label>
        <input type="email" id="correo" name="correo">

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" >


        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password">
        <a href="login.php">Iniciar Sesión</a>

        <button type="submit">Registrar</button>
    </form>

</div>

<script>
function limitarInput(input, maxLength) {
    if (input.value.length > maxLength) {
        input.value = input.value.slice(0, maxLength); // Limita la entrada a maxLength caracteres
    }
}

function validarRegistro() {
    var documento = document.getElementById("documento").value;
    var nombres = document.getElementById("nombres").value;
    var apellidos = document.getElementById("apellidos").value;
    var correo = document.getElementById("correo").value;
    var telefono = document.getElementById("telefono").value;
    var password = document.getElementById("password").value;

    if (documento === "" || nombres === "" || apellidos === "" || correo === "" || telefono === "" || password === "") {
        alert("Por favor complete todos los campos.");
        return false; // Evita que se envíe el formulario
    }

    // Expresiones regulares para validar los campos
    var documentoRegex = /^[0-9]{8,10}$/;
    var nombreApellidoRegex = /^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]{1,20}$/;
    var correoRegex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
    var telefonoRegex = /^[0-9]{1,10}$/;
    var passwordRegex = /^.{8,10}$/;

    // Validar campos uno por uno
    if (!documentoRegex.test(documento)) {
        alert("Por favor, ingresa un número de documento válido de 8 a 10 dígitos.");
        return false;
    }

    if (!nombreApellidoRegex.test(nombres) || !nombreApellidoRegex.test(apellidos)) {
        alert("Por favor, ingresa nombres y apellidos válidos (máximo 20 caracteres y solo letras).");
        return false;
    }

    if (!correoRegex.test(correo)) {
        alert("Por favor, ingresa un correo electrónico válido.");
        return false;
    }

    if (!telefonoRegex.test(telefono)) {
        alert("Por favor, ingresa un número de teléfono válido (máximo 10 dígitos y solo números).");
        return false;
    }

    if (!passwordRegex.test(password)) {
        alert("Por favor, ingresa una contraseña válida (8 a 10 caracteres).");
        return false;
    }

    return true; // Si todo está correcto, se envía el formulario
}
</script>

</body>

</html>

