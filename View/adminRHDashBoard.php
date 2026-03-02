<?php

if (session_status() == PHP_SESSION_NONE) {
    if (session_start()) {
        if (!isset($_SESSION['id'])) {
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
    <title>Dashboard de Trabajadores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../Public/style.css">
    <link rel="stylesheet" href="../Public/dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar" class="js-sidebar">
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="#">FTTC</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        ADMINISTRATOR ELEMENTS
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#pages" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-solid fa-boxes-stacked pe-2"></i> Módulos
                        </a>
                        <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Consulta y Modificacion de Datos de Trabajadores</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Consulta y Modificacion de Datos de Parientes</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link">
                                    <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" data-bs-whatever="Cortesia">Cortesía</button>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#auth" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-regular fa-user pe-2"></i>
                            USUARIO
                        </a>
                        <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Ingreso</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Registrarse</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Olvidé la contraseña</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">

                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="col-md-11 text-center">
                    <h6 class="text-center" style="color: var(--text-primary); letter-spacing: 2px; font-weight: 600;">TERESA CARREÑO THEATRE FOUNDATION — HR</h6>
                </div>

                <div class="navbar-collapse navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <img src="../Public/img/logotipo.jpg" class="avatar img-fluid rounded"
                                    alt="Logotipo del FTTC">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item">Analista</a>
                                <a href="#" class="dropdown-item">Indicaciones</a>
                                <a href="../Models/logout.php" class="dropdown-item">Salir</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container mt-5">
                <div class="section-divider animate-in">
                    <h2 class="section-title">Workers Dashboard</h2>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card metric-card accent-blue animate-in">
                            <div class="card-body text-center">
                                <h5 class="metric-label"><i class="fa-solid fa-users-between-lines me-2"></i> TOTAL WORKERS</h5>
                                <p class="metric-value" id="totalTrabajadores">0</p>
                                <small class="metric-sublabel">Active Workers</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card metric-card accent-emerald animate-in" style="cursor:pointer;">
                            <div class="card-body text-center">
                                <h5 class="metric-label"><i class="fa-solid fa-umbrella-beach me-2"></i> ON VACATION</h5>
                                <p class="metric-value" id="trabajadoresVacaciones">0</p>
                                <small class="metric-sublabel">Workers on Vacation</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card metric-card accent-amber animate-in" style="cursor:pointer;">
                            <div class="card-body text-center">
                                <h5 class="metric-label"><i class="fa-solid fa-person-cane me-2"></i> ELIGIBLE FOR RETIREMENT</h5>
                                <p class="metric-value" id="trabajadoresJubilarse">0</p>
                                <small class="metric-sublabel">Retirement-Eligible Workers</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5 mb-4">
                        <div class="card glass-card animate-in">
                            <div class="card-header glass-card-header">
                                <i class="fa-solid fa-arrow-right-to-city me-2"></i> Workers by Coordination
                            </div>
                            <div class="card-body">
                                <div class="list-group" id="listaCoordinaciones">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 mb-4">
                        <div class="card metric-card accent-violet animate-in" style="cursor:pointer;">
                            <div class="card-body text-center">
                                <h5 class="metric-label"><i class="fa-brands fa-accessible-icon me-2"></i> WORKERS WITH DISABILITIES</h5>
                                <p class="metric-value" id="trabajadoresDiscapacidad">0</p>
                                <small class="metric-sublabel">Total Workers with Disabilities</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="card glass-card animate-in">
                            <div class="card-header glass-card-header"><i class="fa-solid fa-user-plus me-2"></i> Recently Hired</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">REGISTRATION DATE</th>
                                                <th scope="col">ID NUMBER</th>
                                                <th scope="col">NAME</th>
                                                <th scope="col">LAST NAME</th>
                                            </tr>
                                        </thead>
                                        <tbody id="ultimosTrabajadoresTableBody">
                                        </tbody>
                                    </table>
                                </div>
                                <p class="text-muted small mt-2">
                                    *Classifications based on internal application data grouping.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--- MODAL DONDE SE ENSEÑA LA TABLA DE LAS PERSONAS DE VACACIONES--->
        <div class="modal fade" id="vacationModal" tabindex="-1" aria-labelledby="vacationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="background: var(--card-bg); border: 1px solid var(--border-color);">
                    <div class="modal-header" style="background: rgba(16, 185, 129, 0.15); border-bottom: 1px solid rgba(16, 185, 129, 0.3);">
                        <h5 class="modal-title" id="vacationModalLabel" style="color: var(--text-primary);"><i class="fa-solid fa-umbrella-beach me-2" style="color: #10b981;"></i>Workers on Vacation</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Cédula</th>
                                        <th>Fecha Inicio Vacaciones</th>
                                        <th>Fecha Reintegro</th>
                                        <th>Tiempo Disfrutado</th>
                                    </tr>

                                </thead>
                                <tbody id="vacationTableBody">
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--- MODAL DONDE SE ENSEÑA LA TABLA DE LAS PERSONAS QUE CUMPLEN LA CONDICIÓN DE JUBILAMIENTO--->
        <div class="modal fade" id="retirementModal" tabindex="-1" aria-labelledby="retirementModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="background: var(--card-bg); border: 1px solid var(--border-color);">
                    <div class="modal-header" style="background: rgba(245, 158, 11, 0.15); border-bottom: 1px solid rgba(245, 158, 11, 0.3);">
                        <h5 class="modal-title" id="retirementModalLabel" style="color: var(--text-primary);"><i class="fa-solid fa-person-cane me-2" style="color: #f59e0b;"></i>Retirement-Eligible Workers</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Cédula</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Edad</th>
                                        <th>Años de Servicio</th>
                                    </tr>
                                </thead>
                                <tbody id="retirementTableBody">
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="discapacidadModal" tabindex="-1" aria-labelledby="discapacidadModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="background: var(--card-bg); border: 1px solid var(--border-color);">
                    <div class="modal-header" style="background: rgba(139, 92, 246, 0.15); border-bottom: 1px solid rgba(139, 92, 246, 0.3);">
                        <h5 class="modal-title" id="discapacidadModalLabel" style="color: var(--text-primary);"><i class="fa-brands fa-accessible-icon me-2" style="color: #8b5cf6;"></i>Workers with Disabilities</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Cédula</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Edad</th>
                                        <th>Discapacidad</th>
                                    </tr>
                                </thead>
                                <tbody id="discapacidadTableBody">
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="../Public/dashBoard.js"></script>

        <script>
            $(document).ready(function () {
                // Función genérica para hacer llamadas AJAX
                function fetchData(url, successCallback, errorCallback) {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        success: successCallback,
                        error: function (xhr, status, error) {
                            console.error('Error fetching data from ' + url + ':', error);
                            if (errorCallback) errorCallback(xhr, status, error);
                        }
                    });
                }

                // 1. Total de Trabajadores
                fetchData('http://localhost/crud_fetch/index.php/?api=totalTrabajadores', function (response) {
                    if (response.success) {
                        $('#totalTrabajadores').text(response.data.total);
                    } else {
                        $('#totalTrabajadores').text('Error');
                    }
                });

                // 2. Trabajadores de Vacaciones
                fetchData('http://localhost/crud_fetch/index.php/?api=trabajadoresEnVacaciones', function (response) {
                    if (response.success) {
                        $('#trabajadoresVacaciones').text(response.data.total);
                    } else {
                        $('#trabajadoresVacaciones').text('Error');
                    }
                });

                // 3. Trabajadores para Jubilarse
                fetchData('http://localhost/crud_fetch/index.php/?api=trabajadoresParaJubilarse', function (response) {
                    if (response.success) {
                        $('#trabajadoresJubilarse').text(response.data.total);
                    } else {
                        $('#trabajadoresJubilarse').text('Error');
                    }
                });

                // 4. Trabajadores por Coordinación
                fetchData('http://localhost/crud_fetch/index.php/?api=trabajadoresPorCoordinacion', function (response) {
                    if (response.success && response.data) {
                        const listaCoordinaciones = $('#listaCoordinaciones');
                        listaCoordinaciones.empty(); // Limpiar lista antes de añadir
                        response.data.forEach(function (item) {
                            listaCoordinaciones.append(
                                '<button class="list-group-item-action d-flex justify-content-between align-items-center ">'
                                + item.nombre_coordinacion + '<span class="fs-6 badge text-bg-dark text-white rounded-pill" >' + item.total + '</span>' +
                                '</button>');
                        });
                    } else {
                        $('#listaCoordinaciones').html('<li class="list-group-item text-danger">Error al cargar coordinaciones.</li>');
                    }
                });

                // 5. Trabajadores con Discapacidad
                fetchData('http://localhost/crud_fetch/index.php/?api=trabajadoresConDiscapacidad', function (response) {
                    if (response.success) {
                        $('#trabajadoresDiscapacidad').text(response.data.total);
                    } else {
                        $('#trabajadoresDiscapacidad').text('Error');
                    }
                });
                // 6. Ultimas personas contratadas
                fetchData('http://localhost/crud_fetch/index.php/?api=obtenerUltimosTrabajadores', function (response) {
                    if (response.success && response.data) {
                        const tablaUltimosTrabajadores = $('#ultimosTrabajadoresTableBody');
                        tablaUltimosTrabajadores.empty(); // Limpiar tabla antes de añadir
                        response.data.forEach(function (item) {
                            tablaUltimosTrabajadores.append(
                                '<tr>' +
                                '<td class="">' + item.horaRegistro + '</td>' +
                                '<td class="">' + item.cedula + '</td>' +
                                '<td class="">' + item.nombres + '</td>' +
                                '<td class="">' + item.apellidos + '</td>' +
                                '</tr>'
                            );
                        });
                    }
                })
                // Listener para el cuadro de "Trabajadores de Vacaciones"
                $('#trabajadoresVacaciones').closest('.card').on('click', function () {
                    $('#vacationModal').modal('show'); // Mostrar el modal de vacaciones

                    // Realizar la llamada AJAX para obtener los detalles de los trabajadores de vacaciones
                    // Asegúrate de que este endpoint devuelva 'fecha_inicio_vacaciones' y 'fecha_reintegro'
                    fetchData('http://localhost/crud_fetch/index.php/?api=listaTrabajadoresEnVacaciones', function (response) {
                        if (response.success && response.data) {
                            const vacationTableBody = $('#vacationTableBody');
                            vacationTableBody.empty(); // Limpiar la tabla antes de añadir nuevos datos
                            if (response.data.length > 0) {
                                response.data.forEach(function (worker) {
                                    vacationTableBody.append(
                                        '<tr>' +
                                        '<td>' + worker.nombre + '</td>' +
                                        '<td>' + worker.apellido + '</td>' +
                                        '<td>' + worker.cedula + '</td>' +
                                        '<td>' + worker.fecha_inicio_vacaciones + '</td>' + // Nuevo campo
                                        '<td>' + worker.fecha_reintegro + '</td>' +
                                        '<td>' + worker.tiempo_disfrutado + '</td>' +         // Nuevo campo
                                        '</tr>'
                                    );
                                });
                            } else {
                                vacationTableBody.append('<tr><td colspan="5" class="text-center">No hay trabajadores de vacaciones.</td></tr>');
                            }
                        } else {
                            $('#vacationTableBody').html('<tr><td colspan="5" class="text-danger text-center">Error al cargar la lista de vacaciones.</td></tr>');
                        }
                    });
                });
                // Listener para el cuadro de "Trabajadores Jubilables"
                $('#trabajadoresJubilarse').closest('.card').on('click', function () {
                    $('#retirementModal').modal('show'); // Mostrar el modal de jubilables

                    // Realizar la llamada AJAX para obtener los detalles de los trabajadores jubilables
                    fetchData('http://localhost/crud_fetch/index.php/?api=listaTrabajadoresParaJubilarse', function (response) {
                        if (response.success && response.data) {
                            const retirementTableBody = $('#retirementTableBody');
                            retirementTableBody.empty(); // Limpiar la tabla antes de añadir nuevos datos
                            if (response.data.length > 0) {
                                response.data.forEach(function (worker) {
                                    retirementTableBody.append(
                                        '<tr>' +
                                        '<td>' + worker.cedula + '</td>' +
                                        '<td>' + worker.nombre + '</td>' +
                                        '<td>' + worker.apellido + '</td>' +
                                        '<td>' + worker.edad + '</td>' +
                                        '<td>' + worker.años_servicio + '</td>' +
                                        '</tr>'
                                    );
                                });
                            } else {
                                retirementTableBody.append('<tr><td colspan="5" class="text-center">No hay trabajadores que cumplan la condición para ser jubilados.</td></tr>');
                            }
                        } else {
                            $('#retirementTableBody').html('<tr><td colspan="5" class="text-danger text-center">Error al cargar la lista de jubilables.</td></tr>');
                        }
                    });
                });
                // Listener para el cuadro de "Trabajadores Jubilables"
                $('#trabajadoresDiscapacidad').closest('.card').on('click', function () {
                    $('#discapacidadModal').modal('show'); // Mostrar el modal de jubilables

                    // Realizar la llamada AJAX para obtener los detalles de los trabajadores jubilables
                    fetchData('http://localhost/crud_fetch/index.php/?api=listaTrabajadoresConDiscapacidad', function (response) {
                        if (response.success && response.data) {
                            const discapacidadTableBody = $('#discapacidadTableBody');
                            discapacidadTableBody.empty(); // Limpiar la tabla antes de añadir nuevos datos
                            if (response.data.length > 0) {
                                response.data.forEach(function (worker) {
                                    discapacidadTableBody.append(
                                        '<tr>' +
                                        '<td>' + worker.cedula + '</td>' +
                                        '<td>' + worker.nombre + '</td>' +
                                        '<td>' + worker.apellido + '</td>' +
                                        '<td>' + worker.edad + '</td>' +
                                        '<td>' + worker.discapacidad + '</td>' +
                                        '</tr>'
                                    );
                                });
                            } else {
                                discapacidadTableBody.append('<tr><td colspan="5" class="text-center">No hay trabajadores con algun tipo de Discapacidad.</td></tr>');
                            }
                        } else {
                            $('#discapacidadTableBody').html('<tr><td colspan="5" class="text-danger text-center">Error al cargar la lista de trabajadores con Discapacidad.</td></tr>');
                        }
                    });
                });
            });
        </script>
</body>

</html>