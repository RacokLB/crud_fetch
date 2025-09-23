<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INGRESO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../Public/styleLogin.css">

</head>

<body>
    <div class="wrapper">
        <main class="main">
            <form method="POST">
                <h1>Inicio de sesion</h1>
                <?php
                
                include_once "/xampp/htdocs/crud_fetch/Models/login_controllers.php";
                ?>
                <div class="input-box">
                    <input type="text" placeholder="Usuario" name="user" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" placeholder="Contraseña" name="password" required>
                    <i class='bx bxs-key'></i>
                </div>

                <input type="submit" value="Ingresar" name="signupbtn" class="btn">
                <div class="register-link">
                    <p>No tienes cuenta ? <a href="registerLogin.php">Registrarse</a></p>
                </div>
                <hr>
                <div class="register-link">
                    <p>¡Oh noo! <a href="olvidoContraseña.php">¿Olvidaste tu contraseña?</a></p>
                </div>
            </form>
        </main>
    </div>
</body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>



