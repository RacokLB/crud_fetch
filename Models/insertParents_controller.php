<?php

    $error = [];
    if(isset($_POST)){
      
        $consulta = $_POST['tipo_consulta'];
        
        if($consulta == 1){

             // we catch in variables  
            $sede = trim(string: $_POST['sede']);
            $cedula = trim(string: $_POST['paciente']);
            $edad = trim(string: $_POST['edades']);
            $sexo = trim(string: $_POST['sexo_Pariente']);
            $parentesco = trim(string: $_POST['nexo']);
            $coordinacion = trim(string: $_POST['coordinaciones']);
            $patologia = trim(string: $_POST['patologia']);
            $afeccion = trim(string: $_POST['afeccion']);
            $consulta_interna = trim(string: $_POST['medicina_interna']);
            $profesional = trim(string:$_POST['profesional']);

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
            if(!empty($error)){
                foreach ($error as $mensaje) {
                    echo "<p class='error'>$mensaje</p>";
                }
            }else{
                require "/xampp/htdocs/crud_fetch/Config/conexion.php";
                
                $query = $pdo->prepare(query:"INSERT INTO parientes_tratados (cedula, edad, sexo, parentesco, coordinacion, sede, especialidad, especialista, patologia, afeccion) VALUES (:cedula, :edad, :sexo, :parentesco, :coordinacion, :sede, :especialidad, :especialista, :patologia, :afeccion)");

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
                $query->execute();
                
                $pdo = null;
                echo "Right";  
            }
        }elseif($consulta == 2){
            

            $sede = trim(string: $_POST['sede']);
            $cedula = trim(string: $_POST['paciente']);
            $edad = trim(string: $_POST['edades']);
            $sexo = trim(string: $_POST['sexo_Pariente']);
            $parentesco = trim(string: $_POST['nexo']);
            $coordinacion = trim(string: $_POST['coordinaciones']);
            $especialidad = trim(string: $_POST['especialidad']);
            $especialista = trim(string: $_POST['especialista']);
            $patologia = trim(string: $_POST['patologia']);
            $afeccion = trim(string: $_POST['afeccion']);
    
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
            //on this block code we try to insert into table all information from medicina interna choice
            if(!empty($error)){
            foreach ($error as $message) {
                echo "<p class='error'>$message</p>";
                }; 
            }else{
                require "/xampp/htdocs/crud_fetch/Config/conexion.php";

                $query = $pdo->prepare(query:"INSERT INTO parientes_tratados (cedula, edad, sexo, parentesco, coordinacion, sede, especialidad, especialista, patologia, afeccion) VALUES(:cedula, :edad, :sexo, :parentesco, :coordinacion, :sede, :especialidad, :especialista, :patologia, :afeccion)");
                
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
                $query->execute();
    
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