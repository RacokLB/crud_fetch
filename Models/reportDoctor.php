<?php

    require "../Config/conexion.php";

function obtenerTotalesPorDoctor(PDO $pdo, string $fechaInicio, string $fechaFin, string $tabla): array {

    $sql = "SELECT 
                especialistas.doctores, COUNT(*) AS total 
                FROM 
                    $tabla 
                LEFT JOIN
                    especialistas ON $tabla.especialista = especialistas.id
                WHERE 
                    DATE(hora_sistema) BETWEEN :fechaInicio AND :fechaFin
                GROUP BY 
                    especialistas.doctores 
                ORDER BY 
                    total DESC";

    $stmt = $pdo->prepare(query: $sql);
    $stmt->bindValue(':fechaInicio',$fechaInicio);
    $stmt->bindValue(':fechaFin',$fechaFin);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);    
}

try {
    //2. Obtener y validar las fechas de los parametrso GET
    $fechaInicio = $_GET['fechaInicio'] ?? date('Y-m-01');
    $fechaFin = $_GET['fechaFin'] ?? date('Y-m-d');

    $tablas = ['servicio_medico','parientes_tratados','pacientes_cortesia'];

    // 3. Acumular los totales en un solo bucle
    $totalesGlobalesPorDoctor = [];

    foreach($tablas as $tabla){

        $resultados = obtenerTotalesPorDoctor($pdo, $fechaInicio, $fechaFin, $tabla);
        foreach ($resultados as $item){
            $doctores = $item['doctores'];
            $total = (int) $item['total'];
            
            $totalesGlobalesPorDoctor[$doctores] = ($totalesGlobalesPorDoctor[$doctores] ?? 0) + $total;

        }
    }

    //4. Formatear el resultado final para el JSON
    $resultadoFinal = [];
    foreach ($totalesGlobalesPorDoctor as $doctores => $total){
        $resultadoFinal[] = ['doctores' => $doctores, 'total' => $total];

    }
    
    // 5. Ordenar el resultado final por el total de forma DESC
    usort($resultadoFinal, function($a,$b){
        return $b['total'] - $a['total'];
    });

    // 6. Enviar una respuesta JSON estructurada
    http_response_code(200);
    echo json_encode([
        'status' => 'success',
        'data' => $resultadoFinal
    ]);
} catch (PDOException $e){
    //Manejo de errores de la DB
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'mensaje' => 'Error de DB: ' . $e->getMessage()
    ]);
    error_log("Error de DB en reportDoctor.php:" . $e->getMessage());

} finally{
    // 7. Cerrar la conexion
    $pdo = null;
}

?>