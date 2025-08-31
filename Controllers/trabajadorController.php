<?php

namespace  crud_fetch\Controllers;
use Models\Repositories\TrabajadorRepository;
use PDO;
use PDOException;
use DateTime;
 
    class TrabajadorController{
        private $pdo;
        private $trabajadorRepository;

        public function __construct(PDO $pdo){
            $this->pdo = $pdo;
            $this->trabajadorRepository = new TrabajadorRepository(pdo: $this->pdo);
        }


    //-----INICIO DE LAS FUNCIONES PARA LOS PARIENTES
    

        public function listarParientes(){
                $parientes = $this->trabajadorRepository->obtenerParientes();

                if($parientes){
                    header('Content-type: application/json');
                    echo json_encode($parientes);
                }else{
                    http_response_code(404);
                    header('Content-type: application/json');
                    echo json_encode(['error' => 'No se encontraron parientes para el trabajador']);
                }
            }

        
        /**
         * Muestra los detales de un pariente en especifico por su ID
         * @param int $id el ID del pariente que se quiere obtener
         * @return void //
         * 
         */
        public function mostrarPariente(int $idPariente): void{
            $pariente = $this->trabajadorRepository->obtenerParienteId($idPariente);
        

            if($pariente){
                //Ejemplo para retornar como JSON:
                header('Content-Type: application/json');
                echo json_encode($pariente);
            }else{
                //Manejar el caso de que el pariente no se encuentre
                http_response_code(404);
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Pariente no encontrado']);
            }
            
        }
        
    /**
     * Valida si una cédula existe en la base de datos.
     * Retorna JSON con 'success' y 'existe'.
     * @param int $cedula La cédula a verificar.
     */
        public function validarPariente(int $cedulaPariente) {
            
            // Opcional: Limpiar y estandarizar la cédula aquí también,
            // aunque tu router ya debería hacerlo antes de pasártela.
            $cedulaDepurada = preg_replace('/[^0-9VEJ]/i', '', $cedulaPariente);
            

            if (empty($cedulaDepurada)) {
                http_response_code(400); // Bad Request
                echo json_encode(['success' => false, 'message' => 'Cédula no proporcionada o con formato inválido.']);
                return;
            }
            $pariente = $this->trabajadorRepository->findByCedulaPariente($cedulaDepurada);
            if($pariente){
                echo json_encode([
                    'success' => true,
                    'existe' => true,
                    'message' => '¡Cedula ya Registrada'
                ]);
            }else{
                http_response_code(200);
                echo json_encode([
                    'success' => true,
                    'existe' => false,
                    'message' => 'Cedula Disponible'
                ]);
            }
            
        }

         /**
         * 
         * @param int $id El ID del pariente a eliminar
         * @return void // la function en caso de fallar devuelve un codigo directo al navegador 404
         * 
         *  */   

            public function eliminarPariente(int $id){
                if($this->trabajadorRepository->eliminarPariente($id)){
                    http_response_code(204);
                    //No se suele enviar cuerpo en la respuesta 204
                }else{
                    http_response_code(404);
                    header(header: 'Content-Type: application/json');
                    echo json_encode(['error' => 'Pariente no encontrado']);
                }
            }

        /**
         * @param int $id el ID del  pariente a Actualizar
         * @return void // No se necesita que regrese algun value
         * 
         */
        
        public function actualizarPariente(int $idPariente){
                //1. obtener los datos actualizados del pariente desde el formulario de actualizacion
                
                //Leer el cuerpo de la peticion(InputStream) que contiene el JSON
                $jsonDatos = file_get_contents(filename:'php://input');

                // --- DEBUGGING START ---
                // Log the raw JSON data to the PHP error log
                error_log("Raw JSON received for actualizarPariente: " . $jsonDatos);
                
                //Decodificar el JSON a un array asociativo de PHP
                $datosActualizados = json_decode($jsonDatos, true);
                
                // --- DEBUGGING START ---
                // Log the decoded data
                error_log("Decoded data for actualizarPariente: " . print_r($datosActualizados, true));

                //verificar si la decodificacion del JSON fue exitosa
                if(json_last_error() !== JSON_ERROR_NONE){
                    http_response_code(400);
                    header('Content-Type: applicacion/json');
                    echo json_encode(['error' => 'Formato de JSON invalido']);

                }
                
        
                //2. Obtener la lista de parientes del trabajador
                $parienteExistente = $this->trabajadorRepository->obtenerParienteId($idPariente);
        
                if(!$parienteExistente){
                    http_response_code(404);
                    header(header:'Content-Type: application/json');
                    echo json_encode(['error' => 'No se encontraron parientes para este trabajador.']);
                    return;
                }
        
                //4. Actualizar las propiedades del objeto Pariente existente con los nuevos datos
                //NOTA estos campos son los nombres traidos del JSON , no son los datos dentro de la DB 
                $parienteExistente->setTrabajadorId($datosActualizados['trabajadorId'] ?? $parienteExistente->getTrabajadorId());
                $parienteExistente->setCedulaPariente($datosActualizados['cedulaPariente'] ?? $parienteExistente->getCedulaPariente());
                $parienteExistente->setNombrePariente($datosActualizados['nombrePariente'] ?? $parienteExistente->getNombrePariente());
                $parienteExistente->setApellidoPariente($datosActualizados['apellidoPariente'] ?? $parienteExistente->getApellidoPariente());
                $parienteExistente->setFechaNacimientoPariente($datosActualizados['fechaNacimientoPariente'] ??
                    $parienteExistente->getFechaNacimientoPariente());
                $parienteExistente->setParentesco($datosActualizados['parentesco'] ??
                    $parienteExistente->getParentesco());
                $parienteExistente->setGeneroPariente($datosActualizados['generoPariente'] ??
                    $parienteExistente->getGeneroPariente());
                $parienteExistente->setDiscapacidadPariente($datosActualizados['discapacidadPariente'] ??
                    $parienteExistente->getDiscapacidadPariente());
        
                //5. Guardar los cambios utilizando el Repository (asumiendo que tienes un método para actualizar por ID)
                if($this->trabajadorRepository->actualizarPariente($parienteExistente)){
                    header(header:'Content-Type: application/json');
                    echo json_encode(['message' => 'Pariente actualizado con exito']);
                }else{
                    http_response_code(response_code: 500);
                    header(header:'Content-Type: application/json');
                    echo json_encode(['error' => 'No se pudo actualizar el pariente']);
                }
            }



 //------ INICIO DE FUNCIONES PARA EL OBJETO TRABAJADOR-----//

            /**
     * Valida si una cédula existe en la base de datos.
     * Retorna JSON con 'success' y 'existe'.
     * @param int $cedula La cédula a verificar.
     */
        public function validarCedula(int $cedula) {
            
            // Opcional: Limpiar y estandarizar la cédula aquí también,
            // aunque tu router ya debería hacerlo antes de pasártela.
            $cedulaLimpia = preg_replace('/[^0-9VEJ]/i', '', $cedula);
            

            if (empty($cedulaLimpia)) {
                http_response_code(400); // Bad Request
                echo json_encode(['success' => false, 'message' => 'Cédula no proporcionada o con formato inválido.']);
                return;
            }
            $trabajador = $this->trabajadorRepository->findByCedula($cedulaLimpia);
            if($trabajador){
                echo json_encode([
                    'success' => true,
                    'existe' => true,
                    'message' => '¡Cedula ya Registrada'
                ]);
            }else{
                http_response_code(200);
                echo json_encode([
                    'success' => true,
                    'existe' => false,
                    'message' => 'Cedula Disponible'
                ]);
            }
            
        }

        public function listarTrabajadores(){
            $trabajadores = $this->trabajadorRepository->obtenerTrabajadores();
            //Enviar en formato JSON
            header('Content-type: application/json');
            echo json_encode($trabajadores);
        }

        /**
         * @param int $cedula 
         * @return void // Trae de regreso un trabajador en formato JSON 
         * 
         */

        public function mostrarTrabajador(int $id){
            $trabajador = $this->trabajadorRepository->obtenerTrabajadorPorCedula($id);

            if($trabajador){
                //Retorno del trabajador en JSON:
                header('Content-type: application/json');
                echo json_encode($trabajador);
            }else{
                //Manejar el caso en que el trabajador no se encuentra
                http_response_code(404);
                header('Content-type: application/json');
                echo '{"error": "Trabajador no encontrado"}';
            }
        }


        /**
         * Proceso para crear un nuevo trabajador
         *  
         * @return void //No retorna ningun valor
         * 
         */
        public function crearTrabajador(){
        
            //1. Obtener los datos del nuevo trabajador desde el formulario HTML usando el metodo POST
            $datosTrabajador = $_POST;
            $errores = [];

            if (isset($datosTrabajador['nombre'])&& !empty($datosTrabajador['nombre'])) {
            
            }else{
                $errores['nombre'] = 'La cedula es requerida';
            }

            if (isset($datosTrabajador['cedula']) && !empty($datosTrabajador['cedula'])){
                if(mb_strlen($datosTrabajador['cedula'], 'UTF-8') < 7 || mb_strlen($datosTrabajador['cedula'], 'UTF-8') > 8) {
                }
            }else{
                $errores['cedula'] = 'La cédula es requerida';
            }
                
            
            if (isset($datosTrabajador['apellido']) && !empty($datosTrabajador['apellido'])) {
                if(mb_strlen($datosTrabajador['apellido'],'UTF-8') < 3 || mb_strlen($datosTrabajador['apellido'],'UTF-8') > 30){

                }
                
            }else{
                $errores['apellido'] = 'El apellido es requerido';
            }

            if (isset($datosTrabajador['fecha_nacimiento']) && !empty($datosTrabajador['fecha_nacimiento'])) {
            $fechaNacimientoString = $datosTrabajador['fecha_nacimiento'];
            $formatoEsperado = 'Y-m-d'; // Define el formato esperado

            // Intenta crear un objeto DateTime desde la cadena con el formato esperado
            $fechaNacimientoObjeto = DateTime::createFromFormat($formatoEsperado, $fechaNacimientoString);

                // Verifica si la creación del objeto fue exitosa Y si el formato coincide exactamente
                if ($fechaNacimientoObjeto !== false && $fechaNacimientoObjeto->format($formatoEsperado) === $fechaNacimientoString) {
                    // La fecha es válida y tiene el formato esperado
                    // Puedes trabajar con $fechaNacimientoObjeto aquí si lo necesitas como objeto
                    // Por ejemplo, para formatearla de otra manera:
                    // $fechaFormateada = $fechaNacimientoObjeto->format('d/m/Y');
                    // echo "Fecha de nacimiento válida: " . $fechaFormateada;
                } else {
                    // La fecha no coincide con el formato esperado o no es una fecha válida
                    $errores['fecha_nacimiento'] = 'La fecha de nacimiento debe tener el formato YYYY-MM-DD.';
                }

            } else {
                $errores['fecha_nacimiento'] = 'La fecha de nacimiento es requerida.';
            }

            if (isset($datosTrabajador['estado_civil']) && !empty($datosTrabajador['estado_civil'])) {
                if(mb_strlen($datosTrabajador['estado_civil'],'UTF-8') < 3 || mb_strlen($datosTrabajador['estadoCivil'],'UTF-8') > 15){
                }
            }else{
                $errores['estado_civil'] = 'El estado civil es requerido';
            }

            if (isset($datosTrabajador['telefonoFijo'])&& !empty($datosTrabajador['telefonoFijo'])) {
                
            }else{
                $errores['telefonoFijo'] = 'El telefono Fijo es necesario';
            }



            if (isset($datosTrabajador['telefono_movil']) && empty($datosTrabajador['telefono_movil'])) {
                if(mb_strlen($datosTrabajador['telefono_movil'],'UTF-8') < 11 || mb_strlen($datosTrabajador['telefonoMovil'],'UTF-8') > 12){

                }
                
            }else{
                $errores['telefono_movil'] = 'El numero de telefono personal es obligatorio';
            }

            
            if (isset($datosTrabajador['email']) && !empty($datosTrabajador['email'])) {
                $email = $datosTrabajador['email'];
                //Remove all illegal character from Email
                $emailTrabajador = filter_var($email, FILTER_SANITIZE_EMAIL);

                //Validate email
                if(!filter_var($emailTrabajador, FILTER_VALIDATE_EMAIL) === false){

                }else{
                    $errores['email'] = 'El email tiene un formato que no es valido';
                }
            }else{
                $errores['email'] = 'El email es requerido';
            }
            
            if (isset($datosTrabajador['estatura'])&& !empty($datosTrabajador['estatura'])) {
                if(is_numeric($datosTrabajador['estatura'])){

                }else{
                    $errores['estatura'] = 'Debe ingresar un numero valido para la estatura';
                }
            }else{
                $errores['estatura'] = 'Debe ingresar la estatura';
            }

            if (isset($datosTrabajador['peso'])&& !empty($datosTrabajador['peso'])) {
                if(is_numeric($datosTrabajador['peso'])){

                }else{
                    $errores['peso'] = 'Debe ingresar un numero valido para el peso';
                }
            }else{
                $errores['peso'] = 'La dirección general es requerida';
            }

            if (isset($datosTrabajador['tipo_sangre'])&& !empty($datosTrabajador['tipo_sangre'])) {
                
            }else{
                $errores['tipo_sangre'] = 'La dirección específica es requerida';
            }

            if (isset($datosTrabajador['discapacidad'])&& !empty($datosTrabajador['discapacidad'])) {
                if(mb_strlen($datosTrabajador['discapacidad'],'UTF-8') > 5){

                }else{
                    $errores['discapacidad'] = 'La discapacidad debe tener mas de 6 caracteres'; 
                }
            }else{
                $errores['discapacidad'] = 'El campo discapacidad no debe quedar vacio';
            }

            if (isset($datosTrabajador['talla_camisa'])&& !empty($datosTrabajador['talla_camisa'])) {
                
            }else{
                $errores['talla_camisa'] = 'La talla de camisa es necesaria';
            }

            if (isset($datosTrabajador['talla_zapatos'])&& !empty($datosTrabajador['talla_zapatos'])) {
                
            }else{
                $errores['talla_zapatos'] = 'La talla de los zapatos es necesario';
            }

            if(isset($datosTrabajador['talla_pantalon'])&& !empty($datosTrabajador['talla_pantalon'])){

            }else{
                $errores['talla_pantalon'] = 'La talla del pantalon es requerida';
            }

            if(isset($datosTrabajador['vivienda']) && !empty($datosTrabajador['vivienda'])){

            }else{
                $errores['vivienda'] = 'La vivienda es requerida';
            }

            if(isset($datosTrabajador['tenencia']) && !empty($datosTrabajador['tenencia'])){

            }else{
                $errores['tenencia'] = 'La tenencia es requerida';
            }
            
            if(isset($datosTrabajador['tipo_vivienda']) && !empty($datosTrabajador['tipo_vivienda'])){

            }else{
                $errores['tipo_vivienda'] = 'El tipo de vivienda es requerido';
            }

            if (isset($datosTrabajador['estado'])&& !empty($datosTrabajador['estado'])) {
                
            }else{
                $errores['estado'] = 'El estado es requerido';
            }
            if (isset($datosTrabajador['ciudad'])&& !empty($datosTrabajador['ciudad'])) {
                
            }else{
                $errores['ciudad'] = 'La ciudad es requerida';
            }
            if (isset($datosTrabajador['municipio'])&& !empty($datosTrabajador['municipio'])) {
                
            }else{
                $errores['municipio'] = 'El municipio es requerido';
            }
            if (isset($datosTrabajador['parroquia'])&& !empty($datosTrabajador['parroquia'])) {
                
            }else{
                $errores['parroquia'] = 'El estado es requerido';
            }
            if (isset($datosTrabajador['direccion'])&& !empty($datosTrabajador['direccion'])) {
                
            }else{
                $errores['direccion'] = 'La dirección es requerida';
            }

            if (isset($datosTrabajador['rif']) && !empty($datosTrabajador['rif'])) {
                if(mb_strlen($datosTrabajador['rif'], 'UTF-8') < 8 || mb_strlen($datosTrabajador['rif'],'UTF-8') > 9 ){
                }
            }else{
                $errores['rif'] = 'El RIF es requerido';
            }
            
            if(isset($datosTrabajador['cargo']) && !empty($datosTrabajador['cargo'])){

            }else{
                $errores['cargo'] = 'El cargo es necesario';
            }

            if(isset($datosTrabajador['coordinacion']) && !empty($datosTrabajador['coordinacion'])){

            }else{
                $errores['coordinacion'] = 'La coordinacion es requerida';
            }

            if(isset($datosTrabajador['numeroHijos']) && !empty($datosTrabajador['numeroHijos'])){

            }else{
                $errores['numero_hijos'] = 'El numero de hijos es necesario';
            }
            

            //Verficar si existen errores, en caso de que existan devuelve el codigo 400 con los errores en formato JSON
            if (!empty($errores)) {
                http_response_code(400);
                header('Content-Type: application/json');
                echo json_encode(['errors' => $errores]);
                return;
            }

            //2. Crear una instancia del objeto Trabajador
            $nuevoTrabajador = new \Models\Entities\Trabajador(
                id:null,
                nombre: $datosTrabajador['nombres']?? null,
                cedula: $datosTrabajador['cedula']?? null,
                apellido: $datosTrabajador['apellidos']?? null,
                fechaNacimiento: $datosTrabajador['fecha_nacimiento']?? null,
                estadoCivil: $datosTrabajador['estado_civil']?? null,
                telefonoFijo: $datosTrabajador['telefono_fijo']?? null,
                telefonoMovil: $datosTrabajador['telefono_movil']?? null,
                email: $datosTrabajador['email']?? null,
                estatura: $datosTrabajador['estatura']?? null,
                peso: $datosTrabajador['peso']?? null,
                tipoSangre: $datosTrabajador['tipo_sangre']?? null,
                discapacidad: $datosTrabajador['discapacidad']?? null,
                tallaCamisa: $datosTrabajador['talla_camisa']?? null,
                tallaZapatos: $datosTrabajador['talla_zapatos']?? null,
                tallaPantalon: $datosTrabajador['talla_pantalon']?? null,
                vivienda: $datosTrabajador['vivienda']?? null,
                tenencia: $datosTrabajador['tenencia']?? null,
                estado: $datosTrabajador['estado']?? null,
                ciudad:$datosTrabajador['ciudad'] ?? null,
                municipio:$datosTrabajador['municipio'] ?? null,
                parroquia:$datosTrabajador['parroquia'] ?? null,
                direccion: $datosTrabajador['direccion']?? null,
                rif: $datosTrabajador['rif']?? null,
                cargo: $datosTrabajador['cargo']?? null,
                coordinacion: $datosTrabajador['coordinacion']?? null,
                numeroHijos: $datosTrabajador['numero_hijos'] ?? null
            );
            //3. Guardar al nuevo trabajador dentro de la DB
            $trabajadorGuardado = $this->trabajadorRepository->guardar($nuevoTrabajador);

            //4. Retornar respuesta (JSON del trabajador guardado)
            if($trabajadorGuardado){
            http_response_code(201);//Codigo 201: Created
            header('Content-Type: application/json');
            echo json_encode($trabajadorGuardado);
            } else {
                http_response_code(500);//Codigo 500: Internal Server Error
                header('Content-Type: application/json');
                echo json_encode(['error' => 'No se pudo crear el trabajador']);
            }
        }

        public function actualizarTrabajador($cedula){
            //1.Obtener los datos modificados del trabajador desde la peticion(PUT data ,ETC)
            //Es similar a crear el trabajador pero se usa La cedula
            $datosTrabajador = $_POST;
            $errores = [];

            //2.Obtener al trabajador existente para verificar que si existe dentro de la DB
            $trabajadorExistente = $this->trabajadorRepository->obtenerTrabajadorPorCedula($cedula);

            if(!$trabajadorExistente){
                http_response_code(404);
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Trabajador no encontrado']);
                return;
            }

            //3.Actualizar las propiedades del objeto Trabajador existente con los nuevos datos
            $trabajadorExistente->setNombre($datosTrabajador['nombres']?? $trabajadorExistente->getNombre());
            $trabajadorExistente->setCedula($datosTrabajador['cedula']?? $trabajadorExistente->getCedula());
            $trabajadorExistente->setApellido($datosTrabajador['apellidos']?? $trabajadorExistente->getApellido());
            $trabajadorExistente->setFechaNacimiento($datosTrabajador['fecha_nacimiento']?? $trabajadorExistente->getFechaNacimiento());
            $trabajadorExistente->setEstadoCivil($datosTrabajador['estado_civil']?? $trabajadorExistente->getEstadoCivil());
            $trabajadorExistente->setTelefonoFijo($datosTrabajador['telefono_hijo']?? $trabajadorExistente->getTelefonoFijo());
            $trabajadorExistente->setTelefonoMovil($datosTrabajador['telefono_movil']?? $trabajadorExistente->getTelefonoMovil());
            $trabajadorExistente->setEmail($datosTrabajador['email']?? $trabajadorExistente->getEmail());
            $trabajadorExistente->setEstatura($datosTrabajador['estatura']?? $trabajadorExistente->getEstatura());
            $trabajadorExistente->setPeso($datosTrabajador['peso']?? $trabajadorExistente->getPeso());
            $trabajadorExistente->setTipoSangre($datosTrabajador['tipo_sangre']?? $trabajadorExistente->getTipoSangre());
            $trabajadorExistente->setDiscapacidad($datosTrabajador['discapacidad']?? $trabajadorExistente->getDiscapacidad());
            $trabajadorExistente->setTallaCamisa($datosTrabajador['talla_camisa']?? $trabajadorExistente->getTallaCamisa());
            $trabajadorExistente->setTallaZapatos($datosTrabajador['talla_zapatos']?? $trabajadorExistente->getTallaZapatos());
            $trabajadorExistente->setTallaPantalon($datosTrabajador['talla_pantalon']?? $trabajadorExistente->getTallaPantalon());
            $trabajadorExistente->setVivienda($datosTrabajador['vivienda']?? $trabajadorExistente->getVivienda());
            $trabajadorExistente->setTenencia($datosTrabajador['tenencia']?? $trabajadorExistente->getTenencia());
            $trabajadorExistente->setEstado($datosTrabajador['estado']?? $trabajadorExistente->getEstado());
            $trabajadorExistente->setCiudad($datosTrabajador['ciudad']?? $trabajadorExistente->getCiudad());
            $trabajadorExistente->setMunicipio($datosTrabajador['municipio']?? $trabajadorExistente->getMunicipio());
            $trabajadorExistente->setParroquia($datosTrabajador['parroquia']?? $trabajadorExistente->getParroquia());
            $trabajadorExistente->setDireccion($datosTrabajador['direccion']?? $trabajadorExistente->getDireccion());
            $trabajadorExistente->setRif($datosTrabajador['rif']?? $trabajadorExistente->getRif());
            $trabajadorExistente->setCargo($datosTrabajador['cargo']?? $trabajadorExistente->getCargo());
            $trabajadorExistente->setCoordinacion($datosTrabajador['coordinacion']?? $trabajadorExistente->getCoordinacion());
            $trabajadorExistente->setNumeroHijos($datosTrabajador['numero_hijos']?? $trabajadorExistente->getNumeroHijos());

            
            //4.Guardar los cambios utilizando el repository
            if($this->trabajadorRepository->actualizar($trabajadorExistente)){
                http_response_code(200);
                header('Content-Type: application/json');
                echo json_encode($trabajadorExistente);
            }else{
                http_response_code(500);
                header('Content Type: application/json');
                echo json_encode(['error' => 'No se pudo actualizar el trabajador']);
            }
        }

            /**
         * Elimina un trabajador por su ID.
         *
         * @param int $id El ID del trabajador a eliminar.
         * @return void // la function en caso de fallar devuelve un codigo directo al navegador 404 y lo mismo sucede si la function se ejecuta codigo 204
         */
        public function eliminarTrabajador(int $cedula) {
            if ($this->trabajadorRepository->eliminarTrabajador($cedula)) {
                http_response_code(204); // Código de "Sin contenido" (eliminación exitosa)
                // No se suele enviar cuerpo en la respuesta 204
            } else {
                http_response_code(404);
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Trabajador no encontrado']);
            }
        }

        //#----FUNCIONES PARA LOS DISTINTOS REPORTES---//
        public function redirigir(){
            sleep(2);
            header(header: "location index.php");
        }

        public function estadisticasTotales (){
            $registros = $this->trabajadorRepository->obtenerTotales();
            if(!empty($registros)|| $registros === []){
                    //Envio en formato JSON 
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'data' => $registros]);
            }else{
                header('Content-Type: application/json');
                http_response_code(response_code:500);
                echo json_encode(['success' => false, 'message' => 'Error al obtener los calculos.']);
            }
        }

        public function comparativaIngresos(){
            $queryIngresos = $this->trabajadorRepository->comparativaIngresos();
            if(!empty($queryIngresos)||$queryIngresos === []){
                //Envio en formato JSON 
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'data' => $queryIngresos]);

            }else{
                header('Content-Type: application/json');
                http_response_code(response_code:500);
                echo json_encode(['success' => false, 'message' => 'Error al obtener los datos para el grafico']);
            }
        }

    /**
     * Summary of obtenerTrabajadoresRecientes
     * @return void
     */
        public function obtenerTrabajadoresRecientes(): void{
            $trabajadores = $this->trabajadorRepository->obtenerUltimosTrabajadores();
           if (!empty($trabajadores) || $trabajadores === []) { // Check if it returned an empty array or actual data
                    header('Content-Type: application/json');
                    echo json_encode(['success' => true, 'data' => $trabajadores]);
                } else {
                    header('Content-Type: application/json');
                    http_response_code(500); // Internal Server Error
                    echo json_encode(['success' => false, 'message' => 'Error al obtener los trabajadores.']);
                }
        }
        
        // --- New Dashboard Methods ---

        public function getTotalTrabajadores() {
            try {
                $stmt = $this->pdo->query("SELECT COUNT(*) AS total FROM trabajadores");
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                echo json_encode(['success' => true, 'data' => ['total' => $result['total']]]);
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Error al obtener el total de trabajadores: ' . $e->getMessage()]);
            }
        }

        public function getTrabajadoresPorCoordinacion() {
            try {
                $stmt = $this->pdo->query("SELECT coordinacion, COUNT(*) AS total FROM trabajadores GROUP BY coordinacion ORDER BY coordinacion");
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode(['success' => true, 'data' => $data]);
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Error al obtener trabajadores por coordinación: ' . $e->getMessage()]);
            }
        }

        public function getTrabajadoresEnVacaciones() {
            try {
                // Adjust this query based on how you track vacations in your DB
                $stmt = $this->pdo->query("SELECT COUNT(*) AS total FROM trabajadores WHERE estado_actual = 'vacaciones'"); // Example: 'estado_actual' field
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                echo json_encode(['success' => true, 'data' => ['total' => $result['total']]]);
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Error al obtener trabajadores en vacaciones: ' . $e->getMessage()]);
            }
        }

        public function getTrabajadoresParaJubilarse() {
            try {
                // Example: Workers 60 years or older. Adjust `fecha_nacimiento` to your column name.
                $stmt = $this->pdo->query("SELECT COUNT(*) AS total FROM trabajadores WHERE TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) >= 60");
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                echo json_encode(['success' => true, 'data' => ['total' => $result['total']]]);
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Error al obtener trabajadores para jubilarse: ' . $e->getMessage()]);
            }
        }

        public function getTrabajadoresConDiscapacidad() {
            try {
                // Assuming 'tiene_discapacidad' is a boolean (or 1/0) field
                $stmt = $this->pdo->query("SELECT COUNT(*) AS total FROM tabla_titular WHERE discapacidad = 1"); 
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                echo json_encode(['success' => true, 'data' => ['total' => $result['total']]]);
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Error al obtener trabajadores con discapacidad: ' . $e->getMessage()]);
            }
        }

    // Make sure all your API methods consistently exit after echoing JSON
    // to prevent accidental output from views if a view load happens after an API call.
    // Or, better yet, structure your main index.php to ONLY call cargarAPI() if 'api' is set,
    // and ONLY call cargarVistas() if 'cargar' is set, preventing conflicts.

    }

?>