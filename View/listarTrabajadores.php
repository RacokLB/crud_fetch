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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado Trabajadores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/2.3.0/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../Public/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.3/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/colreorder/2.0.4/css/colReorder.dataTables.min.css">

</head>
<?php
include_once "../Config/conexion.php";

$estados = $pdo->prepare(query: "SELECT ID, estado FROM estados");
$estados->execute();

$ciudades = $pdo->prepare(query: "SELECT ID_STATE, CITY FROM table_city");
$ciudades->execute();

$municipios = $pdo->prepare(query: "SELECT ID, ID_STATE, municipios FROM tabla_municipios");
$municipios->execute();

$parroquias = $pdo->prepare(query: "SELECT ID, parroquias FROM tabla_parroquias");
$parroquias->execute();

$cargos = $pdo->prepare(query: "SELECT codigo, nombre_cargos FROM tabla_cargos");
$cargos->execute();

$coordinaciones = $pdo->prepare(query: "SELECT codigo_coordinacion, nombre_coordinacion FROM tabla_coordinaciones");
$coordinaciones->execute();

$instruccion = $pdo->prepare(query: "SELECT ID, grado_instruccion FROM niveles_instruccion");
$instruccion->execute();
?>

<body>
    <div class="wrapper">
        <aside id="sidebar" class="js-sidebar">
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="principalPagina.php">FTTC</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Elementos analista
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#pages" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-solid fa-file-lines pe-2"></i>
                            Modulos
                        </a>
                        <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Trabajadores</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link">
                                    <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" data-bs-whatever="Cortesia">Cortesia</button>
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
                                <a href="login.php" class="sidebar-link">Ingreso</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="registerLogin.php" class="sidebar-link">Registrarse</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Olvide la contraseña</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
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
                                <img src="../Public/img/logotipo.jpg" class="avatar img-fluid rounded"
                                    alt="Logotipo del FTTC">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item">Analista</a>
                                <a href="#" class="dropdown-item">Indicaciones</a>
                                <a href="Controllers/logout.php" class="dropdown-item">Salir</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <br>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h1 class="fw-bold text-center"></h1>
                    </div>
                    <!------- Campo Tabla ------------>
                    <div class="card border-3 border-dark">
                        <div class="card-header">
                            <h3 class="card-title fw-bold">
                                Tabla de Seleccion
                            </h3>
                            <h5 class="card-subtitle text-muted fs-4">
                                Base de datos de los funcionarios activos del Consejo Nacional Electoral
                            </h5>
                        </div>
                        <div class="card-body bg-dark text-white">
                            <table id="tabla" class="table fs-6 table-dark able-striped table-hover"
                                style="width: 100%">
                                <thead>
                                    <tr>
                                        <th scope="col">N°</th>
                                        <th scope="col">Nacionalidad</th>
                                        <th scope="col">C.I</th>
                                        <th scope="col">Nombres</th>
                                        <th scope="col">Apellidos</th>
                                        <th scope="col">Edad</th>
                                        <th scope="col">N°Telf</th>
                                        <th scope="col">RIF</th>
                                        <th scope="col">Cargo</th>
                                        <th scope="col">Coordinacion</th>
                                        <th scope="col">Acciones</th>

                                    </tr>
                                </thead>
                                <tbody id="resultado">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
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
                                    <a href="#" class="text-muted">Contact</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="text-muted">About Us</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="text-muted">Terms</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="text-muted">Booking</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <main>
        <div class="modal fade" id="editTrabajadorModal" tabindex="-1" aria-labelledby="editTrabajadorModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header border-4 border-bottom bg-dark text-white">
                        <h5 class="modal-title" id="editTrabajadorModalLabel">Editar Trabajador</h5>
                        <button type="button" class="btn-close bg-light" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formEditTrabajador">
                            <input type="hidden" id="editTrabajadorId" name="id">

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="editNacionalidad" class="form-label">Nacionalidad:</label>
                                    <select class="form-select" id="editNacionalidad" name="nacionalidad">
                                        <option value="V">Venezolano(a)</option>
                                        <option value="E">Extranjero(a)</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="editCedula" class="form-label">C.I:</label>
                                    <input type="text" class="form-control" id="editCedula" name="cedula">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="editNombre" class="form-label">Nombres:</label>
                                    <input type="text" class="form-control" id="editNombre" name="nombres">
                                </div>
                                <div class="col-md-6">
                                    <label for="editApellido" class="form-label">Apellidos:</label>
                                    <input type="text" class="form-control" id="editApellido" name="apellidos">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="editEstadoCivil" class="form-label">Estado Civil:</label>
                                    <select class="form-select" id="editEstadoCivil" name="estado_civil">
                                        <option value="Soltero(a)">Soltero(a)</option>
                                        <option value="Casado(a)">Casado(a)</option>
                                        <option value="Divorciado(a)">Divorciado(a)</option>
                                        <option value="Viudo(a)">Viudo(a)</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="editFechaNacimiento" class="form-label">Fecha de Nacimiento:</label>
                                    <input type="date" class="form-control" id="editFechaNacimiento"
                                        name="fecha_nacimiento">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="editGenero" class="form-label">Sexo:</label>
                                    <select class="form-select" id="editGenero" name="genero">
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="editNumeroContacto" class="form-label">N° Contacto:</label>
                                    <input type="text" class="form-control" id="editNumeroContacto"
                                        name="telefono_movil">
                                </div>
                                <div class="col-md-6">
                                    <label for="editEmail" class="form-label">Email:</label>
                                    <input type="email" class="form-control" id="editEmail" name="email">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="editRif" class="form-label">N° RIF:</label>
                                    <input type="text" class="form-control" id="editRif" name="rif">
                                </div>
                                <div class="col-md-6">
                                    <label for="editFechaIngreso" class="form-label">Fecha Ingreso:</label>
                                    <input type="date" class="form-control" id="editFechaIngreso" name="fecha_ingreso">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="editEstado" class="form-label">Estado:</label>
                                    <select class="form-select" id="editEstado" name="estado">
                                        <?php foreach ($estados as $estado) { ?>
                                            <option value="<?php echo $estado['ID']; ?>">
                                                <?php echo htmlspecialchars($estado['estado']); ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="editCiudad" class="form-label">Ciudad:</label>
                                    <select class="form-control" id="editCiudad" name="ciudad">
                                        <?php foreach ($ciudades as $ciudad) { ?>
                                            <option value="<?php echo $ciudad['ID_STATE']; ?>">
                                                <?php echo htmlspecialchars($ciudad['CITY']); ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="editMunicipio" class="form-label">Municipio:</label>
                                    <select class="form-control" id="editMunicipio" name="municipio">
                                        <?php foreach ($municipios as $municipio) { ?>
                                            <option value="<?php echo $municipio['ID']; ?>">
                                                <?php echo htmlspecialchars($municipio['municipios']); ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="editParroquia" class="form-label">Parroquia:</label>
                                    <select type="text" class="form-control" id="editParroquia" name="parroquia">
                                        <?php foreach ($parroquias as $parroquia) { ?>
                                            <option value="<?php echo $parroquia['ID']; ?>">
                                                <?php echo htmlspecialchars($parroquia['parroquias']); ?>
                                            </option>
                                        <?php } ?>
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="editDireccion" class="form-label">Direccion:</label>
                                    <textarea class="form-control" id="editDireccion" name="direccion"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="editCargo" class="form-label">Cargo:</label>
                                    <select class="form-select" id="editCargo" name="cargo">
                                        <?php foreach ($cargos as $cargo) { ?>
                                            <option value="<?php echo $cargo['codigo']; ?>">
                                                <?php echo htmlspecialchars($cargo['nombre_cargos']); ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <!--- FIELD UBICACION GENERAL ---->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="editCoordinacion" class="form-label">Coordinacion:</label>
                                    <select class="form-select" id="editCoordinacion" name="coordinacion">
                                        <?php foreach ($coordinaciones as $c) { ?>
                                            <option value="<?php echo $c['codigo_coordinacion']; ?>">
                                                <?php echo htmlspecialchars($c['nombre_coordinacion']); ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="editInstruccion" class="form-label">Grado Academico</label>
                                    <select name="instruccion" id="editInstruccion" class="form-select">
                                        <option value=""></option>
                                        <?php while ($row = $instruccion->fetch()) { ?>
                                            <option value="<?php echo $row['ID'] ?>"><?php echo $row['grado_instruccion'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <!--- FIELD FECHA INGRESO ---->
                                <div class="col-md-6">
                                    <label for="editFechaIngreso" class="form-label">Fecha de Ingreso:</label>
                                    <input type="date" class="form-control" id="editFechaIngreso" name="fecha_ingreso">
                                </div>
                            </div>
                            <!--- FIELD TALLA ---->
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="editTallaCamisa" class="form-label">Talla Camisa:</label>
                                    <input type="text" class="form-control" id="editTallaCamisa" name="talla_camisa">
                                </div>
                                <div class="col-md-4">
                                    <label for="editTallaPantalon" class="form-label">Talla Pantalon</label>
                                    <input type="text" class="form-control" id="editTallaPantalon"
                                        name="talla_pantalon">
                                </div>
                                <div class="col-md-4">
                                    <label for="editTallaZapatos" class="form-label">Talla Zapatos</label>
                                    <input type="text" class="form-control" id="editTallaZapatos" name="talla_zapatos">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="guardarCambiosTrabajador">Guardar
                            Cambios</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--- END CANVAS--->
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="../Public/dashBoard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/colreorder/2.0.4/js/dataTables.colReorder.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#tabla').DataTable({
                order: [
                    [0, 'DESC']
                ], // [[COLUMN, ORDER BY ]]
                processing: true,
                serverSide: false, // Keep this as false if your API returns all data at once
                ajax: {
                    url: 'http://localhost/crud_fetch/index.php/?api=trabajadores', // Your API endpoint

                    dataSrc: '' // Your API directly returns an array
                },
                columns: [
                    // Column 1: N° (ID, but can be a counter if you want to display sequential numbering)

                    {
                        data: 'id'
                    },
                    {
                        data: 'nacionalidad'
                    },
                    {
                        data: 'cedula'
                    }, // Assuming your JSON key is 'cedula'
                    {
                        data: 'nombres'
                    },
                    {
                        data: 'apellidos'
                    },
                    {
                        data: 'fecha_nacimiento'
                    },
                    {
                        data: 'telefono_movil'
                    },
                    {
                        data: 'rif'
                    },
                    {
                        data: 'cargo'
                    },
                    {
                        data: 'coordinacion'
                    },




                    {
                        // Actions column
                        data: null, // This column doesn't map directly to a data field
                        render: function (data, type, row) {
                            // 'row' contains the full data object for the current row
                            const trabajadorCedula = row.cedula;

                            return `
                            <button type="button" class="btn btn-warning btn-sm editar-btn" data-id="${trabajadorCedula}" title="Editar">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm eliminar-btn" data-id="${trabajadorCedula}" title="Eliminar">
                                <i class="bi bi-trash"></i>
                            </button>
                        `;
                        },
                        orderable: false, // Actions column is not orderable
                        searchable: false // Actions column is not searchable
                    }
                ],

                // Optional: DataTables Features
                dom: 'lBfrtip', // Defines the layout of DataTables elements (Length, Buttons, Filter, Table, Info, Pagination)
                buttons: [
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5',
                    'print',
                    'colvis' // Column visibility toggle
                ],
                colReorder: true, // Enable column reordering
                responsive: true, // Enable responsive design
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/2.0.7/i18n/es-ES.json' // Spanish language file
                }
            });
            // Función para abrir el modal de edición y cargar datos
            $(document).on('click', '.editar-btn', function () {
                const cedula = $(this).data('id');
                console.log('Boton de seleccion de funcionario', cedula)
                console.log('URL de la solicitud:', 'http://localhost/crud_fetch/index.php/?api=trabajador&id=' + cedula)

                // Realizar una solicitud AJAX para obtener los datos del trabajador
                $.ajax({
                    url: 'http://localhost/crud_fetch/index.php/?api=trabajador&id=' + cedula,
                    type: 'GET',
                    success: function (response) {
                        console.log('Respuesta de la API', response)
                        // Validar si la respuesta es un objeto y si tiene la estructura esperada
                        if (response && typeof response === 'object' && !Array.isArray(response) && response.id) {
                            const trabajador = response;
                            console.log('Objeto trabajador procesado:', trabajador);

                            // Rellenar los campos del modal de edición
                            $('#editTrabajadorId').val(trabajador.id);
                            $('#editNacionalidad').val(trabajador.nacionalidad); // Assuming your API returns 'nacionalidad'
                            $('#editCedula').val(trabajador.cedula);
                            $('#editNombre').val(trabajador.nombres);
                            $('#editApellido').val(trabajador.apellidos);
                            $('#editEstadoCivil').val(trabajador.estado_civil);
                            $('#editFechaNacimiento').val(trabajador.fecha_nacimiento);
                            $('#editGenero').val(trabajador.genero);
                            $('#editNumeroContacto').val(trabajador.telefono_movil); // Corrected to telefonoMovil

                            $('#editRif').val(trabajador.rif);
                            $('#editFechaIngreso').val(trabajador.fechaIngreso); // Assuming your API returns 'fechaIngreso'

                            // New Fields based on your PHP function's fetched data
                            $('#editTelefonoFijo').val(trabajador.telefono_fijo);
                            $('#editEmail').val(trabajador.email);
                            $('#editEstatura').val(trabajador.estatura);
                            $('#editPeso').val(trabajador.peso);
                            $('#editNumHijos').val(trabajador.num_hijos);
                            $('#editTipoSangre').val(trabajador.tipo_sangre);
                            $('#editDiscapacidad').val(trabajador.discapacidad);
                            $('#editTenenciaVivienda').val(trabajador.tenencia);
                            $('#editTipoVivienda').val(trabajador.vivienda); // Mapped to 'vivienda' in your PHP class
                            $('#editTallaCamisa').val(trabajador.talla_camisa);
                            $('#editTallaZapatos').val(trabajador.talla_zapatos);
                            $('#editTallaPantalon').val(trabajador.talla_pantalon);

                            // Dropdowns (ensure the API returns the correct values that match the option values)
                            $('#editEstado').val(trabajador.estado);
                            // You might need to dynamically load cities/municipalities/parishes based on the selected state/city
                            // For now, assuming they are all loaded and you just need to select the right one.
                            // If your API returns the actual city/municipio/parroquia ID, set it here.
                            $('#editCiudad').val(trabajador.ciudad); // Make sure your API's 'trabajador' object has a 'ciudad' property with the ID
                            $('#editMunicipio').val(trabajador.municipio); // Make sure your API's 'trabajador' object has a 'municipio' property with the ID
                            $('#editParroquia').val(trabajador.parroquia); // Make sure your API's 'trabajador' object has a 'parroquia' property with the ID

                            $('#editDireccion').val(trabajador.direccion);

                            // For Cargo and Coordinacion, ensure your PHP function returns the *code* (ID)
                            // not just the *name*. I've assumed new aliases in PHP for these:
                            $('#editCargo').val(trabajador.cargo_id); // Assuming 'cargo' now holds 'cod_cargo_val'
                            $('#editCoordinacion').val(trabajador.coordinacion_id); // Assuming 'coordinacion' now holds 'cod_coordinacion_val'
                            $('#editUbicacion').val(trabajador.ubicacion); // 'ubicacion' is the name of the select, assume API returns 'codigo_sede'
                            $('#editInstruccion').val(trabajador.grado_academico); // 'instruccion' is the name of the select, assume API returns 'id'
                            $('#editFechaIngreso').val(trabajador.fecha_ingreso);

                            // Mostrar el modal
                            var editModal = new bootstrap.Modal(document.getElementById('editTrabajadorModal'));
                            editModal.show();

                        } else {
                            Swal.fire('Error', 'No se encontraron datos para el trabajador.', 'error');
                        }
                    },
                    error: function (xhr, status, error) {
                        Swal.fire('Error', 'Error al obtener los datos del trabajador: ' + xhr.responseText, 'error');
                    }
                });
            });

            // Manejar el envío del formulario de edición
            $('#guardarCambiosTrabajador').on('click', function () {
                const trabajadorCedula = $('#editCedula').val();
                const formData = $('#formEditTrabajador').serializeArray();
                console.log('formulario de actualizacion', formData)
                const data = {};
                console.log('Esta es la cedula del trabajador seleccionado', trabajadorCedula);
                formData.forEach(function (item) {
                    data[item.name] = item.value;

                });
                //console.log for debugging 
                console.log('JSON data being sent to backend:', data)


                $.ajax({
                    url: 'http://localhost/crud_fetch/index.php/?api=actualizarTrabajador&id=' + trabajadorCedula, // Asume que tu API maneja PUT por ID
                    type: 'PATCH', // O 'POST' si tu API asi lo indica
                    contentType: 'application/json', // Importante para enviar JSON
                    data: JSON.stringify(data), // Enviar los datos como JSON
                    success: function (response) {
                        console.log('cuerpo del json listo para enviar', data)
                        Swal.fire(
                            '¡Actualizado!',
                            'Los datos del trabajador han sido actualizados.',
                            'success'
                        );
                        // Ocultar el modal
                        $('#editTrabajadorModal').modal('hide');
                        // Recargar la tabla
                        $('#tabla').DataTable().ajax.reload();
                    },
                    error: function (xhr, status, error) {
                        Swal.fire(
                            'Error',
                            'Hubo un error al actualizar el trabajador: ' + xhr.responseText,
                            'error'
                        );
                    }
                });
            });

            $(document).on('click', '.eliminar-btn', function () {
                const trabajadorId = $(this).data('id');
                console.log('Boton de eliminar presionado y este es el ID del funcionario', trabajadorId);
                // Use SweetAlert2 for a confirmation dialog
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminarlo!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Perform the deletion via AJAX
                        $.ajax({
                            url: 'http://localhost/crud_fetch/index.php/?api=eliminarTrabajador&id=' + trabajadorId, // Your API endpoint for deletion
                            type: 'DELETE', // Use DELETE HTTP method
                            success: function (response) {
                                Swal.fire(
                                    '¡Eliminado!',
                                    'El trabajador ha sido eliminado.',
                                    'success'
                                );
                                // Reload the DataTables table to reflect changes
                                $('#tabla').DataTable().ajax.reload();
                            },
                            error: function (xhr, status, error) {
                                Swal.fire(
                                    'Error',
                                    'Hubo un error al eliminar el trabajador: ' + xhr.responseText,
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>

</body>

</html>