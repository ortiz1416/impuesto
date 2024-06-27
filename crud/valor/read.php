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
include '../includes/db.php';
include '../includes/header.php';

try {
    $stmt = $conn->prepare("SELECT v.id, v.valor, t.vehiculos as vehiculo, t.peso, m.modelo, v.id_modelo_hasta, mh.modelo AS modelo_hasta
                            FROM valor v 
                            JOIN tp_vehiculos t ON v.id_tp_vehiculos = t.id AND t.peso IS NOT NULL
                            JOIN modelos m ON v.id_modelo = m.id
                            LEFT JOIN modelos mh ON v.id_modelo_hasta = mh.id");

    if (!$stmt) {
        throw new Exception("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        throw new Exception("Error en la ejecución de la consulta: " . $stmt->error);
    }

    $valores = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main>
        <a name="" id="" class="btn btn-primary" href="create.php" role="button">Crear</a>

        <table id="myTable" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Valor</th>
                    <th>Tipo de Vehículo</th>
                    <th>Peso</th>
                    <th>Modelo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($valores as $row) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td>$ <?php echo htmlspecialchars($row['valor']); ?></td>
                        <td><?php echo htmlspecialchars($row['vehiculo']); ?></td>
                        <td><?php echo $row['peso'] ? htmlspecialchars($row['peso']) : ''; ?></td>
                        <td><?php echo htmlspecialchars($row['modelo'] . ' Hasta ' . $row['modelo_hasta']); ?></td>
                        <td>
                            <a href="update.php?id=<?php echo htmlspecialchars($row['id']); ?>">Editar</a>
                            <a href="delete.php?id=<?php echo htmlspecialchars($row['id']); ?>" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <?php include '../includes/footer.php'; ?>
    <!-- jQuery -->
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "lengthMenu": [5, 10, 20, 30, 50]
            });
        });
    </script>
</body>

</html>