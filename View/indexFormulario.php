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
    <title>Formulario para nuevo Ingreso</title>
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href=" ../Public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/f50bfae678.js" crossorigin="anonymous"></script>
    <style>
        .formulario-container {
            max-width: 700px;
            margin: 30px auto;
            padding: 20px;
            box-shadow: 0 0 .955rem 0 white;
            margin-bottom: 24px;
            border-radius: 25px;
            background-color: aliceblue;


        }

        .form-section {
            display: none;
            /* Ocultar todas las secciones por defecto */
        }

        .form-section.current {
            display: block;
            /* Mostrar la sección actual */
        }

        .form-group label {
            font-weight: bold;
        }
    </style>
    <?php

    require_once "/xampp/htdocs/crud_fetch/Config/conexion.php";

    $queryCoordinaciones = $pdo->prepare(query: "SELECT codigo_coordinacion, nombre_coordinacion FROM tabla_coordinaciones");
    $queryCoordinaciones->execute();

    $queryGradoAcademico = $pdo->prepare(query: "SELECT ID, grado_instruccion FROM niveles_instruccion");
    $queryGradoAcademico->execute();

    $queryCargo = $pdo->prepare(query: "SELECT codigo, nombre_cargos FROM tabla_cargos");
    $queryCargo->execute();

    $queryEstado = $pdo->prepare(query: "SELECT ID, estado FROM estados");
    $queryEstado->execute();

    $ciudades = $pdo->prepare(query: "SELECT ID_STATE, CITY FROM table_city");
    $ciudades->execute();

    $municipios = $pdo->prepare(query: "SELECT ID, ID_STATE, municipios FROM tabla_municipios");
    $municipios->execute();

    $parroquias = $pdo->prepare(query: "SELECT ID, parroquias FROM tabla_parroquias");
    $parroquias->execute();


    ?>
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
            <main class="col-12 px-3 " id="main-content">
                <button class="btn btn-dark text-white" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">Informacion de
                    Ingresos <i class="fa-solid fa-chart-pie"></i></button>

                <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions"
                    aria-labelledby="offcanvasWithBothOptionsLabel">
                    <div class="offcanvas-header bg-dark text-white">
                        <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Grafico de ingresos <i
                                class="fa-solid fa-chart-simple"></i></h5>
                        <button type="button" class="btn-close bg-light" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <canvas id="myChart" class="bg-light" width="370" height="600"></canvas>
                        <div class="card p-4 mb-4 mt-4" id="reporte">

                        </div>
                    </div>
                </div>
                <button class="btn btn-dark text-white" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">Reportes <i
                        class="fa-regular fa-chart-bar"></i></button>

                <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
                    id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                    <div class="offcanvas-header bg-dark text-white">
                        <h4 class="offcanvas-title" id="offcanvasScrollingLabel">Estadisticas Generales <i
                                class="fa-solid fa-calculator"></i></h5>
                            <button type="button" class="btn-close bg-white" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="card p-4 mb-4 mt-4" id="totales">

                        </div>
                        <div class="card mb-4" id="totalPersonas">

                        </div>

                    </div>
                </div>
                <div class="container-fluid">
                    <div class="mb-3">
                        <h1 class="fw-bold text-center text-white">Ingreso de Trabajadores</h1>
                    </div>
                    <div class="formulario-container">
                        <h2 class="text-center fw-bold">Formulario de Ingreso</h2>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0"
                                aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                        <form id="personaForm" class="p-6 rounded"
                            action="/crud_fetch/index.php?Controllers=trabajadorController&api=crearTrabajador"
                            method="POST">
                            <input type="hidden" id="parienteArray" name="parienteArray">
                            <div id="personal-info" class="form-section current">
                                <h3 class="">Información Personal</h3>
                                <div class="col-md-4 mb-4">
                                    <span for="nacionalidad"
                                        class="input-group-text bg-dark text-white">Nacionalidad</span>
                                    <select class="form-select" name="nacionalidad" id="nacionalidad">
                                        <option value="">Seleccione una opcion</option>
                                        <option value="V" selected>Venezolano</option>
                                        <option value="E">Extranjero</option>
                                    </select>
                                </div>
                                <div class="input-group mb-3">

                                    <span class="input-group-text bg-dark text-white">Cedula / Rif</span>
                                    <div class="col-md-4">
                                        <input type="text" aria-label="Cedula" class="form-control" id="cedula"
                                            name="cedula" placeholder="Cedula V- E-" minlength="6" maxlength="8"
                                            required>
                                        <input type="text" aria-label="rif" class="form-control" id="rif" name="rif"
                                            pattern="[0-9]+" minlength="8" maxlength="9" placeholder="RIF" required>
                                    </div>
                                    <div class="alert" id="cedulaError">

                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-dark text-white">Nombres y Apellidos</span>
                                    <div class="col-md-6 ">
                                        <input type="text" class="form-control" id="nombres" placeholder="Nombres"
                                            name="nombres" required>
                                        <input type="text" class="form-control" id="apellidos" placeholder="Apellidos"
                                            name="apellidos" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="fechaNacimiento">Fecha de Nacimiento:</label>
                                    <input type="date" class="form-control" id="fechaNacimiento"
                                        name="fecha_nacimiento">
                                    <span id="fechaNacimientoError" class="text-danger"></span>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="genero">Genero:</label>
                                    <select class="form-control" id="genero" name="genero">
                                        <option selected>Seleccione una opción</option>
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="estadoCivil">Estado Civil:</label>
                                    <select class="form-control" id="estadoCivil" name="estado_civil">
                                        <option selected>Seleccione una opción</option>
                                        <option value="soltero">Soltero(a)</option>
                                        <option value="casado">Casado(a)</option>
                                        <option value="divorciado">Divorciado(a)</option>
                                        <option value="viudo">Viudo(a)</option>
                                        <option value="union_estable_de_hechos">Unión Estable de Hechos</option>
                                    </select>
                                </div>
                                <button type="button" class="btn btn-primary next-step">Siguiente</button>
                            </div>

                            <div id="contact-info" class="form-section">
                                <h3>Información de Contacto</h3>
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-dark text-white">Telefonos</span>
                                    <div class="col-md-5">
                                        <input type="tel" class="form-control" id="telefonoFijo" pattern="[0-9]{11}"
                                            maxlength="11" placeholder="teléfono fijo (0212)" name="telefono_fijo">
                                        <input type="tel" class="form-control" id="telefonoMovil" pattern="[0-9]{11}"
                                            maxlength="11" placeholder="teléfono móvil (0412)" name="telefono_movil">
                                    </div>
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label for="email">Correo Electrónico:</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Ingrese su correo electrónico">
                                </div>
                                <button type="button" class="btn btn-secondary prev-step">Anterior</button>
                                <button type="button" class="btn btn-primary next-step">Siguiente</button>
                            </div>

                            <div id="additional-info" class="form-section">
                                <h3>Datos Personales</h3>
                                <div class="form-row">
                                    <div class="form-group mb-3 col-md-5">
                                        <label for="grado_academico">Grado Academico:</label>
                                        <select class="form-control" id="grado_academico" name="grado_academico">
                                            <option selected>"Seleccione un grado academico"</option>
                                            <?php while ($row = $queryGradoAcademico->fetch(PDO::FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['ID']; ?>">
                                                    <?php echo $row['grado_instruccion']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3 col-md-5">
                                        <label for="cargo">Cargo:</label>
                                        <select class="form-control" id="cargo" name="cargo">
                                            <option selected>"Seleccione un cargo"</option>
                                            <?php while ($row = $queryCargo->fetch(PDO::FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['codigo']; ?>">
                                                    <?php echo $row['nombre_cargos']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3 col-md-5">
                                        <label for="coordinacion">Coordinación:</label>
                                        <select class="form-control" id="coordinacion" name="coordinacion">
                                            <option selected>"Seleccione una coordinacion"</option>
                                            <?php while ($row = $queryCoordinaciones->fetch(PDO::FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $row['codigo_coordinacion']; ?>">
                                                    <?php echo $row['nombre_coordinacion']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 mb-3">
                                        <label for="estatura">Estatura (cm):</label>
                                        <input type="text" class="form-control" pattern="[0-9]+" id="estatura"
                                            name="estatura" placeholder="Estatura en cm" maxlength="3">
                                    </div>
                                    <div class="form-group col-md-4 mb-3">
                                        <label for="peso">Peso (kg):</label>
                                        <input type="text" class="form-control" pattern="[0-9]+" id="peso" name="peso"
                                            placeholder="Peso en Kg" maxlength="3" minlength="2">
                                    </div>
                                    <div class="form-group col-md-4 mb-3">
                                        <label for="tipoSangre">Tipo de Sangre:</label>
                                        <select class="form-control" id="tipoSangre" name="tipo_sangre">
                                            <option value="">Seleccione</option>
                                            <option value="o_positivo">O+</option>
                                            <option value="o_negativo">O-</option>
                                            <option value="a_positivo">A+</option>
                                            <option value="a_negativo">A-</option>
                                            <option value="b_positivo">B+</option>
                                            <option value="b_negativo">B-</option>
                                            <option value="ab_positivo">AB+</option>
                                            <option value="ab_negativo">AB-</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mb-3 col-md-6">
                                    <label for="discapacidad">Discapacidad:</label>
                                    <select class="form-control" id="discapacidad" name="discapacidad">
                                        <option value="">Seleccione</option>
                                        <option value="ninguna">Ninguna</option>
                                        <option value="fisica">Física</option>
                                        <option value="visual">Visual</option>
                                        <option value="auditiva">Auditiva</option>
                                        <option value="intelectual">Intelectual</option>
                                        <option value="otra">Otra</option>
                                    </select>
                                </div>
                                <button type="button" class="btn btn-secondary prev-step">Anterior</button>
                                <button type="button" class="btn btn-primary next-step">Siguiente</button>
                            </div>

                            <div id="sizes-info" class="form-section">
                                <h3>Tallas del Trabajador</h3>
                                <div class="form-group mb-3 col-md-3 col-md-2">
                                    <label for="tallaCamisa">Talla de Camisa:</label>
                                    <select class="form-control" id="tallaCamisa" name="talla_camisa">
                                        <option value="">Seleccione</option>
                                        <option value="s">S</option>
                                        <option value="m">M</option>
                                        <option value="l">L</option>
                                        <option value="xl">XL</option>
                                        <option value="xxl">XXL</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-md-4">
                                    <label for="tallaZapatos">Talla de Zapatos:</label>
                                    <input type="number" class="form-control" id="tallaZapatos" name="talla_zapatos"
                                        pattern="[0-9]+" min="30" max="50" placeholder="Talla de zapatos">
                                </div>
                                <div class="form-group mb-3 col-md-4">
                                    <label for="tallaPantalon">Talla de Pantalón:</label>
                                    <input type="number" class="form-control" id="tallaPantalon" name="talla_pantalon"
                                        pattern="[0-9][A-Z]+" min="20" max="42"
                                        placeholder="Talla de pantalón (ej: 30, 32L)">
                                </div>
                                <button type="button" class="btn btn-secondary prev-step">Anterior</button>
                                <button type="button" class="btn btn-primary next-step">Siguiente</button>
                            </div>

                            <div id="sizes-info" class="form-section">
                                <h3>Informacion de Ubicacion</h3>
                                <label for="tipoVivienda">Tipo de Vivienda</label>
                                <div class="form-group mb-3 col-md-4">

                                    <select class="form-control" id="vivienda" name="vivienda">
                                        <option value="">Seleccione</option>
                                        <option value="casa">Casa</option>
                                        <option value="apartamento">Apartamento</option>
                                    </select>
                                </div>
                                <label for="tenencia">Tipo de Tenencia de la Vivienda</label>
                                <div class="form-group mb-3 col-md-4">

                                    <select class="form-control" id="tenencia" name="tenencia">
                                        <option value="">Seleccione </option>
                                        <option value="PROPIA">Propia</option>
                                        <option value="ALQUILADA">Alquilada</option>
                                        <option value="DE UN FAMILIAR">De un Familiar</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-md-5">
                                    <label for="estado">Estado</label>
                                    <select class="form-control" id="estado" name="estado">
                                        <option value="">"Seleccione el estado"</option>
                                        <?php while ($row = $queryEstado->fetch(PDO::FETCH_ASSOC)) { ?>
                                            <option value="<?php echo $row['ID']; ?>"><?php echo $row['estado']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-md-5">
                                    <label for="ciudad">Ciudad</label>
                                    <select class="form-control" id="ciudad" name="ciudad">
                                        <option value="">"Seleccione la ciudad"</option>
                                        <?php while ($row = $ciudades->fetch(PDO::FETCH_ASSOC)) { ?>
                                            <option value="<?php echo $row['ID_STATE']; ?>"><?php echo $row['CITY']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-md-5">
                                    <label for="municipio">Municipio</label>
                                    <select class="form-control" id="municipio" name="municipio">
                                        <option value="">"Seleccione el municipio"</option>
                                        <?php while ($row = $municipios->fetch(PDO::FETCH_ASSOC)) { ?>
                                            <option value="<?php echo $row['ID']; ?>"><?php echo $row['municipios']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-md-5">
                                    <label for="parroquia">Parroquia</label>
                                    <select class="form-control" id="parroquia" name="parroquia">
                                        <option value="">"Seleccione el parroquia"</option>
                                        <?php while ($row = $parroquias->fetch(PDO::FETCH_ASSOC)) { ?>
                                            <option value="<?php echo $row['ID']; ?>"><?php echo $row['parroquias']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group mb-3 col-md-5">
                                    <label for="direccion">Direccion</label>
                                    <textarea name="direccion" class="form-control" rows="3" id="direccion"
                                        name="direccion"></textarea>
                                </div>

                                <button type="button" class="btn btn-secondary prev-step">Anterior</button>
                                <button type="button" class="btn btn-primary next-step">Siguiente</button>
                            </div>

                            <div id="family-info" class="form-section">
                                <h3>Información Familiar</h3>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#modalPariente">Agregar Pariente</button>
                                <div id="parientes-container">
                                    <h4 class="text-dark">Parientes Registrados:</h4>
                                    <ul id="lista-parientes">
                                    </ul>
                                </div>
                                <button type="button" class="btn btn-secondary prev-step">Anterior</button>
                                <button type="button" class="btn btn-primary next-step">Siguiente</button>
                            </div>

                            <div id="work-info" class="form-section">
                                <h3>Información Laboral</h3>

                                <div class="form-group mb-3 col-md-5">
                                    <label for="estatus">Estatus del trabajador dentro de FTTC</label>
                                    <select class="form-control" id="estatus" name="estatus">
                                        <option selected>"Seleccione un estatus"</option>
                                        <option value="Activo">Activo</option>
                                        <option value="Jubilado">Jubilado</option>
                                        <option value="Pensionado">Pensionado</option>
                                        <option value="Contratado">Contratado</option>
                                    </select>
                                </div>

                                <div class="form-group mb-3 col-md-5">
                                    <label for="fechaIngreso">Fecha de Ingreso:</label>
                                    <input type="date" class="form-control" id="fechaIngreso" name="fecha_ingreso">
                                </div>

                                <div class="form-group mb-3 col-md-5">
                                    <label for="numeroHijos">Número de Hijos:</label>
                                    <input type="number" class="form-control" id="numeroHijos" min="0" max="10"
                                        placeholder="Cantidad hijos" name="num_hijos" pattern="(0|[1-9]\d*)"
                                        default="0">
                                </div>
                                <button type="button" class="btn btn-secondary prev-step">Anterior</button>
                                <button type="submit" class="btn btn-success">Enviar Formulario</button>
                            </div>
                        </form>
                        <div class="modal fade" id="reportesModal" tabindex="-1" aria-labelledby="reportesModalLabel">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="reportesModalLabel">Reportes de Trabajadores
                                            Recientes</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="modalReportContent">
                                            <p>Cargando datos de reportes...</p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modalPariente" tabindex="-1" aria-labelledby="modalParienteLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-dark text-white">
                                        <h5 class="modal-title fw-bold" id="modalParienteLabel">Registrar Pariente</h5>
                                        <button type="button" class="btn-close bg-light" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formPariente">
                                            <div class="form-group mb-3">
                                                <label for="cedulaTrabajador">Cedula del Trabajador:</label>
                                                <input type="text" class="form-control" id="cedulaTrabajador"
                                                    name="cedulaTrabajador" placeholder="Cedula del Trabajador"
                                                    required>
                                            </div>
                                            <div id="cedulaParienteError">

                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="coordinacionPariente">Coordinacion del Titular:</label>
                                                <input type="text" class="form-control" id="coordinacionPariente"
                                                    name="coordinacionPariente">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="cedulaPariente">Cedula del Pariente (Opcional) :</label>
                                                <input type="text" class="form-control" pattern="[0-9]{6,8}"
                                                    minlength="6" maxlength="8" id="cedulaPariente"
                                                    placeholder="Cedula del Pariente" name="cedulaPariente">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="nombrePariente">Nombre del Pariente:</label>
                                                <input type="text" class="form-control" id="nombrePariente"
                                                    name="nombrePariente" placeholder="nombre del pariente" required>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="apellidoPariente">Apellido del Pariente:</label>
                                                <input type="text" class="form-control" id="apellidoPariente"
                                                    name="apellidoPariente" placeholder="apellido del pariente"
                                                    required>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="sexoPariente">Genero:</label>
                                                <select class="form-control" id="generoPariente" name="generoPariente"
                                                    required>
                                                    <option value="">Seleccione</option>
                                                    <option value="F">Femenino</option>
                                                    <option value="M">Masculino</option>

                                                </select>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="parentesco">Parentesco:</label>
                                                <select class="form-control" id="parentesco" name="parentesco" required>
                                                    <option value="">Seleccione el parentesco</option>
                                                    <option value="padre">Padre</option>
                                                    <option value="madre">Madre</option>
                                                    <option value="hijo">Hijo</option>
                                                    <option value="hija">Hija</option>
                                                    <option value="esposo">Esposo</option>
                                                    <option value="esposa">Esposa</option>
                                                    <option value="hermano">Hermano</option>
                                                    <option value="hermana">Hermana</option>
                                                    <option value="otro">Otro</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="fechaNacimientoPariente">Fecha de Nacimiento:</label>
                                                <input type="date" class="form-control" id="fechaNacimientoPariente"
                                                    name="fechaNacimientoPariente">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="discapacidadPariente">Discapacidad:</label>
                                                <select class="form-control" id="discapacidadPariente"
                                                    name="discapacidadPariente">
                                                    <option value="">Seleccione una opción</option>
                                                    <option value="ninguna">Ninguna</option>
                                                    <option value="fisica">Física</option>
                                                    <option value="visual">Visual</option>
                                                    <option value="auditiva">Auditiva</option>
                                                    <option value="intelectual">Intelectual</option>
                                                    <option value="otra">Otra</option>
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
                                        <button type="button" class="btn btn-primary" id="guardarPariente">Guardar
                                            Pariente</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </main>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="../Public/dashBoard.js"></script>
    <script>
        $(document).ready(function () {



            const fechaNacimientoInput = document.getElementById('fechaNacimiento');
            const fechaNacimientoError = document.getElementById('fechaNacimientoError');

            fechaNacimientoInput.addEventListener('change', function () {
                const fechaNacimiento = new Date(this.value);
                const hoy = new Date();
                const edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
                const mes = hoy.getMonth() - fechaNacimiento.getMonth();
                const dia = hoy.getDate() - fechaNacimiento.getDate();

                // Ajustar la edad si el cumpleaños no ha pasado aún este año
                let edadValida = edad;
                if (mes < 0 || (mes === 0 && dia < 0)) {
                    edadValida--;
                }

                if (edadValida < 16) {
                    fechaNacimientoError.textContent = 'La persona debe tener al menos 16 años.';
                    this.setCustomValidity('Inválido'); // Muestra el mensaje de error del navegador
                } else {
                    fechaNacimientoError.textContent = '';
                    this.setCustomValidity(''); // Borra el mensaje de error
                }
            });

            $('#estado').change(function () {
                $('#parroquia').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
                $('#estado option:selected').each(function () {
                    var id_estado = $(this).val();
                    console.log(`ID del estado ${id_estado}`)
                    $.post('../Models/fetch_ciudad.php', {
                        id_estado: id_estado
                    }, function (data) {
                        $('#ciudad').html(data);
                    })
                })
            })
            $('#ciudad').change(function () {
                $('#ciudad option:selected').each(function () {
                    var ID_ciudad = $(this).val();
                    $.post('../Models/fetch_municipio.php', {
                        ID_ciudad: ID_ciudad
                    }, function (data) {
                        $('#municipio').html(data)
                    })
                })
            })
            $("#municipio").change(function () {
                $('#municipio option:selected').each(function () {
                    var id_municipio = $(this).val();
                    $.post('../Models/fetch_parroquia.php', {
                        id_municipio: id_municipio
                    }, function (data) {
                        $('#parroquia').html(data)
                    })
                })
            })
            $("#parroquia").change(function () {
                $('#parroquia option:selected').each(function () {
                })
            })





            // Variable para controlar el retraso en la petición AJAX (debounce)
            let debounceTimer;

            // --- Función para realizar la validación de formato inicial (local) ---
            // La dejamos casi igual, pero ahora solo para validaciones rápidas del formato.
            function validarFormatoCedulaLocal(cedula) {
                const cedulaLimpia = cedula.replace(/[^0-9VEJvej]/gi, ''); // Permite números y letras V, E, J
                if (cedulaLimpia.length === 0) {
                    return 'La cédula no puede estar vacía.';
                }
                // Considera una longitud mínima razonable antes de enviar al backend
                if (cedulaLimpia.length < 5) { // Por ejemplo, 5 dígitos mínimos para empezar a validar con backend
                    return 'Cédula muy corta.';
                }

            }


            // --- Añadir el 'event listener' al campo de la cédula ---
            const cedula = document.getElementById('cedula');
            const cedulaError = document.getElementById('cedulaError');

            cedula.addEventListener('keyup', () => {
                const cedulaValor = cedula.value.trim(); // Obtiene el valor actual y elimina espacios

                // Limpia cualquier temporizador anterior
                clearTimeout(debounceTimer);

                // 1. Primero, valida el formato localmente
                const formatoError = validarFormatoCedulaLocal(cedulaValor);

                if (formatoError) {
                    cedulaError.textContent = formatoError;
                    // Si hay un error de formato local, no enviamos al backend
                    return;
                } else {
                    cedulaError.textContent = ''; // Limpiamos el error de formato si ya no existe
                }

                // 2. Si el formato es válido, establece un temporizador para enviar la solicitud al backend
                // Esto se llama "debounce": espera un momento (ej. 500ms) después de que el usuario deja de escribir
                // para no saturar el servidor con peticiones por cada tecla.
                if (cedulaValor.length >= 7) { // Solo envía al backend si la cédula tiene una longitud razonable
                    cedulaError.textContent = 'Verificando cédula...'; // Mensaje de carga

                    cedulaError.style.color = 'dark'; // Un color temporal para el mensaje de carga

                    debounceTimer = setTimeout(() => {
                        // Construye la URL de la API con la cédula como parámetro
                        // Asegúrate de codificar la cédula para URLs seguras

                        const apiUrl = `http://localhost/crud_fetch/index.php/?api=validar_cedula&id=` + cedulaValor;

                        fetch(apiUrl)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error(`Error de red: ${response.statusText}`);
                                }
                                return response.json(); // Espera una respuesta JSON
                            })
                            .then(data => {
                                // Procesar la respuesta del backend
                                console.log(data)
                                if (data.success) {
                                    if (data.existe) {
                                        cedulaError.textContent = '¡Cédula ya registrada!';

                                        cedulaError.style.color = 'red';
                                        cedulaError.style.fontSize = '25px'



                                        // Opcional: podrías deshabilitar el botón de enviar o resaltar el campo
                                    } else {
                                        cedulaError.textContent = '*¡Cedula Disponible!*';

                                        cedulaError.style.color = 'green';
                                        cedulaError.style.fontSize = '25px'


                                    }
                                } else {
                                    // Si success es false, el backend envió un mensaje de error
                                    cedulaError.textContent = `Error del servidor: ${data.message}`;
                                    cedulaError.classList.add('alert-danger')
                                    cedulaError.style.color = 'dark';
                                }
                            })
                            .catch(error => {
                                console.error('Error al verificar cédula:', error);
                                cedulaError.textContent = 'Error al verificar. Intenta de nuevo.';

                                cedulaError.style.color = 'red';
                                cedulaError.style.font = '25px'

                            });
                    }, 500); // Espera 500 milisegundos (0.5 segundos) antes de enviar la petición
                } else {
                    // Si la cédula es demasiado corta para enviar al backend (según tu criterio)
                    cedulaError.textContent = ''; // O un mensaje como "Continúa escribiendo..."
                }
            });

            // Opcional: Validar al cargar la página si ya hay un valor en el input
            document.addEventListener('DOMContentLoaded', () => {
                if (cedula.value) {
                    cedula.dispatchEvent(new Event('keyup')); // Dispara el evento keyup para una validación inicial
                }
            });

            var $formSections = $('.form-section');
            var $progressBar = $('.progress-bar');
            var currentSectionIndex = 0;
            var parientes = []; // Array to store family members

            // Initialize parientes from hidden input if form is pre-populated (e.g., for editing)
            const initialParientesJson = document.getElementById('parienteArray').value;
            if (initialParientesJson) {
                try {
                    parientes = JSON.parse(initialParientesJson);
                    actualizarListaParientes(); // Update the list if there are initial parientes
                } catch (e) {
                    console.error("Error parsing initial parientes JSON:", e);
                }
            }

            function updateProgressBar() {
                var progress = ((currentSectionIndex + 1) / $formSections.length) * 100;
                $progressBar.css('width', progress + '%').attr('aria-valuenow', progress).text(Math.round(progress) + '%');
            }

            function showCurrentSection() {
                $formSections.removeClass('current').eq(currentSectionIndex).addClass('current');
                updateProgressBar();
                // Optional: Focus the first visible input of the newly visible section for accessibility
                $formSections.eq(currentSectionIndex).find('input, select, textarea').not(':disabled, [type="hidden"]').first().focus();
            }

            // --- Validation Function for a Section ---
            function validateCurrentSection() {
                var $currentVisibleSection = $formSections.eq(currentSectionIndex);
                var $formControls = $currentVisibleSection.find(':input:visible');

                let sectionIsValid = true;

                $formControls.each(function () {
                    if (!this.checkValidity()) {
                        sectionIsValid = false;
                        $(this).addClass('is-invalid'); // Add class for visual feedback
                        return false; // Break from .each() loop
                    } else {
                        $(this).removeClass('is-invalid'); // Remove if valid
                    }
                });

                return sectionIsValid;
            }

            // --- Handler for "Next" button click ---
            $('.next-step').click(function (e) {
                e.preventDefault();

                if (!validateCurrentSection()) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de Validación',
                        text: 'Por favor, complete todos los campos requeridos en esta sección antes de continuar.',
                        color: 'white'
                    });
                    // The browser's native validation should have already focused the first invalid element
                    return; // Stop if validation fails
                }

                // If validation passes, proceed to the next step
                if (currentSectionIndex < $formSections.length - 1) {
                    currentSectionIndex++;
                    showCurrentSection();
                }
            });

            // --- Handler for "Previous" button click ---
            $('.prev-step').click(function () {
                if (currentSectionIndex > 0) {
                    currentSectionIndex--;
                    showCurrentSection();
                }
            });

            // Show the first section on page load
            showCurrentSection();

            // --- Final Form Submission Handler ---
            const formularioPrincipal = document.getElementById('personaForm');
            formularioPrincipal.isSubmitting = false; // Flag to prevent infinite submission loop

            formularioPrincipal.addEventListener('submit', function (evento) {
                if (formularioPrincipal.isSubmitting) {
                    return; // If already submitting, let it go through
                }

                evento.preventDefault(); // Prevent default browser submission initially

                let formIsValid = true;
                let firstInvalidField = null; // To store the first invalid field found

                // --- Validate ALL sections on final submit ---
                for (let i = 0; i < $formSections.length; i++) {
                    let currentSection = $formSections.eq(i);
                    // Consider only visible, required inputs in validation to prevent issues with hidden fields
                    let inputsInCurrentSection = currentSection.find(':input[required]:visible');

                    for (let j = 0; j < inputsInCurrentSection.length; j++) {
                        let input = inputsInCurrentSection[j];
                        if (!input.checkValidity()) {
                            formIsValid = false;
                            if (!firstInvalidField) {
                                firstInvalidField = input;
                            }
                            $(input).addClass('is-invalid');
                        } else {
                            $(input).removeClass('is-invalid');
                        }
                    }
                }

                // --- Handle Parientes JSON validation ---
                // This is where you'd add custom client-side logic for the parientes array
                // For example, if at least one pariente is required
                const parientesArrayValue = document.getElementById('parienteArray').value;
                if (parientesArrayValue === '[]' || parientesArrayValue === '') {
                    // Example: If at least one pariente is required, and none are added
                    // This is a custom rule, not covered by HTML5 'required' on a hidden input.
                    // You'd need to decide where this error appears.
                    // For simplicity, we'll just let backend handle it, or add a specific error to 'errores' for Swal.
                }

                if (!formIsValid) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de Envío',
                        text: 'Por favor, complete todos los campos requeridos del formulario antes de enviar.',
                    });

                    // If there's an invalid field, navigate to its section and focus it
                    if (firstInvalidField) {
                        let invalidSectionIndex = $(firstInvalidField).closest('.form-section').index();
                        if (invalidSectionIndex !== -1 && invalidSectionIndex !== currentSectionIndex) {
                            currentSectionIndex = invalidSectionIndex;
                            showCurrentSection(); // Make the section visible
                        }
                        setTimeout(() => {
                            firstInvalidField.focus(); // Focus the field
                        }, 100);
                    }
                    return; // Stop submission
                }



                // If all client-side validation passes, prepare and submit the form
                const parientesJson = JSON.stringify(parientes);
                document.getElementById('parienteArray').value = parientesJson;

                formularioPrincipal.isSubmitting = true; // Set flag
                formularioPrincipal.submit(); // Now submit the form natively
            });


            // --- Modal for Parientes Management ---


            // Escuchar el evento 'show.bs.modal' de Bootstrap en tu modal
            $('#modalPariente').on('show.bs.modal', function (event) {
                // Obtener referencias a los elementos HTML
                const cedula = document.getElementById('cedula');
                const cedulaModal = document.getElementById('cedulaTrabajador');

                cedulaModal.value = cedula.value;

                const coordinacion = document.getElementById('coordinacion');
                const coordinacionModal = document.getElementById('coordinacionPariente')
                // Al abrir el modal, auto-rellenar el campo

                coordinacionModal.value = coordinacion.value;
            });


            var parientes = []; // Array to store family members

            // Lógica para agregar parientes al array y mostrar en la lista
            $('#guardarPariente').click(function () {
                var trabajador_id = $('#cedulaTrabajador').val();
                var cedulaPariente = $('#cedulaPariente').val();
                var nombre = $('#nombrePariente').val();
                var apellido = $('#apellidoPariente').val();
                var generoPariente = $('#generoPariente').val();
                var parentesco = $('#parentesco').val();
                var fechaNacimientoPariente = $('#fechaNacimientoPariente').val();
                var coordinacionPariente = $('#coordinacionPariente').val();
                var discapacidad = $('#discapacidadPariente').val();

                // Basic validation for modal fields
                if (trabajador_id && nombre && apellido && parentesco && generoPariente && fechaNacimientoPariente && coordinacionPariente && discapacidad) {
                    // Add a unique ID to each pariente for more reliable deletion
                    parientes.push({
                        trabajador_id: trabajador_id,
                        cedulaPariente: cedulaPariente,
                        nombrePariente: nombre,
                        apellidoPariente: apellido,
                        fechaNacimientoPariente: fechaNacimientoPariente,
                        parentesco: parentesco,
                        generoPariente: generoPariente,
                        coordinacionPariente: coordinacionPariente,
                        discapacidadPariente: discapacidad
                    });

                    actualizarListaParientes();
                    $('#modalPariente').modal('hide');

                    //limpíar los campos del formulario modal
                    cedulaPariente.val = ('');
                    nombre.val = ('');
                    apellido.val = ('');
                    generoPariente.val = ('');
                    parentesco.val = ('');
                    fechaNacimientoPariente.val = ('');
                    discapacidad.val = ('');


                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Campos Requeridos',
                        text: 'Por favor, complete el Cedula del trabajador, nombre, apellido, Fecha de Nacimiento, parentesco, género y discapacidad del pariente.',
                    });
                }
            });

            function actualizarListaParientes() {
                var listaHTML = '';

                parientes.forEach(function (pariente) {
                    // Use a more robust identifier, perhaps cedulaPariente if it's unique, otherwise use an index
                    // For demonstration, let's stick to using cedulaPariente if available, or a combination
                    const uniqueIdentifier = `${pariente.nombrePariente}-${pariente.apellidoPariente}`;

                    listaHTML += `<li>${pariente.nombrePariente} ${pariente.apellidoPariente} (C.I: ${pariente.cedulaPariente || 'N/A'}) - Parentesco: ${pariente.parentesco}`;

                    if (pariente.fechaNacimientoPariente) {
                        listaHTML += ` - Nacimiento: ${pariente.fechaNacimientoPariente}`;
                    }

                    listaHTML += ` - Género: ${pariente.generoPariente} - Discapacidad: ${pariente.discapacidadPariente} - <strong>C.I del Trabajador: ${pariente.trabajadorId}</strong>`;

                    // Change data-cedula to data-identifier for consistency with retrieval
                    listaHTML += ` <button type="button" class="btn btn-danger btn-sm ms-2 eliminar-pariente" data-identifier="${uniqueIdentifier}">Eliminar</button></li>`;

                });
                $('#lista-parientes').html(listaHTML);

                $('.eliminar-pariente').off('click').on('click', function () {
                    // Retrieve the data attribute correctly
                    const identifierToDelete = $(this).data('identifier');
                    console.log(identifierToDelete)

                    // Filter based on the chosen unique identifier
                    parientes = parientes.filter(p => {
                        const currentIdentifier = `${p.nombrePariente}-${p.apellidoPariente}`;
                        console.log(currentIdentifier)
                        return currentIdentifier !== identifierToDelete;
                    });

                    actualizarListaParientes();
                });
            }

            // Cuando se oculta el modal, limpiar el formulario
            $('#modalPariente').on('hidden.bs.modal', function () {
                //Accedemos al indice [0] ya que el selector de ID osea se $ siempre devuelve 1 elemento el indice siempre sera 0 
                $('#formPariente')[0].reset();
            });

            formularioPrincipal.addEventListener('submit', function (evento) {

                console.log(formularioPrincipal);
                const formData = new FormData(formularioPrincipal);
                //Construir la URL actual de action del formulario
                let currentAction = formularioPrincipal.getAttribute('action');

                // Serializa el array de parientes a una cadena JSON
                const parientesJson = JSON.stringify(parientes);
                console.log(parientesJson);


                // Asigna la cadena JSON al input hidden
                document.getElementById('parienteArray').value = parientesJson;


            })
        });

        // --- Independent script for fetching latest workers ---
        document.addEventListener('DOMContentLoaded', () => {
            const listaTrabajadoresDiv = document.getElementById('reporte');

            fetch(`http://localhost/crud_fetch/index.php/?api=obtenerUltimosTrabajadores`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        listaTrabajadoresDiv.innerHTML = ''; // Clear loading message
                        if (data.data.length > 0) {
                            data.data.forEach(trabajador => {
                                const div = document.createElement('div');
                                div.classList.add('trabajador');
                                div.innerHTML = `
                                    <ol>
                                        <li><strong>Hora Registro :</strong> ${trabajador.horaRegistro}</li>
                                        <li><strong>Cédula:</strong> ${trabajador.cedula}</li>
                                        <li><strong>Nombre:</strong> ${trabajador.nombres}</li>
                                        <li><strong>Apellido:</strong> ${trabajador.apellidos}</li>
                                    </ol>`;
                                listaTrabajadoresDiv.appendChild(div);
                            });
                        } else {
                            listaTrabajadoresDiv.innerHTML = '<p>No se encontraron trabajadores.</p>';
                        }
                    } else {
                        listaTrabajadoresDiv.innerHTML = `<p>Error: ${data.message}</p>`;
                    }
                })
                .catch(error => {
                    console.error('Error al obtener los datos:', error);
                    listaTrabajadoresDiv.innerHTML = `<p>Hubo un problema al cargar los trabajadores: ${error.message}</p>`;
                });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // These should be your actual HTML element IDs
            const totalesContainer = document.getElementById('totales'); // Main container for all totals (or maybe specific sections)
            const generalStatsContainer = document.getElementById('totalPersonas'); // Specific container for general totals

            fetch('http://localhost/crud_fetch/index.php/?api=totalRegistros')
                .then(response => {
                    if (!response.ok) {
                        // Throw an error with the response status for better debugging
                        throw new new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(apiResponse => {
                    if (apiResponse.success) {
                        console.log('API Response:', apiResponse); // Log the full API response to see its structure

                        const data = apiResponse.data; // Access the actual data object

                        // Clear previous content in both containers
                        generalStatsContainer.innerHTML = '';
                        totalesContainer.innerHTML = '';

                        // --- Display General Totals (totalTrabajadores, totalParientes) ---
                        if (data && data.totalPersonas) {
                            console.log(data.totalPersonas)
                            const generalHtml = `
                                    <div class="list-group">
                                        <a href="listarTrabajadores.php" class="list-group-item list-group-item-action fs-5" aria-current="true">
                                            Total Trabajadores:  ${data.totalPersonas.totalTrabajadores} <i class="fa-solid fa-person"></i>
                                        </a>
                                        <a href="listarParientes" class="list-group-item list-group-item-action fs-5">
                                            Total Parientes:  ${data.totalPersonas.totalParientes} <i class="fa-solid fa-users"></i>
                                        </a>
                                    </div>
                                `;
                            generalStatsContainer.innerHTML = generalHtml; // Assign directly to its container
                        } else {
                            generalStatsContainer.innerHTML = `<p>No se pudieron cargar los totales generales.</p>`;
                        }

                        // --- Display Personal por Coordinacion (por_coordinacion array) ---
                        if (data && data.por_coordinacion && data.por_coordinacion.length > 0) {
                            let tableHtml = `
                                    
                                    <table class="table align-middle table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nombre Coordinacion</th>
                                                <th scope="col">Personal por Coordinacion</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-group-divider">
                                `;

                            data.por_coordinacion.forEach(coordinacion => {
                                tableHtml += `
                                            <tr>
                                                <th scope="row">${coordinacion.nombre_coordinacion}</th>
                                                <td>${coordinacion.personalPorCoordinacion}</td>
                                            </tr>
                                    `;
                            });

                            tableHtml += `
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th scope="row" class="fw-bold bg-dark text-white">Total</th>
                                                <td scope="row" class="fw-bold bg-dark text-white">${data.totalPersonas.totalPorCoordinacion}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                `;
                            totalesContainer.innerHTML = tableHtml; // Assign to the main container
                        } else if (data && data.por_coordinacion && data.por_coordinacion.length === 0) {
                            // Handle case where there are no sedes or no personal assigned to sedes
                            totalesContainer.innerHTML = `<p>No hay personal asignado por coordinacion disponible.</p>`;
                        } else {
                            // Fallback for when 'por_sede' data structure is missing or malformed
                            totalesContainer.innerHTML = `<p>No se pudieron cargar los detalles por coordinacion.</p>`;
                        }

                    } else {
                        // API returned success: false
                        totalesContainer.innerHTML = `<p>Error del servidor: ${apiResponse.message || 'Mensaje de error desconocido'}</p>`;
                        generalStatsContainer.innerHTML = ''; // Clear if there's an API error
                    }
                })
                .catch(error => {
                    // Network error, CORS issue, or JSON parsing error
                    console.error('Fetch error:', error); // Log the actual error for debugging
                    generalStatsContainer.innerHTML = `<p>Error de conexión: ${error.message}.</p>`;
                    totalesContainer.innerHTML = `<p>Hubo un problema al cargar los cálculos. Por favor, revise su conexión o intente de nuevo.</p>`;
                });
        });
        /*Variable Renaming: Renamed totales (the HTML element) to totalesContainer to avoid naming conflicts with the data.totales property if you had one, and to better reflect its role as a container. Also renamed data in the second .then() to apiResponse and then extracted const data = apiResponse.data; to clearly distinguish the raw API response from the structured data payload Accessing Data Correctly:
        The general totals (totalTrabajadores, totalParientes) are now accessed from data.generales.
        The personal by sede is an array found at data.por_sede. I've added a separate forEach loop specifically for this array to display each sede's information.
        Improved HTML Structure: Instead of putting everything into a single <ol>, I've separated them into two distinct sections: one for general totals and another for the per-sede breakdown. This makes the displayed information clearer and more organized.
        Robust Error Handling:
        The throw new Error() in the first .then() now includes the HTTP status code for better debugging.
        The catch block now logs the full error object to the console, which is invaluable for debugging network issues.
        Added checks for data && data.generales and data && data.por_sede && data.por_sede.length > 0 to prevent errors if parts of the data are missing or empty.
        Clearer User Feedback: Provided more specific messages for different error scenarios (HTTP errors, server-side logical errors, network errors).*/
    </script>
    <script defer>
        const ctx = document.getElementById('myChart');
        let myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    font: {
                        size: 12,
                        weight: 'bold',
                        family: 'Poppins',
                        color: 'white'

                    },
                    label: 'Personal Nuevo Ingreso',
                    data: [],
                    backgroundColor: ['#8F128F', '#5CDADF', '#CEED20', '#F1CA2E', '#5A19F4', '#041223', '#9B1328', '#EF794E', 'red', 'blue', 'gren', 'yellow'],
                    borderColor: ['purple'],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: true,
                    },
                    title: {
                        display: true,
                        text: 'N° de ingresos por mes en FTTC',
                        color: 'white',
                        family: 'Poppins',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const mostrar = (dataArray) => { // Renamed parameter for clarity
            if (!Array.isArray(dataArray)) {
                console.error("Error: Data passed to mostrar is not an array.", dataArray);
                // Decide how to handle this:
                // return; // Stop execution if it's not an array
                dataArray = []; // Or make it an empty array to avoid crashing map
            }

            const labels = dataArray.map(element => element.anoFormato);
            const values = dataArray.map(element => element.total_personas);

            myChart.data['labels'] = labels;
            myChart.data['datasets'][0]['data'] = values;
            myChart.update();
        };

        fetch('http://localhost/crud_fetch/index.php/?api=comparativa')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Is not find any response from server');
                }
                return response.json();
            })
            .then(jsonResponse => { // Renamed parameter to be explicit about the full JSON object
                if (jsonResponse && jsonResponse.success && Array.isArray(jsonResponse.data)) {
                    mostrar(jsonResponse.data); // Pass only the 'data' array to 'mostrar'
                } else {
                    console.error("API response structure is not as expected:", jsonResponse);
                    // Optionally call mostrar with an empty array or handle error
                    mostrar([]);
                }
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
    </script>

    <script defer>
        //Script para validar si la cedula del pariente ya se encuentra registrada , antes de hacer dicho registro en la base de datos
        // Obtener referencias a los elementos HTML
        const cedulaPariente = document.getElementById('cedulaPariente');
        const cedulaError = document.getElementById('cedulaParienteError');


        // Variable para controlar el retraso en la petición AJAX (debounce)
        let debounceTimerPariente;

        // --- Función para realizar la validación de formato inicial (local) ---
        // La dejamos casi igual, pero ahora solo para validaciones rápidas del formato.
        function validarFormatoCedulaLocalPariente(cedulaPariente) {
            const cedulaLimpia = cedulaPariente.replace(/[^0-9VEJvej]/gi, ''); // Permite números y letras V, E, J
            // Considera una longitud mínima razonable antes de enviar al backend
            if (cedulaLimpia.length < 5) { // Por ejemplo, 5 dígitos mínimos para empezar a validar con backend
                return 'Cédula muy corta.';
            }

        }


        // --- Añadir el 'event listener' al campo de la cédula ---
        cedulaPariente.addEventListener('keyup', () => {
            const cedulaValor = cedulaPariente.value.trim(); // Obtiene el valor actual y elimina espacios

            // Limpia cualquier temporizador anterior
            clearTimeout(debounceTimerPariente);

            // 1. Primero, valida el formato localmente
            const formatoError = validarFormatoCedulaLocalPariente(cedulaValor);

            if (formatoError) {
                cedulaError.textContent = formatoError;
                // Si hay un error de formato local, no enviamos al backend
                return;
            } else {
                cedulaError.textContent = ''; // Limpiamos el error de formato si ya no existe
            }

            // 2. Si el formato es válido, establece un temporizador para enviar la solicitud al backend
            // Esto se llama "debounce": espera un momento (ej. 500ms) después de que el usuario deja de escribir
            // para no saturar el servidor con peticiones por cada tecla.
            if (cedulaValor.length >= 7) { // Solo envía al backend si la cédula tiene una longitud razonable
                cedulaError.textContent = 'Verificando cédula...'; // Mensaje de carga

                cedulaError.style.color = 'red'; // Un color temporal para el mensaje de carga

                debounceTimerPariente = setTimeout(() => {
                    // Construye la URL de la API con la cédula como parámetro
                    // Asegúrate de codificar la cédula para URLs seguras

                    const apiUrl = `http://localhost/crud_fetch/index.php/?api=validarCedulaPariente&id=` + cedulaValor;

                    fetch(apiUrl)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`Error de red: ${response.statusText}`);
                            }
                            return response.json(); // Espera una respuesta JSON
                        })
                        .then(data => {
                            // Procesar la respuesta del backend
                            console.log(data)
                            if (data.success) {
                                if (data.existe) {
                                    cedulaError.textContent = '¡Cédula ya registrada!';

                                    cedulaError.style.color = 'red';
                                    cedulaError.style.fontSize = '25px'



                                    // Opcional: podrías deshabilitar el botón de enviar o resaltar el campo
                                } else {
                                    cedulaError.textContent = '*¡Cedula Disponible!*';

                                    cedulaError.style.color = 'green';
                                    cedulaError.style.fontSize = '15px'


                                }
                            } else {
                                // Si success es false, el backend envió un mensaje de error
                                cedulaError.textContent = `Error del servidor: ${data.message}`;
                                cedulaError.classList.add('alert-danger')
                                cedulaError.style.color = 'dark';
                            }
                        })
                        .catch(error => {
                            console.error('Error al verificar cédula:', error);
                            cedulaError.textContent = 'Error al verificar. Intenta de nuevo.';

                            cedulaError.style.color = 'red';
                            cedulaError.style.font = '25px'

                        });
                }, 500); // Espera 500 milisegundos (0.5 segundos) antes de enviar la petición
            } else {
                // Si la cédula es demasiado corta para enviar al backend (según tu criterio)
                cedulaError.textContent = ''; // O un mensaje como "Continúa escribiendo..."
            }
        });
    </script>

</body>

</html>