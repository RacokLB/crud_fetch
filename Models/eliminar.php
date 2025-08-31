<?php
//$data = 
    $data = file_get_contents("php://input");
    require "Config/conexion.php";
    $query = $pdo->prepare("UPDATE tabla_titular SET estatura = :est, peso = :peso, tipo_sangre = :sangre WHERE id = :id");
    $query -> bindParam(":id",$data);
    $query -> execute();
    $pdo = null;
    echo "Right";
?>