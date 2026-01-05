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
    <title>Portal Interno - Teatro Teresa Carreño</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Montserrat:wght@300;400;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        :root {
            --ttc-gold: #c5a059;
            --ttc-dark: #1a1a1a;
            --ttc-red: #8b0000;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f4f4f4;
            color: var(--ttc-dark);
        }

        h1,
        h2,
        h3,
        .navbar-brand {
            font-family: 'Playfair Display', serif;
        }

        /* Navbar Estilizada */
        .navbar {
            background-color: rgba(0, 0, 0, 0.9) !important;
            border-bottom: 3px solid var(--ttc-gold);
            padding: 1rem 2rem;
        }

        /* Hero Section con Parallax */
        #hero {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('../Public/img/teatro_teresa.jpg');
            background-size: cover;
            background-position: center;
            height: 70vh;
            display: flex;
            align-items: center;
            color: white;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
        }

        .card-has-bg {
            transition: transform 0.3s ease;
            cursor: pointer;
            border: none;
            overflow: hidden;
            min-height: 350px;
        }

        .card-has-bg:hover {
            transform: translateY(-10px);
        }

        .info-section {
            background: white;
            border-left: 5px solid var(--ttc-gold);
        }

        .badge-user {
            background-color: var(--ttc-gold);
            color: black;
            font-weight: bold;
        }

        .btn-ttc {
            background-color: var(--ttc-gold);
            color: black;
            border-radius: 0;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-ttc:hover {
            background-color: white;
            color: var(--ttc-dark);
        }

        .footer-custom {
            background-color: var(--ttc-dark);
            border-top: 4px solid var(--ttc-red);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="../Public/img/logotipo.jpg" alt="Logo" width="70" class="me-3 rounded-circle">
                <div>
                    <span class="d-block lh-1">FUNDACIÓN TEATRO</span>
                    <small class="fs-6 text-uppercase text-secondary">Teresa Carreño</small>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link px-3" href="#historia">Historia</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#recursos-humanos">Recursos Humanos</a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="#servicio-medico">Bienestar</a></li>
                    <li class="nav-item ms-lg-3">
                        <span class="badge badge-user p-2 rounded-pill">
                            <i class="fas fa-user-circle me-1"></i> ID:
                            <?php echo $_SESSION['user'] ?>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="hero">
        <div class="container text-center text-md-start">
            <div class="col-lg-7">
                <h1 class="display-2 fw-bold mb-3">Gestión de Talento con Propósito Cultural</h1>
                <p class="lead mb-4">Bienvenido al portal interno del complejo cultural más importante de Venezuela.
                    Aquí, cada proceso administrativo impulsa el arte.</p>
                <a href="#nuestros-sistemas" class="btn btn-ttc btn-lg px-5">ACCEDER A SISTEMAS</a>
            </div>
        </div>
    </section>

    <section id="historia" class="py-5">
        <div class="container">
            <div class="row align-items-center shadow-sm info-section p-4 p-md-5">
                <div class="col-md-5 mb-4 mb-md-0">
                    <img src="../Public/img/teatroTeresa.jpg" class="img-fluid rounded shadow-lg"
                        alt="Arquitectura TTC">
                </div>
                <div class="col-md-7 ps-md-5">
                    <h2 class="display-5 mb-4">Un Icono de la Arquitectura</h2>
                    <p>Inaugurado en 1983, el Teatro Teresa Carreño es una obra maestra del **Brutalismo**, diseñado
                        por los arquitectos Tomás Lugo, Jesús Sandoval y Dietrich Kunckel. Con sus salas **Ríos
                        Reyna** y **José Félix Ribas**, es el hogar permanente de la Orquesta Sinfónica de Venezuela
                        y el Ballet Teresa Carreño.</p>
                    <p class="text-muted small">Nuestro compromiso en el área administrativa es asegurar que esta
                        maquinaria cultural nunca se detenga.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="recursos-humanos" class="py-5 bg-dark text-white">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-4">Gestión de Capital Humano</h2>
                <div class="mx-auto bg-warning" style="height: 3px; width: 80px;"></div>
            </div>
            <div class="row g-4">
                <div class="col-md-4 text-center p-4">
                    <i class="fas fa-users-cog fa-3x mb-3 text-warning"></i>
                    <h4>Desarrollo Profesional</h4>
                    <p class="text-secondary">Impulsamos la formación técnica de nuestros tramoyistas, iluminadores
                        y personal administrativo.</p>
                </div>
                <div class="col-md-4 text-center p-4">
                    <i class="fas fa-hand-holding-heart fa-3x mb-3 text-warning"></i>
                    <h4>Bienestar Laboral</h4>
                    <p class="text-secondary">Programas de salud y seguridad social adaptados a las exigencias
                        físicas de las artes escénicas.</p>
                </div>
                <div class="col-md-4 text-center p-4">
                    <i class="fas fa-balance-scale fa-3x mb-3 text-warning"></i>
                    <h4>Transparencia</h4>
                    <p class="text-secondary">Sistemas automatizados para la gestión de nómina, beneficios y
                        registros históricos.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="nuestros-sistemas" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Plataformas de Gestión</h2>
            <div class="row g-4 justify-content-center">

                <div class="col-md-4">
                    <div class="card text-white card-has-bg shadow-lg"
                        style="background-image:url('../Public/img/servicio-medico.jpg');">
                        <div class="card-img-overlay d-flex flex-column justify-content-end bg-dark bg-opacity-75">
                            <h4 class="card-title">Registro de Personal</h4>
                            <p class="card-text small">Gestión de expedientes y parentesco.</p>
                            <a href="../View/indexFormulario.php" class="btn btn-ttc w-100">INGRESAR</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card text-white card-has-bg shadow-lg"
                        style="background-image:url('../Public/img/recursosHumano.jpg');">
                        <div class="card-img-overlay d-flex flex-column justify-content-end bg-dark bg-opacity-75">
                            <h4 class="card-title">Panel RRHH</h4>
                            <p class="card-text small">Estadísticas e indicadores de gestión.</p>
                            <a href="../View/adminRHDashboard.php" class="btn btn-ttc w-100">INGRESAR</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <footer class="footer-custom text-white py-5">
        <div class="container text-center">
            <img src="../Public/img/logotipo.jpg" width="60" class="mb-3 rounded-circle" alt="Logo">
            <p class="mb-1 fw-bold">Fundación Teatro Teresa Carreño</p>
            <p class="text-secondary small mb-4">Ubicación: Av. Leonardo Ruiz Pineda con Av. México, Caracas.</p>
            <div class="social-links mb-4">
                <a href="#" class="text-white mx-2"><i class="fab fa-instagram fa-lg"></i></a>
                <a href="#" class="text-white mx-2"><i class="fab fa-twitter fa-lg"></i></a>
            </div>
            <p class="mb-0 x-small text-secondary">&copy; 2026 Departamento de Tecnología y RRHH.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        async function loadEspecialidadData() {
            const tableBody = document.getElementById('especialidadesTableBody');

            try {
                // He corregido la lógica de tu fetch para que coincida con tus IDs de tabla
                const response = await fetch('http://localhost/crud_fetch/index.php/?api=trabajadoresPorCoordinacion');
                const result = await response.json();

                if (result.status === 'success' && Array.isArray(result.data)) {
                    tableBody.innerHTML = '';
                    result.data.forEach(item => {
                        const row = `<tr>
                            <td class="fw-bold text-dark">${item.coordinacion || item.especialidad}</td>
                            <td class="text-center"><span class="badge bg-dark">${item.total}</span></td>
                        </tr>`;
                        tableBody.innerHTML += row;
                    });
                } else {
                    tableBody.innerHTML = '<tr><td colspan="2" class="text-center">No se encontraron datos.</td></tr>';
                }
            } catch (error) {
                console.error("Error:", error);
                tableBody.innerHTML = '<tr><td colspan="2" class="text-danger">Error de conexión con el servidor.</td></tr>';
            }
        }

        document.addEventListener('DOMContentLoaded', loadEspecialidadData);
    </script>
</body>

</html>