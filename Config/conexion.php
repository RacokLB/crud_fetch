<?php
//Esta es la forma mas segura de hacer una conexion a la DB
    $servidor = "mysql:dbname=fttc;host=localhost";
    $user = "root";
    $password = "";
    
    try{
        $pdo = new PDO(dsn: $servidor, username: $user, password: $password, options: array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $pdo -> setAttribute(attribute: PDO::ATTR_ERRMODE, value: PDO::ERRMODE_EXCEPTION);

    } catch(PDOException $e){
        echo "An internal server error occurred."; // Generic user message
        // Optionally, redirect to an error page
       file_put_contents(filename: 'link.txt', data: $e->getMessage());
       exit; //stop further execution
    }


?>