<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Trabajadores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../Public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    
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
                        Elementos Administrador
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="fa-solid fa-file-excel pe-2"></i> Generar Reporte en Excel
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="fa-solid fa-file-pdf pe-2"></i> Generar un Reporte en PDF
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#pages" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-solid fa-boxes-stacked pe-2"></i> Módulos
                        </a>
                        <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Trabajadores</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Parientes</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link">
                                    <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="Cortesia">Cortesía</button>
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
            <nav class="navbar navbar-expand px-3 border-bottom" style="background-color: black;">
                <button class="btn border border-danger bg-light" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon "></span>
                </button>
                <div class="navbar-collapse navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <img src="../Public/img/logotipo.jpg" class="avatar img-fluid rounded" alt="Logotipo del FTTC">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item">Analista</a>
                                <a href="#" class="dropdown-item">Indicaciones</a> 
                                <a href="../Models/logout.php"class="dropdown-item">Salir</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        
        <div class="container mt-5">
            <h2 class="mb-4 text-center text-white">Dashboard de Trabajadores</h2>

            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total de Trabajadores</h5>
                            <p class="card-text display-4" id="totalTrabajadores">Cargando...</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">Trabajadores de Vacaciones</h5>
                            <p class="card-text display-4" id="trabajadoresVacaciones">Cargando...</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card bg-warning text-dark">
                        <div class="card-body">
                            <h5 class="card-title">Para Jubilarse</h5>
                            <p class="card-text display-4" id="trabajadoresJubilarse">Cargando...</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            Trabajadores por Coordinación
                        </div>
                        <div class="card-body">
                            <ul class="list-group" id="listaCoordinaciones">
                                </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            Trabajadores con Discapacidad
                        </div>
                        <div class="card-body">
                            <p class="card-text display-4" id="trabajadoresDiscapacidad">Cargando...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="../Public/dashBoard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            // Función genérica para hacer llamadas AJAX
            function fetchData(url, successCallback, errorCallback) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: successCallback,
                    error: function(xhr, status, error) {
                        console.error('Error fetching data from ' + url + ':', error);
                        if (errorCallback) errorCallback(xhr, status, error);
                    }
                });
            }

            // 1. Total de Trabajadores
            fetchData('http://localhost/crud_fetch/index.php/?api=totalTrabajadores', function(response) {
                if (response.success) {
                    $('#totalTrabajadores').text(response.data.total);
                } else {
                    $('#totalTrabajadores').text('Error');
                }
            });

            // 2. Trabajadores de Vacaciones
            fetchData('http://localhost/crud_fetch/index.php/?api=trabajadoresEnVacaciones', function(response) {
                if (response.success) {
                    $('#trabajadoresVacaciones').text(response.data.total);
                } else {
                    $('#trabajadoresVacaciones').text('Error');
                }
            });

            // 3. Trabajadores para Jubilarse
            fetchData('http://localhost/crud_fetch/index.php/?api=trabajadoresParaJubilarse', function(response) {
                if (response.success) {
                    $('#trabajadoresJubilarse').text(response.data.total);
                } else {
                    $('#trabajadoresJubilarse').text('Error');
                }
            });

            // 4. Trabajadores por Coordinación
            fetchData('http://localhost/crud_fetch/index.php/?api=trabajadoresPorCoordinacion', function(response) {
                if (response.success && response.data) {
                    const listaCoordinaciones = $('#listaCoordinaciones');
                    listaCoordinaciones.empty(); // Limpiar lista antes de añadir
                    response.data.forEach(function(item) {
                        listaCoordinaciones.append('<li class="list-group-item d-flex justify-content-between align-items-center">' +
                            item.coordinacion +
                            '<span class="badge badge-primary badge-pill">' + item.total + '</span>' +
                            '</li>');
                    });
                } else {
                    $('#listaCoordinaciones').html('<li class="list-group-item text-danger">Error al cargar coordinaciones.</li>');
                }
            });

            // 5. Trabajadores con Discapacidad
            fetchData('http://localhost/crud_fetch/index.php/?api=trabajadoresConDiscapacidad', function(response) {
                if (response.success) {
                    $('#trabajadoresDiscapacidad').text(response.data.total);
                } else {
                    $('#trabajadoresDiscapacidad').text('Error');
                }
            });
        });
    </script>
</body>
</html>