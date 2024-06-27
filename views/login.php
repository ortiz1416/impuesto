<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="css/log.css"> <!-- Estilos CSS -->
</head>

<body>
    <div class="botones-container">
    </div>

    <div class="container">
        <h2>Iniciar Sesión</h2>
        <form action="../php/login.php" method="post" autocomplete="off" onsubmit="return validarDocumento()">
            <div class="form-group">
                <label for="documento">Documento:</label>
                <input type="text" id="documento" name="documento" required>
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="password">
            </div>
            <a style=" text-align: right; " href="registro.php">Crear cuenta</a>

            <button type="submit">Iniciar Sesión</button>
        </form>

    </div>

    <script>
        function validarDocumento() {
            var documentoInput = document.getElementById("documento");
            var documento = documentoInput.value.trim(); // Eliminar espacios en blanco al inicio y al final

            // Expresión regular para validar que solo haya números y que la longitud esté entre 8 y 10 caracteres
            var documentoRegex = /^\d{8,10}$/;

            // Validar si el documento cumple con la expresión regular
            if (!documentoRegex.test(documento)) {
                alert("El documento debe contener solo números y tener una longitud entre 8 y 10 caracteres.");
                documentoInput.focus(); // Colocar el foco en el campo de documento
                return false; // Detener el envío del formulario
            }

            // Si pasa la validación, permitir el envío del formulario
            return true;
        }
    </script>
</body>

</html>

