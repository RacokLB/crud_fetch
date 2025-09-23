<?php
    // Establece la conexión a la base de datos.
    require "/xampp/htdocs/crud_fetch/Config/conexion.php";

    // Inicializa la consulta SQL. Por defecto, obtendrá los trabajadores de las coordinaciones deseadas.
    $consulta_sql = "SELECT 
                        tabla_titular.id, 
                        tabla_titular.cedula, 
                        tabla_titular.nombres, 
                        tabla_titular.apellidos, 
                        tabla_titular.discapacidad, 
                        tabla_coordinaciones.nombre_coordinacion, 
                        tabla_titular.estatura, 
                        tabla_titular.peso, 
                        tabla_titular.tipo_sangre, 
                        TIMESTAMPDIFF(YEAR, tabla_titular.fecha_nacimiento, NOW()) AS edad 
                    FROM 
                        tabla_titular 
                    LEFT JOIN 
                        tabla_coordinaciones ON tabla_titular.coordinacion = tabla_coordinaciones.codigo_coordinacion
                    WHERE 
                        tabla_titular.coordinacion NOT IN (31, 30, 33, 32, 34, 25)
                    ORDER BY 
                        tabla_titular.cedula 
                    LIMIT 20";

    // Captura el dato enviado por el usuario para la búsqueda.
    $data = file_get_contents("php://input");

    // Si el dato de búsqueda no está vacío, cambia la consulta SQL.
    if (!empty($data)) {
        // En este caso, buscamos por cédula, nombre o apellido.
        // Se utiliza un parámetro de marcador de posición (?) para evitar inyecciones SQL.
        // La sintaxis LIKE '%...%' se construye para buscar coincidencias parciales.
        $consulta_sql = "SELECT 
                            tabla_titular.id, 
                            tabla_titular.cedula, 
                            tabla_titular.nombres, 
                            tabla_titular.apellidos, 
                            tabla_titular.discapacidad, 
                            tabla_coordinaciones.nombre_coordinacion, 
                            tabla_titular.estatura, 
                            tabla_titular.peso, 
                            tabla_titular.tipo_sangre, 
                            TIMESTAMPDIFF(YEAR, tabla_titular.fecha_nacimiento, NOW()) AS edad 
                        FROM 
                            tabla_titular
                        LEFT JOIN 
                            tabla_coordinaciones ON tabla_titular.coordinacion = tabla_coordinaciones.codigo_coordinacion
                        WHERE
                            tabla_titular.coordinacion NOT IN (31, 30, 33, 32, 34, 25) AND
                            tabla_titular.cedula LIKE ? 
                             
                        ORDER BY 
                            tabla_titular.cedula 
                        LIMIT 5";

        // Prepara la consulta con parámetros.
        $consulta = $pdo->prepare($consulta_sql);
        $param = $data . '%';
        $consulta->execute([$param]);
    } else {
        // Si no hay datos de búsqueda, ejecuta la consulta por defecto.
        $consulta = $pdo->prepare($consulta_sql);
        $consulta->execute();
    }

    // Usa fetchAll para obtener todos los registros de la base de datos.
    $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

    // Itera sobre los resultados y genera las filas de la tabla.
    foreach($resultado as $data) {
        echo "<tr>
                <td>" . htmlspecialchars($data['id']) . "</td>
                <td>" . htmlspecialchars($data['cedula']) . "</td>
                <td>" . htmlspecialchars($data['nombres']) . "</td>
                <td>" . htmlspecialchars($data['apellidos']) . "</td>
                <td>" . htmlspecialchars($data['discapacidad']) . "</td>
                <td>" . htmlspecialchars($data['edad']) . "</td>
                <td>" . htmlspecialchars($data['estatura']) . "</td>
                <td>" . htmlspecialchars($data['peso']) . "</td>
                <td>" . htmlspecialchars($data['tipo_sangre']) . "</td>
                <td>" . htmlspecialchars($data['nombre_coordinacion']) . "</td>
                <td>
                    <button type='button' class='btn btn-outline-primary focus-ring focus-ring-primary' onclick=\"Seleccionar('" . htmlspecialchars($data['id']) . "')\">Seleccionar</button>
                </td>    
            </tr>";
    }
?>