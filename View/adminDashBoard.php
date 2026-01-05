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
    <title>Mi Dashboard de Reportes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../Public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="wrapper">
        <aside id="sidebar" class="js-sidebar">
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="../index.php">FTTC</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Elementos Administrador
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#pages" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-solid fa-boxes-stacked pe-2"></i> Módulos
                        </a>
                        <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="/crud_fetch/View/indexTrabajador.html" class="sidebar-link">Trabajadores Sede PB</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="/crud_fetch/View/indexTrabajadorSotano.html" class="sidebar-link">Trabajadores Sede Sotano</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="/crud_fetch/View/indexParientes.html" class="sidebar-link">Parientes</a>
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
                                <a href="olvidoContraseña.php" class="sidebar-link">Olvidé la contraseña</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </aside>

        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom" style="background-color: black;">
                <button class="btn bg-light" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="col-md-11 text-center">
                    <h6 class="text-center text-white">FUNDACION TEATRO TERESA CARREÑO</h6>
                </div>
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

            <br>
            <div class="container-fluid text-center">
                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                    <input type="checkbox" class="btn-check " id="btncheck1" name="btncheck1" autocomplete="off">
                    <label class="btn btn-outline-dark fw-bold" for="btncheck1">Graficos Estadisticos</label>
                </div>
                <h1 class="mt-4 fw-bold col-md-12 " style="color:#F5F5DC"></h1>
                <hr>
                <h3 class="fw-bold display-6">Metricas Diarias</h3>
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-header bg-dark text-white fw-bold">Total Pacientes Cortesia</div>
                            <div class="card-body" id="cortesia">
                                <h5 class="card-title">XX.XXX</h5> <p class="card-text">Total de pacientes por cortesia atendidos.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-header bg-dark text-white fw-bold">Total Parientes</div>
                            <div class="card-body" id="parientes">
                                <h5 class="card-title">XX.XXX</h5> <p class="card-text">Total de Parientes atendidos</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-header bg-dark text-white fw-bold">Pacientes Hoy</div>
                            <div class="card-body" id="reporte">
                                <h5 class="card-title">XXX</h5> <p class="card-text">Número de pacientes atendidos en el día.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-info mb-3">
                            <div class="card-header bg-dark text-white fw-bold">Total Trabajadores</div>
                            <div class="card-body" id="trabajadores">
                                <h5 class="card-title">XX</h5> <p class="card-text">Total de Trabajadores atendidos.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <h2 class="fw-bold display-6">Datos filtrados por fechas</h2>
                <div class="row mb-4">
                    <div class="col-md-12 text-start">
                        <h4 class="fw-bold text-black" >Filtros Generales</h4>
                        <div class="row">
                            <form action="adminDashBoard.php" method="GET" class="row">
                                <div class="col-md-4">
                                    <label for="fechaInicio" class="form-label" style="color:#000000">Fecha Inicio:</label>
                                    <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" value="<?php echo htmlspecialchars($_GET['fechaInicio'] ?? date('Y-m-01')); ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="fechaFin" class="form-label" style="color:#000000">Fecha Fin:</label>
                                    <input type="date" class="form-control" id="fechaFin" name="fechaFin" value="<?php echo htmlspecialchars($_GET['fechaFin'] ?? date('Y-m-d')); ?>">
                                </div>
                                <div class="col-md-4 d-flex align-items-end">
                                    <button class="btn btn-dark w-100" type="submit" id="boton_filtro">Aplicar Filtros</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <hr>
                
<!---- Seccion de graficos con estadisticas generales--->
                <section id="estadisticasTotales" style="display:none">
                    <h2 class="fw-bold display-6">Estadisticas Totales</h2>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-header bg-dark text-white fw-bold display-6">Reporte Gráfico de Pacientes atendidos por Especialidades</div>
                                <div class="card-body" id="reporte1-container">
                                    <canvas id="myChart"></canvas>
                                    <button onclick="exportChartToExcel('myChart', 'Grafico_Especialidades')" class="btn btn-info mt-3">Exportar Gráfico</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-header bg-dark text-white fw-bold display-6">Reporte Gráfico de Pacientes atendidos por Doctores</div>
                                <div class="card-body" id="reporte2-container">
                                    <canvas id="myChart2"></canvas>
                                    <button onclick="exportChartToExcel('myChart2', 'Grafico_Doctores')" class="btn btn-info mt-3">Exportar Gráfico</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-header bg-dark text-white fw-bold display-6">Reporte Gráfico de Pacientes atendidos por Género</div>
                                <div class="card-body" id="reporte3-container">
                                    <canvas id="myChart3"></canvas>
                                    <button onclick="exportChartToExcel('myChart3', 'Grafico_Pacientes_Por_Genero')" class="btn btn-info mt-3">Exportar Gráfico</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-header bg-dark text-white fw-bold display-6">Reporte Gráfico de Pacientes atendidos por Edad</div>
                                <div class="card-body" id="reporte4-container">
                                    <canvas id="myChart4"></canvas>
                                    <button onclick="exportChartToExcel('myChart4', 'Grafico_Pacientes_Por_Edad')" class="btn btn-info mt-3">Exportar Gráfico</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-header bg-dark text-white fw-bold display-6">Reporte por mes de pacientes visto por cortesia</div>
                                <div class="card-body" id="reporte7-container">
                                    <canvas id="myChart7"></canvas>
                                    <button onclick="exportChartToExcel('myChart7', 'Grafico_Pacientes_Por_Cortesia')" class="btn btn-info mt-3">Exportar Gráfico</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-header bg-dark text-white fw-bold display-6">Reporte por mes de Parientes atendidos</div>
                                <div class="card-body" id="reporte6-container">
                                    <canvas id="myChart6"></canvas>
                                    <button onclick="exportChartToExcel('myChart6', 'Grafico_Total_Parientes_Por_Mes')" class="btn btn-info mt-3">Exportar Gráfico</button>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="card">
                                <div class="card-header bg-dark text-white fw-bold display-6">Reporte por mes de trabajadores atendidos</div>
                                <div class="card-body" id="reporte5-container">
                                    <canvas id="myChart5"></canvas>
                                    <button onclick="exportChartToExcel('myChart5', 'Grafico_Total_Trabajadores_Por_Mes')" class="btn btn-info mt-3">Exportar Gráfico</button>
                                </div>
                            </div>
                        </div>
                    <hr>
                    <h3 class="fw-bold display-6">Metricas por Fecha</h3>
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-header bg-dark text-white fw-bold">Total Pacientes Cortesia</div>
                            <div class="card-body" id="cortesiaFiltrado">
                                <h5 class="card-title">XX.XXX</h5> <p class="card-text">Pacientes por cortesia atendidos.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-header bg-dark text-white fw-bold">Total Parientes</div>
                            <div class="card-body" id="parientesFiltrado">
                                <h5 class="card-title">XX.XXX</h5> <p class="card-text">Parientes atendidos</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-header bg-dark text-white fw-bold">Pacientes </div>
                            <div class="card-body" id="pacientesFiltrado">
                                <h5 class="card-title">XXX</h5> <p class="card-text">Total Pacientes atendidos</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-info mb-3">
                            <div class="card-header bg-dark text-white fw-bold">Total Trabajadores</div>
                            <div class="card-body" id="trabajadoresFiltrado">
                                <h5 class="card-title">XX</h5> <p class="card-text">Trabajadores atendidos.</p>
                            </div>
                        </div>
                    </div>
                </section>
<!------ seccion de las tablas con filtrado ---->
                <section id="datosFiltradoPorFechas">
                    
<!------ Tabla de clasificacion de pacientes por edad ---->
                        <div class="col-md-12 mb-4">
                            <div class="card">
                                <div class="card-header bg-success text-black fw-bold display-6">Clasificación de Pacientes por Edad</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Clasificación de Edad</th>
                                                    <th>Rango de Edad</th>
                                                    <th>Número de Pacientes</th>
                                                    <th>Porcentaje del Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="ageClassificationTableBody">
                                                </tbody>
                                        </table>
                                    </div>
                                    <div class="card-body">
                                        <button onclick="exportTableToExcel('ageClassificationTableBody', 'Reporte_Edad')" class="btn btn-success mt-3">Exportar Tabla a Excel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
<!----- Tabla de pacientes atendidos por patologia --->
                        <div class="col-md-12 mb-4">
                            <div class="card">
                                <div class="card-header bg-dark text-info fw-bold display-6">Pacientes atendidos por Patologías</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Patologia</th>
                                                    <th>Numero de Pacientes</th>
                                                    <th>Porcentaje del Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="patologiaTableBody">
                                                </tbody>
                                        </table>
                                    </div>
                                    <div class="card-body">
                                        <button onclick="exportTableToExcel('patologiaTableBody', 'Reporte_Patologias')" class="btn btn-dark mt-3">Exportar Tabla a Excel</button>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <hr>
<!--- Tabla de pacientes atendidos por coordinaciones --->
                        <div class="col-md-12 mb-4">
                            <div class="card">
                                <div class="card-header bg-warning text-black fw-bold display-6">Trabajadores atendidos por Coordinacion</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Coordinacion</th>
                                                    <th>Numero de Pacientes</th>
                                                    <th>Porcentaje del Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="coordinacionTableBody">
                                                </tbody>
                                        </table>
                                    </div>
                                    <div class="card-body">
                                        <button onclick="exportTableToExcel('coordinacionTableBody', 'Reporte_Coordinacion')" class="btn btn-warning mt-3">Exportar Tabla a Excel</button>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!-- Tabla parientes atendidos por coordinacion -->
                        <div class="col-md-12 mb-4">
                            <div class="card">
                                <div class="card-header bg-primary text-black fw-bold display-6">Parientes atendidos por Coordinacion</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Coordinacion del Titular</th>
                                                    <th>Numero de Pacientes</th>
                                                    <th>Porcentaje del Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="coordinacionParienteTableBody">
                                                </tbody>
                                        </table>
                                    </div>
                                    <div class="card-body">
                                        <button onclick="exportTableToExcel('coordinacionParienteTableBody', 'Reporte_Coordinacion')" class="btn btn-primary mt-3">Exportar Tabla a Excel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!-- Tabla parientes atendidos por coordinacion -->
                        <div class="col-md-12 mb-4">
                            <div class="card">
                                <div class="card-header bg-danger text-black fw-bold display-6">Pacientes por Cortesia</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Origen de la Cortesia</th>
                                                    <th>Numero de Pacientes</th>
                                                    <th>Porcentaje del Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="institucionCortesiaTableBody">
                                                </tbody>
                                        </table>
                                    </div>
                                    <div class="card-body">
                                        <button onclick="exportTableToExcel('institucionCortesiaTableBody', 'Reporte_Cortesia')" class="btn btn-danger   mt-3">Exportar Tabla a Excel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                

                <a href="#" class="theme-toggle">
                    <i class="fa-regular fa-moon"></i>
                    <i class="fa-regular fa-sun"></i>
                </a>

                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row text-muted">
                            <div class="col-6 text-start">
                                <p class="mb-0">
                                    <a href="#" class="text-muted">
                                        <strong>RacokVz</strong>
                                    </a>
                                </p>
                            </div>
                            <div class="col-6 text-end">
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a href="#" class="text-muted">Contacto</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" class="text-muted">Sobre Nosotros</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" class="text-muted">Términos</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" class="text-muted">Reservas</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-to-image/dist/chartjs-to-image.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../Public/dashBoard.js"></script>
    <script defer>
        
        $('input[name="btncheck1"]').change(function(){
            $('#estadisticasTotales').toggle(100);
        });


        

        async function exportChartToExcel(chartID, filename) {
            const canvas = document.getElementById(chartID);
            if (!canvas) {
                console.error(`Canvas con el ID "${chartID}" no encontrado.`);
                return;
            }

            // Convertir el gráfico a una imagen
            const imgData = canvas.toDataURL('image/png');

            // Crear un nuevo libro de trabajo de Excel
            const wb = XLSX.utils.book_new();
            const ws = XLSX.utils.aoa_to_sheet([['Reporte Gráfico']]);
            
            // Agregar la imagen al archivo (esta parte es más compleja y SheetJS no la maneja directamente para imágenes binarias)
            // Para simplificar, descargaremos la imagen directamente
            const a = document.createElement('a');
            a.href = imgData;
            a.download = filename + '.png';
            a.click();
        }

        function exportTableToExcel(tableID, filename) {
            const table = document.getElementById(tableID);
            if (!table) {
                console.error(`Tabla con el ID "${tableID}" no encontrada.`);
                return;
            }

            const ws = XLSX.utils.table_to_sheet(table);
            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "Reporte");
            XLSX.writeFile(wb, filename + '.xlsx');
        }

        const fechaInicioElementChart = document.getElementById('fechaInicio');
        const fechaFinElementChart = document.getElementById('fechaFin');
        const filterButtonChart = document.getElementById('boton_filtro');

        // Function to fetch and render the chart
        var fetchAndRenderChart = () => {
            // Get the values from the date input fields
            const fechaInicio = fechaInicioElementChart.value;
            const fechaFin = fechaFinElementChart.value;

            // Use these values in the fetch URL
            fetch(`http://localhost/crud_fetch/Models/reportSpeciality.php?fechaInicio=${fechaInicio}&fechaFin=${fechaFin}`)
                .then(response => {
                    // Check if the response is ok
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Check for success status from the backend
                    if (data.status === 'success') {
                        mostrar(data.data); // Pass the data array to the display function
                    } else {
                        console.error('Error from backend:', data.mensaje);
                    }
                })
                .catch(error => console.error('Error fetching data:', error));
        };

        // Function to update the chart with new data
        const mostrar = (data) => {
            const labels = data.map(element => element.especialidades);
            const values = data.map(element => element.total);

            myChart.data.labels = labels;
            myChart.data.datasets[0].data = values;
            myChart.update();
        };
        

        // Initialize the chart
        const ctx = document.getElementById('myChart');
        let myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    font: {
                        size: 15,
                        weight: 'bold',
                        family: 'Poppins'
                    },
                    label: 'Personas Atendidas por Especialidades',
                    data: [],
                    backgroundColor: ['#F35050', 'pink', 'aquamarine', '#509c7f', '#34444c', '#90CAF9', '#64B5F6', '#2196F3', '#0D47A1', 'red', 'purple', 'Yellow'],
                    borderColor: ['black'],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'N° PACIENTES ATENDIDOS POR ESPECIALIDADES',
                        color: 'black',
                        position: 'top',
                        family: 'poppins'
                    },
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            color: 'black',
                            font: {
                                size: 15,
                                weight: 'bold',
                                family: 'Poppins'
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Attach event listener to the filter button
        filterButtonChart.addEventListener('click', fetchAndRenderChart);

        // Initial chart load
        fetchAndRenderChart();

//------GRAFICO DE CUANTOS PACIENTES HAN SIDO ATENDIDOS POR DOCTOR-----//
        
        // Function to fetch and render the chart
        var fetchAndRenderChart = () => {
            // Get the values from the date input fields
            const fechaInicio = fechaInicioElementChart.value;
            const fechaFin = fechaFinElementChart.value;

            // Use these values in the fetch URL
            fetch(`http://localhost/crud_fetch/Models/reportDoctor.php?fechaInicio=${fechaInicio}&fechaFin=${fechaFin}`)
                .then(response => {
                    // Check if the response is ok
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Check for success status from the backend
                    if (data.status === 'success') {
                        mostrar1(data.data); // Pass the data array to the display function
                    } else {
                        console.error('Error from backend:', data.mensaje);
                    }
                })
                .catch(error => console.error('Error fetching data:', error));
        };

        // Function to update the chart with new data
        const mostrar1 = (data) => {
            const labels1 = data.map(element => element.doctores);
            const values1 = data.map(element => element.total);

            myChart1.data.labels = labels1;
            myChart1.data.datasets[0].data = values1;
            myChart1.update();
        };

        //ESTE CHART SE ENCARGA DE TRAER ATRAVES DE FETCH AL ARCHIVO reportDoctor.php
        const ctx2 = document.getElementById('myChart2')
        let myChart1 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: [], // Array de etiquetas vacío al inicio
                datasets: [{
                    font:{
                        size: 15,
                        weight: 'bold',
                        family: 'Poppins'
                    },
                    label: 'Pacientes Atendidos por Doctor',
                    data: [], // Array de datos vacío al inicio
                    backgroundColor: ['#F35050','pink', 'aquamarine', '#509c7f', '#34444c', '#90CAF9','#64B5F6','#2196F3','#0D47A1','red','purple','Yellow'],
                    borderColor: ['black'],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    title:{
                        display: true,
                        text: 'N° PACIENTES ATENDIDOS POR DOCTORES',
                        color: 'black',
                        position:'top',
                        family:'poppins'
                    },
                    
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        
        // Attach event listener to the filter button
        filterButtonChart.addEventListener('click', fetchAndRenderChart);

        // Initial chart load
        fetchAndRenderChart();

        //ESTE CHART SE ENCARGA DE TRAER ATRAVES DE FETCH AL ARCHIVO reportSex.php
        // Function to fetch and render the chart
        var fetchAndRenderChart = () => {
            // Get the values from the date input fields
            const fechaInicio = fechaInicioElementChart.value;
            const fechaFin = fechaFinElementChart.value;

            // Use these values in the fetch URL
            fetch(`http://localhost/crud_fetch/Models/reportSex.php?fechaInicio=${fechaInicio}&fechaFin=${fechaFin}`)
                .then(response => {
                    // Check if the response is ok
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Check for success status from the backend
                    if (data.status === 'success') {
                        mostrar2(data.data); // Pass the data array to the display function
                    } else {
                        console.error('Error from backend:', data.mensaje);
                    }
                })
                .catch(error => console.error('Error fetching data:', error));
        };

        // Function to update the chart with new data
        const mostrar2 = (data) => {
            const labels2 = data.map(element => element.sexo);
            const values2 = data.map(element => element.total);

            myChart3.data.labels = labels2;
            myChart3.data.datasets[0].data = values2;
            myChart3.update();
        };

        const ctx3 = document.getElementById('myChart3');

        var myChart3 = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    font:{
                        size: 12,
                        weight: 'bold',
                        family: 'Poppins'
                    },
                    label:'N° de Personas Atentidas por genero: '+' Masculino '+' Femenino',
                    data: [],
                    backgroundColor: ['blue','pink','#E4CD4C','#81ED63','#57D2C1','#C2A1B9','#5F1121','#F90133','#2B2882','#541C81', 'aquamarine', '#509c7f', '#34444c', '#90CAF9','#64B5F6','#2196F3','#0D47A1','red','purple','Yellow'],
                    borderColor: ['black'],
                    showLabelBackdrop: true,
                    textStrokeWidth: 1,
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend:{
                        display: true,
                    },
                    title: {
                    display: true,
                    text: 'Personas atentidas segun su Genero',
                    color: 'black',
                    family:'poppins',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Attach event listener to the filter button
        filterButtonChart.addEventListener('click', fetchAndRenderChart);

        // Initial chart load
        fetchAndRenderChart();
    

//-----ESTE CHART SE ENCARGA DE LLAMAR ATRAVES DE FETCH AL ARCHIVO reportAgeChat.php----------//
             // Function to fetch and render the chart
            var fetchAndRenderChart = () => {
                // Get the values from the date input fields
                const fechaInicio = fechaInicioElementChart.value;
                const fechaFin = fechaFinElementChart.value;

                // Use these values in the fetch URL
                fetch(`http://localhost/crud_fetch/Models/reportAgeChart.php?fechaInicio=${fechaInicio}&fechaFin=${fechaFin}`)
                    .then(response => {
                        // Check if the response is ok
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Check for success status from the backend
                        if (data.status === 'success') {
                            mostrar3(data.data); // Pass the data array to the display function
                        } else {
                            console.error('Error from backend:', data.mensaje);
                        }
                    })
                    .catch(error => console.error('Error fetching data:', error));
            };

            // Function to update the chart with new data
            const mostrar3 = (data) => {
                const labels3 = data.map(element => element.edad);
                const values3 = data.map(element => element.total);

                myChart4.data.labels = labels3;
                myChart4.data.datasets[0].data = values3;
                myChart4.update();
            };

            const ctx4 = document.getElementById('myChart4');
            var myChart4 = new Chart(ctx4, { // Inicializa el gráfico sin datos inicialmente
                type: 'bar',
                data: {
                    labels: [], // Array de etiquetas vacío al inicio
                    datasets: [{
                        font:{
                            size: 15,
                            weight: 'bold',
                            family: 'Poppins'
                        },
                        label: 'Pacientes atentidos por rango de edad',
                        data: [], // Array de datos vacío al inicio
                        backgroundColor: ['#F35050','pink', 'aquamarine', '#509c7f', '#34444c', '#90CAF9','#64B5F6','#2196F3','#0D47A1','red','purple','Yellow'],
                        borderColor: ['black'],
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        title:{
                            display: true,
                            text: 'Total de pacientes atentidos por rango de edad',
                            color: 'black',
                            position:'top',
                            family:'poppins'
                        },
                        legend:{
                            display:true,
                            position:'bottom',
                            labels:{
                                color:'black',
                                font:{
                                    size: 15,
                                    weight: 'bold',
                                    family: 'Poppins'
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Attach event listener to the filter button
            filterButtonChart.addEventListener('click', fetchAndRenderChart);

            // Initial chart load
            fetchAndRenderChart();

//-------------ESTE CHART SE ENCARGA DE TRAER ATRAVES DE FETCH AL ARCHIVO reportMensualChartTrabajadores.php-------//
            const ctxTrabajadores = document.getElementById('myChart5');
            let myChart5 = new Chart(ctxTrabajadores, { // Inicializa el gráfico sin datos inicialmente
                type: 'bar',
                data: {
                    labels: [], // Array de etiquetas vacío al inicio
                    datasets: [{
                        font:{
                            size: 15,
                            weight: 'bold',
                            family: 'Poppins'
                        },
                        label: 'Trabajadores Atentidas por Mes',
                        data: [], // Array de datos vacío al inicio
                        backgroundColor: ['#F35050','pink', 'aquamarine', '#509c7f', '#34444c', '#90CAF9','#64B5F6','#2196F3','#0D47A1','red','purple','Yellow'],
                        borderColor: ['black'],
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        title:{
                            display: true,
                            text: 'N° Trabajadores Atendidos',
                            color: 'black',
                            position:'top',
                            family:'poppins'
                        },
                        legend:{
                            display:true,
                            position:'bottom',
                            labels:{
                                color:'black',
                                font:{
                                    size: 15,
                                    weight: 'bold',
                                    family: 'Poppins'
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            fetch('../Models/reportMensualChartTrabajadores.php')
                .then(response => response.json() )
                .then(data => mostrar5(data) )
                .catch(error => console.log(error) );

                const mostrar5 = (data) => {
                    const labelsTrabajadores = data.map(element => element.mes); //Haciendo uso de la funcion map() creamos un array de los labels y se asignan a una const 
                    const valuesTrabajadores = data.map(element => element.total_pacientes)//Se crea un array haciendo uso de la funcion map() y dicho array contiene la data (JSON) y se almacena en una const
                    myChart5.data['labels'] = labelsTrabajadores;//Se asigna el array a las etiquetas del grafico
                    myChart5.data['datasets'][0]['data'] = valuesTrabajadores;// Se asigna el array a los datos del grafico
                    myChart5.update();//Se actualiza el grafico una sola vez
                };
            //ESTE CHART SE ENCARGA DE TRAER ATRAVES DE FETCH AL ARCHIVO reportMensualChartParientes.php
            const ctxParientes = document.getElementById('myChart6');
            let myChart6 = new Chart(ctxParientes, { // Inicializa el gráfico sin datos inicialmente
                type: 'bar',
                data: {
                    labels: [], // Array de etiquetas vacío al inicio
                    datasets: [{
                        font:{
                            size: 15,
                            weight: 'bold',
                            family: 'Poppins'
                        },
                        label: 'Parientes Atentidos por Mes',
                        data: [], // Array de datos vacío al inicio
                        backgroundColor: ['#F35050','pink', 'aquamarine', '#509c7f', '#34444c', '#90CAF9','#64B5F6','#2196F3','#0D47A1','red','purple','Yellow'],
                        borderColor: ['black'],
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        title:{
                            display: true,
                            text: 'N° Parientes Atendidos',
                            color: 'black',
                            position:'top',
                            family:'poppins'
                        },
                        legend:{
                            display:true,
                            position:'bottom',
                            labels:{
                                color:'black',
                                font:{
                                    size: 15,
                                    weight: 'bold',
                                    family: 'Poppins'
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            fetch('../Models/reportMensualChartParientes.php')
                .then(response => response.json() )
                .then(data => mostrar6(data) )
                .catch(error => console.log(error) );

                const mostrar6 = (data) => {
                    const labelsParientes = data.map(element => element.mes); //Haciendo uso de la funcion map() creamos un array de los labels y se asignan a una const 
                    const valuesParientes = data.map(element => element.total_pacientes)//Se crea un array haciendo uso de la funcion map() y dicho array contiene la data (JSON) y se almacena en una const
                    myChart6.data['labels'] = labelsParientes;//Se asigna el array a las etiquetas del grafico
                    myChart6.data['datasets'][0]['data'] = valuesParientes;// Se asigna el array a los datos del grafico
                    myChart6.update();//Se actualiza el grafico una sola vez
                };
            //ESTE CHART SE ENCARGA DE TRAER ATRAVES DE FETCH AL ARCHIVO reportMensualChartParientes.php
            const ctxCortesia = document.getElementById('myChart7');
            let myChart7 = new Chart(ctxCortesia, { // Inicializa el gráfico sin datos inicialmente
                type: 'bar',
                data: {
                    labels: [], // Array de etiquetas vacío al inicio
                    datasets: [{
                        font:{
                            size: 15,
                            weight: 'bold',
                            family: 'Poppins'
                        },
                        label: 'Pacientes por Cortesia atendidos al Mes',
                        data: [], // Array de datos vacío al inicio
                        backgroundColor: ['#F35050','pink', 'aquamarine', '#509c7f', '#34444c', '#90CAF9','#64B5F6','#2196F3','#0D47A1','red','purple','Yellow'],
                        borderColor: ['black'],
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        title:{
                            display: true,
                            text: 'N° Pacientes Por Cortesia Atendidos',
                            color: 'black',
                            position:'top',
                            family:'poppins',
                            size:20
                        },
                        legend:{
                            display:true,
                            position:'bottom',
                            labels:{
                                color:'black',
                                font:{
                                    size: 15,
                                    weight: 'bold',
                                    family: 'Poppins'
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            fetch('../Models/reportMensualChartCortesia.php')
                .then(response => response.json() )
                .then(data => mostrar7(data) )
                .catch(error => console.log(error) );

                const mostrar7 = (data) => {
                    const labelsCortesia = data.map(element => element.mes); //Haciendo uso de la funcion map() creamos un array de los labels y se asignan a una const 
                    const valuesCortesia = data.map(element => element.total_pacientes)//Se crea un array haciendo uso de la funcion map() y dicho array contiene la data (JSON) y se almacena en una const
                    myChart7.data['labels'] = labelsCortesia;//Se asigna el array a las etiquetas del grafico
                    myChart7.data['datasets'][0]['data'] = valuesCortesia;// Se asigna el array a los datos del grafico
                    myChart7.update();//Se actualiza el grafico una sola vez
                };

        // Fin de la section de graficos //
            
            // dashBoard.js
            const fechaInicioElementAge = document.getElementById('fechaInicio');
            const fechaFinElementAge = document.getElementById('fechaFin');
            const filterButtonAge = document.getElementById('boton_filtro'); 

            // Función para obtener los datos de la API y renderizar la tabla
            async function loadAgeClassificationData() {

                // Selecciona el tbody de la tabla donde se insertarán las filas
                const tableBody = document.getElementById('ageClassificationTableBody');
                tableBody.innerHTML = '';

                
                // **Lectura de fechas en cada llamada**
                let fechaInicio = fechaInicioElementAge ? fechaInicioElementAge.value : '';
                let fechaFin = fechaFinElementAge ? fechaFinElementAge.value : ''; 
                        // Asigna valores por defecto si los campos están vacíos
                if (!fechaInicio) {
                    const today = new Date();
                    fechaInicio = today.getFullYear() + '-' + (today.getMonth() + 1).toString().padStart(2, '0') + '-01';
                }
                if (!fechaFin) {
                    const today = new Date();
                    fechaFin = today.getFullYear() + '-' + (today.getMonth() + 1).toString().padStart(2, '0') + '-' + today.getDate().toString().padStart(2, '0');
                }
                
                try {
                    // Realiza la llamada a tu API PHP
                    // Asegúrate de que esta URL sea la correcta para tu endpoint PHP
                    // Si tu archivo PHP está en 'htdocs/crud_fetch/Controllers/tu_archivo_api.php',
                    // la URL en el frontend debería apuntar a ese lugar, por ejemplo:
                    // const response = await fetch('/crud_fetch/Controllers/tu_archivo_api.php');
                    // Limpia cualquier contenido previo en la tabla, útil si se recargan los datos
                    
                    const response = await fetch(`http://localhost/crud_fetch/Models/reportAge.php?fechaInicio=${fechaInicio}&fechaFin=${fechaFin}`); // Reemplaza con la ruta correcta a tu archivo PHP
                    console.log(response)
                    if (!response.ok) {
                        console.log(`Error HTTP: ${response.status}`);
                        throw new Error(`Error HTTP: ${response.status}`);
                    }
                    const result = await response.json(); // Asume que la API devuelve JSON
                    

                    if (result.status === 'success' && result.data) {
                        const ageData = result.data; // Los datos clasificados de tu PHP
                        
                        

                        // Calcular el total general para los porcentajes
                        const totalRegistros = ageData.ninos + ageData.adolescentes + ageData.adultos + ageData.adultos_mayores;

                        
                        // Define las categorías y sus rangos como se manejan en tu backend PHP
                        const categories = [
                            { classification: "Niños", range: "0 - 12 años", key: "ninos" },
                            { classification: "Adolescentes", range: "13 - 17 años", key: "adolescentes" },
                            { classification: "Adultos", range: "18 - 64 años", key: "adultos" },
                            { classification: "Adultos Mayores", range: "65 años en adelante", key: "adultos_mayores" }
                        ];

                        // Itera sobre las categorías definidas y rellena la tabla
                        categories.forEach(category => {
                            
                            const count = ageData[category.key];
                           
                            // Calcula el porcentaje. Evita división por cero si no hay registros.
                            const percentage = totalRegistros > 0 ? (count / totalRegistros) * 100 : 0;

                            const row = tableBody.insertRow(); // Crea una nueva fila <tr>

                            // Inserta las celdas <td> con los datos
                            const cell1 = row.insertCell();
                            cell1.textContent = category.classification;

                            const cell2 = row.insertCell();
                            cell2.textContent = category.range;

                            const cell3 = row.insertCell();
                            cell3.textContent = count;

                            const cell4 = row.insertCell();
                            cell4.textContent = `${percentage.toFixed(2)}%`; // Formato de porcentaje con 2 decimales

                            
                            
                        });
                        

                    } else {
                        console.error("API Error:", result.mensaje || "Datos no disponibles o estado no exitoso.");
                        tableBody.innerHTML = `<tr><td colspan="4" class="text-danger">No se pudieron cargar los datos de clasificación por edad.</td></tr>`;
                    }

                } catch (error) {
                    console.error("Error al cargar los datos de clasificación por edad:", error);
                    // Mostrar un mensaje de error en la UI
                    tableBody.innerHTML = `<tr><td colspan="4" class="text-danger">Error al conectar con el servidor de datos.</td></tr>`;
                }   
            }
            // Manejador del botón de filtro
            if (filterButtonAge) {
                filterButtonAge.addEventListener('click', (event) => {
                    event.preventDefault();
                    
                    loadAgeClassificationData(); // Carga la tabla de clasificación por edad
                });
            }
            
            // Llama a la función cuando el DOM esté completamente cargado
            document.addEventListener('DOMContentLoaded', () => {
                
                loadAgeClassificationData();
                
                // Aquí inicializarías tus otros gráficos de Chart.js
                // Ejemplo:
                // initMyChart();
                // initMyChart2();
                // initMyChart3();

                
            });
            
        
    </script>
    <script defer>
    //GET THE ID WHERE WE SHOW THE DATA FROM SCRIPT PHP PARIENTES
    const resultadoParientes = document.getElementById('parientes');
    
    resultadoParientes.innerHTML = '<div class="spinner-border text-dark" role="status"><span class="visually-hidden">Cargando Informacion...</span></div>';

    fetch('../Models/dailyReport_controller.php')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'error') {
                resultadoParientes.innerHTML =  `<h4 class='text-danger fw-bold'>${data.mensaje}</h4>`;
            } else if (data.status === 'success') {
                resultadoParientes.innerHTML = `
                    <h3 class="fw-bold text-center"> ${data.totalParientes} </h3><br>
                    <h4 class='fw-bold'> Total Parientes Atendidos </h4>
                    `;
            }
        })
        .catch(error => {
            console.error('Error al obtener los datos:', error);
            document.getElementById('parientes').textContent = `<h4 class='text-danger fw-bold' Error al cargar los datos </h4>`;
        });

        // GET THE ID WHERE WE SHOW THE DATA FROM SCRIPT PHP TRABAJADORES
        const resultadoTrabajadores = document.getElementById('trabajadores');
        resultadoTrabajadores.innerHTML = '<div class="spinner-border" role="status"><span class="visually-hidden">Cargando Informacion...</span></div>';
        
        fetch('../Models/dailyReport_controller.php') // URL FROM CATCH THE DATA 
            .then(response => response.json())
            .then(data =>{
                //
                if(data.status==='error'){
                    resultadoTrabajadores.innerHTML = `<h4 class='text-danger fw-bold'>${data.mensaje}</h4>`;

                }else if(data.status === 'success'){
                    resultadoTrabajadores.innerHTML = `
                        <h3 class="fw-bold text-center"> ${data.totalTrabajadores} </h3><br>
                        <h4 class='fw-bold'> Total Trabajadores Atendidos </h4>
                        `;
                }

            })
        .catch(error=>{
            console.error('Error al obtener los datos:', error);
            document.getElementById('trabajadores').textContent = `<h4 class='text-danger fw-bold' Error al cargar los datos </h4>`;
        })

        // GET THE ID WHERE WE SHOW THE DATA FROM SCRIPT PHP TRABAJADORES
        const resultadoPacientes = document.getElementById('reporte');
        resultadoPacientes.innerHTML = '<div class="spinner-border" role="status"><span class="visually-hidden">Cargando Informacion...</span></div>';
        
        fetch('../Models/dailyReport_controller.php') // URL FROM CATCH THE DATA 
            .then(response => response.json())
            .then(data =>{
                //
                if(data.status==='error'){
                    resultadoPacientes.innerHTML = `<h4 class='text-danger fw-bold'>${data.mensaje}</h4>`;

                }else if(data.status === 'success'){
                    resultadoPacientes.innerHTML = `
                        <h3 class="fw-bold text-center"> ${data.totalPacientes} </h3><br>
                        <h4 class='fw-bold'> Total Pacientes Atendidos </h4>
                        `;
                }

            })
        .catch(error=>{
            console.error('Error al obtener los datos:', error);
            document.getElementById('trabajadores').textContent = `<h4 class='text-danger fw-bold' Error al cargar los datos </h4>`;
        })


        // GET THE ID WHERE WE SHOW THE DATA FROM SCRIPT PHP PARIENTES
        const resultadoCortesia = document.getElementById('cortesia');
        //ADD AN SPINNER WHILE THE DOM LOADING
        resultadoCortesia.innerHTML = '<div class="spinner-border" role="status"><span class="visually-hidden">Cargando Informacion...</span></div>';

        fetch('../Models/dailyReport_controller.php') // URL FROM CATCH THE DATA 
            .then(response => response.json())
            .then(data => {
            //TRY TO VERIFICATE WHAT TYPE OF RESPONSE WE RECEIVE FROM THE SCRIPT dailyReport_controller. status is a array
            if (data.status ==='error'){
                resultadoCortesia.innerHTML = `<h4 class='text-danger fw-bold'>${data.mensaje}</h4>`;
                //IN OTHERWISE IN CASE STATUS SEND BE 'SUCCESS' THE CODE EXECUTE
            }else if(data.status === 'success'){
                resultadoCortesia.innerHTML = `
                    <h3 class="fw-bold text-center"> ${data.totalCortesia} </h3><br>
                    <h4 class='fw-bold'> Total Pacientes por Cortesia </h4>
                    `;
            }
            })
        .catch(error => {
            console.error('Error al obtener los datos:', error);
            document.getElementById('cortesia').textContent = `<h4 class='text-danger fw-bold' Error al cargar los datos </h4>`;
        });
    </script>
    <script>
    // This function will handle the data fetching and UI updates
    async function updateGeneralReport() {
        const fechaInicioElementGeneral = document.getElementById('fechaInicio');
        const fechaFinElementGeneral = document.getElementById('fechaFin');
        const fechaInicio = fechaInicioElementGeneral.value;
        const fechaFin = fechaFinElementGeneral.value;
        const resultadoParientesGeneral = document.getElementById('parientesFiltrado');
        const resultadoTrabajadoresGeneral = document.getElementById('trabajadoresFiltrado');
        const resultadoPacientesGeneral = document.getElementById('pacientesFiltrado');
        const resultadoCortesiaGeneral = document.getElementById('cortesiaFiltrado');

        try {
            // 1. Show spinners immediately before starting the fetch
            resultadoParientesGeneral.innerHTML = '<div class="spinner-border text-dark" role="status"><span class="visually-hidden">Cargando Informacion...</span></div>';
            resultadoTrabajadoresGeneral.innerHTML = '<div class="spinner-border text-dark" role="status"><span class="visually-hidden">Cargando Informacion...</span></div>';
            resultadoPacientesGeneral.innerHTML = '<div class="spinner-border text-dark" role="status"><span class="visually-hidden">Cargando Informacion...</span></div>';
            resultadoCortesiaGeneral.innerHTML = '<div class="spinner-border text-dark" role="status"><span class="visually-hidden">Cargando Informacion...</span></div>';

            // 2. Perform the fetch request
            const response = await fetch(`http://localhost/crud_fetch/Models/generalReport.php?fechaInicio=${fechaInicio}&fechaFin=${fechaFin}`);
            
            // Check if the network request was successful
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();


            // 3. Update the UI with fetched data
            if (data.status === 'success') {
                console.log(`en caso de data status sea 'success' ${data.totalPacientes}`)
                    resultadoParientesGeneral.innerHTML = `<h3 class="fw-bold text-center"> ${data.totalParientes} </h3><br><h4 class='fw-bold'> Total Parientes Atendidos </h4>`;
                    resultadoTrabajadoresGeneral.innerHTML = `<h3 class="fw-bold text-center"> ${data.totalTrabajadores} </h3><br><h4 class='fw-bold'> Total Trabajadores Atendidos </h4>`;
                    resultadoPacientesGeneral.innerHTML = `<h3 class="fw-bold text-center"> ${data.totalPacientes} </h3><br><h4 class='fw-bold'> Total Pacientes Atendidos </h4>`;
                    resultadoCortesiaGeneral.innerHTML = `<h3 class="fw-bold text-center"> ${data.totalCortesia} </h3><br><h4 class='fw-bold'> Total Pacientes por Cortesia </h4>`;
            } else {
                const errorMessage = `<h4 class='text-danger fw-bold'>${data.mensaje || 'No hay datos disponibles'}</h4>`;
                resultadoParientesGeneral.innerHTML = errorMessage;
                resultadoTrabajadoresGeneral.innerHTML = errorMessage;
                resultadoPacientesGeneral.innerHTML = errorMessage;
                resultadoCortesiaGeneral.innerHTML = errorMessage;
            }

        } catch (error) {
            console.error('Error al obtener los datos:', error);
            const errorMessage = `<h4 class='text-danger fw-bold'>Error al cargar los datos </h4>`;
            resultadoParientesGeneral.innerHTML = errorMessage;
            resultadoTrabajadoresGeneral.innerHTML = errorMessage;
            resultadoPacientesGeneral.innerHTML = errorMessage;
            resultadoCortesiaGeneral.innerHTML = errorMessage;
        }
    }

// Event listener for the filter button, placed outside the function
document.addEventListener('DOMContentLoaded', () => {
    const filterButton = document.getElementById('boton_filtro');
    
    // Call the function once when the page loads to show initial data
    updateGeneralReport();
    
    if (filterButton) {
        filterButton.addEventListener('click', (event) => {
            event.preventDefault();
            updateGeneralReport();
        });
    }
});

    

    </script>

    <script defer>
    // Variables para los elementos de entrada de fecha
    const fechaInicioElement = document.getElementById('fechaInicio');
    const fechaFinElement = document.getElementById('fechaFin');
    const filterButton = document.getElementById('boton_filtro');

    /**
     * @description Carga los datos de un reporte específico y renderiza la tabla.
     * @param {string} reportType - El tipo de reporte a cargar ('patologias', 'coordinaciones', etc.).
     * @param {string} tableBodyId - El ID del <tbody> de la tabla donde se renderizarán los datos.
     * @param {string} nameKey - La clave del objeto de datos que contiene el nombre de la categoría (ej. 'patologias', 'nombre_coordinacion').
     */
    async function loadReportData(reportType, tableBodyId, nameKey) {
        const tableBody = document.getElementById(tableBodyId);
        tableBody.innerHTML = ''; // Limpia cualquier contenido previo

        // **Lectura de fechas en cada llamada**
        let fechaInicio = fechaInicioElement ? fechaInicioElement.value : '';
        let fechaFin = fechaFinElement ? fechaFinElement.value : '';

        // Asigna valores por defecto si los campos están vacíos
        if (!fechaInicio) {
            const today = new Date();
            fechaInicio = today.getFullYear() + '-' + (today.getMonth() + 1).toString().padStart(2, '0') + '-01';
        }
        if (!fechaFin) {
            const today = new Date();
            fechaFin = today.getFullYear() + '-' + (today.getMonth() + 1).toString().padStart(2, '0') + '-' + today.getDate().toString().padStart(2, '0');
        }

        try {
            // **Construcción de la URL de manera genérica**
            const response = await fetch(`http://localhost/crud_fetch/Models/report${reportType}.php?fechaInicio=${fechaInicio}&fechaFin=${fechaFin}`);
            
            if (!response.ok) {
                throw new Error(`Error HTTP: ${response.status}`);
            }

            const answer = await response.json();

            if (answer.status === 'success' && Array.isArray(answer.data)) {
                const data = answer.data;

                if (data.length === 0) {
                    tableBody.innerHTML = `<tr><td colspan="4" class="text-info">No hay datos de ${reportType} disponibles.</td></tr>`;
                    return;
                }

                const totalRegistros = data.reduce((sum, item) => sum + parseInt(item.total), 0);

                data.forEach(item => {
                    const total = parseInt(item.total);
                    const porcentaje = totalRegistros > 0 ? (total / totalRegistros) * 100 : 0;
                    
                    const row = tableBody.insertRow();
                    const cell1 = row.insertCell();
                    cell1.textContent = item[nameKey]; // Usa la clave dinámica
                    const cell2 = row.insertCell();
                    cell2.textContent = total;
                    const cell3 = row.insertCell();
                    cell3.textContent = `${porcentaje.toFixed(2)}%`;
                });
            } else {
                console.error("API Error:", answer.mensaje || "Datos no disponibles o estado no exitoso.");
                tableBody.innerHTML = `<tr><td colspan="4" class="text-danger">No se pudieron cargar los datos de los totales por ${reportType}.</td></tr>`;
            }

        } catch (error) {
            console.error(`Error al cargar los datos de ${reportType}:`, error);
            tableBody.innerHTML = `<tr><td colspan="4" class="text-danger">Error al conectar con el servidor de datos.</td></tr>`;
        }
    }

        // Manejador del botón de filtro
        if (filterButton) {
            filterButton.addEventListener('click', (event) => {
                event.preventDefault();
                // Llama a la función unificada para cada tabla
                loadReportData('Patologias', 'patologiaTableBody', 'patologias');
                loadReportData('Coordinaciones', 'coordinacionTableBody', 'nombre_coordinacion');
                loadReportData('Cortesia', 'institucionCortesiaTableBody', 'departamento');
                loadReportData('CoordinacionesParientes','coordinacionParienteTableBody','nombre_coordinacion')
                

            });
        }
        // Llama a las funciones para cargar los datos al cargar la página
        document.addEventListener('DOMContentLoaded', () => {
            loadReportData('Patologias', 'patologiaTableBody', 'patologias');
            loadReportData('Coordinaciones', 'coordinacionTableBody', 'nombre_coordinacion');
            loadReportData('Cortesia', 'institucionCortesiaTableBody', 'nombre');
            loadReportData('CoordinacionesParientes','coordinacionParienteTableBody','nombre_coordinacion');
            
        });
    </script>
</html>