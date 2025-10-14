<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRO</title>
    <link rel="stylesheet" href="../Public/styleLogin.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
    <body>
        <div class="wrapper">
            <form action="" method="POST">
                <?php
                require_once "/xampp/htdocs/crud_fetch/Models/registerLogin_controller.php";
                require_once "/xampp/htdocs/crud_fetch/Config/conexion.php";
                ?>
                <h1>Registro</h1>
                <div class="input-box">
                    <input type="text" autocomplete="off"  placeholder="cedula de identidad" required name="cedula_identidad" id="cedula_identidad" minlength="7" maxlength="8" pattern="[0-9]+" title = "Indique numero de cedula . use solo numeros">
                    <i class='bx bx-id-card'></i>
                </div>
                <div class="input-box">
                    <input type="password" placeholder="password" name="password" minlength="4" maxlength="20" title="Tiene un minimo de 4 a un maximo de 20 caracteres" required>
                    <i class='bx bxs-key'></i>
                </div>
                <input type="submit" value="Registrarse" class="btn" name="registerbtn">
                <div class="login-link">
                    <p>Ya tienes una cuenta ? <a href="login.php">Login</a></p>
                </div>
            </form>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>