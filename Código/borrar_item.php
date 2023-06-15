<?php
    $conexion=mysqli_connect("localhost","root","","proyecto");
    mysqli_set_charset($conexion,"utf8");
    extract($_POST);

    $sqlIdItem = "SELECT id_item FROM item WHERE nombre_item = '$nombre_item'";
    $resultado = $conexion->query($sqlIdItem);
    $res = $resultado->fetch_assoc();
    extract($res);


    $sqlBorrarDeLista = "DELETE FROM tiene_item WHERE id_item = '$id_item'";
    $sqlBorrarItem = "DELETE FROM item WHERE id_item ='$id_item'";

    if(mysqli_query($conexion, $sqlBorrarDeLista))
        if(mysqli_query($conexion, $sqlBorrarItem))
            header("Location:index_usuario.php?mail=$mail");



?>