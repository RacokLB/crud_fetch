<?php

    require "/xampp/htdocs/crud_fetch/Config/conexion.php";

    
    
    $especialidad= $_POST['id_especialidad'] ?? null;
    $especialidades = $_POST['id_especialidades'] ?? null;
    $interna = $_POST['id_interna'] ?? null;
    $id = null;
    
    if(!empty( $especialidad)){
        $id = $especialidad;
    }else if(!empty( $especialidades)){
        $id = $especialidades;
    }else if(!empty( $interna)){
        $id = $interna;
    }
    
    if($id !== null){
        try {
            $query = $pdo->prepare(query: "SELECT id, doctores, cod_especialidad FROM especialistas WHERE cod_especialidad = :id ORDER BY id ASC");
            $query->bindParam(param: ":id", var: $id);
            $query->execute();

            $html = "<option value='0'>Elija un Especialista</option>";

            while ($resultado = $query->fetch(mode: PDO::FETCH_ASSOC)){
                $html.='<option value="'.$resultado['id'].'">'.$resultado['doctores'].'</option>';
            }
            echo $html;//code...
        } catch (PDOException $e) {
            echo "Error: issues with DB". $e->getMessage();
        }finally{
            $pdo = null;
            echo "finally block executed";
        }
    }
?>
