<?php

// 1. Encapsular la lógica en un solo script
header("Content-Type: application/json; charset=UTF-8");
// Add this line at the top of your PHP file
    header('Access-Control-Allow-Origin: *');

require "/xampp/htdocs/crud_fetch/Config/conexion.php";

/**
 * @description Obtiene el total de pacientes por Edad de una tabla específica dentro de un rango de fechas.
 * @param PDO $pdo Objeto de conexión a la base de datos.
 * @param string $fechaInicio Fecha de inicio del filtro (formato 'Y-m-d').
 * @param string $fechaFin Fecha de fin del filtro (formato 'Y-m-d').
 * @param string $tabla Nombre de la tabla a consultar.
 * @return array Devuelve un array con los resultados.
 * @throws PDOException Si la consulta a la base de datos falla.
 */
function clasificacionPorEdades(PDO $pdo, string $fechaInicio, string $fechaFin, string $tabla): array {
    $query = "SELECT 
                edad, COUNT(edad) AS total
              FROM
                $tabla
              WHERE
                DATE(hora_sistema) BETWEEN :fechaInicio AND :fechaFin
              GROUP BY 
                edad 
              ORDER BY 
                edad ASC";
    
    // El try-catch no es necesario aquí; el bloque principal lo manejará.
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':fechaInicio', $fechaInicio);
    $stmt->bindValue(':fechaFin', $fechaFin);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

try {
    // 2. Obtener y validar las fechas del formulario
    $fechaInicio = $_GET['fechaInicio'] ?? date('Y-m-01');
    $fechaFin = $_GET['fechaFin'] ?? date('Y-m-d');

    $tablas = ['servicio_medico', 'parientes_tratados', 'pacientes_cortesia'];
    $totalGlobalClasificado = [
        'ninos' => 0,
        'adolescentes' => 0,
        'adultos' => 0,
        'adultos_mayores' => 0,
    ];

    foreach ($tablas as $tabla) {
        $resultados = clasificacionPorEdades($pdo, $fechaInicio, $fechaFin, $tabla);
        
        foreach ($resultados as $item) {
            $edad = (int) $item['edad'];
            $total = (int) $item['total'];

            if ($edad >= 0 && $edad <= 12) {
                $totalGlobalClasificado['ninos'] += $total;
            } elseif ($edad >= 13 && $edad <= 17) {
                $totalGlobalClasificado['adolescentes'] += $total;
            } elseif ($edad >= 18 && $edad <= 64) {
                $totalGlobalClasificado['adultos'] += $total;
            } else {
                $totalGlobalClasificado['adultos_mayores'] += $total;
            }
        }
    }
    // Convert the object into the required array format
    $dataForChart = [];
    $dataForChart[] = ['edad' => 'Niños (0-12)', 'total' => $totalGlobalClasificado['ninos']];
    $dataForChart[] = ['edad' => 'Adolescentes (13-17)', 'total' => $totalGlobalClasificado['adolescentes']];
    $dataForChart[] = ['edad' => 'Adultos (18-64)', 'total' => $totalGlobalClasificado['adultos']];
    $dataForChart[] = ['edad' => 'Adultos Mayores (65+)', 'total' => $totalGlobalClasificado['adultos_mayores']];

    // ... inside the try block ...
    http_response_code(200);
    echo json_encode([
        'status' => 'success',
        'data' => $dataForChart // Pass the new array here
    ]);

} catch (PDOException $e) {
    // Manejo de errores de la base de datos
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'mensaje' => 'Error de base de datos: ' . $e->getMessage()
    ]);
    error_log("Error de base de datos en reportAge.php: " . $e->getMessage());
} catch (Exception $e) {
    // Manejo de otros errores inesperados
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'mensaje' => 'Error general: ' . $e->getMessage()
    ]);
    error_log("Error general en reportAge.php: " . $e->getMessage());
} finally {
    // 4. Cerrar la conexión
    $pdo = null;
}
?>