<?php
    require "/xampp/htdocs/crud_fetch/Config/conexion.php";
        
            /**
         * Fetches total counts for pathologies within a given date range.
         *
         * @param PDO $pdo The PDO database connection object.
         * @return array An array of associative arrays, each containing 'patologias' and 'total'.
         */
        function obtenerTotalesPorEspecialidades(PDO $pdo): array {

            $query = "SELECT especialidades.especialidades, COUNT(especialistas.doctores) AS total FROM especialistas INNER JOIN especialidades ON especialistas.cod_Especialidad = especialidades.id GROUP BY especialidades.especialidades ORDER BY total DESC";
                    

            try {

                $stmt = $pdo->prepare(query: $query);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                
            } catch (PDOException $e) {
                error_log("Error al  obtener los datos por especialidades " . $e->getMessage());
                return array(); // Devolver un array vacío en caso de error
            }
        }

            try{
                    
                $totalesGlobalesPorEspecialidades = obtenerTotalesPorEspecialidades($pdo);
                

                // Prepare the response in the format the frontend expects
                echo json_encode([
                    'status' => 'success',
                    'data' => $totalesGlobalesPorEspecialidades, // This will be an array of objects/arrays
                    'mensaje' => 'Datos de Especialidades cargados exitosamente.'
                ]);

                } catch (Exception $e) {
                    // Catch any exceptions during the main execution flow
                    error_log("General API Error in reportEspecialidades.php: " . $e->getMessage());
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