<?php include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>
<link rel="stylesheet" href="../css/editarc.css">
<h2>Crear Cilindrada</h2>
<form action="create.php" method="POST" class="centered-form">
    
<label for="cilindrada">Cilindrada:</label>
<input type="text" id="cilindrada" name="cilindrada" required>

<script>
    document.getElementById("cilindrada").addEventListener("input", function() {
        // Obtener el valor del campo de entrada
        var inputValue = this.value;

        // Verificar si el valor cumple con las condiciones
        if (/^[1-9]\d{0,4}$/.test(inputValue)) {
            // El valor es válido, eliminar cualquier mensaje de error
            this.setCustomValidity("");
        } else {
            // El valor no cumple con las condiciones, establecer un mensaje de error
            this.setCustomValidity("La cilindrada debe tener máximo de 5 dígitos.");
        }
    });
</script>


    <label for="cilindrada">Para vehiculo:</label>
    <select name="id_tp_vehiculo	" required>
        <?php
        $sql = "SELECT * FROM tp_vehiculos WHERE id IN (1, 2, 3)";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "'>" . $row['vehiculos'] . " </option>";
        }
        ?>
    </select>
    <input type="submit" name="submit" value="Crear" class="blue-button">
</form>

<?php
if (isset($_POST['submit'])) {
    $cilindrada = $_POST['cilindrada'];
    $id_tp_vehiculo	 = $_POST['id_tp_vehiculo	'];
    $sql = "INSERT INTO cilindrada (cilindrada,id_tp_vehiculo	) VALUES ('$cilindrada','$id_tp_vehiculo	')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('Cilindrada actualizado con éxito');
        window.location = 'read.php';
      </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<?php include '../includes/footer.php'; ?>