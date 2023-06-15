<?php
   $conexion=mysqli_connect("localhost","root","","proyecto");
   mysqli_set_charset($conexion,"utf8");
   extract($_POST);

    $sqlDNI ="SELECT dni FROM usuarios WHERE mail = '$mail'";
    $resultado = $conexion->query($sqlDNI);
    $res1 = $resultado->fetch_assoc();
    
    $sqlDATOS ="SELECT id_lista FROM listas WHERE nombre_lista = '$nombre_lista'";
    $resultado = $conexion->query($sqlDATOS);
    $res = $resultado->fetch_assoc();

    $sqlPAPELERA = "INSERT INTO en_papelera VALUES( '$res1[dni]', '$res[id_lista]' )";

    if (mysqli_query($conexion, $sqlPAPELERA)) {
        $sqlBORRAR = "DELETE FROM tiene_listas WHERE dni='$res1[dni]' AND id_lista='$res[id_lista]'";
        if (mysqli_query($conexion, $sqlBORRAR)) {
            header("Location:index_usuario.php?mail=$mail");
        }
    }
?>