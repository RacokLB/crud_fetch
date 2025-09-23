<?php

header('Content-Type: application/json');

// Incluye el archivo de conexión. Asegúrate de que este archivo devuelva el objeto PDO.
require_once "/xampp/htdocs/crud_fetch/Config/conexion.php";

/**
 * Obtiene el total de registros por mes desde una tabla específica.
 *
 * @param PDO $pdo El objeto de conexión a la base de datos PDO.
 * @param string $tabla El nombre de la tabla a consultar.
 * @return array Un array de arrays asociativos, cada uno con 'mes' y 'total_pacientes'.
 */
function obtenerTotalParientesPorMes(PDO $pdo): array
{
    $query = "SELECT
                DATE_FORMAT(hora_sistema, '%Y-%m') AS mes,
                COUNT(*) AS total_pacientes
            FROM parientes_tratados
            GROUP BY mes
            ORDER BY mes";
    try {
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        // PDOStatement::fetch() itera sobre los resultados automáticamente.
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Si no hay resultados, retorna un array vacío.
        return $data;
    } catch (PDOException $e) {
        // Usa error_log para registrar el error sin exponer detalles al usuario.
        error_log("Error al obtener los datos por mes: " . $e->getMessage());
        return []; // Retorna un array vacío en caso de error.
    }
}

// Lógica principal
try {
    
    // Llama a la función para obtener los datos.
    $totalMensual = obtenerTotalParientesPorMes($pdo);

    // Prepara la respuesta en el formato JSON esperado.
    echo json_encode($totalMensual);
} catch (Exception $e) {
    // Captura cualquier excepción en el flujo de ejecución principal.
    error_log("Error general en el script: " . $e->getMessage());

    // Devuelve un JSON de error al cliente.
    echo json_encode([
        'status' => 'error',
        'mensaje' => 'Error al procesar la solicitud: ' . $e->getMessage()
    ]);
} finally {
    // Cierra la conexión a la base de datos.
    $pdo = null;
}

?>