<?php
//empty significa si no existe  
    $error = [];
    if(isset($_POST)){
        // aqui realizamos una validacion en el caso de que no exista el idpersonas dentro de la DB pasa a realizar un registro
        $consulta = $_POST['tipo_consulta'];
        
        if($consulta == 1){

             // we catch in variables  
            $sede = trim(string: $_POST['sede']);
            $cedula = trim(string: $_POST['paciente']);
            $edad = trim(string: $_POST['edades']);
            $sexo = trim(string: $_POST['sexo']);
            $coordinacion = trim(string: $_POST['coordinaciones']);
            $consulta_interna = trim(string: $_POST['medicina_interna']);
            $profesional = trim(string:$_POST['profesional']);
            $patologia = trim(string: $_POST['patologia']);
            $afeccion = trim(string: $_POST['afeccion']);

            // we validate then variables are´nt empty
            if(strlen($cedula)< 6 || strlen($cedula)>8){
                $error[]= "Debe introducir una cedula valida V-xxxxxxx o V-xxxxxxxx";
            }
            if(strlen($sede) < 2){
                $error[] = "Seleccione una sede";
            }
            if(strlen($edad) < 1){
                $error[]= "LLene el campo Edad";
            }
            if(strlen(string: $sexo) < 1){
                $error[]= "Recuerde indicar el sexo";
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
                
                $query = $pdo->prepare(query:"INSERT INTO servicio_medico (sede, cedula, edad, sexo, coordinacion, especialidad, especialista, patologia, afeccion) VALUES (:sede, :cedula, :edad, :sexo, :coordinacion, :especialidad, :especialista, :patologia, :afeccion)");

                $query->bindParam(param: ':sede', var: $sede);
                $query->bindParam(param: ':cedula', var: $cedula);
                $query->bindParam(param: ':edad', var: $edad);
                $query->bindParam(param: ':sexo', var: $sexo);
                $query->bindParam(param: ':coordinacion', var: $coordinacion); 
                $query->bindParam(param: ':especialidad', var: $consulta_interna);
                $query->bindParam(param: ':especialista', var: $profesional);
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
            $coordinacion = trim(string: $_POST['coordinaciones']);
            $especialidad = trim(string: $_POST['especialidad']);
            $especialista = trim(string: $_POST['especialista']);
            $patologia = trim(string: $_POST['patologia']);
            $afeccion = trim(string: $_POST['afeccion']);
    
            if(strlen($cedula)< 6 || strlen($cedula)>8){
                $error[]= "Debe introducir una cedula valida V-xxxxxxx o V-xxxxxxxx";
            }
            if(strlen($sede) < 1){
                $error[] = "Seleccione una sede";
            }
            if(strlen($edad) < 1){
                $error[]= "LLene el campo Edad";
            }
            if(strlen(string: $sexo) < 1){
                $error[]= "Recuerde indicar el sexo";
            }
            if(strlen(string: $patologia) < 1){
                $error[]= "Recuerde indicar la patologia";
            }
            if(strlen(string:$afeccion) < 3){
                $error[]= "Recuerde indicar la afeccion";
            }
            if(strlen($especialidad) < 1){
                $error[] = "Debe seleccionar una especialidad";
            }
            if(strlen($especialista) < 1){
                $error[] = "Debe seleccionar el especialista";
            }
            //on this block code we try to insert into table all information from medicina interna choice
            if(!empty($error)){
            foreach ($error as $message) {
                echo "<p class='error'>$message</p>";
                }; 
            }else{
                require "/xampp/htdocs/crud_fetch/Configconexion.php";

                $query = $pdo->prepare(query:"INSERT INTO servicio_medico (sede, cedula, edad, ,sexo, coordinacion, especialidad, especialista, patologia, afeccion) VALUES(:sede, :cedula, :edad, :sexo, :coordinacion, :especialidad, :especialista, :patologia, :afeccion)");
                $query->bindParam(param: ':sede', var: $sede);
                $query->bindParam(param: ':cedula', var: $cedula);
                $query->bindParam(param: ':edad', var: $edad);
                $query->bindParam(param: ':sexo', var: $sexo);
                $query->bindParam(param: ':coordinacion', var: $coordinacion);
                $query->bindParam(param: ':especialidad', var: $especialidad);
                $query->bindParam(param: ':especialista', var: $especialista);
                $query->bindParam(param: ':patologia', var: $patologia);
                $query->bindParam(param: ':afeccion', var: $afeccion);
                $query->execute();
    
                    $pdo=null;
                    echo "Right";
            }
        }else{
            echo "<div class='alert'>Debe Seleccionar el tipo de consulta</div>";
        }
    }else{
        echo "PROBLEMAS CON SU PETICION";
    }
    
?>