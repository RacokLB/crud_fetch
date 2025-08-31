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
                $sqlTrabajador = "INSERT INTO tabla_titular (nacionalidad,cedula, nombres, apellidos, discapacidad, fecha_nacimiento, estado_civil, telefono_fijo, telefono_movil, estatura, peso, num_hijos, email, tipo_sangre, rif, cargo, coordinacion) VALUES (:nacionalidad, :cedula, :nombre, :apellido, :discapacidad, :fecha_nacimiento, :estado_civil, :telefono_fijo, :telefono_movil, :estatura, :peso, :num_hijos, :email, :tipo_sangre, :rif, :cargo, :coordinacion)";
                $sqlRopa = "INSERT INTO tabla_vestimenta (cedula, talla_camisa, talla_zapatos, talla_pantalon) VALUES (:cedula, :talla_camisa, :talla_zapatos, :talla_pantalon)";
                $sqlDireccion = "INSERT INTO tabla_direccion (cedula, tenencia, tipo_vivienda, estado, ciudad, municipio, parroquia, direccion) VALUES (:cedula, :tenencia, :tipo_vivienda, :estado, :ciudad, :municipio, :parroquia, :direccion)";

                try{
                    // Iniciar una transacción para asegurar la integridad de los datos
                    $this->pdo->beginTransaction();

                    // Preparar y ejecutar la inserción del trabajador
                    $stmtTrabajador = $this->pdo->prepare($sqlTrabajador);
                    $stmtTrabajador->bindValue(':cedula', $trabajador->getCedula());
                    $stmtTrabajador->bindValue(':nombre', $trabajador->getNombre());
                    $stmtTrabajador->bindValue(':apellido', $trabajador->getApellido());
                    $stmtTrabajador->bindValue(':discapacidad', $trabajador->getDiscapacidad());
                    $stmtTrabajador->bindValue(':fecha_nacimiento', $trabajador->getFechaNacimiento());
                    $stmtTrabajador->bindValue(':estado_civil', $trabajador->getEstadoCivil());
                    $stmtTrabajador->bindValue(':telefono_fijo', $trabajador->getTelefonoFijo());
                    $stmtTrabajador->bindValue(':telefono_movil', $trabajador->getTelefonoMovil());
                    $stmtTrabajador->bindValue(':estatura', $trabajador->getEstatura());
                    $stmtTrabajador->bindValue(':peso', $trabajador->getPeso());
                    $stmtTrabajador->bindValue(':num_hijos', $trabajador->getNumeroHijos());
                    $stmtTrabajador->bindValue(':email', $trabajador->getEmail());
                    $stmtTrabajador->bindValue(':tipo_sangre', $trabajador->getTipoSangre());
                    $stmtTrabajador->bindValue(':rif', $trabajador->getRif());
                    $stmtTrabajador->bindValue(':cargo', $trabajador->getCargo());
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
                    $stmtRopa->bindValue(':talla_camisa', $trabajador->getTallaCamisa());
                    $stmtRopa->bindValue(':talla_zapatos', $trabajador->getTallaZapatos());
                    $stmtRopa->bindValue(':talla_pantalon', $trabajador->getTallaPantalon());
                    $stmtRopa->execute();

                    // Confirmar la transacción
                    $this->pdo->commit();

                    return $trabajador;

                } catch(PDOException $e){
                    // Revertir la transacción en caso de error
                    $this->pdo->rollBack();
                    echo "Error al guardar Trabajador y/o su dirección: " . $e->getMessage();
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
                            nombre:$rowTrabajador['nombres'],
                            apellido:$rowTrabajador['apellidos'],
                            fechaNacimiento:$rowTrabajador['edad'],
                            telefonoMovil:$rowTrabajador['telefono_movil'],
                            estado:$rowTrabajador['estado'] ?? null,
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
                    tabla_cargos.nombre_cargos,
                    tabla_titular.coordinacion, -- Added the actual coordinacion ID
                    tabla_coordinaciones.nombre_coordinacion,
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
                FROM ((((tabla_titular
                LEFT JOIN tabla_direccion ON tabla_titular.cedula = tabla_direccion.cedula)
                LEFT JOIN tabla_cargos ON tabla_titular.cargo = tabla_cargos.codigo)
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
                            nombre: $rowTrabajador['nombres'] ?? null, // Use 'nombres' as fetched
                            apellido: $rowTrabajador['apellidos'] ?? null, // Use 'apellidos' as fetched
                            fechaNacimiento: $rowTrabajador['fecha_nacimiento'] ?? null,
                            estadoCivil: $rowTrabajador['estado_civil'] ?? null,
                            telefonoFijo: $rowTrabajador['telefono_fijo'] ?? null,
                            telefonoMovil: $rowTrabajador['telefono_movil'] ?? null,
                            email: $rowTrabajador['email'] ?? null,
                            estatura: $rowTrabajador['estatura'] ?? null,
                            peso: $rowTrabajador['peso'] ?? null,
                            tipoSangre: $rowTrabajador['tipo_sangre'] ?? null,
                            discapacidad: $rowTrabajador['discapacidad'] ?? null,
                            tallaCamisa: $rowTrabajador['talla_camisa'] ?? null, // Added ?? null for consistency
                            tallaZapatos: $rowTrabajador['talla_zapatos'] ?? null,
                            tallaPantalon: $rowTrabajador['talla_pantalon'] ?? null,
                            vivienda: $rowTrabajador['tipo_vivienda'] ?? null,
                            tenencia: $rowTrabajador['tenencia'] ?? null,
                            estado: $rowTrabajador['estado'] ?? null,
                            ciudad: $rowTrabajador['ciudad'] ?? null,
                            municipio: $rowTrabajador['municipio'] ?? null,
                            parroquia: $rowTrabajador['parroquia'] ?? null,
                            direccion: $rowTrabajador['direccion'] ?? null,
                            rif: $rowTrabajador['rif'] ?? null,
                            cargo: $rowTrabajador['cargo'] ?? null, // Now getting the ID
                            coordinacion: $rowTrabajador['coordinacion'] ?? null, // Now getting the ID
                            numeroHijos: $rowTrabajador['num_hijos'] ?? null
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
                nombres = :nombre,
                apellidos = :apellido,
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
                $stmtTrabajador->bindValue(':nombre', $trabajador->getNombre(), PDO::PARAM_STR);
                $stmtTrabajador->bindValue(':apellido', $trabajador->getApellido(), PDO::PARAM_STR);
                $stmtTrabajador->bindValue(':discapacidad', $trabajador->getDiscapacidad(), PDO::PARAM_STR);
                $stmtTrabajador->bindValue(':fecha_nacimiento', $trabajador->getFechaNacimiento(), PDO::PARAM_STR);
                $stmtTrabajador->bindValue(':estado_civil', $trabajador->getEstadoCivil(), PDO::PARAM_STR);
                $stmtTrabajador->bindValue(':telefono_fijo', $trabajador->getTelefonoFijo(), PDO::PARAM_STR);
                $stmtTrabajador->bindValue(':telefono_movil', $trabajador->getTelefonoMovil(), PDO::PARAM_STR);
                $stmtTrabajador->bindValue(':estatura', $trabajador->getEstatura(), PDO::PARAM_INT);
                $stmtTrabajador->bindValue(':peso', $trabajador->getPeso(), PDO::PARAM_INT);
                $stmtTrabajador->bindValue(':num_hijos', $trabajador->getNumeroHijos(), PDO::PARAM_INT);
                $stmtTrabajador->bindValue(':email', $trabajador->getEmail(), PDO::PARAM_STR);
                $stmtTrabajador->bindValue(':tipo_sangre', $trabajador->getTipoSangre(), PDO::PARAM_STR);
                $stmtTrabajador->bindValue(':rif', $trabajador->getRif(), PDO::PARAM_STR);
                $stmtTrabajador->bindValue(':cargo', $trabajador->getCargo(), PDO::PARAM_INT);
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
                $stmtVestimenta->bindValue(':talla_camisa', $trabajador->getTallaCamisa(), PDO::PARAM_STR);
                $stmtVestimenta->bindValue(':talla_zapatos', $trabajador->getTallaZapatos(), PDO::PARAM_INT);
                $stmtVestimenta->bindValue(':talla_pantalon', $trabajador->getTallaPantalon(), PDO::PARAM_STR); // Assuming string, update if int
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
            $sql = "SELECT tabla_parentesco.id,tabla_parentesco.trabajador_id,tabla_parentesco.cedula,tabla_parentesco.nombre,tabla_parentesco.apellido,tabla_parentesco.parentesco,tabla_parentesco.genero,tabla_coordinaciones.nombre_coordinacion,tabla_parentesco.discapacidad,TIMESTAMPDIFF(Year,tabla_parentesco.fechaNacimiento,NOW()) AS edad FROM (tabla_parentesco
            LEFT JOIN tabla_coordinaciones ON tabla_parentesco.coordinacion = tabla_coordinaciones.codigo_coordinacion)";
            try{
                $this->pdo->beginTransaction();
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                $parientes = [];
                while($row = $stmt->fetch()){
                    $parientes [] = new Trabajador(
                        idPariente:$row['id'],
                        trabajadorId:$row['trabajador_id'],
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
                        trabajadorId:$row['trabajador_id'],
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
            $stmt = $this->pdo->prepare("UPDATE tabla_parentesco SET trabajador_id = :trabajadorId, cedula = :cedulaPariente, nombre = :nombrePariente, apellido = :apellidoPariente, fechaNacimiento = :fechaNacimientoPariente, parentesco = :parentesco, genero = :generoPariente, discapacidad = :discapacidadPariente WHERE id = :id");
            $stmt->bindValue(':trabajadorId', $pariente->getTrabajadorId());
            $stmt->bindValue(':cedulaPariente', $pariente->getCedulaPariente());
            $stmt->bindValue(':nombrePariente', $pariente->getNombrePariente());
            $stmt->bindValue(':apellidoPariente', $pariente->getApellidoPariente());
            $stmt->bindValue(':fechaNacimientoPariente', $pariente->getFechaNacimientoPariente());
            $stmt->bindValue(':parentesco', $pariente->getParentesco());
            $stmt->bindValue(':generoPariente' , $pariente->getGeneroPariente());
            $stmt->bindValue(':discapacidadPariente', $pariente->getDiscapacidadPariente());
            $stmt->bindValue(':id', $pariente->getIdPariente());
            return $stmt->execute();
        }

        
        public function eliminarPariente(int $id): bool {
            $stmt = $this->pdo->prepare("DELETE FROM tabla_parentesco WHERE id = :id");
            $stmt->bindValue(':id', $id, PDO::PARAM_INT );
            return $stmt->execute();
        }
    }

?>