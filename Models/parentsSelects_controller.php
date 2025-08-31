<?php

        $data = file_get_contents(filename: "php://input");
        require "/xampp/htdocs/crud_fetch/Config/conexion.php";
        $query = $pdo->prepare(query: "SELECT id, trabajador_id, coordinacionPariente, parentesco, TIMESTAMPDIFF(YEAR,fechaNacimientoPariente,NOW()) AS edad FROM tabla_parentesco WHERE id = :id");
        $query -> bindParam(param: ":id", var: $data);
        $query -> execute();
        $resultado = $query->fetch(mode: PDO::FETCH_ASSOC);
        echo json_encode(value: $resultado);
        $pdo = null;
?>