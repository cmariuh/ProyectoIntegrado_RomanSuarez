<?php
    $conexion=mysqli_connect("localhost","root","","proyecto");
    mysqli_set_charset($conexion,"utf8");
    extract($_GET);

    $sqlDNI = "SELECT dni FROM usuarios WHERE mail = '$mail'";
    $resultado = $conexion->query($sqlDNI);
    $res = $resultado->fetch_assoc();
    extract($res);

    $sqlPapelera = "DELETE FROM en_papelera WHERE id_lista = '$id_lista'";
    $sqlInsert = "INSERT INTO tiene_listas VALUES ('$dni', '$id_lista')";

    if (mysqli_query($conexion, $sqlPapelera)) {
        if (mysqli_query($conexion, $sqlInsert)) {
            header("Location:index_usuario.php?mail=$mail");
        }
    }
?>