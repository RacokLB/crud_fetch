<?php
  
         // Función para obtener el total de registros de una tabla
         function obtenerTotalRegistros(PDO $pdo, string $tabla): array {
                try {
                    $stmt = $pdo->prepare(query: "SELECT COUNT(*) AS total FROM $tabla WHERE DATE(hora_sistema) = CURDATE()");
                    $stmt->execute();
                    $resultado = $stmt->fetch(mode: PDO::FETCH_ASSOC);
            
                    if ($resultado && isset($resultado['total'])) {
                        return array(
                            "total" => (int) $resultado['total'],
                            "mensaje" => "Total de registros obtenidos."
                        );
                    } else {
                        return array(
                            "total" => 0,
                            "mensaje" => "No hay registros hasta el momento."
                        );
                    }
                } catch (PDOException $e) {
                    return array(
                        "total" => 0,
                        "mensaje" => "Error en la consulta: " . $e->getMessage()
                    );
                }
            }
            
            require_once "/xampp/htdocs/crud_fetch/Config/conexion.php";
            
            try {
                // Obtener el total de registros de cada tabla
                $totalTrabajadoresResultado = obtenerTotalRegistros(pdo: $pdo, tabla: 'servicio_medico');
                $totalParientesResultado = obtenerTotalRegistros(pdo: $pdo, tabla: 'parientes_tratados');
                $totalCortesiaResultado = obtenerTotalRegistros(pdo: $pdo, tabla: 'pacientes_cortesia');
            
                // Verificar si las consultas fueron exitosas
                if (isset($totalTrabajadoresResultado['total']) && isset($totalParientesResultado['total']) && isset($totalCortesiaResultado['total'])) {
                    $totalPacientes = $totalTrabajadoresResultado['total'] + $totalParientesResultado['total'] + $totalCortesiaResultado['total'];
            
                    // Enviar la respuesta como JSON
                    header(header: 'Content-Type: application/json');
                    echo json_encode(value: [
                        'status' => 'success',
                        'totalPacientes' => $totalPacientes,
                        'totalTrabajadores' => $totalTrabajadoresResultado['total'],
                        'totalParientes' => $totalParientesResultado['total'],
                        'totalCortesia' => $totalCortesiaResultado['total'],
                    ]);
                } else {
                    // Enviar respuesta de error
                    header(header: 'Content-Type: application/json');
                    echo json_encode(value: [
                        'status' => 'error',
                        'mensaje' => 'No hay registros disponibles.',
                    ]);
                }
            } catch (Exception $e) {
                // Enviar respuesta de error general
                header(header: 'Content-Type: application/json');
                echo json_encode(value: ['status' => 'error', 'mensaje' => 'Error general: ' . $e->getMessage()]);
            } finally {
                $pdo = null;
            }
            