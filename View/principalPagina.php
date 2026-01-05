<?php
if (session_status() == PHP_SESSION_NONE) {
    if (session_start()) {
        if (!isset($_SESSION['id'])) {
            header("location: login.php");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicio Médico Especializado - Teatro Teresa Carreño</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Montserrat:wght@300;400;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        :root {
            --ttc-black: #121212;
            --turkiye-red: #e30a17;
            /* Rojo de la bandera de Türkiye */
            --medical-blue: #00a8cc;
            --gold-accent: #c5a059;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f8f9fa;
        }

        h1,
        h2,
        h3 {
            font-family: 'Playfair Display', serif;
        }

        /* Navbar Estilo Minimalista */
        .navbar {
            background: rgba(18, 18, 18, 0.98) !important;
            border-bottom: 2px solid var(--gold-accent);
        }

        /* Hero con enfoque en Medicina Deportiva */
        #hero-medical {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                url('https://images.unsplash.com/photo-1547153760-18fc86324498?auto=format&fit=crop&q=80');
            /* Imagen de danza/músculos */
            background-size: cover;
            background-position: center;
            height: 80vh;
            display: flex;
            align-items: center;
            color: white;
        }

        /* Sección de Alianza Internacional */
        .alliance-banner {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-top: -50px;
            position: relative;
            z-index: 10;
            padding: 30px;
        }

        .flag-icon {
            width: 40px;
            height: auto;
            margin: 0 10px;
        }

        /* Cards de Especialidades */
        .spec-card {
            border: none;
            border-radius: 0;
            border-left: 4px solid var(--medical-blue);
            transition: 0.3s;
            background: #fff;
        }

        .spec-card:hover {
            background: var(--medical-blue);
            color: white;
            transform: scale(1.02);
        }

        .systems-card {
            height: 100%;
            background-size: cover;
            background-position: center;
            border: none;
            min-height: 300px;
            transition: 0.4s;
        }

        .systems-card .overlay {
            background: rgba(0, 0, 0, 0.6);
            height: 100%;
            padding: 2rem;
            display: flex;
            flex-column: column;
            justify-content: flex-end;
        }

        .btn-medical {
            background-color: var(--turkiye-red);
            color: white;
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 600;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="../Public/img/logotipo.jpg" width="60" class="me-2 rounded-circle">
                <span class="fs-4">Centro de Medicina de las Artes</span>
            </a>
            <div class="ms-auto text-white d-none d-md-block">
                <span class="badge bg-success py-2 px-3">
                    <i class="fas fa-user-md me-2"></i>Personal:
                    <?php echo $_SESSION['user'] ?>
                </span>
            </div>
        </div>
    </nav>

    <section id="hero-medical">
        <div class="container text-center">
            <h1 class="display-3 fw-bold mb-3">El Cuerpo como Instrumento</h1>
            <p class="lead fs-3 mb-4 text-uppercase">Ciencia aplicada al rendimiento de Danza y Ópera</p>
            <div class="d-flex justify-content-center align-items-center">
                <div class="mx-3 text-center">
                    <i class="fas fa-running fa-2x text-warning"></i>
                    <p class="small">Fisiatría Deportiva</p>
                </div>
                <div class="mx-3 text-center">
                    <i class="fas fa-microphone-alt fa-2x text-warning"></i>
                    <p class="small">Foniatría de Ópera</p>
                </div>
                <div class="mx-3 text-center">
                    <i class="fas fa-heartbeat fa-2x text-warning"></i>
                    <p class="small">Rehabilitación</p>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="alliance-banner text-center">
            <div class="row align-items-center">
                <div class="col-md-3 d-flex justify-content-center">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/b/b4/Flag_of_Turkey.svg" class="flag-icon"
                        alt="Bandera de Türkiye">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/0/06/Flag_of_Venezuela.svg"
                        class="flag-icon" alt="Bandera de Venezuela">
                </div>
                <div class="col-md-6 border-start border-end">
                    <h5 class="fw-bold mb-1">COOPERACIÓN INTERNACIONAL ESTRATÉGICA</h5>
                    <p class="small mb-0 text-muted">Infraestructura financiada por el Gobierno de la República de
                        Türkiye para el fomento de la cultura y salud venezolana.</p>
                </div>
                <div class="col-md-3">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/70/T%C4%B0KA_logo.svg/1200px-T%C4%B0KA_logo.svg.png"
                        width="80" alt="Logo TIKA">
                </div>
            </div>
        </div>
    </div>

    <section class="py-5 mt-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="display-5 text-dark">Prevención de Lesiones en la Escena</h2>
                    <p class="lead">El bailarín y el cantante de ópera son **atletas de élite**. Un salto de ballet
                        ejerce una presión de hasta 12 veces el peso corporal, mientras que un tenor requiere un control
                        muscular diafragmático absoluto.</p>
                    <p>Nuestra unidad, remodelada con tecnología de punta, se enfoca en la medicina deportiva adaptada
                        para prolongar la carrera profesional de nuestro elenco teatral.</p>
                </div>
                <div class="col-md-6">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="card spec-card p-3 shadow-sm h-100">
                                <i class="fas fa-bone fa-2x mb-2 text-primary"></i>
                                <h6>Traumatología</h6>
                                <p class="x-small text-muted">Enfoque en lesiones de pie y columna.</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card spec-card p-3 shadow-sm h-100">
                                <i class="fas fa-lungs fa-2x mb-2 text-primary"></i>
                                <h6>Foniatría</h6>
                                <p class="x-small text-muted">Salud vocal y cuidado de cuerdas.</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card spec-card p-3 shadow-sm h-100">
                                <i class="fas fa-dumbbell fa-2x mb-2 text-primary"></i>
                                <h6>Fisiatría</h6>
                                <p class="x-small text-muted">Recuperación muscular intensiva.</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card spec-card p-3 shadow-sm h-100">
                                <i class="fas fa-apple-alt fa-2x mb-2 text-primary"></i>
                                <h6>Nutrición</h6>
                                <p class="x-small text-muted">Dietética para alto rendimiento.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="nuestros-sistemas" class="py-5 bg-dark">
        <div class="container">
            <h2 class="text-center text-white mb-5">Gestión Médica Digitalizada</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card systems-card" style="background-image: url('../Public/img/servicio-medico.jpg');">
                        <div class="overlay">
                            <h4 class="text-white">Admisión Médica PB</h4>
                            <p class="text-light small">Registro de atletas y personal administrativo de planta baja.
                            </p>
                            <a href="../View/indexTrabajador.html" class="btn btn-medical mt-3">Gestionar Pacientes</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center d-flex flex-column justify-content-center">
                    <div class="p-4 border border-secondary rounded shadow">
                        <i class="fas fa-chart-line fa-3x text-warning mb-3"></i>
                        <h4 class="text-white">Analítica de Salud</h4>
                        <p class="text-secondary small">Visualización de estadísticas de incidencias médicas y
                            especialidades.</p>
                        <a href="../View/adminDashBoard.php" class="btn btn-outline-light rounded-pill">Ver
                            Estadísticas</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card systems-card"
                        style="background-image: url('../Public/img/servicioMedicoSotano.jpg');">
                        <div class="overlay">
                            <h4 class="text-white">Unidad Sótano</h4>
                            <p class="text-light small">Control médico exclusivo para el Cuerpo Teatral y Artistas.</p>
                            <a href="../View/indexTrabajadorSotano.html" class="btn btn-medical mt-3">Gestionar Cuerpo
                                Teatral</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-5 bg-black text-white border-top border-danger">
        <div class="container text-center">
            <div class="row align-items-center">
                <div class="col-md-4 text-md-start">
                    <p class="mb-0 small">&copy; 2026 Fundación Teatro Teresa Carreño.</p>
                </div>
                <div class="col-md-4">
                    <p class="mb-0">Remodelado bajo la alianza estratégica <strong>Venezuela - Türkiye</strong></p>
                </div>
                <div class="col-md-4 text-md-end">
                    <i class="fab fa-instagram mx-2"></i>
                    <i class="fab fa-twitter mx-2"></i>
                    <i class="fas fa-globe mx-2"></i>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Función de carga dinámica de datos (mantenida de tu código base)
        async function loadEspecialidadData() {
            const tableBody = document.getElementById('especialidadesTableBody');
            if (!tableBody) return;

            try {
                const response = await fetch('http://localhost/crud_fetch/Models/reportEspecialidades.php');
                const answer = await response.json();

                if (answer.status === 'success' && Array.isArray(answer.data)) {
                    tableBody.innerHTML = '';
                    answer.data.forEach(especialidad => {
                        const row = `<tr>
                            <td class="fw-bold">${especialidad.especialidades}</td>
                            <td class="text-center"><span class="badge bg-danger">${especialidad.total}</span></td>
                        </tr>`;
                        tableBody.innerHTML += row;
                    });
                }
            } catch (error) {
                console.error("Error cargando especialidades:", error);
            }
        }
        document.addEventListener('DOMContentLoaded', loadEspecialidadData);
    </script>
</body>

</html>