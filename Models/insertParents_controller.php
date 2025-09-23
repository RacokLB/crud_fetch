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
      
        $consulta = $_POST['tipo_consulta'];
        
        if($consulta == 1){

             // we catch in variables  
            $sede = trim(string: $_POST['sede']);
            $cedula = trim(string: $_POST['cedulaTitular']);
            $edad = trim(string: $_POST['edades']);
            $sexo = trim(string: $_POST['sexo_pariente']);
            $parentesco = trim(string: $_POST['nexo']);
            $coordinacion = trim(string: $_POST['coordinacionPariente']);
            $patologia = trim(string: $_POST['patologia']);
            $afeccion = trim(string: $_POST['afeccion']);
            $consulta_interna = trim(string: $_POST['medicina_interna']);
            $profesional = trim(string:$_POST['profesional']);
            $diagnostico = trim(string:$_POST['diagnostico']);
            $tratamiento = trim(string:$_POST['tratamiento']);
            $observaciones = trim(string:$_POST['observaciones']);


            // we validate then variables are´nt empty
            if(strlen(string: $cedula) < 6 || strlen(string: $cedula) > 8){
                $error[]= "Debe introducir una cedula valida V-xxxxxxx o V-xxxxxxxx";
            }
            if(strlen(string: $sede) < 2){
                $error[] = "Seleccione una sede";
            }
            if(strlen(string: $edad) < 1){
                $error[]= "LLene el campo Edad";
            }
            if(strlen(string: $sexo) < 1){
                $error[]= "Debe seleccionar el sexo";
            }
            if(strlen(string: $parentesco) < 2){
                $error[]= "Debe seleccionar el parentesco con el trabajador";
            }
            if(strlen(string: $patologia) < 1){
                $error[]= "Recuerde indicar la patologia";
            }
            if(strlen(string:$afeccion) < 3){
                $error[]= "Recuerde indicar la afeccion";
            }
            if(strlen(string:$consulta_interna) < 1){
                $error[]= "Debe seleccionar una especialidad";
            }
            if(strlen(string:$profesional) < 1){
                $error[]= "Debe seleccionar el profesional";
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
                
                $query = $pdo->prepare(query:"INSERT INTO parientes_tratados (cedula, edad, sexo, parentesco, coordinacion, sede, especialidad, especialista, patologia, afeccion, diagnostico, tratamiento, observaciones) VALUES (:cedula, :edad, :sexo, :parentesco, :coordinacion, :sede, :especialidad, :especialista, :patologia, :afeccion, :diagnostico, :tratamiento, :observaciones)");

                $query->bindParam(param: ':cedula', var: $cedula);
                $query->bindParam(param: ':edad', var: $edad);
                $query->bindParam(param: ':sexo', var: $sexo);
                $query->bindParam(param: ':parentesco', var: $parentesco);
                $query->bindParam(param: ':coordinacion', var: $coordinacion); 
                $query->bindParam(param: ':sede', var: $sede);
                $query->bindParam(param: ':especialista', var: $profesional);
                $query->bindParam(param: ':especialidad', var: $consulta_interna);
                $query->bindParam(param: ':patologia', var: $patologia);
                $query->bindParam(param: ':afeccion', var: $afeccion);
                $query->bindParam(param: ':diagnostico', var: $diagnostico);
                $query->bindParam(param: ':tratamiento', var: $tratamiento);
                $query->bindParam(param: ':observaciones', var: $observaciones);
                $query->execute();

                //Capturamos el ultimo ID registrado dentro de la DB 
                $lastId = $pdo->lastInsertId();
                // Aquí es donde registras la acción en la tabla de log
                $user_id = $_SESSION['user']; // Asegúrate de que tu sesión guarda el ID del usuario
                $accion = 'INSERTAR PACIENTE';
                $tabla = 'parientes_tratados';
                
                
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
            

            $sede = trim(string: $_POST['sede']);
            $cedula = trim(string: $_POST['cedulaTitular']);
            $edad = trim(string: $_POST['edades']);
            $sexo = trim(string: $_POST['sexo_pariente']);
            $parentesco = trim(string: $_POST['nexo']);
            $coordinacion = trim(string: $_POST['coordinacionPariente']);
            $especialidad = trim(string: $_POST['especialidad']);
            $especialista = trim(string: $_POST['especialista']);
            $patologia = trim(string: $_POST['patologia']);
            $afeccion = trim(string: $_POST['afeccion']);
            $diagnostico = trim(string:$_POST['diagnostico']);
            $tratamiento = trim(string:$_POST['tratamiento']);
            $observaciones = trim(string:$_POST['observaciones']);

    
            if(strlen(string: $cedula) < 6 || strlen(string: $cedula) > 8){
                $error[]= "Debe introducir una cedula valida V-xxxxxxx o V-xxxxxxxx";
            }
            if(strlen(string: $sede) < 1){
                $error[] = "Seleccione una sede";
            }
            if(strlen(string: $edad) < 1){
                $error[]= "LLene el campo Edad";
            }
            if(strlen(string: $sexo) < 1){
                $error[]= "Debe seleccionar el sexo";
            }
            if(strlen(string: $parentesco) < 2){
                $error[]= "Debe seleccionar el parentesco con el trabajador";
            }
            if(strlen(string: $patologia) < 1){
                $error[]= "Recuerde indicar la patologia";
            }
            if(strlen(string:$afeccion) < 3){
                $error[]= "Recuerde indicar la afeccion";
            }
            if(strlen(string: $especialidad) < 1){
                $error[] = "Debe seleccionar una especialidad";
            }
            if(strlen(string: $especialista) < 1){
                $error[] = "Debe seleccionar el especialista";
            }
            if(strlen(string:$diagnostico) < 10){
            $error[]= "Recuerde indicar el diagnostico dado por el profesional de la salud"; 
            }
            if(strlen(string:$tratamiento) < 8){
                $error[]= "Recuerde indicar el tratamiento dado por el profesional de la salud"; 
            }
            //on this block code we try to insert into table all information from medicina interna choice
            if(!empty($error)){
            foreach ($error as $message) {
                echo "<p class='error'>$message</p>";
                }; 
            }else{
                require "/xampp/htdocs/crud_fetch/Config/conexion.php";

                $query = $pdo->prepare(query:"INSERT INTO parientes_tratados (cedula, edad, sexo, parentesco, coordinacion, sede, especialidad, especialista, patologia, afeccion, diagnostico, tratamiento, observaciones) VALUES(:cedula, :edad, :sexo, :parentesco, :coordinacion, :sede, :especialidad, :especialista, :patologia, :afeccion, :diagnostico, :tratamiento, :observaciones)");
                
                $query->bindParam(param: ':cedula', var: $cedula);
                $query->bindParam(param: ':edad', var: $edad);
                $query->bindParam(param: ':sexo', var: $sexo);
                $query->bindParam(param: ':parentesco', var:$parentesco);
                $query->bindParam(param: ':coordinacion', var: $coordinacion);
                $query->bindParam(param: ':sede', var: $sede);
                $query->bindParam(param: ':especialidad', var: $especialidad);
                $query->bindParam(param: ':especialista', var: $especialista);
                $query->bindParam(param: ':patologia', var: $patologia);
                $query->bindParam(param: ':afeccion', var: $afeccion);
                $query->bindParam(param: ':diagnostico', var: $diagnostico);
                $query->bindParam(param: ':tratamiento', var: $tratamiento);
                $query->bindParam(param: ':observaciones', var: $observaciones);
                $query->execute();

                //Capturamos el ultimo ID registrado dentro de la DB 
                $lastId = $pdo->lastInsertId();
                // Aquí es donde registras la acción en la tabla de log
                $user_id = $_SESSION['user']; // Asegúrate de que tu sesión guarda el ID del usuario
                $accion = 'INSERTAR PACIENTE';
                $tabla = 'parientes_tratados';
                
                
                $log_query = $pdo->prepare("INSERT INTO log_acciones (user_id, accion, tabla_afectada, id_registro_afectado) VALUES (:user_id, :accion, :tabla, :lastId)");
                $log_query->bindParam(':user_id', $user_id);
                $log_query->bindParam(':accion', $accion);
                $log_query->bindParam(':tabla', $tabla);
                $log_query->bindParam(':lastId', $lastId);
                
                $log_query->execute();
                
                $pdo=null;
                echo "Right";
            }
        }else{
            echo "<div class='alert alert-warning'>Debe Seleccionar el tipo de consulta</div>";
        }
    }else{
        echo "<div class='alert alert-danger'PROBLEMAS CON SU PETICION </div>";
    }
?>