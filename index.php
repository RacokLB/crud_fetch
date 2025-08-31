<?php
/*
        //here we open the session from the user
        session_start();
        //here we verified if the field "id" is empty the user cannot enter into the index page 
        if (!isset($_SESSION['rol'])){
            header(header:'location: View/login.php');
        }else{
            if($_SESSION['rol'] != 1){
                header(header:'location: View/login.php');
            }
        }
            */
        // Incluye tus archivos de configuración de la base de datos
        require_once 'Config/POOConexion.php'; // Asegúrate de que este archivo exista y configure la conexión PDO

        require_once 'Enrutador/enrutador.php';
        require_once 'Controllers/TrabajadorController.php'; // Asegúrate de que la ruta sea correcta
        require_once 'Models/Repositories/trabajadorRepository.php'; // Asegúrate de que la ruta sea correcta
        require_once 'Models/Entities/Trabajador.php'; // Asegúrate de que la ruta sea correcta

        // Obtén la conexión PDO

        $database = new Database();
        $pdo = $database->getPDO();
        $error = $database->getError();

        // Instancia el enrutador, pasando la conexión PDO
        $enrutador = new Enrutador($pdo);
        $enrutador->enrutar(); // Llama al método principal del enrutador

?>
<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Direccion General de Talento Humano</title>
    <link rel="stylesheet" href="Public/stylepage.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="Public/slider.css">
</head>
 <body>
    <header>
        <div class="container">
            <a href="" target="_blank" rel="noopener noreferrer" class="logo">
            <img src="Public/img/logotipo.jpg" alt="logo del Teatro Teresa Carreño">
            </a>
            <h1>PODER ELECTORAL</h1>
            <nav>
                <a href="#Direccion-general-de-talento-humano">Direccion General de Talento Humano</a>
                <a href="#Nuestros-departamentos">Nuestros Proyectos</a>
                <a href="#caracteristicas">Beneficios de nuestros Proyectos</a>
                <a href="controlador/controlador_cerrar_session.php" name="salir" value="5">Salir</a>
                <?php
                echo "ID de inicio de sesion: ".$_SESSION["rol"]."<br>"." ". "cedula del usuario :  ".$_SESSION["user"];
                ?>
            </nav>
        </div>
    </header>
    <section id="hero">
        <h1 class="border"><br></h1>
    </section>
    <section id="Direccion-de-talento-humano">
        <div class="container">
       
          <div class="img-container"></div>
          <h2>Direccion General de <span class="color-acento">Talento Humano</span></h2>
          <p>La Direccion General de Talento Humano es una de las áreas clave de la organizacion ya que se encarga de la gestión del personal. No solo selecciona a los profesionales más capacitados que compartan los valores de la institucion, sino que también supervisa su formación y se asegura de mantener un clima laboral adecuado que garantice su satisfacción y el cumplimiento de las actividades</p>
          </div>
    </section>
<!-----------------nuestros departamentos------------------>
    <section id="Nuestros-departamentos">
        <div class="container">
          <h2>Nuestros Sistemas</h2>
          <div class="programas">
          <div class="carta">
            <h3>Aplicativo para el registro de trabajadores</h3>
            <p>El desarrollo de este aplicativo tiene como fin el registro, modificacion y consulta de los funcionarios que se encuentran laborando dentro del Teatro Teresa Carreño y en proceso de ingreso al organismo, nace de la necesidad de alimentar la data de nuestro departamento con informacion veraz sobre el funcionario y de su nucleo familiar</p>
            <!--para que este boton nos redirija a un link es necesario envolverlo en un form y action agregar el link de la pagina a donde queremos redirigir al usuario-->
            <form action="View/indexFormulario.php" method="GET">
                <input type="hidden" name="api" value="crearTrabajador">
                <button type="submit">Ir al Formulario</button>
            </form>
          </div>
<!--------------- Direccion de Desarrollo Personal---------------->
          <div class="carta">
            <h3>Consulta de Funcionario</h3>
            <form method="View/listarTrabajadores.php" method="GET">
                <input type="hidden" name="api" value="trabajadores">
                <button type="submit">Consultar</button>
            </form>

          </div>
<!------------------Direccion de Remuneraciones----------------------->
          <div class="carta">
            <h3>Sistema para la Fe De Vida</h3>
            <p>El área de remuneraciones es la que prepara las liquidaciones mensuales de los trabajadores, procesando todos los incidentes que pueden hacer variar tu pago mensual.</p>
            <button>Informacion</button>
          </div>
          </div>
        </div>
    </section>
<!------------------------ seccion de ventajas ---------------------->

<!------------- Seccion de ventajas del sistema de jornada ----->
    <section id="caracteristicas">
        <div class="container">  
        <label><h2>Aspectos positivos del Aplicativo para el registro de funcionarios <br> </h2></label>
        <ul>
        <li>✅​Recaudacion de informacion veraz y certera de los funcionarios</li>
        <li>✅​Formulario estructurado para el almacenamiento de la informacion solicitada</li>
        <li>✅​Rapidez en la consulta</li>
        <li>✅Creacion de Bases de datos interrelacionadas para asi nutrir los distintos departamentos de la DGTH</li>
        <li>✅​Facil manejo de la informacion </li>
        <li>✅​Acceso oportuno a la informacion</li>
        <li>✅​Mejora en los tiempos de respuesta</li>
        <li>✅Resguardo de la informacion en bases de datos</li>
        </ul>
        </div>
    </section>
<!---------------------marquesina de la pagina--------------------------->
    <section class="slider">

        <div class="slide-track">
            <div class="slide">
                <img src="Public/img/logotipo.jpg" alt="marquesina">
            </div>
            <div class="slide">
                <img src="Public/img/logotipo.jpg" alt="marquesina">
            </div>
            <div class="slide">
                <img src="Public/img/logotipo.jpg" alt="marquesina">
            </div>
            <div class="slide">
                <img src="Public/img/logotipo.jpg" alt="marquesina">
            </div>

            <div class="slide">
                <img src="Public/img/logotipo.jpg" alt="marquesina">
            </div>
            <div class="slide">
                <img src="Public/img/logotipo.jpg" alt="marquesina">
            </div>
            <div class="slide">
                <img src="Public/img/logotipo.jpg" alt="marquesina">
            </div>
            <div class="slide">
                <img src="Public/img/logotipo.jpg" alt="marquesina">
            </div>
        </div>
    </section>
<!-------------------- pie de pagina -------------------->
    <footer>
        <div class="container">            
            <p>&copy; Direccion General De Talento Humano</p>
        </div>
    </footer>
 </body>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</html>