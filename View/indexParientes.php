<?php
/*
 session_start();

  if(!isset($_SESSION['rol'])){//we validate the session exist and case him not exist , get out to login.php
    header(header:"location: login.php");
  }else{
    if($_SESSION['rol'] != 2){//we validate the session ['rol'] is = 1 and case be difference get out to login.php
      header(header:"location: login.php");
    }
  }
*/
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Parientes-FTTC</title>    
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href=" ../Public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <?php
    include_once "../Config/conexion.php";

    $queryPatologias = $pdo->prepare(query: "SELECT id, patologias FROM patologias ORDER BY id DESC");
    $queryPatologias->execute();

    $queryEspecialidades = $pdo->prepare(query: "SELECT id, especialidades FROM especialidades");
    $queryEspecialidades->execute();

    $queryInterna = $pdo->prepare(query: "SELECT id, especialidades FROM especialidades WHERE id = 1 LIMIT 1");
    $queryInterna->execute();

  ?>
  <body>
    <div class="wrapper">
      <aside id="sidebar" class="js-sidebar">
          <!-- Content For Sidebar -->
          <div class="h-100">
              <div class="sidebar-logo">
                  <a href="#">FTTC</a>
              </div>
              <ul class="sidebar-nav">
                <li class="sidebar-header">
                    Elementos analista
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="fa-solid fa-list pe-2"></i>
                        Generar Excel
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="fa-solid fa-list pe-2"></i>
                        Generar PDF
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed" data-bs-target="#pages" data-bs-toggle="collapse"
                        aria-expanded="false">
                        <i class="fa-solid fa-file-lines pe-2"></i>
                        Modulos
                    </a>
                    <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">Trabajadores</a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link">
                              <button type="button" class="btn text-white" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="Cortesia">Cortesia</button>
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
              <button class="btn border border-danger bg-light" id="sidebar-toggle" type="button">
                  <span class="navbar-toggler-icon"></span>
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
                              <a href="Models/logout.php" class="dropdown-item">Salir</a>
                          </div>
                      </li>
                  </ul>
              </div>
          </nav>
          <br>
          <main class="col-12 px-3 ">
            <div class="container-fluid">
                <div class="mb-3">
                    <h1 class="fw-bold text-center text-white">MODULO PARIENTES</h1>
                </div>
                <div class="row shadow-lg">
                    <div class="col-12 col-md-6 d-flex">
                        <div class="card flex-fill border-0 illustration">
                            <div class="card-body p-0 d-flex flex-fill">
                                <div class="row g-0 w-100">
                                    <div class="col-6">
                                        <div class="p-4 m-1">
                                            <h4>¡Bienvenido!,<br> <?php
                                                              echo "C.I -".$_SESSION['usuario']." "."Analista"
                                                              ?></h4>
                                            <p class="mb-0">Vista Analista/Servicio Medico</p>
                                        </div>
                                    </div>
                                    <div class="col-6 align-self-end text-end">
                                        <img src="../Public/img/logotipo.jpg" class="img-fluid illustration-img"
                                            alt="teatro teresa carreño">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  <div class="col-12 col-md-6 d-flex">
                      <div class="card flex-fill border-0 illustration">
                          <div class="card-body py-4">
                              <div class="d-flex align-items-start">
                                  <div class="flex-grow-1">
                                    
                                    <div class="list-group" id="reporte">
                                      
                                    </div>
                                    <div class="list-group col-4 d-flex">
                                      <button type="button" id="desglozar" class="list-group-item list-group-item-action bg-dark text-white" aria-current="true">
                                        Desplegar Estadisticas
                                      </button>
                                    </div>
                        
                                        <h4 class="mb-2">
                                            
                                        </h4>
                                        <p class="mb-2 ">
                                            FECHA & HORA
                                        </p>
                                      <div class="mb-0">
                                        <span class="text-white fs-6">
                                            <?php 
                                              echo date(format:"d-m-Y");
                                             ?>
                                        </span>
                                        <span class="text-white fs-6" id="mostrar_fecha">
                                              
                                        </span>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </main>
          <main class="content px-3 py-2">
              <div class="container-fluid">
                  <div class="card-body">
                    <div class="col-12 d-flex ">
                      <div class="card flex-fill border-0 " style="background-color:black;" id="form_container">
                        <div class="card-body py-4">
                          <div class="align-items-center">
                            <div class="flex-grow-1">
                <!--CAMPO TITULO-->
                              <div class="card border-3">
                                <div class="card-header shadow-lg" id="card">
                                  <h3 class="card-title text-center text-dark fw-bold" >Registro de Parientes</h3>
                                </div>
                                <div class="card-body border border-5 bg-light shadow-lg" id="card-registro">
                                  <form action="" id="formulario" name="formulario">
                <!---- Campo Opciones --->
                                    <div class="container-sm">
                                      <h4 class=" fw-bold">Motivo de la Consulta</h4> 
                                        <div class="form-check" id="campo_medicina">
                                          <input type="radio" class="form-check-input fs-5 bg-dark focus-ring focus-ring-info" value="1" id="tipo_interna" name="tipo_consulta">
                                          <label for="tipo_interna" class="fs-5">Medicina Interna</label>
                                        </div>
                                        <div class="form-check" id="campo_especialidad">
                                          <input type="radio" class="form-check-input fs-5 bg-dark focus-ring focus-ring-warning" value="2" id="tipo_especialista" name="tipo_consulta">
                                          <label for="tipo_especialista" class="fs-5">Especialidad</label>
                                        </div>
                                    </div>
                                    <hr>
                  <!--CAMPO UBICACION DEL SERVICIO MEDICO-->
                                    <div class="container" id="main_container" style="display: none;">
                                      <h4 class="text-start fw-bold">Sede del Servicio medico</h4>
                                        <div class="form-check" id="campo_planta">
                                          <input type="radio" class="form-check-input fs-5 bg-dark" value="PB" id="planta" name="sede">
                                          <label for="planta" class="fs-5">Planta Baja</label>
                                        </div>
                                        <div class="form-check" id="campo_sotano">
                                          <input type="radio" class="form-check-input fs-5 bg-dark" value="sotano" id="sotano" name="sede">
                                          <label for="sotano" class="fs-5" >Sotano</label>
                                        </div>
                                      <hr>
                    <!--- Campo Cedula --->
                                      <h5 class="text-center fw-bold">Datos Personales</h5>
                                        <div class="mb-3">
                                          <input type="hidden" name="idpersonas" id="idpersonas" value="">
                                          <div class="input-group">
                                            <span class="input-group-text">Cedula</span>
                                            <input type="text" name="paciente" id="paciente" placeholder="Cedula..." class="form-control">
                                          </div>
                                        </div>
                    <!--Campo EDAD-->
                                        <div class="mb-3">
                                          <div class="input-group">
                                            <span class="input-group-text">Edad</span>
                                            <input type="text" name="edades" id="edades" placeholder="Edad..." class="form-control" >
                                          </div>
                                        </div>
                    <!---Campo Sexo--->
                                        <div class="d-sm-inline-flex text-center">
                                          <div class="p-2" id="masculinoPariente">
                                            <input type="radio" class="form-check-input fs-5 bg-dark focus-ring focus-ring-info" value="M" id="masculino" name="sexo_Pariente">
                                            <label for="masculino" class="fs-5">Masculino</label>
                                          </div>
                                          <div class="p-2" id="femeninoPariente">
                                            <input type="radio" class="form-check-input fs-5 bg-dark focus-ring focus-ring-info" value="F" id="femenino" name="sexo_Pariente">
                                            <label for="femenino" class="fs-5">Femenino</label>
                                          </div>
                                        </div>
                                        <hr>
                    <!--Campo Parentesco-->
                                        <div class="mb-3">
                                          <div class="input-group">
                                            <span class="input-group-text">Parentesco</span>
                                            <input type="text" name="nexo" id="nexo" placeholder="Parentesco" class="form-control" >
                                          </div>
                                        </div>
                    <!--CAMPO COORDINACION-->
                                        <div class="mb-3">
                                          <div class="input-group">
                                            <span class="input-group-text">Coordinacion</span>
                                            <input type="text" name="coordinaciones" id="coordinaciones" placeholder="Coordinacion..." class="form-control">
                                          </div>
                                        </div>
                                        <hr>
                    <!--- Campo Medicina General--->
                                      <div class="container-sm" id="campo_medicinaInterna">
                                        <div class="mb-3">
                                        <h5 class="text-center fw-bold">Medicina Interna</h5>
                                          <div class="input-group">
                                            <span class="input-group-text">Consulta</span>
                                            <select class="form-select" name="medicina_interna" id="medicina_interna">
                                              <option value=""></option>
                                              <?php while($row = $queryInterna->fetch(mode: PDO::FETCH_ASSOC)){?>
                                                <option value="<?php echo $row['id'];?>"><?php echo $row['especialidades'];?></option>
                                                <?php } ?>
                                            </select>
                                          </div>
                                        </div>
                      <!--- Campo Doctor--->
                                        <div class="mb-3">
                                          <div class="input-group">
                                            <span class="input-group-text">Profesional</span>
                                            <select class="form-select" id="profesional" name="profesional" data-placeholder="Hazme Click">
                                              <option value=""></option>
                                            </select>
                                          </div>
                                        </div>
                                        <hr>
                                      </div>
                  <!--- Campo Especialidad-->
                                      <div class="container-sm" id="campo_especialista">
                                      <h5 class="text-center fw-bold">Especialidad</h5>
                                        <div class="mb-3">
                                          <div class="input-group">
                                            <span class="input-group-text">Especialidad</span>
                                            <select class="form-select" id="especialidad" name="especialidad" data-placeholder="Hazme Click">
                                              <option value=""></option>
                                              <?php while($row = $queryEspecialidades->fetch(mode: PDO::FETCH_ASSOC)){?>
                                                <option value="<?php echo $row['id'];?>"><?php echo $row['especialidades'];?></option>
                                                <?php } ?>
                                            </select>
                                          </div>
                                        </div>
                  <!--- Campo Especialista-->
                                        <div class="mb-3">
                                          <div class="input-group">
                                            <span class="input-group-text">Especialista</span>
                                            <select class="form-select" id="especialista" name="especialista" data-placeholder="Hazme Click">
                                              <option value=""></option>
                                            </select>
                                          </div>
                                        </div>
                                        <hr>
                                      </div>
                    <!--Campo Patologia-->
                                    <div class="mb-3">
                                    <h5 class="text-center fw-bold">Sintomas</h5>
                                      <div class="mb-3">
                                        <div class="input-group">
                                          <span class="input-group-text">Patologia</span>
                                          <select class="form-select" name="patologia" id="patologia" data-placeholder="Hazme Click">
                                            <option></option>
                                            <?php while($row = $queryPatologias->fetch(mode: PDO::FETCH_ASSOC)){?>
                                              <option value="<?php echo $row['id']?>"><?php echo $row['patologias']?></option>
                                            <?php } ?>
                                          </select>
                                        </div>
                                      </div>
                    <!--CAMPO AFECCION-->
                                      <div class="mb-3">
                                        <div class="input-group">
                                          <span class="input-group-text">Afeccion</span>
                                          <textarea class="form-control" placeholder="Afeccion del paciente.." id="afeccion" name="afeccion"></textarea>
                                        </div>
                                      </div>
                                      <hr>
                                    </div>
                    <!--- Campo Botton Registrar --->
                                    <div class="form-group text-center">                  
                                      <input type="button" name="registrar" id="registrar" value="Registrar" class="btn btn-outline-primary focus-ring focus-ring-dark btn-lg">
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
<!------- Campo Tabla ------------>
                      <div class="card border-3">
                          <div class="card-header bg-dark text-white">
                              <h4 class="card-title fw-bold">
                                  Tabla de Seleccion
                              </h4>
                              <h6 class="card-subtitle text-white ">
                                  Base de datos de los trabajadores activos de la Fundacion Teatro Teresa Carreño.
                              </h6>
                          </div>
                          <div class="card-body">
                            <form action="" method="post">
                              <div class="form-group">
                                <label for="buscar" class="form-label fw-bold fs-5">Introduzca CI o Nombre</label>
                              <p class="placeholder-glow col-6 bg-dark">
                                <span class="placeholder col-12">
                                <input type="text" name="buscarPariente" id="buscarPariente" class="form-control bg-light text-dark fs-4 fw-bold" placeholder="Buscar..." title="Introduzca Nombre, Apellido o CI">
                                </span>                    
                              </p>
                              </div>
                            </form>
                              <table class="table fs-6 able-striped table-hover shadow-lg">
                                <thead>
                                  <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">C.I Trabajador</th>
                                    <th scope="col">Nombre del Trabajador</th>
                                    <th scope="col">C.I pariente</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Apellidos</th>
                                    <th scope="col">Parentesco</th>
                                    <th scope="col">Discapacidad</th>
                                    <th scope="col">Edad</th>
                                    <th scope="col">Coordinacion</th>
                                    <th scope="col">Accion</th>
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
                                      <a href="#" class="text-muted">Sobre mi </a>
                                  </li>
                                  <li class="list-inline-item">
                                      <a href="#" class="text-muted">Terminos y Condiciones</a>
                                  </li>
                                  
                              </ul>
                          </div>
                      </div>
                  </div>
              </footer>
          </div>
      </div>
    <main>
      <?php
          require_once "/xampp/htdocs/crud_fetch/Config/conexion.php";

          $queryInstitucion = $pdo->prepare(query: "SELECT id, departamento FROM cortesia ORDER BY departamento ASC");
          $queryInstitucion->execute();

          $query_Interna = $pdo->prepare(query:"SELECT id, especialidades FROM especialidades WHERE id = 1");
          $query_Interna->execute();
          
          $query_Especialidades = $pdo->prepare(query:"SELECT id, especialidades FROM especialidades");
          $query_Especialidades->execute();

          $query_Patologias = $pdo->prepare(query:"SELECT id, patologias FROM patologias");
          $query_Patologias->execute();
          
      ?>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header border-4 border-bottom bg-dark text-white">
              <h1 class="modal-title fs-3">Datos del Funcionario</h1>
              <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body border-2">
              <form class="border border-radio border-3" id="formCortesia">
  <!---Campo Motivo de la Consulta--->
                <h5 class="fw-bold text-center"></h5> 
                <div class="d-sm-inline-flex text-center" id="motivoConsulta">
                  <div class="p-2" id="campoMedicina">
                    <input type="radio" class="form-check-input fs-5 bg-dark focus-ring focus-ring-info" value="1" id="tipoMedicina" name="tipoConsulta">
                    <label for="tipoMedicina" class="fs-5">Medicina Interna</label>
                  </div>
                  <div class="p-2" id="campoEspecialidad">
                    <input type="radio" class="form-check-input fs-5 bg-dark focus-ring focus-ring-info" value="2" id="tipoEspecialidad" name="tipoConsulta">
                    <label for="tipoEspecialidad" class="fs-5">Especialidad</label>
                  </div>               
                </div>
                <hr>
  <!--- Campo Sede del Servicio medico--->
              <div class="container-sm" id="container-sedes" style="display: none">
                <h5 class="fw-bold text-center">Sede del Servicio Medico</h5>
                <div class="d-sm-inline-flex text-center" id="sedeCortesia">
                  <div class="p-2" id="PB_Cortesia">
                    <input type="radio" class="form-check-input fs-5 bg-dark focus-ring focus-ring-info" value="PB" id="PBCortesia" name="sede_Cortesia">
                    <label for="PBCortesia" class="fs-5">Planta Baja</label>
                  </div>
                  <div class="p-2" id="sotano_Cortesia">
                    <input type="radio" class="form-check-input fs-5 bg-dark focus-ring focus-ring-info" value="sotano" id="sotanoCortesia" name="sede_Cortesia">
                    <label for="sotanoCortesia" class="fs-5">Sotano</label>
                  </div>
                </div>
                <hr>
              </div>
  <!--- Datos personales---->
                <div class="container-sm" id="container_Modal" style="display: none">
                  <div class="mb-3">
                    <h5 class="fw-bold text-center">Datos Personales</h5>
    <!---Campo Cedula--->
                    <div class="input-group">
                      <span class="input-group-text">Cedula</span>
                      <input type="text" class="form-control" name="cedula_cortesia" id="cedula_cortesia" placeholder="...">
                    </div>  
                  </div>
    <!---Campo Nombre--->
                  <div class="mb-3">
                    <div class="input-group">
                      <span class="input-group-text">Nombre</span>
                      <input type="text" class="form-control" name="nombre_cortesia" id="nombre_cortesia" placeholder="..."></input>
                    </div>
                  </div>
    <!---Campo Edad-->
                  <div class="mb-3">
                    <div class="input-group">
                      <span class="input-group-text">Edad</span>
                      <input type="text" class="form-control" name="edad_cortesia" id="edad_cortesia" placeholder="..."></input>
                    </div>
                  </div>
    <!---Campo Sexo--->
                  <div class="d-sm-inline-flex text-center">
                    <div class="p-2" id="sexo_Masculino">
                      <input type="radio" class="form-check-input fs-5 bg-dark focus-ring focus-ring-info" value="M" id="masculinoCortesia" name="sexo_cortesia">
                      <label for="masculinoCortesia" class="fs-5">Masculino</label>
                    </div>
                    <div class="p-2" id="sexo_Femenino">
                      <input type="radio" class="form-check-input fs-5 bg-dark focus-ring focus-ring-info" value="F" id="femeninoCortesia" name="sexo_cortesia">
                      <label for="femeninoCortesia" class="fs-5">Femenino</label>
                    </div>
                  </div>
                  <hr>
    <!--- Campo Cortesia--->
                  <div class="mb-3">
                  <h5 class="fw-bold text-center">Organismo de Cortesia</h5>
                    <div class="input-group">
                      <span class="input-group-text">Cortesia</span>
                      <select name="institucionCortesia" id="institucionCortesia" class="form-select" >
                        <option value=""></option>
                        <?php while($row = $queryInstitucion->fetch(mode: PDO::FETCH_ASSOC)){?>
                        <option value="<?php echo $row['id']?>"><?php echo $row['departamento'];?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <hr>
                  </div>
    <!---- Campo Medicina General--->
                  <div class="mb-3" id="field_medicina">
                    <h5 class="fw-bold text-center">Medicina Interna</h5>
                    <div class="input-group">
                      <span class="input-group-text">Consulta</span>
                      <select class="form-select" name="medicinaCortesia" id="medicinaCortesia">
                        <option value=""></option>
                        <?php while($row = $query_Interna->fetch(mode: PDO::FETCH_ASSOC)){?>
                          <option value="<?php echo $row['id'];?>"><?php echo $row['especialidades'];?></option>
                          <?php } ?>
                      </select>
                    </div>
                    <br>
    <!---- campo profesional-->
                    <div class="input-group">
                      <span class="input-group-text">Profesional</span>
                      <select class="form-select" id="profesionalCortesia" name="profesionalCortesia" data-placeholder="Hazme Click">
                        <option value=""></option>
                      </select>
                    </div>
                    <hr>
                  </div>
    <!--- Campo Especialidad-->
                  <div class="mb-3" id="field_especialidad">
                  <h5 class="text-center fw-bold">Especialidad</h5>
                    <div class="input-group">
                      <span class="input-group-text">Especialidad</span>
                      <select class="form-select" id="especialidadCortesia" name="especialidadCortesia" data-placeholder="Hazme Click">
                        <option value=""></option>
                        <?php while($row = $query_Especialidades->fetch(mode: PDO::FETCH_ASSOC)){?>
                          <option value="<?php echo $row['id'];?>"><?php echo $row['especialidades'];?></option>
                          <?php } ?>
                      </select>
                    </div>
                    <br>
    <!--- Campo Especialista-->
                    <div class="input-group">
                      <span class="input-group-text">Especialista</span>
                      <select class="form-select" id="especialistaCortesia" name="especialistaCortesia" data-placeholder="Hazme Click">
                        <option value=""></option>
                      </select>
                    </div>
                    <hr>
                  </div>
    <!--- Campo Patologia-->
                  <div class="mb-3">
                    <div class="input-group">
                      <span class="input-group-text">Patologia</span>
                      <select class="form-select" name="patologiaCortesia" id="patologiaCortesia" data-placeholder="Hazme Click">
                        <option></option>
                        <?php while($row = $query_Patologias->fetch(mode: PDO::FETCH_ASSOC)){?>
                          <option value="<?php echo $row['id']?>"><?php echo $row['patologias']?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
    <!--- Campo Afeccion-->
                  <div class="mb-3">
                    <div class="input-group">
                      <span class="input-group-text">Afeccion</span>
                      <textarea name="afeccionCortesia" class="form-control" id="afeccionCortesia" rows="3"></textarea>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                  <button type="button" class="btn btn-primary" id="registrarCortesia" name="registrarCortesia" style="display: none">Registrar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </main>
    

            
<!--CAMPO SCRIPTS-->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../public/parientes.js"></script>
<!---Script del modal cortesia -->
    <script defer>
        $(document).ready(function(){
          $('#medicinaCortesia').change(function(){
            $('#medicinaCortesia option:selected').each(function(){
              id_interna = $(this).val()
              $.post('../Models/doctorSearch_controller.php',{id_interna: id_interna},function(data){
                $('#profesionalCortesia').html(data)
              })
            })
          })
          $('#especialidadCortesia').change(function (){
            $('#especialidadCortesia option:selected').each(function(){
              id_especialidad = $(this).val()
              $.post('../Models/doctorSearch_controller.php',{id_especialidad: id_especialidad},function(data){
                $('#especialistaCortesia').html(data)
              })
            })
          })
          $('input[name="tipoConsulta"]').change(function(){
          //aqui usamos this para hacer referencia a los radio button y con la funcion .is (:checked) capturamos cual boton se apreto
          if($(this).is(':checked')){
            
            //capturamos en una const el valor del button presionado para asi poder usar el value del mismo
            const consultas = $(this).val()
            console.log(consultas)
            if(consultas == 1){
              $('#campoEspecialidad').slideUp(200)
              $('#container-sedes').fadeIn(200)
              $('#field_especialidad').hide(300)
            }if(consultas == 2){
              $('#campoMedicina').fadeOut(200)
              $('#container-sedes').fadeIn(200)
              $('#field_medicina').hide(300)
            }
          }else{
            console.log("por favor selecciona el tipo de consulta")
          }
        })
        //Esconder radio del sexo contrario al momento de seleccionar una opcion
        $('input[name="sexo_Pariente"]').change(function(){
          if($(this).is(':checked')){
            const sexoP = $(this).val()
            console.log(sexoP)
            if(sexoP == 'M'){
              $('#femeninoPariente').slideUp(200)
            }if(sexoP == 'F'){
              $('#masculinoPariente').hide(200) 
            }
          }else{
            console.log('Debe indicar el genero de la persona')
          }
        });
        $('input[name="sede_Cortesia"]').change(function(){
          if($(this).is(':checked')){
            const sedes = $(this).val()
            console.log(sedes)
            if(sedes == 'PB'){
              $('#sotano_Cortesia').slideUp(200)
              $('#registrarCortesia').fadeIn(200)
              $('#container_Modal').slideDown(200)
            }if(sedes == 'sotano'){
              $('#PB_Cortesia').fadeOut(200)
              $('#container_Modal').slideDown(200)
              $('#registrarCortesia').fadeIn(200)
            }
          }else{
            console.log('Debe seleccionar una sede')
          }
        })
        
        $('input[name="sexo_cortesia"]').change(function(){
          if($(this).is(':checked')){
            const sexo = $(this).val()
            console.log(sexo)
            if(sexo == 'M'){
              $('#sexo_Femenino').slideUp(200)
            }if(sexo == 'F'){
              $('#sexo_Masculino').fadeOut(200)
            }
          }
        })
      })
    </script>
<!---Script del modulo parientes --->
    <script defer>
      $(document).ready(function (){
        $('#medicina_interna').change(function(){
          $('#medicina_interna option:selected').each(function(){
            id_interna = $(this).val()
            $.post('../Models/doctorSearch_controller.php',{id_interna: id_interna},function(data){
              $('#profesional').html(data)
            })
          })
        })
        $('#especialidad').change(function (){
          $('#especialidad option:selected').each(function(){
            id_especialidad = $(this).val()
            $.post('../Models/doctorSearch_controller.php',{id_especialidad: id_especialidad},function(data){
              $('#especialista').html(data)
            })
          })
        })

        $('#desglozar').click(function(){
          $('#tabla_reporte').toggle(200)
        })

        const miForm = document.getElementById('form_container')
        //Creamos el evento change para verificar si hubo algun cambio en el estado del radio button
        $('input[name="tipo_consulta"]').change(function(){
          //aqui usamos this para hacer referencia a los radio button y con la funcion .is (:checked) capturamos cual boton se apreto
          if($(this).is(':checked')){
            //Aqui cambiamos la clase de nuestro container que tiene el formulario , para dejar espacio a la table donde se van a seleccionar los datos del trabajador 
            miForm.classList.toggle('row')
            //capturamos en una const el valor del button presionado para asi poder usar el value del mismo
            const consulta = $(this).val()
            console.log(consulta)
            if(consulta == 1){
              $('#campo_especialidad').hide(300)
              $('#campo_especialista').hide(300)
              $('#table_container').fadeIn(300)
              $('#main_container').slideDown(300)
            }if(consulta == 2){
              $('#campo_medicina').hide(300)
              $('#campo_medicinaInterna').hide(300)
              $('#main_container').slideDown(300)
              $('#table_container').slideDown(300)
            }
          }else{
            console.log("por favor selecciona el tipo de consulta")
          }
        })
        $('input[name="sede"]').change(function(){
          if($(this).is(':checked')){
            const sedes = $(this).val()
            console.log(sedes)
            if(sedes == 'PB'){
              $('#campo_sotano').hide(300)
            }if(sedes == 'sotano'){
              $('#campo_planta').hide(300)
            }
          }else{
            console.log('Debe seleccionar una sede')
          }
        })
        //creamos una function donde vamos a capturar el timestamp y lo actualizamos cada 1 segundo usando la funcion setInterval
          function myTimer(){
            const fecha = new Date();
            document.getElementById('mostrar_fecha').innerHTML = fecha.toLocaleTimeString()
          }
          setInterval(myTimer,1000);
          
      })
    </script>
    <script defer>
      // GET THE ID WHERE WE SHOW THE DATA FROM SCRIPT PHP
      const resultadoDiv = document.getElementById('reporte');
      //ADD AN SPINNER WHILE THE DOM LOADING
      resultadoDiv.innerHTML = '<div class="spinner-border" role="status"><span class="visually-hidden">Cargando Informacion...</span></div>';

      fetch('../Models/dailyReport_controller.php') // URL FROM CATCH THE DATA 
        .then(response => response.json())
        .then(data => {
          //TRY TO VERIFICATE WHAT TYPE OF RESPONSE WE RECEIVE FROM THE SCRIPT dailyReport_controller. status is a array
          if (data.status ==='error'){
            resultadoDiv.innerHTML = `<h4 class='text-danger fw-bold'>${data.mensaje}</h4>`;
            //IN OTHERWISE IN CASE STATUS SEND BE 'SUCCESS' THE CODE EXECUTE
          }else if(data.status === 'success'){
            resultadoDiv.innerHTML = `
                <h4 class='fw-bold'>Total Pacientes Atendidos: ${data.totalPacientes}</h4>
                <div class='list-group' id='tabla_reporte' style='display: none;'>
                  <button type='button' class='list-group-item list-group-item-action'>N° de Trabajadores Atendidos: ${data.totalTrabajadores}</button>
                  <button type='button' class='list-group-item list-group-item-action'>N° de Parientes Atendidos: ${data.totalParientes}</button>
                  <button type='button' class='list-group-item list-group-item-action'>N° de personas por Cortesia atentidas: ${data.totalCortesia}</button>
                </div>`;
          }
        })
        .catch(error => {
            console.error('Error al obtener los datos:', error);
            document.getElementById('reporte').textContent = `<h4 class='text-danger fw-bold' Error al cargar los datos </h4>`;
        });
    </script>
  </body>
</html>