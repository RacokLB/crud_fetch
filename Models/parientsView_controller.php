<?php
    $data = file_get_contents(filename:"php://input");
    require "/xampp/htdocs/crud_fetch/Config/conexion.php";

    $query = $pdo->prepare("SELECT tabla_parentesco.id, tabla_titular.cedula, tabla_parentesco.cedulaPariente, tabla_parentesco.nombrePariente, tabla_parentesco.apellidoPariente, tabla_parentesco.parentesco,tabla_parentesco.generoPariente, tabla_parentesco.discapacidadPariente, tabla_coordinaciones.nombre_coordinacion, tabla_parentesco.fechaNacimientoPariente, TIMESTAMPDIFF(YEAR, tabla_parentesco.fechaNacimientoPariente, NOW()) AS edad 
    FROM ((tabla_parentesco 
    LEFT JOIN tabla_coordinaciones ON tabla_parentesco.coordinacionPariente = tabla_coordinaciones.codigo_coordinacion)
    INNER JOIN tabla_titular ON tabla_parentesco.trabajador_id = tabla_titular.cedula)
    ORDER BY tabla_parentesco.id ASC LIMIT 10");
    $query->execute();

    if($data != ""){
        $query = $pdo->prepare("SELECT tabla_parentesco.id, tabla_titular.cedula, tabla_parentesco.nombrePariente, tabla_parentesco.cedulaPariente,  tabla_parentesco.apellidoPariente, tabla_parentesco.parentesco, tabla_parentesco.discapacidadPariente, tabla_parentesco.generoPariente, tabla_coordinaciones.nombre_coordinacion, tabla_parentesco.fechaNacimientoPariente, TIMESTAMPDIFF(YEAR, tabla_parentesco.fechaNacimientoPariente, NOW()) AS edad 
        FROM ((tabla_parentesco 
        LEFT JOIN tabla_coordinaciones ON tabla_parentesco.coordinacionPariente = tabla_coordinaciones.codigo_coordinacion)
        INNER JOIN tabla_titular ON tabla_parentesco.trabajador_id = tabla_titular.cedula)
        WHERE tabla_titular.cedula LIKE '".$data."%' OR tabla_titular.nombres LIKE '".$data."%'
        ORDER BY tabla_parentesco.id ASC");
        $query->execute();
    }

    $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach($resultado as $row){
        echo "<tr>
                <td >".$row['id']."</td>
                <td >".$row['cedula']."</td>
                <td >".$row['cedulaPariente']."</td>
                <td >".$row['nombrePariente']."</td>
                <td >".$row['apellidoPariente']."</td>
                <td >".$row['parentesco']."</td>
                <td >".$row['generoPariente']."</td>
                <td >".$row['discapacidadPariente']."</td>
                <td >".$row['edad']."</td>
                <td >".$row['nombre_coordinacion']."</td>
                <td>
                    <button type='button'class='btn btn-outline-primary focus-ring focus-ring-primary' onclick = Seleccionar('".$row['id']."')>Seleccionar</button>
                </td>
        
        </tr>";
    }
?>