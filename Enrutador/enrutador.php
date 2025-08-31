<?php

// Asegúrate de incluir el namespace correcto de tu controlador

use crud_fetch\Controllers\TrabajadorController;


class Enrutador {

    private $trabajadorController;

    //A constructor allows you to initialize an object's properties upon creation of the object.PHP will automatically call this function when you create an object from a class.

    public function __construct(PDO $pdo) {
        // Inyecta la dependencia de PDO al instanciar el controlador
    
        $this->trabajadorController = new TrabajadorController($pdo);
    }


    public function cargarVistas() {
        if (isset($_GET['cargar'])) {
            $vista = $_GET['cargar'];
            if ($this->validarVista($vista)) {
                include_once('View/' . $vista . '.php');
            } else {
                include_once('index.php'); // O manejar de otra manera
            }
        } else {
            include_once('index.php');
            
        }
    }

        public function validarVista($vista) {
        // **IMPORTANT:** Add 'dashboard' if you plan to have a dashboard view file
        $vistasValidas = [
            "crearTrabajador", "listarTrabajadores", "actualizarTrabajador", "validarCedula", 
            "estadisticasTotales", "comparativaIngresos", "obtenerUltimosTrabajadores", 
            "eliminarTrabajador", "mostrarTrabajador", "validarPariente", "crearPariente",
            "listarParientes", "actualizarPariente", "mostrarPariente", 
            "dashboard" // Add your new dashboard view here
        ];
        return in_array($vista, $vistasValidas);
    }

    // Nuevo método para manejar las llamadas a la API
    public function cargarAPI() {
        if (isset($_GET['api'])) {
            $apiLlamada = $_GET['api'];
            $rutasAPI = [
                "trabajadores"               => [$this->trabajadorController, 'listarTrabajadores'],
                "trabajador"                 => [$this->trabajadorController, 'mostrarTrabajador'],
                "validar_cedula"             => [$this->trabajadorController, 'validarCedula'],
                "crearTrabajador"            => [$this->trabajadorController, 'crearTrabajador'],
                "obtenerUltimosTrabajadores" => [$this->trabajadorController, 'obtenerTrabajadoresRecientes'],
                "totalRegistros"             => [$this->trabajadorController, 'estadisticasTotales'],
                "comparativa"                => [$this->trabajadorController, 'comparativaIngresos'],
                "actualizarTrabajador"       => [$this->trabajadorController, 'actualizarTrabajador'],
                "eliminarTrabajador"         => [$this->trabajadorController, 'eliminarTrabajador'],
                "validarCedulaPariente"      => [$this->trabajadorController, "validarPariente"],
                "parientes"                  => [$this->trabajadorController, 'listarParientes'],
                "pariente"                   => [$this->trabajadorController, 'mostrarPariente'],
                "actualizarPariente"         => [$this->trabajadorController, 'actualizarPariente'],
                "eliminarPariente"           => [$this->trabajadorController, 'eliminarPariente'],
                
                // --- Nuevas rutas para el Dashboard ---
                "totalTrabajadores"          => [$this->trabajadorController, 'getTotalTrabajadores'],
                "trabajadoresPorCoordinacion" => [$this->trabajadorController, 'getTrabajadoresPorCoordinacion'],
                "trabajadoresEnVacaciones"   => [$this->trabajadorController, 'getTrabajadoresEnVacaciones'],
                "trabajadoresParaJubilarse"  => [$this->trabajadorController, 'getTrabajadoresParaJubilarse'],
                "trabajadoresConDiscapacidad" => [$this->trabajadorController, 'getTrabajadoresConDiscapacidad'],
                // ------------------------------------
            ];
            

            if (array_key_exists($apiLlamada, $rutasAPI)) {
                $handler = $rutasAPI[$apiLlamada];

                // Validacion de parametros que solicitan de un ID o cedula para su ejecucion
                // This list now needs to *exclude* the new dashboard APIs, as they don't take an 'id' param
                $apisWithId = [
                    "trabajador", "actualizarTrabajador", "validar_cedula", 
                    "validarCedulaPariente", "eliminarTrabajador", "pariente", 
                    "actualizarPariente", "eliminarPariente"
                ];

                if (in_array($apiLlamada, $apisWithId)) {
                    if (isset($_GET['id'])) { // Changed from is_numeric($_GET['id']) to allow non-numeric IDs like cedula if needed
                        call_user_func($handler, $_GET['id']);
                    } else {
                        http_response_code(400);
                        header('Content-Type: application/json');
                        echo json_encode(['error' => 'Se requiere el parámetro "id" para esta operación']);
                    }
                } else {
                    // For APIs that do not require an 'id' parameter (including the new dashboard ones)
                    call_user_func($handler);
                }
            } else {
                http_response_code(404);
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Endpoint de API no encontrado']);
            }
            exit(); // Ensure that script execution stops after handling an API call
        }
    }

    // Método principal para enrutar la petición
    public function enrutar() {
        // Primero, intentar cargar la API
        $this->cargarAPI();

        // Si no fue una llamada a la API, intentar cargar una vista
        // This line will only be reached if cargarAPI() does not find an 'api' parameter
        // or if it doesn't call exit().
        $this->cargarVistas();
    }
}

?>