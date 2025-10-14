<?php

if(session_status() == PHP_SESSION_NONE){
    if(session_start()){
        if(!isset($_SESSION['id'])){
            header("location: login.php");
        }
    }
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistemas TTC - Teatro Teresa Carreño</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../Public/stylePage.css" >

</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand text-white fs-2" href="#"> <img src="../Public/img/logotipo.jpg" class="d-inline-block align-text-center " width="100" height="90" > Teatro Teresa Carreño</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse navbar" id="navbarNav">
                <ul class="navbar-nav dropdown">
                    <li class="nav-item ">
                        <a class="nav-link text-white fs-5" href="#nuestros-sistemas">Nuestros Sistemas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fs-5" href="#beneficios">Servicio Medico</a>
                    </li>
                    <li>
                        <a class="nav-link text-white fs-5 bg-success rounded-3" > <?php echo "C.I Trabajador - " . $_SESSION['user']?></a>
                    </li>
                </ul>
                
            </div>
        </div>
    </nav>
    <section id="hero" class="jumbotron">
        <div class="container text-center">
            <h1 class="display-5">Fundación Teatro Teresa Carreño</h1>
            <p class="lead">Gestión eficiente y transparente para el desarrollo de nuestro capital humano.</p>
            <a href="#nuestros-sistemas" class="btn btn-dark text-white btn-lg mt-3">
                Explorar Sistemas <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </section>

    <section class="info-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4 order-md-2">
                    <img src="../Public/img/teatroTeresa.jpg" class="img-fluid rounded shadow-lg" alt="Imagen del Teatro Teresa Carreño">
                </div>
                <div class="col-md-6 order-md-1">
                    <h2 class="display-5 fw-bold mb-4">Un Lugar de Encuentro con el Arte</h2>
                    <p class="lead">El Teatro Teresa Carreño es el epicentro cultural de Venezuela, un monumento al arte en todas sus formas. Desde sus majestuosos auditorios hasta sus vibrantes salas de ensayo, es un hogar para la danza, la ópera, la música clásica y el teatro.
                    </p>
                </div>
            </div>
        </div>
    </section>
    
    <section id="servicio-medico" class="py-5">
        <div class="container">
            <h1 class="text-center fw-bold mb-5 display-5">El Servicio Médico del Teatro Teresa Carreño</h1>
            <div class="row align-items-center mb-5">
                <div class="col-md-6 order-md-2">
                    <h4 class="subtitle-style">Compromiso con el Bienestar</h4>
                    <p class="lead">El Servicio Médico de la Fundación Teatro Teresa Carreño es una pieza fundamental para garantizar la salud y el bienestar de nuestro talento humano. Brindamos atención integral, desde la prevención y el diagnóstico hasta el tratamiento y seguimiento de las afecciones más comunes. Nuestro enfoque se extiende a todo el personal, incluyendo a nuestros artistas, técnicos y personal administrativo, así como a sus familiares directos, para asegurar que toda la familia del teatro esté protegida.
                    </p>
                </div>
                <div class="col-md-4 text-center">
                    <img src="../Public/img/servicioMedico.png" class="img-fluid rounded shadow-lg" alt="Servicio médico general">
                </div>
            </div>
            <hr>
            <div class="row align-items-center mb-5">
                <div class="col-md-4 order-md-2">
                    <h4 class="subtitle-style">Una necesidad para las Artes Escénicas</h4>
                    <p class="lead">La vida en el teatro es físicamente exigente. Bailarines, cantantes y músicos se enfrentan a un alto riesgo de lesiones. Por ello, el servicio médico especializado en medicina covencional y de las artes. Nuestro enfoque se orienta a la prevención y tratamiento de dolencias específicas como esguinces, fracturas, y problemas de cuerdas vocales, permitiendo que nuestros artistas mantengan su rendimiento y longevidad profesional. Un cuerpo sano es un artista en su mejor forma.
                    </p>
                </div>
                <div class="col-md-4 text-center">
                    <img src="../Public/img/foniatra.png" class="img-fluid rounded shadow-lg" alt="Medicina deportiva para artistas">
                </div>
            </div>
<hr>

            <div class="row align-items-start mb-5"> <div class="col-md-6"> <h4 class="subtitle-style"></h4>
                    <div class="col-md-12 mb-4">
                        <div class="card" style="background-color: #000000">
                            <div class="card-header text-white fw-bold text-center" style="background-color: #000000"><h4>Especialidades del servicio medico</h4></div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-dark table-hover">
                                        <thead>
                                            <tr>
                                                <th class="bg-warning text-dark">Especialidades</th>
                                                <th class="bg-warning text-dark" >Doctores por especialidad</th>
                                            </tr>
                                        </thead>
                                        <tbody id="especialidadesTableBody">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div id="carouselEspecialidades" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="../Public/img/bailarinDoctor.png" class="d-block w-100 rounded" alt="FisioTerapia">
                            </div>
                            <div class="carousel-item">
                                <img src="../Public/img/fisiatra.png" class="d-block w-100 rounded" alt="FisioTerapia">
                            </div>
                            <div class="carousel-item">
                                <img src="../Public/img/nutrologo.png" class="d-block w-100 rounded" alt="FisioTerapia">
                            </div>
                            <div class="carousel-item">
                                <img src="../Public/img/medicinaInterna.png" class="d-block w-100 rounded" alt="FisioTerapia">
                            </div>
                            <div class="carousel-item">
                                <img src="../Public/img/terapiaLenguaje.png" class="d-block w-100 rounded" alt="FisioTerapia">
                            </div>
                            <div class="carousel-item">
                                <img src="../Public/img/traumatologia.png" class="d-block w-100 rounded" alt="FisioTerapia">
                            </div>
                            <div class="carousel-item">
                                <img src="../Public/img/terapiaOcupacional.png" class="d-block w-100 rounded" alt="FisioTerapia">
                            </div>
                            <div class="carousel-item">
                                <img src="../Public/img/foniatraHombre.png" class="d-block w-100 rounded" alt="FisioTerapia">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselEspecialidades" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselEspecialidades" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
                
        </div>
    <hr>
    </section>
    

    <section id="nuestros-sistemas" class="systems-section py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Sistemas de la Fundación</h2>
            <div class="row g-4 justify-content-center">
                <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                    <div class="card text-white card-has-bg" style="background-image:url('../Public/img/servicio-medico.jpg');">
                        <img class="card-img d-none" src="../Public/img/servicio-medico.jpg" alt="Sistemas de Pacientes">
                        <div class="card-img-overlay d-flex flex-column">
                            <div class="card-body">
                                <small class="card-meta mb-2">Trabajadores Administrativos & Parientes</small>
                                <h4 class="card-title mt-0"><a class="text-white" href="../View/indexTrabajador.html">Registro de pacientes <br> *sede PB*</a></h4>
                            </div>
                            <div class="card-footer">
                                <a href="../View/indexTrabajador.html" class="btn btn-dark btn-sm">Acceder al sistema</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                    <div class="card text-white card-has-bg" style="background-image:url('../Public/img/recursosHumano.jpg');">
                        <img class="card-img d-none" src="../Public/img/recursoshumano.jpg" alt="Sistema de Recursos Humanos">
                        <div class="card-img-overlay d-flex flex-column">
                            <div class="card-body">
                                <small class="card-meta mb-2">Resumen Estadistico</small>
                                <h4 class="card-title mt-0"><a class="text-white" href="../View/adminDashBoard.php">Panel de Estadisticas</a></h4>
                            </div>
                            <div class="card-footer">
                                <a href="../View/adminDashBoard.php" class="btn btn-dark btn-sm">Acceder al sistema</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                    <div class="card text-white card-has-bg" style="background-image:url('../Public/img/servicioMedicoSotano.jpg');">
                        <img class="card-img d-none" src="../Public/img/servicioMedicoSotano.jpg" alt="Sistema de Reservas">
                        <div class="card-img-overlay d-flex flex-column">
                            <div class="card-body">
                                <small class="card-meta mb-2">Cuerpo Teatral</small>
                                <h4 class="card-title mt-0"><a class="text-white" href="../View/indexTrabajadorSotano.html">Registro de Pacientes <br> *sede Sotano*</a></h4>
                            </div>
                            <div class="card-footer">
                                <a href="../View/indexTrabajadorSotano.html" class="btn btn-dark btn-sm center">Acceder al sistema</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white-50 py-4">
        <div class="container text-center">
            <p class="mb-0">&copy; 2025 Fundación Teatro Teresa Carreño. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script defer>

        // dashBoard.js

            // Función para obtener los datos de la API y renderizar la tabla
            async function loadEspecialidadData() {
                const especialidadesTableBody = document.getElementById('especialidadesTableBody');
                especialidadesTableBody.innerHTML = ''; // Limpia cualquier contenido previo

                try {
                    const response = await fetch('http://localhost/crud_fetch/Models/reportEspecialidades.php');
                    console.log(`respuesta del backend al momento de solicitar las especialidades ${response}`)
                    if (!response.ok) {
                        throw new Error(`Error HTTP: ${response.status}`);
                    }
                    
                    const answer = await response.json();
                    console.log(`respuesta de las especialidades llamadas del backend ${answer}`)

                    if (answer.status === 'success' && Array.isArray(answer.data)) {
                        const especialidadesData = answer.data;

                        // Verifica si el array de datos está vacío
                        if (especialidadesData.length === 0) {
                            especialidadesTableBody.innerHTML = `<tr><td colspan="4" class="text-info">No hay datos de especialidades disponibles.</td></tr>`;
                            return;
                        }

                        

                        // Iterar sobre el array de especialidadesData y crear las filas de la tabla
                        especialidadesData.forEach(especialidad => {
                    
                            // Crea el elemento de la fila
                            const row = especialidadesTableBody.insertRow();//Se crea una nueva fila
                            //Insertar las celdas <> con los datos
                            const cell1 = row.insertCell();
                            cell1.textContent = especialidad.especialidades;
                            const cell2 = row.insertCell();
                            cell2.textContent = especialidad.total;
                           
                        });
                        
                    } else {
                        console.error("API Error:", answer.mensaje || "Datos no disponibles o estado no exitoso.");
                        especialidadesTableBody.innerHTML = `<tr><td colspan="4" class="text-danger">No se pudieron cargar los datos de los totales por especialidades.</td></tr>`;
                    }

                } catch (error) {
                    console.error("Error al cargar los datos de las especialidades:", error);
                    especialidadesTableBody.innerHTML = `<tr><td colspan="4" class="text-danger">Error al conectar con el servidor de datos.</td></tr>`;
                }
            }

            // Llama a la función para cargar los datos cuando se cargue la página
            document.addEventListener('DOMContentLoaded', loadEspecialidadData);

    </script>
</body>
</html>