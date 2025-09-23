<?php
    require "/xampp/htdocs/crud_fetch/Config/conexion.php";
        
            /**
         * Fetches total counts for pathologies within a given date range.
         *
         * @param PDO $pdo The PDO database connection object.
         * @param string $fechaInicial The start date (YYYY-MM-DD).
         * @param string $fechaFinal The end date (YYYY-MM-DD).
         * @return array An array of associative arrays, each containing 'patologias' and 'total'.
         */
        function obtenerTotalesPorPatologia(PDO $pdo, $fechaInicio, $fechaFin): array {

            $query = "SELECT
                            p.patologias,
                            COUNT(*) AS total
                        FROM (
                            SELECT patologia, hora_sistema FROM servicio_medico
                            UNION ALL
                            SELECT patologia, hora_sistema FROM parientes_tratados
                            UNION ALL
                            SELECT patologia, hora_sistema FROM pacientes_cortesia
                        ) AS combined_data
                        LEFT JOIN patologias AS p ON combined_data.patologia = p.id
                        WHERE combined_data.hora_sistema BETWEEN :fechaInicio AND :fechaFin
                        GROUP BY p.patologias
                        ORDER BY total DESC";

            try {

                $stmt = $pdo->prepare(query: $query);
                $stmt->bindValue(":fechaInicio", $fechaInicio);
                $stmt->bindValue(":fechaFin", $fechaFin);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                
            } catch (PDOException $e) {
                error_log("Error al  obtener los datos por patologia " . $e->getMessage());
                return array(); // Devolver un array vacío en caso de error
            }
        }

            try{

                // Obtener fechas del formulario (o valores por defecto si no se han enviado)
                    $fechaInicio = $_GET['fechaInicio'] ?? date('Y-m-01');
                    $fechaFin = $_GET['fechaFin'] ?? date('Y-m-d');
                    error_log("Fecha Inicio recibida: " . $fechaInicio);
                    error_log("Fecha Fin recibida: " . $fechaFin);
                    


                    $totalesGlobalesPorPatologia = obtenerTotalesPorPatologia($pdo, $fechaInicio, $fechaFin);
                    

                    // Prepare the response in the format the frontend expects
                    echo json_encode([
                        'status' => 'success',
                        'data' => $totalesGlobalesPorPatologia, // This will be an array of objects/arrays
                        'mensaje' => 'Datos de patologías cargados exitosamente.'
                    ]);

                    } catch (Exception $e) {
                        // Catch any exceptions during the main execution flow
                        error_log("General API Error in reportPatologias.php: " . $e->getMessage());
                        echo json_encode([
                            'status' => 'error',
                            'mensaje' => 'Error al procesar la solicitud: ' . $e->getMessage()
                        ]);
                    } finally {
                        // Close the database connection if it was opened
                        if (isset($pdo) && $pdo instanceof PDO) {
                            $pdo = null;
                        }
                    }
                
        
    
    
?>