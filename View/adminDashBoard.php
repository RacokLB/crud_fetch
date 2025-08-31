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

            <br>
            <div class="container-fluid text-center">
                <h1 class="mt-4 fw-bold">Panel de Control</h1>
                <hr>

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

                <div class="row mb-4">
                    <div class="col-md-12 text-start">
                        <h4>Filtros Generales</h4>
                        <div class="row">
                            <form action="" method="GET" class="row">
                                <div class="col-md-4">
                                    <label for="fechaInicial" class="form-label">Fecha Inicio:</label>
                                    <input type="date" class="form-control" id="fechaInicial" name="fechaInicial">
                                </div>
                                <div class="col-md-4">
                                    <label for="fechaFinal" class="form-label">Fecha Fin:</label>
                                    <input type="date" class="form-control" id="fechaFinal" name="fechaFinal">
                                </div>
                                <div class="col-md-4 d-flex align-items-end">
                                    <button class="btn btn-primary w-100" >Aplicar Filtros</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header bg-dark text-white fw-bold">Reporte Gráfico de Pacientes atendidos por Especialidades</div>
                            <div class="card-body" id="reporte1-container">
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header bg-dark text-white fw-bold">Reporte Gráfico de Pacientes atendidos por Doctores</div>
                            <div class="card-body" id="reporte2-container">
                                <canvas id="myChart2"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header bg-dark text-white fw-bold">Reporte Gráfico de Pacientes atendidos por Género</div>
                            <div class="card-body" id="reporte3-container">
                                <canvas id="myChart3"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header bg-dark text-white fw-bold">Reporte Gráfico de Pacientes atendidos por Edad</div>
                            <div class="card-body" id="reporte4-container">
                                <canvas id="myChart4"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-header bg-dark text-white fw-bold">Clasificación de Pacientes por Edad</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
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
                                <p class="text-muted small mt-2">
                                    *Clasificaciones basadas en la agrupación interna de datos de la aplicación.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-header bg-dark text-white fw-bold">Reporte 5</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table>
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
                                <p class="text-muted small mt-2">Aquí puedes integrar otro gráfico o una tabla de datos más detallada para el Reporte 5.</p>
                            </div>
                        </div>
                    </div>
                </div>

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
                                        <strong>CodzSwod</strong>
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
    
    <script src="../Public/dashBoard.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        //ESTE CHART SE ENCARGA DE TRAER ATRAVES DE FETCH AL ARCHIVO reportSpeciality.php
        const ctx = document.getElementById('myChart');
        let myChart = new Chart(ctx, { // Inicializa el gráfico sin datos inicialmente
            type: 'bar',
            data: {
                labels: [], // Array de etiquetas vacío al inicio
                datasets: [{
                    font:{
                        size: 15,
                        weight: 'bold',
                        family: 'Poppins'
                    },
                    label: 'Personas Atendidas por Especialidades',
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
                        text: 'N° PACIENTES ATENDIDOS POR ESPECIALIDADES',
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

        fetch('../Models/reportSpeciality.php')
            .then(response => response.json() )
            .then(data => mostrar(data) )
            .catch(error => console.log(error) );

            const mostrar = (data) => {
                const labels = data.map(element => element.especialidades); //Haciendo uso de la funcion map() creamos un array de los labels y se asignan a una const 
                const values = data.map(element => element.total)//Se crea un array haciendo uso de la funcion map() y dicho array contiene la data (JSON) y se almacena en una const
                
                myChart.data['labels'] = labels;//Se asigna el array a las etiquetas del grafico
                myChart.data['datasets'][0]['data'] = values;// Se asigna el array a los datos del grafico
                myChart.update();//Se actualiza el grafico una sola vez
            };

        //ESTE CHART SE ENCARGA DE TRAER ATRAVES DE FETCH AL ARCHIVO reportDoctor.php
        const ctx2 = document.getElementById('myChart2')
        let myChart2 = new Chart(ctx2, {
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
        //Traemos con un fetch el script donde hicimos nuestra query para obtener los totales de pacientes atendidos por doctores
        fetch('../Models/reportDoctor.php')
        //indicamos que la respuesta es un json que ya enviamos envuelto en un json_encode
            .then(response => response.json() )
            .then(data => mostrar2(data) )
            .catch(error => console.log(error))
        
            //creamos la const mostrar2 donde 
            const mostrar2 = (data) => {
                const labelsDoctores = data.map(element => element.doctores)
                const valuesDoctores = data.map(element => element.total)
            
                myChart2.data.labels = labelsDoctores
                myChart2.data.datasets[0].data = valuesDoctores
                myChart2.update();
            
        };

        //ESTE CHART SE ENCARGA DE TRAER ATRAVES DE FETCH AL ARCHIVO reportSex.php
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

    fetch('../Models/reportSex.php')
            .then(response => response.json() )
            .then(data => mostrar3(data) )
            .catch(error => console.log(error))
        
            const mostrar3 = (data) => {
                const labelsSex = data.map(element => element.sexo)
                const valuesSex = data.map(element => element.total)
            
                myChart3.data.labels = labelsSex
                myChart3.data.datasets[0].data = valuesSex
                myChart3.update()
                    
            };

            //ESTE CHART SE ENCARGA DE LLAMAR ATRAVES DE FETCH AL ARCHIVO reportAgeChat.php
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

            fetch('../Models/reportAgeChart.php')
                .then(response => response.json() )
                .then(data => mostrar4(data) )
                .catch(error => console.log(error) );

                const mostrar4 = (data) => {
                    const labelsAge = data.map(element => element.edad); //Haciendo uso de la funcion map() creamos un array de los labels y se asignan a una const 
                    const valuesAge = data.map(element => element.total)//Se crea un array haciendo uso de la funcion map() y dicho array contiene la data (JSON) y se almacena en una const
                    
                    myChart4.data.labels = labelsAge;//Se asigna el array a las etiquetas del grafico
                    myChart4.data.datasets[0].data = valuesAge;// Se asigna el array a los datos del grafico
                    myChart4.update();//Se actualiza el grafico una sola vez
                
                };


            // dashBoard.js

            // Función para obtener los datos de la API y renderizar la tabla
            async function loadAgeClassificationData() {
                // Selecciona el tbody de la tabla donde se insertarán las filas
                const tableBody = document.getElementById('ageClassificationTableBody'); 
                // Limpia cualquier contenido previo en la tabla, útil si se recargan los datos
                tableBody.innerHTML = ''; 

                try {
                    // Realiza la llamada a tu API PHP
                    // Asegúrate de que esta URL sea la correcta para tu endpoint PHP
                    // Si tu archivo PHP está en 'htdocs/crud_fetch/Controllers/tu_archivo_api.php',
                    // la URL en el frontend debería apuntar a ese lugar, por ejemplo:
                    // const response = await fetch('/crud_fetch/Controllers/tu_archivo_api.php');
                    const response = await fetch('http://localhost/crud_fetch/Models/reportAge.php'); // Reemplaza con la ruta correcta a tu archivo PHP
                    console.log(response)
                    if (!response.ok) {
                        console.log(`Error HTTP: ${response.status}`);
                        throw new Error(`Error HTTP: ${response.status}`);
                    }
                    const result = await response.json(); // Asume que la API devuelve JSON
                    

                    if (result.status === 'success' && result.data) {
                        const ageData = result.data; // Los datos clasificados de tu PHP
                        

                        // Calcular el total general para los porcentajes
                        const totalRegistros = ageData.niños + ageData.adolescentes + ageData.adultos + ageData.adultos_mayores;

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

            // Llama a la función cuando el DOM esté completamente cargado
            document.addEventListener('DOMContentLoaded', () => {
                // Aquí inicializarías tus otros gráficos de Chart.js
                // Ejemplo:
                // initMyChart();
                // initMyChart2();
                // initMyChart3();

                loadAgeClassificationData(); // Carga la tabla de clasificación por edad
            });
            
        
    </script>
    <script defer>
      // GET THE ID WHERE WE SHOW THE DATA FROM SCRIPT PHP
      const resultadoDiv = document.getElementById('reporte');
      //ADD AN SPINNER WHILE THE DOM LOADING
      resultadoDiv.innerHTML = '<div class="spinner-border text-light" role="status"><span class="visually-hidden">Cargando Informacion...</span></div>';

      fetch('../Models/dailyReport_controller.php') // URL FROM CATCH THE DATA 
        .then(response => response.json())
        .then(data => {
          //TRY TO VERIFICATE WHAT TYPE OF RESPONSE WE RECEIVE FROM THE SCRIPT dailyReport_controller. status is a array
          if (data.status ==='error'){
            resultadoDiv.innerHTML = `<h4 class='text-danger fw-bold'>${data.mensaje}</h4>`;
            //IN OTHERWISE IN CASE STATUS SEND BE 'SUCCESS' THE CODE EXECUTE
          }else if(data.status === 'success'){
            resultadoDiv.innerHTML = `
                <h3 class="fw-bold text-center"> ${data.totalPacientes} </h3><br>
                <h4 class='fw-bold'> Total Pacientes Atendidos </h4>
                `;
          }
        })
        .catch(error => {
            console.error('Error al obtener los datos:', error);
            document.getElementById('reporte').textContent = `<h4 class='text-danger fw-bold' Error al cargar los datos </h4>`;
        });

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
    </script>

    <script defer>
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


            // GET THE ID WHERE WE SHOW THE DATA FROM SCRIPT PHP CORTESIA
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
    <script defer>

        // dashBoard.js

            // Función para obtener los datos de la API y renderizar la tabla
            async function loadPatologiaData() {
                // Selecciona el tbody de la tabla donde se insertarán las filas
                const tableBodyPatologia = document.getElementById('patologiaTableBody'); 
                // Limpia cualquier contenido previo en la tabla, útil si se recargan los datos
                tableBodyPatologia.innerHTML = ''; 

                try {
                    // Realiza la llamada a tu API PHP
                    // Asegúrate de que esta URL sea la correcta para tu endpoint PHP
                    // Si tu archivo PHP está en 'htdocs/crud_fetch/Controllers/tu_archivo_api.php',
                    // la URL en el frontend debería apuntar a ese lugar, por ejemplo:
                    // const response = await fetch('/crud_fetch/Controllers/tu_archivo_api.php');
                    const response = await fetch('http://localhost/crud_fetch/Models/reportPatologias.php'); // Reemplaza con la ruta correcta a tu archivo PHP
                    console.log(response)
                    if (!response.ok) {
                        console.log(`Error HTTP: ${response.status}`);
                        throw new Error(`Error HTTP: ${response.status}`);
                    }
                    const answer = await response.json(); // Asume que la API devuelve JSON
                    

                    if (answer.status === 'success' && answer.data) {
                        const patologiaData = answer.data; // Los datos clasificados de tu PHP
                        console.log('Datos enviados del backend : ' , patologiaData);

                        // Calcular el total general para los porcentajes
                        const totalRegistros = patologiaData.niños + patologiaData.adolescentes ;


                    } else {
                        console.error("API Error:", answer.mensaje || "Datos no disponibles o estado no exitoso.");
                        tableBodyPatologia.innerHTML = `<tr><td colspan="4" class="text-danger">No se pudieron cargar los datos de los totales por patologia.</td></tr>`;
                    }

                } catch (error) {
                    console.error("Error al cargar los datos de las patologias:", error);
                    // Mostrar un mensaje de error en la UI
                    tableBodyPatologia.innerHTML = `<tr><td colspan="4" class="text-danger">Error al conectar con el servidor de datos.</td></tr>`;
                }
            }

            // Llama a la función cuando el DOM esté completamente cargado
            document.addEventListener('DOMContentLoaded', () => {
                // Aquí inicializarías tus otros gráficos de Chart.js
                // Ejemplo:
                // initMyChart();
                // initMyChart2();
                // initMyChart3();

                loadPatologiaData(); // Carga la tabla de clasificación por edad
            });

    </script>
</body>
</html>