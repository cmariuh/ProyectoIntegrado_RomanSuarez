<?php
        $conexion=mysqli_connect("localhost","root","","proyecto");
        mysqli_set_charset($conexion, "utf8");
        extract($_POST);


        if (isset($add_new_list)){

            $sqlBuscarCoincidencia= "SELECT nombre_lista FROM listas WHERE nombre_lista='$nombre_lista'";
            $res = $conexion->query($sqlBuscarCoincidencia); 

            if (mysqli_num_rows($res) == 0){

                $sqlInsertList= "INSERT INTO listas (nombre_lista) VALUES ('$nombre_lista')";

                if (mysqli_query($conexion, $sqlInsertList)) {

                    $sqlSacarIDlista = "SELECT id_lista FROM listas WHERE nombre_lista = '$nombre_lista'";
                    $resultado = $conexion->query($sqlSacarIDlista);
                    $res = $resultado->fetch_assoc();
                    $sqlEnlazarUsuario = "INSERT INTO tiene_listas (dni, id_lista) VALUES ('$dni', '$res[id_lista]')";
                    mysqli_query($conexion, $sqlEnlazarUsuario);
                    header("Location:index_usuario.php?mail=$mail");
                }
            }
            else{
                header("Location:index_usuario.php?mensaje=Escoge otro nombre para tu lista&mail=$mail");  
            }
        }
        

?>