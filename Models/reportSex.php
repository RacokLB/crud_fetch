<?php

header("Content-Type: application/json; charset=UTF-8");

// Requerir el archivo de conexión.
// Se usa require_once para asegurar que se carga una sola vez.
require_once "/xampp/htdocs/crud_fetch/Config/conexion.php";

/**
 * @description Obtiene el total de pacientes por sexo de una tabla específica dentro de un rango de fechas.
 * @param PDO $pdo Objeto de conexión a la base de datos.
 * @param string $fechaInicio Fecha de inicio del filtro (formato 'Y-m-d').
 * @param string $fechaFin Fecha de fin del filtro (formato 'Y-m-d').
 * @param string $tabla Nombre de la tabla a consultar.
 * @return array Devuelve un array con los resultados.
 * @throws PDOException Si la consulta a la base de datos falla.
 */
function totalPacientesPorSexo(PDO $pdo, string $fechaInicio, string $fechaFin, string $tabla): array {
    $sql = "SELECT sexo, COUNT(*) AS total FROM $tabla WHERE sexo != '' AND DATE(hora_sistema) BETWEEN :fechaInicio AND :fechaFin GROUP BY sexo";
    
    // El try/catch en la función no es necesario si se maneja en el bloque principal.
    // Lanza la excepción para que el bloque externo la capture.
    $queryData = $pdo->prepare($sql);
    $queryData->bindValue(":fechaInicio", $fechaInicio);
    $queryData->bindValue(":fechaFin", $fechaFin);
    $queryData->execute();
    
    return $queryData->fetchAll(PDO::FETCH_ASSOC);
}

try {
    // 1. Obtener y validar las fechas del GET
    // Usar el operador de fusión nula `??` es una excelente práctica.
    $fechaInicio = $_GET['fechaInicio'] ?? date('Y-m-01');
    $fechaFin = $_GET['fechaFin'] ?? date('Y-m-d');
    
    // Opcional: Validar que las fechas sean válidas, en este caso, se asume que
    // el formato es correcto por la entrada del <input type="date"> del frontend.
    
    $tablas = ['servicio_medico', 'parientes_tratados', 'pacientes_cortesia'];
    
    // 2. Acumular los totales globales
    $totalesGlobalesPorGenero = [];

    foreach ($tablas as $tabla) {
        $resultados = totalPacientesPorSexo($pdo, $fechaInicio, $fechaFin, $tabla);
        
        foreach ($resultados as $item) {
            $sexo = $item['sexo'];
            $total = (int) $item['total'];
            
            // Sumar al total global, usando el operador de fusión nula para inicializar si es necesario
            $totalesGlobalesPorGenero[$sexo] = ($totalesGlobalesPorGenero[$sexo] ?? 0) + $total;
        }
    }
    
    // 3. Formatear el resultado final para el JSON
    $resultadoFinal = [];
    foreach ($totalesGlobalesPorGenero as $sexo => $total) {
        $resultadoFinal[] = ['sexo' => $sexo, 'total' => $total];
    }
    
    // 4. Ordenar el resultado
    usort($resultadoFinal, function ($a, $b) {
        return $b['total'] - $a['total'];
    });
    
    // 5. Enviar respuesta exitosa con código 200 OK
    http_response_code(200);
    echo json_encode(['status' => 'success', 'data' => $resultadoFinal]);

} catch (PDOException $e) {
    // Capturar errores específicos de la base de datos y enviar un error de servidor
    http_response_code(500); // Internal Server Error
    echo json_encode(['status' => 'error', 'mensaje' => 'Error de base de datos: ' . $e->getMessage()]);
    // Registrar el error para fines de depuración
    error_log("Error de base de datos: " . $e->getMessage());

} catch (Exception $e) {
    // Capturar cualquier otro tipo de error
    http_response_code(500); // Internal Server Error
    echo json_encode(['status' => 'error', 'mensaje' => 'Error general: ' . $e->getMessage()]);
    // Registrar el error
    error_log("Error general: " . $e->getMessage());

} finally {
    // 6. Cerrar la conexión
    $pdo = null;
}
?>