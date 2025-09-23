<?php

if(session_status() == PHP_SESSION_NONE){
    if(session_start()){
        if(!isset($_SESSION['id'])){
            header("location: login.php");
        }
    }
}

$error = [];
if(isset($_POST)){
  
    $consulta = $_POST['tipoConsulta'];
    
    if($consulta == 1){

         // we catch in variables  
        $sede = trim(string: $_POST['sede_cortesia']);
        $cedula = trim(string: $_POST['cedula_cortesia']);
        $nombre = trim(string: $_POST['nombre_cortesia']);
        $edad = trim(string: $_POST['edad_cortesia']);
        $sexo = trim(string:$_POST['sexo_cortesia']);
        $institucion = trim(string:$_POST['institucionCortesia']);
        $consulta_interna = trim(string:$_POST['medicinaCortesia']);
        $profesional = trim(string:$_POST['profesionalCortesia']);
        $patologia = trim(string: $_POST['patologiaCortesia']);
        $afeccion = trim(string: $_POST['afeccion_cortesia']);
        $diagnostico = trim(string:$_POST['diagnostico_cortesia']);
        $tratamiento = trim(string:$_POST['tratamiento_cortesia']);
        $observaciones = trim(string:$_POST['observaciones_cortesia']);

        // we validate then variables are´nt empty
        if(strlen(string: $sede) < 2){
            $error[] = "Seleccione una sede";
        }
        if(strlen(string: $cedula) < 6 || strlen(string: $cedula) > 8){
            $error[]= "Debe introducir una cedula valida V-xxxxxxx o V-xxxxxxxx";
        }
        if(strlen(string: $nombre) < 3){
            $error[]= "Debe introducir un nombre";
        }
        if(strlen(string: $edad) < 1){
            $error[]= "LLene el campo Edad";
        }
        if(strlen(string: $sexo) < 1){
            $error[]= "Debe seleccionar el parentesco con el trabajador";
        }
        if(strlen(string: $institucion) < 1){
            $error[]= "Debe indicar la institucion o Razon social del apoyo";
        }
        if(strlen(string: $consulta_interna) < 1){
            $error[]= "Debe seleccionar una especialidad";
        }
        if(strlen(string: $profesional) < 1){
            $error[]= "Debe seleccionar el profesional";
        }
        if(strlen(string: $patologia) < 1){
            $error[]= "Recuerde indicar la patologia";
        }
        if(strlen(string: $afeccion) < 3){
            $error[]= "Recuerde indicar la afeccion";
        }
        if(strlen(string:$diagnostico) < 10){
            $error[]= "Recuerde indicar el diagnostico dado por el profesional de la salud"; 
        }
        if(strlen(string:$tratamiento) < 8){
            $error[]= "Recuerde indicar el tratamiento dado por el profesional de la salud"; 
        }
        if(!empty($error)){
            foreach ($error as $mensaje) {
                echo "<p class='error'>$mensaje</p>";
            }
        }else{
            require "/xampp/htdocs/crud_fetch/Config/conexion.php";
            
            $query = $pdo->prepare(query:"INSERT INTO pacientes_cortesia (sede_servicio, cedula, edad, nombres, sexo, institucion, especialidad, especialista, patologia, afeccion, diagnostico, tratamiento, observaciones) VALUES (:sede,:cedula, :edad, :nombre, :sexo, :institucion, :especialidad, :especialista, :patologia, :afeccion, :diagnostico, :tratamiento, :observaciones)");

            $query->bindParam(param: ':sede', var: $sede);
            $query->bindParam(param: ':cedula', var: $cedula);
            $query->bindParam(param: ':edad', var: $edad);
            $query->bindParam(param: ':nombre', var: $nombre);
            $query->bindParam(param: ':sexo', var: $sexo);
            $query->bindParam(param: ':institucion', var: $institucion); 
            $query->bindParam(param: ':especialista', var: $profesional);
            $query->bindParam(param: ':especialidad', var: $consulta_interna);
            $query->bindParam(param: ':patologia', var: $patologia);
            $query->bindParam(param: ':afeccion', var: $afeccion);
            $query->bindParam(param: 'diagnostico', var:$diagnostico);
            $query->bindParam(param: 'tratamiento', var:$tratamiento);
            $query->bindParam(param: 'observaciones', var:$observaciones);
            $query->execute();
            
            //Capturamos el ultimo ID registrado dentro de la DB 
            $lastId = $pdo->lastInsertId();
            // Aquí es donde registras la acción en la tabla de log
            $user_id = $_SESSION['user']; // Asegúrate de que tu sesión guarda el ID del usuario
            $accion = 'INSERTAR PACIENTE';
            $tabla = 'pacientes_cortesia';
            $fecha = date('Y-m-d H:i:s');
            
            $log_query = $pdo->prepare("INSERT INTO log_acciones (user_id, accion, tabla_afectada, id_registro_afectado) VALUES (:user_id, :accion, :tabla, :lastId)");
            $log_query->bindParam(':user_id', $user_id);
            $log_query->bindParam(':accion', $accion);
            $log_query->bindParam(':tabla', $tabla);
            $log_query->bindParam(':lastId', $lastId);
            
            $log_query->execute();
            $pdo = null;
            echo "Right";  
        }
    }elseif($consulta == 2){
        
         // we catch in variables  
        $sede = trim(string: $_POST['sede_cortesia']);
        $cedula = trim(string: $_POST['cedula_cortesia']);
        $nombre = trim(string: $_POST['nombre_cortesia']);
        $edad = trim(string: $_POST['edad_cortesia']);
        $sexo = trim(string:$_POST['sexo_cortesia']);
        $institucion = trim(string: $_POST['institucionCortesia']);
        $especialidad = trim(string: $_POST['especialidadCortesia']);
        $especialista = trim(string:$_POST['especialistaCortesia']);
        $patologia = trim(string: $_POST['patologiaCortesia']);
        $afeccion = trim(string: $_POST['afeccion_cortesia']);
        $diagnostico = trim(string:$_POST['diagnostico_cortesia']);
        $tratamiento = trim(string:$_POST['tratamiento_cortesia']);
        $observaciones = trim(string:$_POST['observaciones_cortesia']);
         // we validate then variables are´nt empty
        if(strlen(string: $sede) < 2){
            $error[] = "Seleccione una sede";
        }
        if(strlen(string: $cedula) < 6 || strlen(string: $cedula) > 8){
            $error[]= "Debe introducir una cedula valida V-xxxxxxx o V-xxxxxxxx";
        }
        if(strlen(string: $nombre) < 3){
            $error[]= "Debe introducir un nombre";
        }
        if(strlen(string: $edad) < 1){
            $error[]= "LLene el campo Edad";
        }
        if(strlen(string: $sexo) < 1){
            $error[]= "Debe seleccionar el parentesco con el trabajador";
        }
        if(strlen(string: $institucion) < 1){
            $error[]= "Debe indicar la institucion o Razon social del apoyo";
        }
        if(strlen(string: $especialidad) < 1){
            $error[]= "Debe seleccionar una especialidad";
        }
        if(strlen(string: $especialista) < 1){
            $error[]= "Debe seleccionar el profesional";
        }
        if(strlen(string: $patologia) < 1){
            $error[]= "Recuerde indicar la patologia";
        }
        if(strlen(string: $afeccion) < 3){
            $error[]= "Recuerde indicar la afeccion";
        }
        if(strlen(string:$diagnostico) < 10){
            $error[]= "Recuerde indicar el diagnostico dado por el profesional de la salud"; 
        }
        if(strlen(string:$tratamiento) < 8){
            $error[]= "Recuerde indicar el tratamiento dado por el profesional de la salud"; 
        }
        if(!empty($error)){
            foreach ($error as $mensaje) {
                echo "<p class='error'>$mensaje</p>";
            }
        }else{
            require "/xampp/htdocs/crud_fetch/Config/conexion.php";
            
            $query = $pdo->prepare(query:"INSERT INTO pacientes_cortesia (sede_servicio, cedula, edad, nombres, sexo, institucion, especialidad, especialista, patologia, afeccion, diagnostico, tratamiento, observaciones) VALUES (:sede, :cedula, :edad, :nombre, :sexo, :institucion, :especialidad, :especialista, :patologia, :afeccion, :diagnostico, :tratamiento, :observaciones)");

            $query->bindParam(param: ':sede', var: $sede);
            $query->bindParam(param: ':cedula', var: $cedula);
            $query->bindParam(param: ':edad', var: $edad);
            $query->bindParam(param: ':nombre', var: $nombre);
            $query->bindParam(param: ':sexo', var: $sexo);
            $query->bindParam(param: ':institucion', var: $institucion); 
            $query->bindParam(param: ':especialidad', var: $especialidad);
            $query->bindParam(param: ':especialista', var: $especialista);
            $query->bindParam(param: ':patologia', var: $patologia);
            $query->bindParam(param: ':afeccion', var: $afeccion);
            $query->bindParam(param: 'diagnostico', var:$diagnostico);
            $query->bindParam(param: 'tratamiento', var:$tratamiento);
            $query->bindParam(param: 'observaciones', var:$observaciones);
            $query->execute();
            
            // Obtener el ID del último registro insertado
            $lastId = $pdo->lastInsertId();
            // Aquí es donde registras la acción en la tabla de log
            $user_id = $_SESSION['user']; // Asegúrate de que tu sesión guarda el ID del usuario
            $accion = 'INSERTAR PACIENTE';
            $tabla = 'pacientes_cortesia';
           
            
            $log_query = $pdo->prepare("INSERT INTO log_acciones (user_id, accion, tabla_afectada, id_registro_afectado) VALUES (:user_id, :accion, :tabla, :lastId)");
            $log_query->bindParam(':user_id', $user_id);
            $log_query->bindParam(':accion', $accion);
            $log_query->bindParam(':tabla', $tabla);
            $log_query->bindParam(':lastId', $lastId);
            
            $log_query->execute();
            $pdo = null;
            echo "Right";  
        }
    }else{
        echo "<div class='alert alert-warning'>Debe Seleccionar el tipo de consulta</div>";
    }
}
?>