<?php
require '../vendor/autoload.php';
include("../crud/includes/db.php");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Verificar si se ha enviado la placa por GET
if (isset($_GET['placa'])) {
    $placa = $_GET['placa'];

    // Crear un nuevo documento de hoja de cálculo
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Títulos de las columnas para la información del vehículo
    $sheet->setCellValue('A1', 'Tipo de Vehículo');
    $sheet->setCellValue('B1', 'Placa');
    $sheet->setCellValue('C1', 'Marca');
    $sheet->setCellValue('D1', 'Modelo');
    $sheet->setCellValue('E1', 'Valor del Vehículo');
    $sheet->setCellValue('F1', 'Propietario');
    $sheet->setCellValue('G1', 'Fecha de matrícula');

    // Consulta SQL para obtener la información del vehículo
    $sql = "SELECT vehiculos.*, marcas.marca, modelos.modelo, usuarios.nombres, usuarios.apellidos, tp_vehiculos.vehiculos as tipo_vehiculo
            FROM vehiculos
            INNER JOIN marcas ON vehiculos.marca = marcas.id
            INNER JOIN modelos ON vehiculos.modelo = modelos.id
            INNER JOIN usuarios ON vehiculos.propietario = usuarios.documento
            INNER JOIN tp_vehiculos ON vehiculos.tp_vehiculo = tp_vehiculos.id
            WHERE vehiculos.placa = '$placa'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Rellenar la información del vehículo
        $sheet->setCellValue('A2', $row['tipo_vehiculo']);
        $sheet->setCellValue('B2', $row['placa']);
        $sheet->setCellValue('C2', $row['marca']);
        $sheet->setCellValue('D2', $row['modelo']);
        $sheet->setCellValue('E2', $row['valor']);
        $sheet->setCellValue('F2', $row['nombres'] . ' ' . $row['apellidos']);
        $sheet->setCellValue('G2', $row['f_matricula']);

        // Títulos de las columnas para los impuestos asociados
        $sheet->setCellValue('A4', 'Fecha Inicio Impuesto');
        $sheet->setCellValue('B4', 'Fecha Fin Impuesto');
        $sheet->setCellValue('C4', 'Valor del Vehículo');
        $sheet->setCellValue('D4', 'Avalúo');
        $sheet->setCellValue('E4', 'Valor x Avalúo');
        $sheet->setCellValue('F4', 'Valor del Impuesto');
        $sheet->setCellValue('G4', 'Total con Avalúo');
        $sheet->setCellValue('H4', 'Estado del Impuesto');

        // Consulta SQL para obtener los impuestos asociados
        $sql_impuestos = "SELECT impuesto.*, avaluos.avaluo, estados.estado AS estado_impuesto 
                          FROM impuesto
                          INNER JOIN vehiculos ON impuesto.placa = vehiculos.placa
                          INNER JOIN avaluos ON vehiculos.id_avaluo = avaluos.id
                          INNER JOIN estados ON impuesto.id_estado = estados.id
                          WHERE impuesto.placa = '$placa'";
        $result_impuestos = $conn->query($sql_impuestos);

        if ($result_impuestos && $result_impuestos->num_rows > 0) {
            $fila = 5; // Fila inicial para los impuestos
            while ($row_impuestos = $result_impuestos->fetch_assoc()) {
                $avaluo = $row_impuestos['avaluo'];
                $valor_impuesto = $row_impuestos['id_valor'];
                $valor_vehiculo = $row['valor'];
                $multiplicacion_valor_avaluo = $valor_vehiculo * ($avaluo / 100);
                $total_con_avaluo = $multiplicacion_valor_avaluo + $valor_impuesto;
                $estado_impuesto = $row_impuestos['estado_impuesto'];

                // Rellenar la información de los impuestos asociados
                $sheet->setCellValue('A' . $fila, $row_impuestos['fecha_ini']);
                $sheet->setCellValue('B' . $fila, $row_impuestos['fecha_fin']);
                $sheet->setCellValue('C' . $fila, $valor_vehiculo);
                $sheet->setCellValue('D' . $fila, $avaluo . '%');
                $sheet->setCellValue('E' . $fila, $multiplicacion_valor_avaluo);
                $sheet->setCellValue('F' . $fila, $valor_impuesto);
                $sheet->setCellValue('G' . $fila, $total_con_avaluo);
                $sheet->setCellValue('H' . $fila, $estado_impuesto);

                $fila++;
            }
        }
    }

    // Crear el archivo Excel
    $writer = new Xlsx($spreadsheet);
    $filename = 'informacion_vehiculo_' . $placa . '.xlsx';

    // Configurar las cabeceras para la descarga
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
    exit();
} else {
    echo "No se ha especificado una placa.";
}
?>
