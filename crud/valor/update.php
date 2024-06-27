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

$id = $_GET['id'] ?? null; // Se agrega manejo para el caso en que $_GET['id'] no esté definido
if ($id === null) {
    // Si no se proporciona un ID válido, redirigir o mostrar un mensaje de error
    header("Location: error.php");
    exit();
}

$stmt = $conn->prepare("SELECT valor FROM valor WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
if (!$row) {
    // Si no se encuentra el registro correspondiente, redirigir o mostrar un mensaje de error
    header("Location: error.php");
    exit();
}
$valor = $row['valor'];
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valor = $_POST['valor'];

    $stmt = $conn->prepare("UPDATE valor SET valor = ?");
    $stmt->bind_param("s", $valor);
    $stmt->execute();
    $stmt->close();

    header("Location: read.php");
    exit();
}


?>

<form method="post" action="">
    Valor: <input type="text" name="valor" value="<?php echo htmlspecialchars($valor); ?>" required><br>
   <br>
    <input type="submit" value="Guardar">
</form>

<?php include '../includes/footer.php'; ?>