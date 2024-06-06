<?php include '../includes/db.php'; ?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="../css/sty.css">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
   
</head>

<body>
<div style="display: flex; flex-direction: row; position: fixed; top: 0; left: 0;">
<a href="../../index.php" style="background-color: blue; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; margin-top: 20px; margin-left: 20px;">Salir</a>
</div>
    <header>
        <!-- place navbar here -->
    </header>
    <main>

        <div class="container">
            <h2>Buscar Vehículo</h2>
            <form action="" method="GET">
                <div class="form-group">
                    <label for="documento">Documento del Usuario:</label>
                    <input type="text" class="form-control" name="documento" pattern="[0-9]+" title="Por favor ingrese solo números" placeholder="Ingrese el documento del usuario">
                </div>

                <div class="form-group">
                    <label for="placa">Placa del Vehículo:</label>
                    <input type="text" class="form-control" name="placa" placeholder="Ingrese la placa del vehículo">
                </div>
                <input type="submit" class="btn btn-primary" name="submit" value="Buscar">
            </form>

            <?php
            if (isset($_GET['submit'])) {
                if (!empty($_GET['documento'])) {
                    $documento = $_GET['documento'];
                    $sql = "SELECT v.*, 
                                   u.nombres AS propietario_nombres, 
                                   u.apellidos AS propietario_apellidos, 
                                   u.correo AS propietario_correo, 
                                   u.Telefono AS propietario_telefono, 
                                   m.marca AS marca_vehiculo, 
                                   mo.modelo AS modelo_vehiculo, 
                                   e.estado AS estado_vehiculo, 
                                   tp.vehiculos AS tipo_vehiculo,
                                   CASE 
                                     WHEN (SELECT COUNT(*) FROM impuesto i WHERE i.placa = v.placa AND i.id_estado = 1) > 0 THEN 'Por pagar'
                                     ELSE 'Pago'
                                   END AS estado_impuestos
                            FROM vehiculos v 
                            INNER JOIN usuarios u ON v.propietario = u.documento 
                            INNER JOIN marcas m ON v.marca = m.id 
                            INNER JOIN modelos mo ON v.modelo = mo.id 
                            INNER JOIN tp_vehiculos tp ON v.tp_vehiculo = tp.id 
                            INNER JOIN estados e ON v.estado = e.id
                            WHERE u.documento='$documento'";
                } elseif (!empty($_GET['placa'])) {
                    $placa = $_GET['placa'];
                    $sql = "SELECT v.*, 
                                   u.nombres AS propietario_nombres, 
                                   u.apellidos AS propietario_apellidos, 
                                   u.correo AS propietario_correo, 
                                   u.Telefono AS propietario_telefono, 
                                   m.marca AS marca_vehiculo, 
                                   mo.modelo AS modelo_vehiculo, 
                                   e.estado AS estado_vehiculo, 
                                   tp.vehiculos AS tipo_vehiculo,
                                   CASE 
                                     WHEN (SELECT COUNT(*) FROM impuesto i WHERE i.placa = v.placa AND i.id_estado = 1) > 0 THEN 'Por pagar'
                                     ELSE 'Pago'
                                   END AS estado_impuestos
                            FROM vehiculos v 
                            INNER JOIN usuarios u ON v.propietario = u.documento 
                            INNER JOIN marcas m ON v.marca = m.id 
                            INNER JOIN modelos mo ON v.modelo = mo.id 
                            INNER JOIN tp_vehiculos tp ON v.tp_vehiculo = tp.id 
                            INNER JOIN estados e ON v.estado = e.id
                            WHERE v.placa='$placa'";
                } else {
                    echo "<div class='alert alert-danger'>Por favor ingrese el documento del usuario o la placa del vehículo</div>";
                    exit;
                }
 
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    echo "<h3>Vehículo Encontrado:</h3>";
                    echo "<div class='table-responsive'>";
                    echo "<table class='table table-striped'>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th>Tipo Vehículo</th>";
                    echo "<th>Placa</th>";
                    echo "<th>Marca</th>";
                    echo "<th>Modelo</th>";
                    echo "<th>Estados de impuestos</th>";
                    echo "<th>Propietario</th>";
                    echo "<th>Correo del Propietario</th>";
                    echo "<th>Teléfono del Propietario</th>";
                    echo "<th>Acciones</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["tipo_vehiculo"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["placa"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["marca_vehiculo"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["modelo_vehiculo"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["estado_impuestos"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["propietario_nombres"] . " " . $row["propietario_apellidos"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["propietario_correo"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["propietario_telefono"]) . "</td>";
                        echo "<td>";
                        echo "<a href='../../php/detalle.php?placa=" . urlencode($row["placa"]) . "' class='btn btn-primary'>Ver detalle</a> ";
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                    echo "</div>";
                } else {
                    echo "<div class='alert alert-info'>No se encontraron vehículos asociados a la búsqueda.</div>";
                }
            }
            ?>
        </div>
    </main>
    <br>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>
