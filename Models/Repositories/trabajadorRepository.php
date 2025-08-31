<?php

    namespace Models\Repositories;
    use Models\Entities\Trabajador;
    use PDO;
    use PDOException;

        class TrabajadorRepository{
            private $pdo;

            public function __construct(PDO $pdo){
                $this->pdo = $pdo;
            }

            /**
             * Guardar un nuevo Trabajador y su dirección (datos del formulario en $_POST)
             * @param Trabajador $trabajador
             * @return ?Trabajador
             */

            public function guardar(Trabajador $trabajador): ?Trabajador{
                //QUERY TO SAVE THE WORKER
                $sqlTrabajador = "INSERT INTO tabla_titular (nacionalidad,cedula, nombres, apellidos, discapacidad, fecha_nacimiento, estado_civil, telefono_fijo, telefono_movil, estatura, peso, num_hijos, email, tipo_sangre, rif, cargo, estatus, coordinacion) 
                    VALUES (:nacionalidad, :cedula, :nombres, :apellidos, :discapacidad, :fecha_nacimiento, :estado_civil, :telefono_fijo, :telefono_movil, :estatura, :peso, :num_hijos, :email, :tipo_sangre, :rif, :cargo, :estatus, :coordinacion)";
                //QUERY TO SAVE CLOTHES SIZET
                $sqlRopa = "INSERT INTO tabla_vestimenta (cedula, talla_camisa, talla_zapatos, talla_pantalon) 
                    VALUES (:cedula, :talla_camisa, :talla_zapatos, :talla_pantalon)";
                //QUERY TO SAVE THE ADDRESS WORKER
                $sqlDireccion = "INSERT INTO tabla_direccion (cedula, tenencia, tipo_vivienda, estado, ciudad, municipio, parroquia, direccion) 
                    VALUES (:cedula, :tenencia, :tipo_vivienda, :estado, :ciudad, :municipio, :parroquia, :direccion)";

                //QUERY TO SAVE THE PARIENTES WORKER
                $sqlPariente = "INSERT INTO tabla_parentesco(trabajador_id, cedulaPariente, nombrePariente, apellidoPariente, fechaNacimientoPariente, parentesco, generoPariente, coordinacionPariente, discapacidadPariente) 
                    VALUES (:trabajador_id, :cedulaPariente, :nombrePariente, :apellidoPariente, :fechaNacimientoPariente, :parentesco, :generoPariente, :coordinacionPariente,:discapacidadPariente)";

                try{
                    // Iniciar una transacción para asegurar la integridad de los datos
                    $this->pdo->beginTransaction();

                    // Preparar y ejecutar la inserción del trabajador
                    $stmtTrabajador = $this->pdo->prepare($sqlTrabajador);
                    $stmtTrabajador->bindValue(':nacionalidad', $trabajador->getNacionalidad());
                    $stmtTrabajador->bindValue(':cedula', $trabajador->getCedula());
                    $stmtTrabajador->bindValue(':nombres', $trabajador->getNombre());
                    $stmtTrabajador->bindValue(':apellidos', $trabajador->getApellido());
                    $stmtTrabajador->bindValue(':discapacidad', $trabajador->getDiscapacidad());
                    $stmtTrabajador->bindValue(':fecha_nacimiento', $trabajador->getFecha_nacimiento());
                    $stmtTrabajador->bindValue(':estado_civil', $trabajador->getEstado_civil());
                    $stmtTrabajador->bindValue(':telefono_fijo', $trabajador->getTelefono_fijo());
                    $stmtTrabajador->bindValue(':telefono_movil', $trabajador->getTelefono_movil());
                    $stmtTrabajador->bindValue(':estatura', $trabajador->getEstatura());
                    $stmtTrabajador->bindValue(':peso', $trabajador->getPeso());
                    $stmtTrabajador->bindValue(':num_hijos', $trabajador->getNum_hijos());
                    $stmtTrabajador->bindValue(':email', $trabajador->getEmail());
                    $stmtTrabajador->bindValue(':tipo_sangre', $trabajador->getTipo_sangre());
                    $stmtTrabajador->bindValue(':rif', $trabajador->getRif());
                    $stmtTrabajador->bindValue(':cargo', $trabajador->getCargo());
                    $stmtTrabajador->bindValue(':estatus', $trabajador->getEstatus());
                    $stmtTrabajador->bindValue(':coordinacion', $trabajador->getCoordinacion());
                    $stmtTrabajador->execute();

                    // Obtener la cédula del trabajador para la inserción en la tabla de dirección
                    $trabajadorCedula = $trabajador->getCedula();

                    // Preparar y ejecutar la inserción de la dirección utilizando los datos de $_POST
                    $stmtDireccion = $this->pdo->prepare($sqlDireccion);
                    $stmtDireccion->bindValue(':cedula', $trabajadorCedula);
                    $stmtDireccion->bindValue(':tenencia',$trabajador->getTenencia()); // Asegúrate de que estos nombres coincidan con los del formulario
                    $stmtDireccion->bindValue(':tipo_vivienda',$trabajador->getVivienda());
                    $stmtDireccion->bindValue(':estado',$trabajador->getEstado());
                    $stmtDireccion->bindValue(':ciudad',$trabajador->getCiudad());
                    $stmtDireccion->bindValue(':municipio',$trabajador->getMunicipio());
                    $stmtDireccion->bindValue(':parroquia',$trabajador->getParroquia());
                    $stmtDireccion->bindValue(':direccion', $trabajador->getDireccion());
                    $stmtDireccion->execute();

                    // Preparar y ejecutar la inserción de la ropa utilizando los datos de $_POST
                    $stmtRopa = $this->pdo->prepare($sqlRopa);
                    $stmtRopa->bindValue(':cedula', $trabajadorCedula);
                    $stmtRopa->bindValue(':talla_camisa', $trabajador->getTalla_camisa());
                    $stmtRopa->bindValue(':talla_zapatos', $trabajador->getTalla_zapatos());
                    $stmtRopa->bindValue(':talla_pantalon', $trabajador->getTalla_pantalon());
                    $stmtRopa->execute();

                    // --- 3. Insert Parientes Data (Loop through the array) ---
                    // Prepare the pariente statement *once* outside the loop for efficiency
                    $stmtPariente = $this->pdo->prepare($sqlPariente);

                    // Access the parientes array from the Trabajador object
                    // (Assumes you have a public $parientes property or a getParientes() method in Trabajador entity)
                    $parientes = $trabajador->parientes ?? []; // Get the array, default to empty if not set

                    foreach ($parientes as $pariente) {
                        // Vincular valores con los nuevos marcadores de posición
                        $stmtPariente->bindValue(':trabajador_id', $trabajadorCedula);
                        $stmtPariente->bindValue(':cedulaPariente', $pariente['cedulaPariente'] ?? null);
                        $stmtPariente->bindValue(':nombrePariente', $pariente['nombrePariente'] ?? null);
                        $stmtPariente->bindValue(':apellidoPariente', $pariente['apellidoPariente'] ?? null);
                        $stmtPariente->bindValue(':fechaNacimientoPariente', $pariente['fechaNacimientoPariente'] ?? null);
                        $stmtPariente->bindValue(':parentesco', $pariente['parentesco'] ?? null);
                        $stmtPariente->bindValue(':generoPariente', $pariente['generoPariente'] ?? null);
                        $stmtPariente->bindValue(':coordinacionPariente', $pariente['coordinacionPariente'] ?? null); // Usar el nombre correcto del campo
                        $stmtPariente->bindValue(':discapacidadPariente', $pariente['discapacidadPariente'] ?? null);
                        
                        // Ejecutar la inserción
                        $stmtPariente->execute();
                    }

                    // Confirmar la transacción
                    $this->pdo->commit();

                    return $trabajador;

                } catch(PDOException $e){
                    // Revertir la transacción en caso de error
                    $this->pdo->rollBack();
                    echo "Error al guardar Trabajador: " . $e->getMessage();
                    error_log("Error al guardar el trabajador & pariente en la DB". $e->getMessage());
                    return null;
                }
            }

            /**
             * Obtener todos los Trabajadores con su información de dirección
             * @return array<Trabajador>
             */
            public function obtenerTrabajadores(): array{
                $sqlTrabajador = "SELECT tabla_titular.id, tabla_titular.nacionalidad, tabla_titular.cedula, tabla_titular.rif, tabla_titular.nombres, tabla_titular.apellidos, tabla_cargos.nombre_cargos, tabla_coordinaciones.nombre_coordinacion, tabla_titular.telefono_movil, TIMESTAMPDIFF(YEAR,tabla_titular.fecha_nacimiento,NOW()) AS edad FROM (((tabla_titular
                LEFT JOIN tabla_direccion ON tabla_titular.cedula = tabla_direccion.cedula)
                LEFT JOIN tabla_cargos ON tabla_titular.cargo = tabla_cargos.codigo)
                LEFT JOIN tabla_coordinaciones ON tabla_titular.coordinacion = tabla_coordinaciones.codigo_coordinacion)";
            
                try{
                    $stmtTrabajador = $this->pdo->prepare($sqlTrabajador);
                    $stmtTrabajador->execute();
                    $trabajadores = [];

                    while($rowTrabajador = $stmtTrabajador->fetch(PDO::FETCH_ASSOC))
                        $trabajadores[] = new Trabajador(
                            id:$rowTrabajador['id'],
                            nacionalidad:$rowTrabajador['nacionalidad'],
                            cedula:$rowTrabajador['cedula'],
                            nombres:$rowTrabajador['nombres'],
                            apellidos:$rowTrabajador['apellidos'],
                            fecha_nacimiento:$rowTrabajador['edad'],
                            telefono_movil:$rowTrabajador['telefono_movil'],
                            rif:$rowTrabajador['rif'],
                            cargo:$rowTrabajador['nombre_cargos'],
                            coordinacion:$rowTrabajador['nombre_coordinacion'],
                            
                        );

                        
                    return $trabajadores;
                

                }catch(PDOException $e){
                    echo "Error al obtener Trabajadores con su dirección: " . $e->getMessage();
                    return [];
                }
            }


// ... namespace and class declaration above

            public function obtenerTrabajadorPorCedula(int $cedula): ?Trabajador{ // Added FQCN for Trabajador return type
                $sqlTrabajador = "SELECT
                    tabla_titular.id,
                    tabla_titular.nacionalidad, -- Added nacionalidad
                    tabla_titular.cedula,
                    tabla_titular.nombres,
                    tabla_titular.apellidos,
                    tabla_titular.discapacidad,
                    tabla_titular.fecha_nacimiento,
                    tabla_titular.estado_civil,
                    tabla_titular.telefono_fijo,
                    tabla_titular.telefono_movil,
                    tabla_titular.estatura,
                    tabla_titular.peso,
                    tabla_titular.num_hijos,
                    tabla_titular.email,
                    tabla_titular.tipo_sangre,
                    tabla_titular.rif,
                    tabla_titular.cargo, -- Added the actual cargo ID
                    tabla_titular.estatus,
                    tabla_titular.coordinacion, -- Added the actual coordinacion ID
                    tabla_direccion.tenencia,
                    tabla_direccion.tipo_vivienda,
                    tabla_direccion.estado,
                    tabla_direccion.ciudad,
                    tabla_direccion.municipio,
                    tabla_direccion.parroquia,
                    tabla_direccion.direccion,
                    tabla_vestimenta.talla_camisa,
                    tabla_vestimenta.talla_zapatos,
                    tabla_vestimenta.talla_pantalon
                FROM (((tabla_titular
                LEFT JOIN tabla_direccion ON tabla_titular.cedula = tabla_direccion.cedula)  
                LEFT JOIN tabla_coordinaciones ON tabla_titular.coordinacion = tabla_coordinaciones.codigo_coordinacion)
                LEFT JOIN tabla_vestimenta ON tabla_titular.cedula = tabla_vestimenta.cedula)
                WHERE tabla_titular.cedula = :cedula";

                try{
                    $stmtTrabajador = $this->pdo->prepare($sqlTrabajador);
                    $stmtTrabajador->bindValue(':cedula', $cedula, PDO::PARAM_INT); // Assuming cedula is truly an INT
                    $stmtTrabajador->execute();
                    $rowTrabajador = $stmtTrabajador->fetch(PDO::FETCH_ASSOC); // Fetch as associative array for explicit key access

                    if($rowTrabajador){
                        return new Trabajador( // Use FQCN for constructor
                            id: $rowTrabajador['id'],
                            nacionalidad: $rowTrabajador['nacionalidad'] ?? null,
                            cedula: $rowTrabajador['cedula'],
                            nombres: $rowTrabajador['nombres'] ?? null, // Use 'nombres' as fetched
                            apellidos: $rowTrabajador['apellidos'] ?? null, // Use 'apellidos' as fetched
                            fecha_nacimiento: $rowTrabajador['fecha_nacimiento'] ?? null,
                            estado_civil: $rowTrabajador['estado_civil'] ?? null,
                            telefono_fijo: $rowTrabajador['telefono_fijo'] ?? null,
                            telefono_movil: $rowTrabajador['telefono_movil'] ?? null,
                            email: $rowTrabajador['email'] ?? null,
                            estatura: $rowTrabajador['estatura'] ?? null,
                            peso: $rowTrabajador['peso'] ?? null,
                            tipo_sangre: $rowTrabajador['tipo_sangre'] ?? null,
                            discapacidad: $rowTrabajador['discapacidad'] ?? null,
                            talla_camisa: $rowTrabajador['talla_camisa'] ?? null, // Added ?? null for consistency
                            talla_zapatos: $rowTrabajador['talla_zapatos'] ?? null,
                            talla_pantalon: $rowTrabajador['talla_pantalon'] ?? null,
                            vivienda: $rowTrabajador['tipo_vivienda'] ?? null,
                            tenencia: $rowTrabajador['tenencia'] ?? null,
                            estado: $rowTrabajador['estado'] ?? null,
                            ciudad: $rowTrabajador['ciudad'] ?? null,
                            municipio: $rowTrabajador['municipio'] ?? null,
                            parroquia: $rowTrabajador['parroquia'] ?? null,
                            direccion: $rowTrabajador['direccion'] ?? null,
                            rif: $rowTrabajador['rif'] ?? null,
                            cargo: $rowTrabajador['cargo'] ?? null, // Now getting the ID
                            estatus:$rowTrabajador['estatus']?? null,
                            coordinacion: $rowTrabajador['coordinacion'] ?? null, // Now getting the ID
                            num_hijos: $rowTrabajador['num_hijos'] ?? null
                        );
                    }
                    return null; // If no row is found, return null

                }catch(PDOException $e){
                    // Log the error for debugging, but don't expose sensitive info to the user
                    error_log("Error al obtener el Trabajador por cédula: " . $e->getMessage());
                    // Optionally, re-throw or return a specific error object if needed upstream
                    return null;
                }
            }

        public function actualizar(Trabajador $trabajador): bool{ // Added FQCN for Trabajador parameter

            // Removed 'cedula = :cedula' from SET clause as it's the WHERE condition
            $sqlTrabajador = "UPDATE tabla_titular SET
                nacionalidad = :nacionalidad,
                nombres = :nombres,
                apellidos = :apellidos,
                discapacidad = :discapacidad,
                fecha_nacimiento = :fecha_nacimiento,
                estado_civil = :estado_civil,
                telefono_fijo = :telefono_fijo,
                telefono_movil = :telefono_movil,
                estatura = :estatura,
                peso = :peso,
                num_hijos = :num_hijos,
                email = :email,
                tipo_sangre = :tipo_sangre,
                rif = :rif,
                cargo = :cargo,
                estatus = :estatus,
                coordinacion = :coordinacion
            WHERE cedula = :cedula";

            $sqlVestimenta = "UPDATE tabla_vestimenta SET
                talla_camisa = :talla_camisa,
                talla_zapatos = :talla_zapatos,
                talla_pantalon = :talla_pantalon
            WHERE cedula = :cedula";

            $sqlDireccion = "UPDATE tabla_direccion SET
                tenencia = :tenencia,
                tipo_vivienda = :tipo_vivienda,
                estado = :estado,
                ciudad = :ciudad,
                municipio = :municipio,
                parroquia = :parroquia,
                direccion = :direccion
            WHERE cedula = :cedula";

            try{
                //Iniciar una transaccion para asegurar la integridad de los datos
                $this->pdo->beginTransaction();

                $stmtTrabajador = $this->pdo->prepare($sqlTrabajador);
                $stmtTrabajador->bindValue(':nacionalidad', $trabajador->getNacionalidad(), PDO::PARAM_STR);
                $stmtTrabajador->bindValue(':cedula', $trabajador->getCedula(), PDO::PARAM_INT);
                $stmtTrabajador->bindValue(':nombres', $trabajador->getNombre(), PDO::PARAM_STR);
                $stmtTrabajador->bindValue(':apellidos', $trabajador->getApellido(), PDO::PARAM_STR);
                $stmtTrabajador->bindValue(':discapacidad', $trabajador->getDiscapacidad(), PDO::PARAM_STR);
                $stmtTrabajador->bindValue(':fecha_nacimiento', $trabajador->getFecha_nacimiento(), PDO::PARAM_STR);
                $stmtTrabajador->bindValue(':estado_civil', $trabajador->getEstado_civil(), PDO::PARAM_STR);
                $stmtTrabajador->bindValue(':telefono_fijo', $trabajador->getTelefono_fijo(), PDO::PARAM_STR);
                $stmtTrabajador->bindValue(':telefono_movil', $trabajador->getTelefono_movil(), PDO::PARAM_STR);
                $stmtTrabajador->bindValue(':estatura', $trabajador->getEstatura(), PDO::PARAM_INT);
                $stmtTrabajador->bindValue(':peso', $trabajador->getPeso(), PDO::PARAM_INT);
                $stmtTrabajador->bindValue(':num_hijos', $trabajador->getNum_hijos(), PDO::PARAM_INT);
                $stmtTrabajador->bindValue(':email', $trabajador->getEmail(), PDO::PARAM_STR);
                $stmtTrabajador->bindValue(':tipo_sangre', $trabajador->getTipo_sangre(), PDO::PARAM_STR);
                $stmtTrabajador->bindValue(':rif', $trabajador->getRif(), PDO::PARAM_STR);
                $stmtTrabajador->bindValue(':cargo', $trabajador->getCargo(), PDO::PARAM_INT);
                $stmtTrabajador->bindValue(':estatus', $trabajador->getEstatus(), PDO::PARAM_STR);
                $stmtTrabajador->bindValue(':coordinacion', $trabajador->getCoordinacion(), PDO::PARAM_INT);
                // The WHERE clause :cedula is already bound above for the main update
                $stmtTrabajador->execute();

                // Actualizar tabla_direccion
                $stmtDireccion = $this->pdo->prepare($sqlDireccion);
                $stmtDireccion->bindValue(':tenencia', $trabajador->getTenencia(), PDO::PARAM_STR);
                $stmtDireccion->bindValue(':tipo_vivienda', $trabajador->getVivienda(), PDO::PARAM_STR);
                $stmtDireccion->bindValue(':estado', $trabajador->getEstado(), PDO::PARAM_INT);
                $stmtDireccion->bindValue(':ciudad', $trabajador->getCiudad(), PDO::PARAM_INT);
                $stmtDireccion->bindValue(':municipio', $trabajador->getMunicipio(), PDO::PARAM_INT);
                $stmtDireccion->bindValue(':parroquia', $trabajador->getParroquia(), PDO::PARAM_INT);
                $stmtDireccion->bindValue(':direccion', $trabajador->getDireccion(), PDO::PARAM_STR);
                $stmtDireccion->bindValue(':cedula', $trabajador->getCedula(), PDO::PARAM_INT); // Cláusula WHERE
                $stmtDireccion->execute();

                // Actualizar tabla_vestimenta
                $stmtVestimenta = $this->pdo->prepare($sqlVestimenta);
                $stmtVestimenta->bindValue(':talla_camisa', $trabajador->getTalla_camisa(), PDO::PARAM_STR);
                $stmtVestimenta->bindValue(':talla_zapatos', $trabajador->getTalla_zapatos(), PDO::PARAM_INT);
                $stmtVestimenta->bindValue(':talla_antalon', $trabajador->getTalla_pantalon(), PDO::PARAM_STR); // Assuming string, update if int
                $stmtVestimenta->bindValue(':cedula', $trabajador->getCedula(), PDO::PARAM_INT); // Cláusula WHERE
                $stmtVestimenta->execute();

                $this->pdo->commit();
                return true;

            }catch(PDOException $e){
                // Rollback en caso de error para evitar cambios no deseados
                $this->pdo->rollback();
                error_log("Error al actualizar el trabajador: " . $e->getMessage());
                return false;
            }
        }

        public function eliminarTrabajador($cedula){
            $sqlTrabajador = "DELETE FROM tabla_titular WHERE cedula = :cedula";
            $sqlDireccion = "DELETE FROM tabla_direccion WHERE cedula = :cedula";
            $sqlVestimenta = "DELETE FROM tabla_vestimenta WHERE cedula = :cedula";
            try{
                $this->pdo->beginTransaction();
                $stmtTrabajador = $this->pdo->prepare($sqlTrabajador);
                $stmtTrabajador->bindValue(':cedula', $cedula);
                $stmtTrabajador->execute();

                // Eliminar de tabla_direccion
                $stmtDireccion = $this->pdo->prepare($sqlDireccion);
                $stmtDireccion->bindValue(':cedula', $cedula);
                $stmtDireccion->execute();

                //Eliminar de tabla_vestimenta
                $stmtVestimenta = $this->pdo->prepare($sqlVestimenta);
                $stmtVestimenta->bindValue(':cedula', $cedula);
                $stmtVestimenta->execute();

                $this->pdo->commit();
                return true;

            }catch(PDOException $e){
                $this->pdo->rollBack();
                echo "Error al eliminar el Trabajador: " . $e->getMessage();
                return null;
            }
        }

 //----AQUI INICIA TODAS LAS FUNCIONES DE LOS PARIENTES----//
        /**
         * Summary of obtenerParientes
         * @return array<Trabajador> Un array de los datos de los parientes , o un array vacio en caso de no obtener ningun dato 
         */
        public function obtenerParientes(): array{
            $sql = "SELECT tabla_parentesco.id,tabla_parentesco.trabajador_id,tabla_parentesco.cedulaPariente,tabla_parentesco.nombrePariente,tabla_parentesco.apellidoPariente,tabla_parentesco.parentescoPariente,tabla_parentesco.generoPariente,tabla_coordinaciones.nombre_coordinacion,tabla_parentesco.discapacidadPariente,TIMESTAMPDIFF(Year,tabla_parentesco.fechaNacimientoPariente,NOW()) AS edad FROM (tabla_parentesco
            LEFT JOIN tabla_coordinaciones ON tabla_parentesco.coordinacionPariente = tabla_coordinaciones.codigo_coordinacion)";
            try{
                $this->pdo->beginTransaction();
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                $parientes = [];
                while($row = $stmt->fetch()){
                    $parientes [] = new Trabajador(
                        idPariente:$row['id'],
                        trabajador_id:$row['trabajador_id'],
                        cedulaPariente:$row['cedula'],
                        nombrePariente:$row['nombre'],
                        apellidoPariente:$row['apellido'],
                        fechaNacimientoPariente:$row['edad'],
                        parentesco:$row['parentesco'],
                        generoPariente:$row['genero'],
                        coordinacion:$row['nombre_coordinacion'],
                        discapacidadPariente:$row['discapacidad']
                    );
                }
                $this->pdo->commit();
                return $parientes;
            }catch(PDOException $e){
                $this->pdo->rollBack();
                error_log('Error al obtener a los parientes: ' . $e->getMessage());
                return [];
            }
        }
        

        /**
         * Proceso de creacion de un nuevo pariente
         * 
         * @return void//0 no tiene que devolver ningun dato, solo necesitamos una confirmacion de exito o fracaso
         */

        

    //----- REPORTE PARA OBTENER LOS TOTALES POR COORDINACION.----//
        public function obtenerTotales():array{
            // Query 1: Get overall totals
            $sqlTotales = "SELECT
                                (SELECT COUNT(*) FROM tabla_titular) AS totalTrabajadores,
                                (SELECT COUNT(*) FROM tabla_parentesco) AS totalParientes,
                                (SELECT COUNT(coordinacion) FROM tabla_titular) AS totalPorCoordinacion";

            // Query 2: Query to get personal for (coordinacion)
            $sqlPersonalPorCoordinacion = "SELECT
                                        
                                        tc.nombre_coordinacion,
                                        COUNT(tt.cedula) AS personalPorCoordinacion
                                FROM
                                        tabla_titular tt
                                INNER JOIN
                                        tabla_coordinaciones tc ON tt.coordinacion = tc.codigo_coordinacion
                                GROUP BY
                                        tc.nombre_coordinacion";

            try {
                // Execute Query 1
                $stmtTotales = $this->pdo->prepare($sqlTotales);
                $stmtTotales->execute();
                $totales = $stmtTotales->fetch(PDO::FETCH_ASSOC); // Fetch one row for totals

                // Execute Query 2
                $stmtPersonalPorCoordinacion = $this->pdo->prepare($sqlPersonalPorCoordinacion);
                $stmtPersonalPorCoordinacion->execute();
                $personalPorCoordinacion = $stmtPersonalPorCoordinacion->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows for sede breakdown

                // Combine results into a single array for easier return
                return [
                    'totalPersonas' => $totales,
                    'por_coordinacion' => $personalPorCoordinacion
                ];

            } catch (PDOException $e) {
                error_log("Error al obtener los totales: " . $e->getMessage());
                return [];
            }
        }
        

        public function obtenerUltimosTrabajadores(): array { // El método ahora devuelve un array
            $sql = "SELECT cedula, nombres, apellidos, horaRegistro FROM tabla_titular ORDER BY id DESC LIMIT 8";
            try {
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();

                // Devuelve los datos como un array asociativo
                $trabajadores = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $trabajadores; // <-- ¡Aquí está el cambio!

            } catch(PDOException $e) {
                // En caso de error, registra el mensaje y devuelve un array vacío
                error_log('Error al obtener los últimos trabajadores: ' . $e->getMessage());
                return []; // Devuelve un array vacío en caso de error
            }
        }

        public function comparativaIngresos(): array{
            $sql = "SELECT
                        YEAR(horaRegistro) AS ano,                 -- Extracts the year (e.g., 2023, 2024)
                        MONTH(horaRegistro) AS mes,          -- Extracts the month number (e.g., 1 for January, 2 for February)
                        DATE_FORMAT(horaRegistro, '%Y-%m') AS anoFormato, -- Formats as 'YYYY-MM' (e.g., '2023-01') for easy sorting/labeling
                        DATE_FORMAT(horaRegistro, '%M') AS nombreMes,   -- Gets the full month name (e.g., 'January', 'February')
                        COUNT(*) AS total_personas                    -- Counts the number of people for that month/year
                    FROM
                        tabla_titular
                    GROUP BY
                        ano,
                        anoFormato,
                        nombreMes                                    -- Group by year and month to get distinct monthly counts
                    ORDER BY
                        ano ASC,
                        mes ASC                               -- Order chronologically
                        ";
            try{
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();

                //Devuelve los datos en un array asociativo
                $ingresos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $ingresos;
            }catch(PDOException $e){
                error_log("Error al traer los calculos mensuales de ingresos : " . $e->getMessage());
                return [];
            }
        }
        

        
        
        /**
         * Verificacion de existencia de la CI dentro de la base de datos previo a su envio
         * 
         * @param Trabajador es el objeto a ser consultado
         * @return null en caso de que el trabajador no exista y si el trabajador existe retorna sus datos
         */
        public function findByCedula(string $cedula): ?Trabajador {
            $sql = "SELECT * FROM tabla_titular WHERE cedula = :cedula";
            try {
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindValue(':cedula', $cedula);
                $stmt->execute();
                $data = $stmt->fetch();

                if ($data) {
                    // Assuming you have a method to create a Trabajador object from array data
                    // Or you can directly map it if you have a constructor that accepts an array
                    $trabajador = new Trabajador();
                    // Manually map properties for example (better to have a method in entity)
                    $trabajador->id = $data['id'] ?? null; // If you have an ID column
                    $trabajador->cedula = $data['cedula'];
                    // ... map all other properties from $data to $trabajador
                    return $trabajador;
                }
                return null; // No worker found
            } catch (PDOException $e) {
                error_log("Error al buscar trabajador por cédula: " . $e->getMessage());
                return null;
            }
        }


        public function obtenerParienteId(int $id): ?Trabajador {

            $sql ="SELECT * FROM tabla_parentesco WHERE id = :id";
            try{
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $row = $stmt->fetch();
                if($row){
                    return new Trabajador(
                        idPariente:$row['id'],
                        trabajador_id:$row['trabajador_id'],
                        cedulaPariente:$row['cedula'],
                        nombrePariente:$row['nombre'],
                        apellidoPariente:$row['apellido'],
                        fechaNacimientoPariente:$row['fechaNacimiento'],
                        parentesco:$row['parentesco'],
                        generoPariente:$row['genero'],
                        discapacidadPariente:$row['discapacidad']
                        
                    );
                }
                return null;
            }catch(PDOException $e){
                error_log("Error al obtener al Pariente".$e->getMessage());
                return null;
            }
        }
            /**
         *Consulta si el pariente se encuentra dentro de la DB
        *
        *@param Trabajador busca a un pariente dentro de la base de datos
        *@return bool True si la cedula existe
        */

        public function findByCedulaPariente(int $cedulaPariente): ?Trabajador {
                $sql = "SELECT 
                                EXISTS (
                                    SELECT 1 FROM tabla_titular WHERE cedula = :cedula)
                                        OR EXISTS (
                                        SELECT 1 FROM tabla_parentesco WHERE cedula  = :cedula)
                                        AS Existe";

                try {
                    $stmt = $this->pdo->prepare($sql);
                    $stmt->bindValue(':cedula', $cedulaPariente, PDO::PARAM_INT);
                    $stmt->execute();
                    $data = $stmt->fetch();

                    if ($data['Existe']) {
                        // Assuming you have a method to create a Trabajador object from array data
                        // Or you can directly map it if you have a constructor that accepts an array
                        $pariente = new Trabajador();
                        // Manually map properties for example (better to have a method in entity)
                        $pariente->id = $data['id'] ?? null; // If you have an ID column
                        #$pariente->ced_familiar = $data['ced_familiar'];
                        #$pariente->ced_titular = $data['ced_titular'];
                        
                        // ... map all other properties from $data to $trabajador
                        return $pariente;
                    }
                    return null; // No worker found
                } catch (PDOException $e) {
                    error_log("Error al buscar el pariente por cédula: " . $e->getMessage());
                    return null;
                }

            
        }

        public function actualizarPariente(Trabajador $pariente): bool {
            $stmt = $this->pdo->prepare("UPDATE tabla_parentesco SET trabajador_id = :trabajadorId, cedula = :cedulaPariente, nombre = :nombrePariente, apellido = :apellidoPariente, fechaNacimiento = :fechaNacimientoPariente, parentesco = :parentesco, genero = :generoPariente, coordinacion = :coordinacionPariente, discapacidad = :discapacidadPariente WHERE id = :id");
            $stmt->bindValue(':trabajador_id', $pariente->getTrabajador_id());
            $stmt->bindValue(':cedulaPariente', $pariente->getCedulaPariente());
            $stmt->bindValue(':nombrePariente', $pariente->getNombrePariente());
            $stmt->bindValue(':apellidoPariente', $pariente->getApellidoPariente());
            $stmt->bindValue(':fechaNacimientoPariente', $pariente->getFechaNacimientoPariente());
            $stmt->bindValue(':parentesco', $pariente->getParentesco());
            $stmt->bindValue(':generoPariente' , $pariente->getGeneroPariente());
            $stmt->bindValue(':coordinacionPariente', $pariente->getCoordinacionPariente());
            $stmt->bindValue(':discapacidadPariente', $pariente->getDiscapacidadPariente());
            $stmt->bindValue(':id', $pariente->getIdPariente());
            return $stmt->execute();
        }

        
        public function eliminarPariente(int $id): bool {
            $stmt = $this->pdo->prepare("DELETE FROM tabla_parentesco WHERE id = :id");
            $stmt->bindValue(':id', $id, PDO::PARAM_INT );
            return $stmt->execute();
        }

            // --- Dashboard Specific Queries (Integradas desde la conversación anterior) ---

        /**
         * Obtiene el número total de trabajadores registrados.
         * @return int
         */
        public function countTotalTrabajadores(): int
        {
            try {
                $stmt = $this->pdo->query("SELECT COUNT(*) AS total FROM tabla_titular");
                return (int)$stmt->fetchColumn();
            } catch (PDOException $e) {
                error_log("Error al obtener el total de trabajadores: " . $e->getMessage());
                return 0;
            }
        }

        /**
         * Obtiene el número de trabajadores por coordinación.
         * @return array<array<string, string|int>>
         */
        public function getTrabajadoresCountByCoordinacion(): array
        {
            try {
                $stmt = $this->pdo->query("SELECT tc.nombre_coordinacion, COUNT(tt.cedula) AS total 
                                        FROM tabla_titular tt
                                        INNER JOIN tabla_coordinaciones tc ON tt.coordinacion = tc.codigo_coordinacion
                                        GROUP BY tc.nombre_coordinacion
                                        ORDER BY tc.nombre_coordinacion");
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                error_log("Error al obtener trabajadores por coordinación: " . $e->getMessage());
                return [];
            }
        }

        /**
         * Obtiene el número total de parientes registrados.
         * @return int
         */
        public function countTotalParientes(): int
        {
            try {
                $stmt = $this->pdo->query("SELECT COUNT(*) AS total FROM tabla_parentesco");
                return (int)$stmt->fetchColumn();
            } catch (PDOException $e) {
                error_log("Error al obtener el total de parientes: " . $e->getMessage());
                return 0;
            }
        }

        /**
         * Obtiene el número de trabajadores con discapacidad.
         * Assumes 'discapacidad' column in `tabla_titular` is a boolean or 1/0 value.
         * @return int
         */
        public function countTrabajadoresConDiscapacidad(): int
        {
            try {
                // Adjust this query if 'discapacidad' stores text instead of boolean/int
                $stmt = $this->pdo->query("SELECT COUNT(*) AS total FROM tabla_titular WHERE discapacidad = 1");
                return (int)$stmt->fetchColumn();
            } catch (PDOException $e) {
                error_log("Error al obtener trabajadores con discapacidad: " . $e->getMessage());
                return 0;
            }
        }

        /**
         * Obtiene el número de parientes con discapacidad.
         * Assumes 'discapacidad' column in `tabla_parentesco` is a boolean or 1/0 value.
         * @return int
         */
        public function countParientesConDiscapacidad(): int
        {
            try {
                // Adjust this query if 'discapacidad' stores text instead of boolean/int
                $stmt = $this->pdo->query("SELECT COUNT(*) AS total FROM tabla_parentesco WHERE discapacidad = 1");
                return (int)$stmt->fetchColumn();
            } catch (PDOException $e) {
                error_log("Error al obtener parientes con discapacidad: " . $e->getMessage());
                return 0;
            }
        }

        /**
         * Obtiene el número de trabajadores que están en estado de vacaciones.
         * You need a column or logic in your DB to track vacation status.
         * Example assumes a `estado_actual` column.
         * @return int
         */
        public function countTrabajadoresEnVacaciones(): int
        {
            try {
                // IMPORTANT: You need to define how 'vacaciones' status is recorded in your tabla_titular
                // This is a placeholder query. Adjust `estado_actual` and 'vacaciones' to your actual schema.
                $stmt = $this->pdo->query("SELECT COUNT(*) AS total FROM tabla_titular WHERE estado_actual = 'vacaciones'");
                return (int)$stmt->fetchColumn();
            } catch (PDOException $e) {
                error_log("Error al obtener trabajadores en vacaciones: " . $e->getMessage());
                return 0;
            }
        }

        /**
         * Obtiene el número de trabajadores que están cerca de la edad de jubilación.
         * Assumes retirement age is 60 and uses 'fecha_nacimiento' from tabla_titular.
         * @return int
         */
        public function countTrabajadoresParaJubilarse(): int
        {
            try {
                $stmt = $this->pdo->query("SELECT COUNT(*) AS total FROM tabla_titular WHERE TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) >= 60");
                return (int)$stmt->fetchColumn();
            } catch (PDOException $e) {
                error_log("Error al obtener trabajadores para jubilarse: " . $e->getMessage());
                return 0;
            }
        }
    }

?>