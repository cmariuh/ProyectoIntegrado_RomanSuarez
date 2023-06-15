<?php
    $conexion=mysqli_connect("localhost","root","","proyecto");
    mysqli_set_charset($conexion,"utf8");
    extract($_GET);

    $sqlDNI = "SELECT dni FROM usuarios WHERE mail = '$mail'";
    $resultado = $conexion->query($sqlDNI);
    $res = $resultado->fetch_assoc();
    extract($res);


    // EL SIGUIENTE SCRIPT BORRA LOS ITEMS PERTENECIENTES A LAS LISTAS, SUS ENLACES Y EL GUARDADO EN LA PAPELERA
    $sqlPapelera = "DELETE FROM en_papelera WHERE id_lista = '$id_lista'";
    $sqlListas = "DELETE FROM listas WHERE id_lista = '$id_lista'";

    $sqlItems="SELECT id_item FROM tiene_item WHERE id_lista='$id_lista'";
    $resu = $conexion->query($sqlItems); 

    if (mysqli_num_rows($resu) <> 0){
        while($row = $resu->fetch_assoc()) {
            extract($row);
            $sqlBorrarItem = "DELETE FROM item WHERE id_item='$id_item'";
            mysqli_query($conexion, $sqlBorrarItem);
        }   
        echo "hay un item al menos";
        $sqlTieneItem = "DELETE FROM tiene_item WHERE id_lista='$id_lista'";
        mysqli_query($conexion, $sqlTieneItem);
    }

    if( mysqli_query($conexion, $sqlPapelera) && mysqli_query($conexion, $sqlListas)){
        header("Location:index_usuario.php?mail=$mail");
    }
    
    

?>