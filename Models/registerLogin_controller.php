<?php
//llamamos a la conexion que establecimos con la base de datos
require "Config/conexion.php";

    //aqui indicamos que queremos hacer al momento de que el usuario presione el boton registrarse el name del button es 'registerbtn'
    if(isset($_POST['registerbtn'])) {
        
    //aqui revisamos si los campos estan llenos para continuar con el envio de la informacion , estamos diciendo si el campo 'user' es mayor o igual a 1 es True en php && indica true , aparte hacemos uso de la funcion strlen que nos devuelve la longitud de una cadena determinada de string  
        if(isset($_POST['cedula_identidad']) && isset($_POST['password']) && strlen(string: $_POST['cedula_identidad']) <= 8 && strlen($_POST['password']) >= 4)
        {  
    
            
            
            // usamos la funcion trim para eliminar espacio entre los datos introducidos por el usuario
            $cedula = trim(string: $_POST['cedula_identidad']);
            $password = trim(string:$_POST['password']);
            //convertimos el password con la funcion password_hash y PASSWORD_DEFAULT
            $hashed_password = password_hash(password: $password, algo: PASSWORD_DEFAULT);
            $ip = $_SERVER['REMOTE_ADDR'];
            $cambio = trim(string: $_POST['registerbtn']);

            $query = $pdo->prepare(query: "INSERT INTO users (user, clave, ip) VALUES (:user, :clave, :ip)");
            $query->bindParam(param:":user",var:$cedula);
            $query->bindParam(param:":clave",var:$hashed_password);
            $query->bindParam(param:":ip",var:$ip);
            
            print_r (value: $query);
            $query->execute();
            
            if ($query == true) {
                
                sleep(seconds: 2);
                
                header(header:"location: login.php");
            } else {
                echo "<h5 id='error'>Verifique su Usuario y la contraseña ingresada</h5>";
            }
        }else {
            echo "<div class='alert'>Cedula debe tener entre 7 y 8 caracteres</div>";

        }
    }
        
    
?>