<?php

include("../crud/includes/db.php");

function cargarImpuestos($conn)
{
    // Verificar si se recibió la placa correctamente
    if (!isset($_GET['placa']) || empty($_GET['placa'])) {
        echo "No se recibió la placa del vehículo.";
        return;
    }

    // Obtener la placa del vehículo desde el método GET
    $placa = $conn->real_escape_string($_GET['placa']);

    // Seleccionar el vehículo específico
    $sql_vehiculo = "SELECT * FROM vehiculos WHERE placa='$placa'";
    $result = $conn->query($sql_vehiculo);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $tipo_vehiculo = $row['tp_vehiculo'];
        $f_matricula = $row['f_matricula'];
        $año_matricula = date("Y", strtotime($f_matricula));

        // Determinar el intervalo de impuestos
        $intervalo = ($tipo_vehiculo == 2) ? 5 : 3;

        $impuestos_aplicados = false;
        $fecha_ini = $f_matricula;

        while (strtotime($fecha_ini) <= strtotime(date("Y-m-d"))) {
            $fecha_fin = date("Y-m-d", strtotime("$fecha_ini +$intervalo years -1 day"));

            // Verificar si ya existe el impuesto para el intervalo y modelo
            $sql_check = "SELECT * FROM impuesto WHERE placa='$placa' AND fecha_ini='$fecha_ini' AND fecha_fin='$fecha_fin'";
            $result_check = $conn->query($sql_check);

            if ($result_check && $result_check->num_rows == 0) {
                // Obtener el valor del impuesto según el tipo de vehículo y modelo
                $sql_valor = "SELECT valor FROM valor WHERE id_tp_vehiculos='$tipo_vehiculo' AND id_modelo<=$año_matricula";
                $result_valor = $conn->query($sql_valor);
                
                if ($result_valor && $row_valor = $result_valor->fetch_assoc()) {
                    $id_valor = $row_valor['valor'];

                    // Insertar el impuesto con el valor calculado
                    $sql_insert = "INSERT INTO impuesto (placa, id_valor, fecha_ini, fecha_fin, id_estado) VALUES ('$placa', '$id_valor', '$fecha_ini', '$fecha_fin', 1)";
                    if ($conn->query($sql_insert) === TRUE) {
                        $impuestos_aplicados = true;
                        echo "
                        <script>
                           alert('Impuesto cargado para $placa desde $fecha_ini hasta $fecha_fin');
                           window.location = '../crud/vehiculos/read.php';
                        </script>
                        ";
                    } else {
                        echo "Error al insertar el impuesto: " . $conn->error;
                    }
                } else {
                    echo "Error al obtener el valor del impuesto: " . $conn->error;
                }
            } else {
                echo "El impuesto ya está aplicado para el periodo $fecha_ini a $fecha_fin.";
            }

            // Avanzar al siguiente periodo de impuesto
            $fecha_ini = date("Y-m-d", strtotime("$fecha_ini +$intervalo years"));
        }

        if (!$impuestos_aplicados) {
            echo "
            <script>
                alert('El vehículo con placa $placa ya tiene todos los impuestos aplicados.');
                window.location = '../crud/vehiculos/read.php';
            </script>
            ";
        }
    } else {
        echo "No se encontró el vehículo con placa '$placa'.";
    }

    // Cerrar la conexión con la base de datos al finalizar
    $conn->close();
}

// Llamar a la función para cargar impuestos
cargarImpuestos($conn);

?>
