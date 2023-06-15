<?php
   $conexion=mysqli_connect("localhost","root","","proyecto");
   mysqli_set_charset($conexion,"utf8");
   extract($_POST);

   if(isset($borrar)){

        $sqlID = "SELECT id_lista FROM listas WHERE nombre_lista = '$nombre_lista'";
        $resultado = $conexion->query($sqlID);
        $res = $resultado->fetch_assoc();

        $sqlBORRAR = "DELETE FROM compartido WHERE id_lista ='$res[id_lista]' AND mailReceptor = '$mail'";
        if (mysqli_query($conexion, $sqlBORRAR)) {
            header("Location:index_usuario.php?mail=$mail");
        }
   }
?>