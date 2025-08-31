<?php

    $data = file_get_contents(filename: "php://input");
    require "/xampp/htdocs/crud_fetch/Config/conexion.php";
    $query = $pdo->prepare(query: "SELECT id, cedula, coordinacion, fecha_nacimiento, TIMESTAMPDIFF(YEAR,fecha_nacimiento,NOW()) AS edad FROM tabla_titular WHERE id = :id");
    $query -> bindParam(param: ":id", var: $data);
    $query -> execute();
    $resultado = $query->fetch(mode: PDO::FETCH_ASSOC);
    echo json_encode(value: $resultado);
    $pdo = null;
?>