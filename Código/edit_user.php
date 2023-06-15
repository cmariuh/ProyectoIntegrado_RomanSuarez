<?php
        extract($_POST);
        $conexion=mysqli_connect("localhost","root","","proyecto");
        mysqli_set_charset($conexion, "utf8");

        $sql= "UPDATE usuarios SET nombre='$nombre', apellido='$apellido', contraseña='$contraseña' WHERE mail='$mail'";

        if (isset($edit_user)){

            if (mysqli_query($conexion, $sql)) {

              //aqui se puede meter una notificacion con javascript
              header("Location:index_usuario.php?mail=$mail");
            }
        }
?>