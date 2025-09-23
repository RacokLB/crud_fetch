<?php

session_start();

    if(isset($_SESSION['id'])){
        switch ($_SESSION['id']){
            case 1:
                header(header:"location: ../View/principalPagina.php");
                exit();
                break;
            default:
                header(header:"location:../View/login.php");
                exit();
                break;
        }
    }


//Here we indicate what we want to do when the login button that has name="signupbtn" is pressed.
if(isset($_POST["signupbtn"])){
    
      //we call our PDO connection 
      require_once "/xampp/htdocs/crud_fetch/Config/conexion.php";

    //Here we indicate what we are going to do when we enter the user and password data, we also indicate what will be reflected in case no data is entered within the fields
    if (isset($_POST["user"]) && isset($_POST["password"])){
        //Here the data extracted from the global variable $_POST is stored in our local variables $user, $password 
        $user = $_POST["user"];
        $password = $_POST['password'];

        //Here we call the variable that stores the connection with the database and make the request to the DB using an SQL query to bring the data $user and $password and this verify that the data entered by the user are those stored in the DB and this the user can validate himself and enter the page
        $query = $pdo->prepare(query:"SELECT * FROM users WHERE user = :user");
        $query->bindParam(param:':user',var:$user);
        $query->execute();
        $user_data = $query->fetch(mode: PDO::FETCH_ASSOC); //fetch the user data as an associative array
        
        if($user_data){ //Check if the user was found with the given username   
            $hash = $user_data['clave']; // search the password associate with the username in the column 'clave'
            
            
                //Verify if the entered password matches the stored hash 
                if (password_verify(password: $password,hash: $hash)){

                    //Password is correct , now fetch user details and role verification
                    
                    //It´s generally better to re-execute the query or fetch the data again
                    // To ensure you have the lastest user information after a successful login
                    $query_role = $pdo->prepare(query:"SELECT id, rol, user FROM users WHERE user = :user");
                    $query_role->bindParam(param:":user",var:$user);
                    $query_role->execute();
                    $user_role_data = $query_role->fetch(mode: PDO::FETCH_ASSOC);
                    
                if($user_role_data){
                    $rol_id = $user_role_data['rol'];
                    $cedula = $user_role_data['user'];
                    $idUser = $user_role_data['id'];

                    $_SESSION['rol'] = $rol_id;
                    // we try to catch the id from user array
                    $_SESSION["user"]=$cedula;//we try to catch the user
                    $_SESSION['id']=$idUser;

                    switch ($_SESSION['rol']){
                        case 1:
                            header(header: "location: ../View/principalPagina.php");
                            exit();//Important to stop further script execution after redirection/Importante detener la ejecución posterior del script después de la redirección
                            break;
                        default:
                            header(header:"location: ../View/login.php");
                            exit();
                            break;
                    }
                }else{
                    echo "<h5 id='error'>El usuario no tiene un rol valido</h5>";
                }
            }else{
                // Password does not match
                echo "<h5> No hay match</h5>";
            }
            
        
        }else{
            echo "<h5 id='error'>Verifique la contraseña y el usuario</h5>";
        }
    }
}
        
            
?>