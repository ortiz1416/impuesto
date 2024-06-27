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
include '../includes/header.php';
include '../includes/db.php';
?>
<link rel="stylesheet" href="../css/crudusu.css">
<br>
<br>
<h2>Crear Vehículo</h2>
<form action="create.php" method="POST">

    <label for="tp_vehiculo">Tipo de Vehículo:</label>
    <select name="tp_vehiculo" id="tp_vehiculo" required>
        <?php
        $sql = "SELECT * FROM tp_vehiculos";
        $result = $conn->query($sql);
        echo "<option value='' disabled selected>Seleccione un tipo de vehículo</option>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['vehiculos'] . " " . $row['peso'] . "</option>";
            }
        } else {
            echo "<option>No se encontraron vehículos</option>";
        }
        ?>
    </select>

    <label for="placa">Placa:</label>
    <input type="text" id="placa" name="placa" required maxlength="6">
    <span id="placa_feedback"></span>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const inputPlaca = document.getElementById("placa");
            const feedback = document.getElementById("placa_feedback");

            inputPlaca.addEventListener("input", function() {
                // Convert the input value to uppercase
                inputPlaca.value = inputPlaca.value.toUpperCase();

                // Validate the input value
                const regex = /^[A-Z0-9]{0,6}$/;
                if (!regex.test(inputPlaca.value)) {
                    inputPlaca.value = inputPlaca.value.slice(0, -1);
                }

                // Additional validation to ensure the proper format
                const carRegex = /^[A-Z]{3}[0-9]{3}$/; // Car plate: 3 letters followed by 3 numbers
                const motoRegex = /^[A-Z]{3}[0-9]{2}[A-Z]$/; // Motorbike plate: 3 letters, 2 numbers, and 1 letter

                if (inputPlaca.value.length < 6) {
                    feedback.textContent = "Placa no válida";
                    feedback.style.color = "red";
                } else if (carRegex.test(inputPlaca.value)) {
                    feedback.textContent = "Placa de carro válida";
                    feedback.style.color = "green";
                } else if (motoRegex.test(inputPlaca.value)) {
                    feedback.textContent = "Placa de moto válida";
                    feedback.style.color = "green";
                } else {
                    feedback.textContent = "Placa no válida";
                    feedback.style.color = "red";
                }
            });
        });
    </script>





    <label for="marca">Marca:</label>
    <select name="marca" required>
        <option value="" disabled selected hidden>Seleccione marca</option>
        <?php
        $sql = "SELECT * FROM marcas";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "'>" . $row['marca'] . "</option>";
        }
        ?>
    </select>


    <label for="propietario">Propietario: <a href="../usuarios/create.php">Crear</a>
    </label>
    <select name="propietario" required>
        <option value="" disabled selected hidden>Seleccione Propietario</option>

        <?php
        $sql = "SELECT * FROM usuarios WHERE tp_user =  1";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['documento'] . "'>" . $row['nombres'] . " " . $row['apellidos'] . "</option>";
        }
        ?>
    </select>

    <label for="cilindrada">Cilindrada:</label>
    <select name="cilindrada" id="cilindrada" required>
        <option value="">Seleccione un tipo de vehículo primero</option>
    </select>
    <label for="n_motor">Número de Motor:</label>
    <input type="text" id="n_motor" name="n_motor" required>
    <span id="n_motor_feedback"></span>

    <label for="n_chasis">Número de Chasis:</label>
    <input type="text" id="n_chasis" name="n_chasis" required>
    <span id="n_chasis_feedback"></span>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const inputs = document.querySelectorAll("input[name='n_motor'], input[name='n_chasis']");

            inputs.forEach(input => {
                input.addEventListener("input", function() {
                    const regex = /^[A-Z0-9]{0,17}$/i;
                    const feedback = document.getElementById(input.id + "_feedback");

                    // Convert the input value to uppercase
                    input.value = input.value.toUpperCase();

                    // Check if the input value is valid
                    const isValid = regex.test(input.value) &&
                        input.value.length === 17 &&
                        /[A-Z]/.test(input.value) &&
                        /[0-9]/.test(input.value);

                    if (isValid) {
                        feedback.textContent = "Válido";
                        feedback.style.color = "green";
                    } else {
                        feedback.textContent = "Inválido";
                        feedback.style.color = "red";
                    }

                    // If invalid character is found, remove the last character
                    if (!regex.test(input.value)) {
                        input.value = input.value.slice(0, -1);
                    }
                });
            });
        });
    </script>



    <label for="capacidad">Capacidad:</label>
    <input type="text" name="capacidad" required>

    <label for="valor">Valor del vehículo:</label>
    <input type="number" name="valor" required>

    <label for="combustible">Combustible:</label>
    <select name="combustible" id="combustible" required>
        <option value="">Seleccione un tipo de vehículo primero</option>
    </select>

    <label for="color">Color:</label>
    <select name="color" required>
        <?php
        $sql = "SELECT * FROM colores";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "'>" . $row['color'] . "</option>";
        }
        ?>
    </select>

    <label for="avaluo">Avaluo:</label>
    <select name="avaluo" required>
        <?php
        $sql = "SELECT * FROM avaluos";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "'>" . $row['avaluo'] . " %</option>";
        }
        ?>
    </select>

    <label for="linea">Línea:</label>
    <input type="text" name="linea" required>

    <label for="modelo">Modelo:</label>
    <select name="modelo" required>
        <?php
        $sql = "SELECT * FROM modelos";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "'>" . $row['modelo'] . "</option>";
        }
        ?>
    </select>

    <label for="f_matricula">Fecha de Matrícula:</label>
    <input type="date" name="f_matricula" required>

    <input type="submit" name="submit" value="Crear">
</form>

<script>
    document.getElementById('tp_vehiculo').addEventListener('change', function() {
        var tp_vehiculo = this.value;
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'get_combustibles.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (this.status == 200) {
                document.getElementById('combustible').innerHTML = this.responseText;
            }
        };
        xhr.send('tp_vehiculo=' + tp_vehiculo);
    });
</script>
<script>
    document.getElementById('tp_vehiculo').addEventListener('change', function() {
        var tp_vehiculo = this.value;
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'get_cilindradas.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (this.status == 200) {
                document.getElementById('cilindrada').innerHTML = this.responseText;
            }
        };
        xhr.send('tp_vehiculo=' + tp_vehiculo);
    });
</script>

<?php
if (isset($_POST['submit'])) {
    $placa = $_POST['placa'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $propietario = $_POST['propietario'];
    $cilindrada = $_POST['cilindrada'];
    $n_motor = $_POST['n_motor'];
    $n_chasis = $_POST['n_chasis'];
    $tp_vehiculo = $_POST['tp_vehiculo'];
    $capacidad = $_POST['capacidad'];
    $combustible = $_POST['combustible'];
    $color = $_POST['color'];
    $avaluo = $_POST['avaluo'];
    $linea = $_POST['linea'];
    $valor = $_POST['valor'];
    $f_matricula = $_POST['f_matricula'];

    $sql = "INSERT INTO vehiculos (placa, marca, modelo, propietario, cilindrada, n_motor, n_chasis, tp_vehiculo, capacidad, combustible, id_color, id_avaluo, valor, linea, f_matricula, estado) 
            VALUES ('$placa', '$marca', '$modelo', '$propietario', '$cilindrada', '$n_motor', '$n_chasis', '$tp_vehiculo', '$capacidad', '$combustible', '$color', '$avaluo', '$valor', '$linea', '$f_matricula', 1)";
    if ($conn->query($sql) === TRUE) {
        echo '
        <script>
            alert("Vehiculo registrado con exito");
            window.location = "read.php";
        </script>
        ';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<?php include '../includes/footer.php'; ?>