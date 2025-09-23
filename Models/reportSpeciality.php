<?php

// 1. Encapsular la lógica en un solo script
header("Content-Type: application/json; charset=UTF-8");

require "/xampp/htdocs/crud_fetch/Config/conexion.php";

/**
 * @description Obtiene el total de pacientes por especialidad de una tabla específica dentro de un rango de fechas.
 * @param PDO $pdo Objeto de conexión a la base de datos.
 * @param string $fechaInicio Fecha de inicio del filtro (formato 'Y-m-d').
 * @param string $fechaFin Fecha de fin del filtro (formato 'Y-m-d').
 * @param string $tabla Nombre de la tabla a consultar.
 * @return array Devuelve un array con los resultados.
 * @throws PDOException Si la consulta a la base de datos falla.
 */
function obtenerTotalesPorEspecialidad(PDO $pdo, string $fechaInicio, string $fechaFin, string $tabla): array {
    $query = "SELECT 
                especialidades.especialidades, 
                COUNT(*) AS total 
              FROM 
                $tabla
              LEFT JOIN 
                especialidades ON $tabla.especialidad = especialidades.id
              WHERE 
                DATE(hora_sistema) BETWEEN :fechaInicio AND :fechaFin
              GROUP BY 
                especialidades.especialidades 
              ORDER BY 
                total DESC";

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':fechaInicio', $fechaInicio);
    $stmt->bindValue(':fechaFin', $fechaFin);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

try {
    // 2. Obtener y validar las fechas de los parámetros GET
    $fechaInicio = $_GET['fechaInicio'] ?? date('Y-m-01');
    $fechaFin = $_GET['fechaFin'] ?? date('Y-m-d');

    $tablas = ['servicio_medico', 'parientes_tratados', 'pacientes_cortesia'];
    
    // 3. Acumular los totales en un solo bucle
    $totalesGlobalesPorEspecialidad = [];

    foreach ($tablas as $tabla) {
        $resultados = obtenerTotalesPorEspecialidad($pdo, $fechaInicio, $fechaFin, $tabla);
        
        foreach ($resultados as $item) {
            $especialidad = $item['especialidades'];
            $total = (int) $item['total'];
            
            $totalesGlobalesPorEspecialidad[$especialidad] = ($totalesGlobalesPorEspecialidad[$especialidad] ?? 0) + $total;
        }
    }

    // 4. Formatear el resultado final para el JSON
    $resultadoFinal = [];
    foreach ($totalesGlobalesPorEspecialidad as $especialidad => $total) {
        $resultadoFinal[] = ['especialidades' => $especialidad, 'total' => $total];
    }

    // 5. Ordenar el resultado final por el total de forma descendente
    usort($resultadoFinal, function ($a, $b) {
        return $b['total'] - $a['total'];
    });

    // 6. Enviar una respuesta JSON estructurada
    http_response_code(200);
    echo json_encode([
        'status' => 'success',
        'data' => $resultadoFinal
    ]);

} catch (PDOException $e) {
    // Manejo de errores de la base de datos
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'mensaje' => 'Error de base de datos: ' . $e->getMessage()
    ]);
    error_log("Error de base de datos en reportEspecialidades.php: " . $e->getMessage());
    
} catch (Exception $e) {
    // Manejo de otros errores inesperados
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'mensaje' => 'Error general: ' . $e->getMessage()
    ]);
    error_log("Error general en reportEspecialidades.php: " . $e->getMessage());

} finally {
    // 7. Cerrar la conexión
    $pdo = null;
}
?>