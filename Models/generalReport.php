<?php

// Set headers for CORS and JSON
//header('Content-Type: application/json; charset=UTF-8');
//header('Access-Control-Allow-Origin: *');

// Include the database connection file
require_once "/xampp/htdocs/crud_fetch/Config/conexion.php";

/**
 * @description Obtiene el total de registros de una tabla dentro de un rango de fechas.
 * @param PDO $pdo Objeto de conexión a la base de datos.
 * @param string $tabla Nombre de la tabla a consultar.
 * @param string $fechaInicio Fecha de inicio del filtro (formato 'Y-m-d').
 * @param string $fechaFin Fecha de fin del filtro (formato 'Y-m-d').
 * @return int Devuelve el total de registros o 0 si no hay.
 */
function obtenerTotalRegistros(PDO $pdo, string $tabla, string $fechaInicio, string $fechaFin): int {
    $query = "SELECT COUNT(id) AS total FROM $tabla WHERE DATE(hora_sistema) BETWEEN :fechaInicio AND :fechaFin";
    
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(":fechaInicio", $fechaInicio);
    $stmt->bindValue(":fechaFin", $fechaFin);
    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return (int) ($result['total'] ?? 0);
}

try {
    // Get and validate the dates from the GET parameters
    $fechaInicio = $_GET['fechaInicio'] ?? date('Y-m-01');
    $fechaFin = $_GET['fechaFin'] ?? date('Y-m-d');

    // Get the total records for each table
    $totalTrabajadores = obtenerTotalRegistros($pdo, 'servicio_medico', $fechaInicio, $fechaFin);
    $totalParientes = obtenerTotalRegistros($pdo, 'parientes_tratados', $fechaInicio, $fechaFin);
    $totalCortesia = obtenerTotalRegistros($pdo, 'pacientes_cortesia', $fechaInicio, $fechaFin);

    // Calculate the total number of patients
    $totalPacientes = $totalTrabajadores + $totalParientes + $totalCortesia;

    // Send the JSON response
    echo json_encode([
        'status' => 'success',
        'totalPacientes' => $totalPacientes,
        'totalTrabajadores' => $totalTrabajadores,
        'totalParientes' => $totalParientes,
        'totalCortesia' => $totalCortesia,
    ]);

} catch (PDOException $e) {
    // Handle database errors
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'mensaje' => 'Database error: ' . $e->getMessage(),
    ]);
    error_log("Database error in reportAge.php: " . $e->getMessage());
} catch (Exception $e) {
    // Handle other unexpected errors
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'mensaje' => 'General error: ' . $e->getMessage(),
    ]);
    error_log("General error in reportAge.php: " . $e->getMessage());
} finally {
    // Close the connection
    $pdo = null;
}
?>