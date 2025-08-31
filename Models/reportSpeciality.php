<?php
    require "/xampp/htdocs/crud_fetch/Config/conexion.php";


    function obtenerTotalesPorEspecialidad(PDO $pdo, string $tabla): array {
        $query = "SELECT especialidades.especialidades, COUNT(*) AS total FROM $tabla
        LEFT JOIN especialidades ON $tabla.especialidad = especialidades.id
        GROUP BY especialidades.especialidades ORDER BY total DESC";
    
        try {
            $stmt = $pdo->prepare(query: $query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            return array(); // Devolver un array vacío en caso de error
        }
    }
    
    
    try {
        // Obtener los totales por especialidad de cada tabla
        $trabajadoresPorEspecialidad = obtenerTotalesPorEspecialidad($pdo, 'servicio_medico');
        $parientesPorEspecialidad = obtenerTotalesPorEspecialidad($pdo, 'parientes_tratados');
        $cortesiaPorEspecialidad = obtenerTotalesPorEspecialidad($pdo, 'pacientes_cortesia');
    
        // Unificar los resultados en un solo array asociativo por especialidad
        $totalesGlobalesPorEspecialidad = [];
    
        foreach ($trabajadoresPorEspecialidad as $item) {
            $especialidad = $item['especialidades'];
            $total = (int) $item['total'];
            $totalesGlobalesPorEspecialidad[$especialidad] = ($totalesGlobalesPorEspecialidad[$especialidad] ?? 0) + $total;
        }
    
        foreach ($parientesPorEspecialidad as $item) {
            $especialidad = $item['especialidades'];
            $total = (int) $item['total'];
            $totalesGlobalesPorEspecialidad[$especialidad] = ($totalesGlobalesPorEspecialidad[$especialidad] ?? 0) + $total;
        }
    
        foreach ($cortesiaPorEspecialidad as $item) {
            $especialidad = $item['especialidades'];
            $total = (int) $item['total'];
            $totalesGlobalesPorEspecialidad[$especialidad] = ($totalesGlobalesPorEspecialidad[$especialidad] ?? 0) + $total;
        }
    
        // Formatear los resultados para el JSON
        $resultadoFinal = [];
        foreach ($totalesGlobalesPorEspecialidad as $especialidad => $total) {
            $resultadoFinal[] = ['especialidades' => $especialidad, 'total' => $total];
        }
    
        // Ordenar el resultado final por el total de forma descendente (opcional)
    usort($resultadoFinal, function ($a, $b) {
        return $b['total'] - $a['total'];
        });

        // Enviar la respuesta como JSON
        header('Content-Type: application/json');
        echo json_encode($resultadoFinal);

    } catch (Exception $e) {
        // Enviar respuesta de error general
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'mensaje' => 'Error general: ' . $e->getMessage()]);
    } finally {
        $pdo = null;
    }
?>