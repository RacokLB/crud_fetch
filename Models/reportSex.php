<?php

    require_once "/xampp/htdocs/crud_fetch/Config/conexion.php";

    function totalPacientesPorSexo (PDO $pdo, STRING $tabla): array {
        $sql ="SELECT sexo, COUNT(*) AS total FROM $tabla WHERE sexo != '' GROUP BY sexo";
    
        try{
            $queryData = $pdo->prepare(query: $sql);
            $queryData->execute();
            return $queryData->fetchAll(PDO::FETCH_ASSOC);
        

        }catch (PDOException $e){
            return array();
        }
    }

    try {
    
        // Crear un array para almacenar los totales globales por sexo
        $tablas = ['servicio_medico', 'parientes_tratados', 'pacientes_cortesia'];
        //Iniciamos un array vacio que contendra lo iterado de las variables con los valores globales
        $totalesGlobalesPorGenero = [];

    //Iteracion sobre las distintas tablas y llenado del array $totalesGlobalesPorGenero = []; con los datos obtenidos
        foreach ($tablas as $tabla) {
            $resultados = totalPacientesPorSexo(pdo: $pdo, tabla: $tabla);
            foreach ($resultados as $item) {
                $sexo = $item['sexo'];
                $total = (int) $item['total'];
                
                $totalesGlobalesPorGenero[$sexo] = ($totalesGlobalesPorGenero[$sexo] ?? 0) + $total;
            }
        }
    
        // Formatear los resultados para el JSON
        $resultadoFinal = [];
        foreach ($totalesGlobalesPorGenero as $sexo => $total) {
            $resultadoFinal[] = ['sexo' => $sexo, 'total' => $total];
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
        header(header: 'Content-Type: application/json');
        echo json_encode(['status' => 'error', 'mensaje' => 'Error general: ' . $e->getMessage()]);
    } finally {
        $pdo = null;
    }


?>