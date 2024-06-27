<?php
include("../crud/includes/db.php"); // Incluir archivo de conexión a la base de datos

// Número de registros por página
$registros_por_pagina = 1;

// Verificar si se ha enviado la página por GET
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$inicio = ($pagina > 1) ? ($pagina * $registros_por_pagina) - $registros_por_pagina : 0;

// Verificar si se ha enviado la placa por GET
if (isset($_GET['placa'])) {
    // Obtener la placa desde el parámetro GET
    $placa = $_GET['placa'];

    // Consulta SQL para obtener el número total de registros
    $sql_total = "SELECT COUNT(*) as total FROM vehiculos WHERE placa = '$placa'";
    $result_total = $conn->query($sql_total);

    if ($result_total) {
        $total_registros = $result_total->fetch_assoc()['total'];
        $total_paginas = ceil($total_registros / $registros_por_pagina);

        // Consulta SQL para obtener la información del vehículo y los impuestos asociados con límite para paginación
        $sql = "SELECT vehiculos.*, marcas.marca, modelos.modelo, usuarios.nombres, usuarios.apellidos, tp_vehiculos.vehiculos as tipo_vehiculo
                FROM vehiculos
                INNER JOIN marcas ON vehiculos.marca = marcas.id
                INNER JOIN modelos ON vehiculos.modelo = modelos.id
                INNER JOIN usuarios ON vehiculos.propietario = usuarios.documento
                INNER JOIN tp_vehiculos ON vehiculos.tp_vehiculo = tp_vehiculos.id
                WHERE vehiculos.placa = '$placa'
                LIMIT $inicio, $registros_por_pagina";
        $result = $conn->query($sql);

        // Verificar si se encontraron resultados
        if ($result && $result->num_rows > 0) {
            echo "<div class='container mt-5'>";
            echo "<h2 class='mb-4'>Información del Vehículo</h2>";
            echo "<table class='table table-striped'>";
            echo "<thead><tr>
            <th>Tipo de Vehículo</th>
            <th>Placa</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Valor del Vehículo</th>
            <th>Propietario</th>
            <th>Fecha de matrícula</th>
            </tr></thead>";
            echo "<tbody>";

            // Mostrar la información del vehículo
            while ($row = $result->fetch_assoc()) {
                $valor_vehiculo = $row['valor'];
                echo "<tr>";
                echo "<td>" . $row['tipo_vehiculo'] . "</td>";
                echo "<td>" . $row['placa'] . "</td>";
                echo "<td>" . $row['marca'] . "</td>";
                echo "<td>" . $row['modelo'] . "</td>";
                echo "<td>$" . number_format($valor_vehiculo, 2) . "</td>";
                echo "<td>" . $row['nombres'] . " " . $row['apellidos'] . "</td>";
                echo "<td>" . $row['f_matricula'] . "</td>";
                echo "</tr>";
            }

            echo "</tbody></table>";

            // Paginación
            echo "<nav>";
            echo "<ul class='pagination' style='display: none;'>";
            for ($i = 1; $i <= $total_paginas; $i++) {
                echo "<li class='page-item " . ($pagina == $i ? 'active' : '') . "'><a class='page-link' href='?placa=$placa&pagina=$i'>$i</a></li>";
            }
            echo "</ul>";
            echo "</nav>";

            echo "</div>";

            // Consulta SQL para obtener los impuestos asociados y el avaluo del vehículo
            $sql_impuestos = "SELECT impuesto.*, avaluos.avaluo 
                              FROM impuesto
                              INNER JOIN vehiculos ON impuesto.placa = vehiculos.placa
                              INNER JOIN avaluos ON vehiculos.id_avaluo = avaluos.id
                              WHERE impuesto.placa = '$placa'";
            $result_impuestos = $conn->query($sql_impuestos);

            $pagar_todo = 0; // Inicializar la variable para sumar los valores de los impuestos no pagados

            if ($result_impuestos && $result_impuestos->num_rows > 0) {
                echo "<div class='container mt-5'>";
                echo "<h2 class='mb4'>Impuestos Asociados</h2>";
                echo "<table class='table table-striped'>";
                echo "<thead><tr><th>Fecha Inicio Impuesto</th>
                <th>Fecha Fin Impuesto</th>
                <th>Valor del Vehículo</th>
                <th>Avalúo</th>
                <th> Valor x Avalúo</th>
                <th>Valor del Impuesto</th>
                <th>Total con Avalúo</th>
                <th>Acción</th>
                </tr></thead>";
                echo "<tbody>";

                // Mostrar los impuestos asociados
                while ($row_impuestos = $result_impuestos->fetch_assoc()) {
                    $avaluo = $row_impuestos['avaluo'];
                    $valor_impuesto = $row_impuestos['id_valor'];
                    $multiplicacion_valor_avaluo = $valor_vehiculo * ($avaluo / 100);
                    $total_con_avaluo = $multiplicacion_valor_avaluo + $valor_impuesto;

                    // Sumar solo los impuestos no pagados
                    if ($row_impuestos['id_estado'] == 1) {
                        $pagar_todo += $total_con_avaluo;
                    }

                    echo "<tr>";
                    echo "<td>" . $row_impuestos['fecha_ini'] . "</td>";
                    echo "<td>" . $row_impuestos['fecha_fin'] . "</td>";
                    echo "<td>$" . number_format($valor_vehiculo, 2) . "</td>";
                    echo "<td>" . $avaluo . "%</td>";
                    echo "<td>$" . number_format($multiplicacion_valor_avaluo, 2) . "</td>";

                    echo "<td>$" . number_format($valor_impuesto, 2) . "</td>";
                    echo "<td>$" . number_format($total_con_avaluo, 2) . "</td>";
                    echo "<td>";
                    if ($row_impuestos['id_estado'] == 1) {
                        echo "<a href='pagar.php?id_impuesto=" . $row_impuestos['id'] . "&placa=" . $placa . "' class='btn btn-primary'>Pagar</a>";
                    } elseif ($row_impuestos['id_estado'] == 2) {
                        echo "<button type='button' class='btn btn-success'>Pago</button>";
                    }
                    echo "</td>";
                    echo "</tr>";
                }

                echo "</tbody></table>";
                echo "<h3>Total de impuestos pendientes: $" . number_format($pagar_todo, 2) . "</h3>"; // Mostrar el total a pagar
                echo "

             
                <button id='descargar-excel' class='btn btn-success'>Descargar Excel</button>
                <br>
                <br>

                <script>
                document.getElementById('descargar-excel').addEventListener('click', function() {
                    window.location.href = 'excel.php?placa=$placa';
                });
            </script>";

                echo "</div>";
            } else {
                echo "<div class='container mt-5'><div class='alert alert-warning'>No se encontraron impuestos asociados para la placa $placa</div></div>";
            }
        } else {
            // Si no se encontraron resultados, mostrar un mensaje
            echo "<div class='container mt-5'><div class='alert alert-warning'>No se encontraron resultados para la placa $placa</div></div>";
        }
    } else {
        echo "<div class='container mt-5'><div class='alert alert-danger'>Error al ejecutar la consulta de total de registros</div></div>";
    }
} else {
    // Si no se ha enviado la placa por GET, mostrar un mensaje de error
    echo "<div class='container mt-5'><div class='alert alert-danger'>No se ha especificado una placa</div></div>";
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Información del Vehículo</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <style>
  .boton {
    background-color: #007bff; /* Azul */
    color: white;
    border: 2px solid #007bff; /* Bordes */
    border-radius: 10px; /* Bordes curvos */
    padding: 10px 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    cursor: pointer;
    position: absolute; /* Posición absoluta */
    top: 20px; /* Ajusta la posición desde arriba */
    left: 20px; /* Ajusta la posición desde la izquierda */
  }
</style>
</head>

<body>
    <header>
    <a href="../crud/views/index.php" class="boton">Volver</a>
    </header>
    <main>

    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-AgOfQF3nwT9TXt9h18YkHuNJ2Ed6u3XkLXDa5dF5OKu9QepVQ6yw5yGiqBu0V8QK" crossorigin="anonymous"></script>
</body>

</html>
