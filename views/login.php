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
        <a href="../index.php">Salir</a>
        <a href="registro.php">Crear cuenta</a>
    </div>

    <div class="container">
        <h2>Iniciar Sesión</h2>
        <form action="../php/login.php" method="post" autocomplete="off">
            <div class="form-group">
                <label for="documento">Documento:</label>
                <input type="text" id="documento" name="documento" pattern="[0-9]{1,10}" title="Por favor ingrese solo números (máximo 10)" required>
            </div>
            <div class="form-group">
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" id="contrasena" name="password" required pattern=".{8,11}" title="La contraseña debe tener entre 8 y 11 caracteres." maxlength="11">
            </div>
            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>
</body>

</html>
