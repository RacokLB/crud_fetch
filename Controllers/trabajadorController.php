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
                $parienteExistente->setTrabajador_id($datosActualizados['trabajador_id'] ?? $parienteExistente->getTrabajador_id());
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
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $datosTrabajador = $_POST;
                $errores = [];

                if(isset($datosTrabajador['nacionalidad']) && !empty($datosTrabajador['nacionalidad'])){
        
                }else{
                    $errores['nacionalidad'] = 'La nacionalidad es';
                }
                if (isset($datosTrabajador['cedula']) && !empty($datosTrabajador['cedula'])){
                    if(mb_strlen($datosTrabajador['cedula'], 'UTF-8') < 7 || mb_strlen($datosTrabajador['cedula'], 'UTF-8') > 8) {
                    }
                }else{
                    $errores['cedula'] = 'La cédula es requerida';
                }
                if (isset($datosTrabajador['nombres'])&& !empty($datosTrabajador['nombres'])) {
                    
                }else{
                    $errores['nombres'] = 'El nombre es necesario';
                }

                    
                
                if (isset($datosTrabajador['apellidos']) && !empty($datosTrabajador['apellidos'])) {
                    
                }else{
                    $errores['apellidos'] = 'El apellido es requerido';
                }

                if (isset($datosTrabajador['discapacidad'])&& !empty($datosTrabajador['discapacidad'])) {
                    
                }else{
                    $errores['discapacidad'] = 'El campo discapacidad no debe quedar vacio';
                }
                
                if (isset($datosTrabajador['fecha_nacimiento']) && !empty($datosTrabajador['fecha_nacimiento'])) {
                    

                } else {
                    $errores['fecha_nacimiento'] = 'La fecha de nacimiento es requerida.';
                }

                if (isset($datosTrabajador['estado_civil']) && !empty($datosTrabajador['estado_civil'])) {
                    
                }else{
                    $errores['estado_civil'] = 'El estado civil es requerido';
                }

                if (isset($datosTrabajador['telefono_fijo'])&& !empty($datosTrabajador['telefono_fijo'])) {
                    
                }else{
                    $errores['telefono_fijo'] = 'El telefono Fijo es necesario';
                }

                if (isset($datosTrabajador['telefono_movil']) && !empty($datosTrabajador['telefono_movil'])) {
                    
                }else{
                    $errores['telefono_movil'] = 'El numero de telefono personal es obligatorio';
                }
                if (isset($datosTrabajador['estatura'])&& !empty($datosTrabajador['estatura'])) {
                    
                }else{
                    $errores['estatura'] = 'Debe ingresar la estatura';
                }

                if (isset($datosTrabajador['peso'])&& !empty($datosTrabajador['peso'])) {
                    
                }else{
                    $errores['peso'] = 'Debe indicar el peso del trabajador';
                }
                
                if(isset($datosTrabajador['num_hijos']) && !empty($datosTrabajador['num_hijos'])){

                }else{
                    $errores['num_hijos'] = 'El numero de hijos es necesario';
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
                

                if (isset($datosTrabajador['tipo_sangre'])&& !empty($datosTrabajador['tipo_sangre'])) {
                    
                }else{
                    $errores['tipo_sangre'] = 'El tipo de sangre debe ser indicado';
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
                if(isset($datosTrabajador['estatus']) && !empty($datosTrabajador['estatus'])){
                    
                }else{
                    $errores['estatus'] = 'El estado actual es necesario';
                }
                if(isset($datosTrabajador['coordinacion']) && !empty($datosTrabajador['coordinacion'])){

                }else{
                    $errores['coordinacion'] = 'La coordinacion es requerida';
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
                if(isset($datosTrabajador['tenencia']) && !empty($datosTrabajador['tenencia'])){

                }else{
                    $errores['tenencia'] = 'La tenencia es requerida';
                }

                if(isset($datosTrabajador['vivienda']) && !empty($datosTrabajador['vivienda'])){

                }else{
                    $errores['vivienda'] = 'El tipo de vivienda es requerido';
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
                

                //2. Crear una instancia del objeto Trabajador
                $nuevoTrabajador = new \Models\Entities\Trabajador(
                    null,
                    $datosTrabajador['nacionalidad'] ?? null,
                    $datosTrabajador['cedula']?? null,
                    $datosTrabajador['nombres']?? null,
                    $datosTrabajador['apellidos']?? null,
                    $datosTrabajador['fecha_nacimiento']?? null,
                    $datosTrabajador['estado_civil']?? null,
                    $datosTrabajador['telefono_fijo']?? null,
                    $datosTrabajador['telefono_movil']?? null,
                    $datosTrabajador['email']?? null,
                    $datosTrabajador['estatura']?? null,
                    $datosTrabajador['peso']?? null,
                    $datosTrabajador['tipo_sangre']?? null,
                    $datosTrabajador['discapacidad'] ?? null,
                    $datosTrabajador['talla_camisa']?? null,
                    $datosTrabajador['talla_zapatos']?? null,
                    $datosTrabajador['talla_pantalon']?? null,
                    $datosTrabajador['vivienda']?? null,
                    $datosTrabajador['tenencia']?? null,
                    $datosTrabajador['estado']?? null,
                    $datosTrabajador['ciudad']?? null,
                    $datosTrabajador['municipio']?? null,
                    $datosTrabajador['parroquia']?? null,
                    $datosTrabajador['direccion']?? null,
                    $datosTrabajador['rif']?? null,
                    $datosTrabajador['cargo'] ?? null,
                    $datosTrabajador['estatus'] ?? null,
                    $datosTrabajador['coordinacion'] ?? null,
                    $datosTrabajador['num_hijos']?? null
                );

                //Verficar si existen errores, en caso de que existan devuelve el codigo 400 con los errores en formato JSON
                if (!empty($errores)) {
                    http_response_code(400);
                    header('Content-Type: application/json');
                    echo json_encode(['errors' => $errores]);
                    return;
                }
                //3.Recibir y decodificar el JSON de parientes
                $parientesJSON = $_POST['parienteArray'] ?? '[]';

                
                //Add this specific check to log what´s actually being passed to json_decode
                error_log("Attempting to decode parientesJSON: '". $parientesJSON . "'");
                $parientes = json_decode($parientesJSON, true);
                
                if($parientesJSON){
                    if(json_last_error() === JSON_ERROR_NONE && is_array($parientes)){
                        //4. Asignar los parientes al objeto Trabajador
                    $nuevoTrabajador->parientes = $parientes;

                    }else{
                        // This block is for actual JSON syntax errors.
                        $errorMessage = 'Error al decodificar la información de parientes: ' . json_last_error_msg();
                        error_log($errorMessage . " | Input that failed: '" . $parientesJSON . "'");
                        $errores['parientes'] = $errorMessage;
                        // Si el JSON de parientes está mal formado, debería ser un error fatal.
                        // Retorna un error 400 y detiene la ejecución.
                        http_response_code(400);
                        header('Content-Type: application/json');
                        echo json_encode(['errors' => $errores]);
                        //Se puede redirigir o mostrar un error al usuario
                        return;
                    }
                }else{
                    // This block will be hit if $_POST['parientesJson'] is null or an empty string ""
                    error_log("parientesJson is empty or null, no relatives to process.");
                    // In this case, it's fine if there are no relatives.
                    // Ensure $nuevoTrabajador->parientes is initialized to an empty array
                    $nuevoTrabajador->parientes = []; // Important: Initialize to empty array if no relatives
                }
                
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        echo "<pre>";
                        print_r($_POST);
                        echo "</pre>";
                    }
                //3. Guardar al nuevo trabajador dentro de la DB
                
                $trabajadorGuardado = $this->trabajadorRepository->guardar($nuevoTrabajador);

                // 4. Retornar una respuesta (por ejemplo, el trabajador creado o un mensaje de éxito)
                    if ($trabajadorGuardado) {
                        
                        header("Location: ../crud_fetch/View/listarTrabajadores.php");
                        exit();
                    } else {
                        http_response_code(500); // Código de "Error interno del servidor"
                        header('Content-Type: application/json');
                        
                        echo json_encode(['error' => 'No se pudo crear el trabajador']);
                    }
                }
            }
            
        
        /**
         * Procesa la actualización de la información de un trabajador existente.
         *
         * @param int $id El ID del trabajador a actualizar.
         * @return void // No se necesita que regrese algun value
         */
        public function actualizarTrabajador(int $cedula){
            // 1. Obtener los datos actualizados del trabajador desde la petición (PUT data, etc.)
            // (Similar a crearTrabajador, pero asegurándote de incluir el ID)

                // Leer el cuerpo de la petición (InputStream) que contiene el JSON
            $jsonDatos = file_get_contents(filename: 'php://input');

            //DEBUGGING IN THE START 
            //Log the raw JSON data to the PHP error log
            error_log("Raw JSON received for actualizarTrabajador: ". $jsonDatos);

            // Decodificar el JSON a un array asociativo de PHP
            $datosActualizados = json_decode($jsonDatos, true);

            //DEBUGGING IN THE START
            // Log the decoded data
            error_log("Decoded data for actualizarTrabajador: ". print_r($datosActualizados, true));

            

            // Verificar si la decodificación JSON fue exitosa
            if (json_last_error() !== JSON_ERROR_NONE) {
                http_response_code(400); // Bad Request
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Formato de JSON invalido']);
                return;
            }

            // 2. Obtener el trabajador existente para asegurarse de que existe
            $trabajadorExistente = $this->trabajadorRepository->obtenerTrabajadorPorCedula($cedula);

            if (!$trabajadorExistente) {
                http_response_code(404);
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Trabajador no encontrado']);
                return;
            }

            //3.Actualizar las propiedades del objeto Trabajador existente con los nuevos datos
            $trabajadorExistente->setNombre($datosTrabajador['nombres']?? $trabajadorExistente->getNombre());
            $trabajadorExistente->setCedula($datosTrabajador['cedula']?? $trabajadorExistente->getCedula());
            $trabajadorExistente->setApellido($datosTrabajador['apellidos']?? $trabajadorExistente->getApellido());
            $trabajadorExistente->setFecha_nacimiento($datosTrabajador['fecha_nacimiento']?? $trabajadorExistente->getFecha_nacimiento());
            $trabajadorExistente->setEstado_civil($datosTrabajador['estado_civil']?? $trabajadorExistente->getEstado_civil());
            $trabajadorExistente->setTelefono_fijo($datosTrabajador['telefono_fijo']?? $trabajadorExistente->getTelefono_fijo());
            $trabajadorExistente->setTelefono_movil($datosTrabajador['telefono_movil']?? $trabajadorExistente->getTelefono_movil());
            $trabajadorExistente->setEmail($datosTrabajador['email']?? $trabajadorExistente->getEmail());
            $trabajadorExistente->setEstatura($datosTrabajador['estatura']?? $trabajadorExistente->getEstatura());
            $trabajadorExistente->setPeso($datosTrabajador['peso']?? $trabajadorExistente->getPeso());
            $trabajadorExistente->setTipo_sangre($datosTrabajador['tipo_sangre']?? $trabajadorExistente->getTipo_sangre());
            $trabajadorExistente->setDiscapacidad($datosTrabajador['discapacidad']?? $trabajadorExistente->getDiscapacidad());
            $trabajadorExistente->setTalla_camisa($datosTrabajador['talla_camisa']?? $trabajadorExistente->getTalla_camisa());
            $trabajadorExistente->setTalla_zapatos($datosTrabajador['talla_zapatos']?? $trabajadorExistente->getTalla_zapatos());
            $trabajadorExistente->setTalla_pantalon($datosTrabajador['talla_pantalon']?? $trabajadorExistente->getTalla_pantalon());
            $trabajadorExistente->setVivienda($datosTrabajador['vivienda']?? $trabajadorExistente->getVivienda());
            $trabajadorExistente->setTenencia($datosTrabajador['tenencia']?? $trabajadorExistente->getTenencia());
            $trabajadorExistente->setEstado($datosTrabajador['estado']?? $trabajadorExistente->getEstado());
            $trabajadorExistente->setCiudad($datosTrabajador['ciudad']?? $trabajadorExistente->getCiudad());
            $trabajadorExistente->setMunicipio($datosTrabajador['municipio']?? $trabajadorExistente->getMunicipio());
            $trabajadorExistente->setParroquia($datosTrabajador['parroquia']?? $trabajadorExistente->getParroquia());
            $trabajadorExistente->setDireccion($datosTrabajador['direccion']?? $trabajadorExistente->getDireccion());
            $trabajadorExistente->setRif($datosTrabajador['rif']?? $trabajadorExistente->getRif());
            $trabajadorExistente->setCargo($datosTrabajador['cargo']?? $trabajadorExistente->getCargo());
            $trabajadorExistente->setEstatus($datosTrabajador['estatus']?? $trabajadorExistente->getEstatus());
            $trabajadorExistente->setCoordinacion($datosTrabajador['coordinacion']?? $trabajadorExistente->getCoordinacion());
            $trabajadorExistente->setNum_hijos($datosTrabajador['num_hijos']?? $trabajadorExistente->getNum_hijos());

            
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

                // --- Refactored Dashboard Methods ---

        public function getTotalTrabajadores()
        {
            try {
                $total = $this->trabajadorRepository->countTotalTrabajadores();
                echo json_encode(['success' => true, 'data' => ['total' => $total]]);
            } catch (\Exception $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Error al obtener el total de trabajadores: ' . $e->getMessage()]);
            }
        }

        public function getTrabajadoresPorCoordinacion()
        {
            try {
                $data = $this->trabajadorRepository->getTrabajadoresCountByCoordinacion();
                echo json_encode(['success' => true, 'data' => $data]);
            } catch (\Exception $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Error al obtener trabajadores por coordinación: ' . $e->getMessage()]);
            }
        }

        public function getTrabajadoresEnVacaciones()
        {
            try {
                $total = $this->trabajadorRepository->countTrabajadoresEnVacaciones();
                echo json_encode(['success' => true, 'data' => ['total' => $total]]);
            } catch (\Exception $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Error al obtener trabajadores en vacaciones: ' . $e->getMessage()]);
            }
        }

        public function getTrabajadoresParaJubilarse()
        {
            try {
                $total = $this->trabajadorRepository->countTrabajadoresParaJubilarse();
                echo json_encode(['success' => true, 'data' => ['total' => $total]]);
            } catch (\Exception $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Error al obtener trabajadores para jubilarse: ' . $e->getMessage()]);
            }
        }

        public function getTrabajadoresConDiscapacidad()
        {
            try {
                $total = $this->trabajadorRepository->countTrabajadoresConDiscapacidad();
                echo json_encode(['success' => true, 'data' => ['total' => $total]]);
            } catch (\Exception $e) {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Error al obtener trabajadores con discapacidad: ' . $e->getMessage()]);
            }
        }
    }
?>