<?php

    require "../Config/conexion.php";

    function totalVistasDoctores(PDO $pdo, string $tabla): array {

        $sql = "SELECT especialistas.doctores, COUNT(*) AS total FROM $tabla 
        LEFT JOIN especialistas ON $tabla.especialista = especialistas.id
        GROUP BY especialistas.doctores ORDER BY total DESC";

        try {
            $stmt = $pdo->prepare(query: $sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            return array();
        }
        
    }

    try{
        
        $totalEspecialistasTrabajadores = totalVistasDoctores(pdo: $pdo, tabla: 'servicio_medico');
        $totalEspecialistasParientes = totalVistasDoctores(pdo: $pdo, tabla: 'parientes_tratados');
        $totalEspecialistasCortesia = totalVistasDoctores(pdo: $pdo, tabla: 'pacientes_cortesia');

        $totalGlobalEspecialista = [];

        foreach ($totalEspecialistasTrabajadores as $item) {
            $especialista = $item['doctores'];
            $total = (int) $item['total'];
            $totalGlobalEspecialista[$especialista] = ($totalGlobalEspecialista[$especialista] ?? 0) + $total;
        }

        foreach ($totalEspecialistasParientes as $item) {
            $especialista = $item['doctores'];
            $total = (int) $item['total'];
            $totalGlobalEspecialista[$especialista]= ($totalGlobalEspecialista[$especialista] ?? 0) + $total;
        }
        foreach ($totalEspecialistasCortesia as $item) {
            $especialista = $item['doctores'];
            $total = (int) $item['total'];
            $totalGlobalEspecialista[$especialista] = ($totalGlobalEspecialista[$especialista]) ?? 0 + $total;
        }
        $resultadoDoctor = [];
        foreach ($totalGlobalEspecialista as $especialista => $total) {
            $resultadoDoctor[] = ['doctores' => $especialista, 'total' => $total];
        }
        usort($resultadoDoctor, function ($a, $b) {
            return $b['total'] - $a['total'];
        });

        header(header: 'Content-Type: application/json');
        echo json_encode(value: $resultadoDoctor);

    }catch (Exception $e) {
        header(header: 'Content-Type: application/json');
        echo json_encode(value: ['status' => 'error', 'mensaje' => 'Error general: ' . $e->getMessage()]);
    }finally{
        $pdo = null;
    }
?>