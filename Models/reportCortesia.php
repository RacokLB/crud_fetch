<?php

    require "/xampp/htdocs/crud_fetch/Config/conexion.php";

    /**
         * Fetches total counts for pathologies within a given date range.
         *
         * @param PDO $pdo The PDO database connection object.
         * @param string $fechaInicial The start date (YYYY-MM-DD).
         * @param string $fechaFinal The end date (YYYY-MM-DD).
         * @return array An array of associative arrays, each containing 'departamento' and 'total'.
         */
        function obtenerTotalPorCortesia(PDO $pdo, $fechaInicio, $fechaFin): array{

            $query = "SELECT c.nombre, COUNT(nombre) AS total FROM pacientes_cortesia
            LEFT JOIN cortesia AS c ON pacientes_cortesia.institucion = c.id
            WHERE DATE(hora_sistema) BETWEEN :fechaInicio AND :fechaFin 
            GROUP BY c.nombre
            ORDER BY c.nombre DESC";
            
            try{

                $stmt = $pdo->prepare(query: $query);
                $stmt->bindValue(":fechaInicio",$fechaInicio);
                $stmt->bindValue(":fechaFin",$fechaFin);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);

            } catch (PDOException $e){
                error_log("Error al obtener los datos por Institucion " . $e->getMessage());
                return array(); //Devolver una array vacio en caso de error
            }
        }

            try{

                //Obtener las fechas del formulario
                $fechaInicio = $_GET['fechaInicio'] ?? date('Y-m-01');
                $fechaFin = $_GET['fechaFin'] ?? date('Y-m-d');

                $totalesGlobalesPorCortesia = obtenerTotalPorCortesia($pdo,$fechaInicio,$fechaFin);

                //Prepare the response in the format the frontend expects
                echo json_encode([
                    'status' => 'success',
                    'data' => $totalesGlobalesPorCortesia,
                    'mensaje' => 'Datos de Cortesias cargados con exito.'
                ]);
            }catch (Exception $e){
                // Catch any exceptions during the main execution flow
                error_log("General API Error in reportCortesia.php: " . $e->getMessage());
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