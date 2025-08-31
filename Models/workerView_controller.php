<?php
    $data = file_get_contents(filename: "php://input");
    require "/xampp/htdocs/crud_fetch/Config/conexion.php";

    $consulta = $pdo->prepare("SELECT tabla_titular.id, tabla_titular.cedula, tabla_titular.nombres, tabla_titular.apellidos, tabla_titular.discapacidad, tabla_coordinaciones.nombre_coordinacion, tabla_titular.estatura, tabla_titular.peso, tabla_titular.tipo_sangre, TIMESTAMPDIFF(YEAR, tabla_titular.fecha_nacimiento, NOW()) AS edad 
    FROM (tabla_titular 
    LEFT JOIN tabla_coordinaciones ON tabla_titular.coordinacion = tabla_coordinaciones.codigo_coordinacion)
    ORDER BY id DESC LIMIT 5");
    $consulta->execute();    
    
    //Aqui haremos una consulta comprobando que data no este vacio usando el condicional $data != "";
    if($data != ""){
        $consulta = $pdo->prepare(query: "SELECT tabla_titular.id, tabla_titular.cedula, tabla_titular.nombres, tabla_titular.apellidos, tabla_titular.discapacidad, tabla_coordinaciones.nombre_coordinacion, tabla_titular.estatura, tabla_titular.peso, tabla_titular.tipo_sangre, TIMESTAMPDIFF(YEAR, tabla_titular.fecha_nacimiento, NOW()) AS edad  
        FROM (tabla_titular
        LEFT JOIN tabla_coordinaciones ON tabla_titular.coordinacion = tabla_coordinaciones.codigo_coordinacion) 
        WHERE tabla_titular.cedula LIKE '".$data."%' OR tabla_titular.nombres LIKE '".$data."%' OR tabla_titular.apellidos LIKE '".$data."%' ORDER BY tabla_titular.cedula LIMIT 3");
        $consulta->execute();
    }

    //Usamos fetchAll cuando necesitamos traer muchos registros de la base de datos 
    $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
    foreach($resultado as $data) {
        echo "<tr>
            
            <td >" .$data['cedula']. "</td>
            <td >" .$data['nombres']. "</td>
            <td >" .$data['apellidos']. "</td>
            <td >" .$data['discapacidad']. "</td>
            <td >" .$data['edad']. "</td>
            <td >" .$data['estatura']. "</td>
            <td >" .$data['peso']. "</td>
            <td >" .$data['tipo_sangre']. "</td>
            <td >".$data['nombre_coordinacion']."</td>
            <td >
                <button type='button'class='btn btn-outline-primary focus-ring focus-ring-primary' onclick = Seleccionar('".$data['id']."')>Seleccionar</button>
            </td>    
        </tr>";
    }


?>