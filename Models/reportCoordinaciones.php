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
        function obtenerTotalPorCoordinaciones(PDO $pdo, $fechaInicio, $fechaFin): array{

            $query = "SELECT tc.nombre_coordinacion, COUNT(coordinacion) AS total FROM servicio_medico
            LEFT JOIN tabla_coordinaciones AS tc ON servicio_medico.coordinacion = tc.codigo_coordinacion
            WHERE DATE(hora_sistema) BETWEEN :fechaInicio AND :fechaFin 
            GROUP BY tc.nombre_coordinacion
            ORDER BY tc.nombre_coordinacion DESC";
            
            try{

                $stmt = $pdo->prepare(query: $query);
                $stmt->bindValue(":fechaInicio",$fechaInicio);
                $stmt->bindValue(":fechaFin",$fechaFin);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);

            } catch (PDOException $e){
                error_log("Error al obtener los datos por coordinacion " . $e->getMessage());
                return array(); //Devolver una array vacio en caso de error
            }
        }

            try{

                //Obtener las fechas del formulario
                $fechaInicio = $_GET['fechaInicio'] ?? date('Y-m-01');
                $fechaFin = $_GET['fechaFin'] ?? date('Y-m-d');

                $totalesGlobalesPorCoordinacion = obtenerTotalPorCoordinaciones($pdo,$fechaInicio,$fechaFin);

                //Prepare the response in the format the frontend expects
                echo json_encode([
                    'status' => 'success',
                    'data' => $totalesGlobalesPorCoordinacion,
                    'mensaje' => 'Datos de coordinaciones cargados con exito.'
                ]);
            }catch (Exception $e){
                // Catch any exceptions during the main execution flow
                error_log("General API Error in reportCoordinaciones.php: " . $e->getMessage());
                echo json_encode([
                    'status' => 'error',
                    'mensaje' => 'Error al procesar la solicitud: ' . $e->getMessage()
                ]);
            }finally{
                //Close the database connection if it awas opened
                if(isset($pdo) && $pdo instanceof PDO){
                    $pdo=null;
                }
            }

        


?>