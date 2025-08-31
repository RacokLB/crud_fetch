<?php
// ESTE ARCHIVO ES LA FORMA QUE SIRVE PARA ENVIAR ATRAVES DE UN JSON SIMPLE LOS DATOS , OSEA UN JSON QUE NO AMERITE CONVERTIRLO EN UN ARRAY HACIENDO USO DE STATUS ===SUCCESS , DATA=$VARIABLE QUE CONTIENE LOS DATOS 
    require "/xampp/htdocs/crud_fetch/Config/conexion.php";

    function clasificacionPorEdades(PDO $pdo, string $tabla): array
    {
        $sql = "SELECT edad, COUNT(edad) AS total FROM $tabla GROUP BY edad ORDER BY edad ASC";
        $arrayClasificada = array(
            'ninos' => 0,
            'adolescentes' => 0,
            'adultos' => 0,
            'adultos_mayores' => 0,
            'total_registros' => 0
        );
        try {
            $queryData = $pdo->prepare($sql);
            $queryData->execute();
            while ($item = $queryData->fetch(PDO::FETCH_ASSOC)) {
                $edad = (int) $item['edad'];
                $total = (int) $item['total'];
                
    
                if ($edad >= 0 && $edad <= 12) {
                    $arrayClasificada['ninos'] += $total;
                } elseif ($edad >= 13 && $edad <= 17) {
                    $arrayClasificada['adolescentes'] += $total;
                } elseif ($edad >= 18 && $edad <= 64) {
                    $arrayClasificada['adultos'] += $total;
                } else {
                    $arrayClasificada['adultos_mayores'] += $total;
                }
            }
            
            return $arrayClasificada;
        } catch (PDOException $e) {
            error_log("Error al obtener la clasificacion por edades: ". $e->getMessage());
            // Consider logging the error for debugging purposes
            return [];
        }
    }
    try{
        $tablas = ['servicio_medico', 'parientes_tratados', 'pacientes_cortesia'];
        $totalGlobalClasificado = [
            'ninos' => 0,
            'adolescentes' => 0,
            'adultos' => 0,
            'adultos_mayores' => 0,
            
        ];
        foreach ($tablas as $tabla) {
            $clasificacion = clasificacionPorEdades(pdo: $pdo, tabla: $tabla);
            $totalGlobalClasificado['ninos'] += $clasificacion['ninos'] ?? 0;
            $totalGlobalClasificado['adolescentes'] += $clasificacion['adolescentes'] ?? 0;
            $totalGlobalClasificado['adultos'] += $clasificacion['adultos'] ?? 0;
            $totalGlobalClasificado['adultos_mayores'] += $clasificacion['adultos_mayores'] ?? 0;
        
        }
        //Formatear los resultados para el JSON 
        $resultadoFinal = array();
        foreach ($totalGlobalClasificado as $key => $value) {
            $resultadoFinal[] = ['edad' => $key, 'total' => $value];
        }
        header(header: 'Content-Type: application/json');
        echo json_encode($resultadoFinal);

    }catch(Exception $e){
        header(header: 'Content-Type: application/json');
        echo json_encode(value: ['status' => 'error', 'mensaje' => 'Error general: ' . $e->getMessage()]);
    }finally{
        
        $pdo = null;
    }

?>