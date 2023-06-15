<?php
        extract($_POST);
        $conexion=mysqli_connect("localhost","root","","proyecto");
        mysqli_set_charset($conexion, "utf8");

        $fecha_actual = date("Y-m-d");
        $sqlInsertItem= "INSERT INTO item (nombre_item, fecha_alta) VALUES ('$nombre_item', '$fecha_actual')";

        if (isset($add_new_item)){

            $sqlComprobarNombre = "SELECT id_item FROM item WHERE nombre_item = '$nombre_item' ";

            $res = $conexion->query($sqlComprobarNombre); 

            if (mysqli_num_rows($res) == 0){

                if (mysqli_query($conexion, $sqlInsertItem)) {
                    // OBTIENE EL ID_LISTA Y EL ID_ITEM PARA SER INSERTADO EN TIENE_ITEM
                    $sqlITEM="SELECT item.id_item, nombre_item FROM `item` INNER JOIN tiene_item on item.id_item = tiene_item.id_item INNER JOIN listas 
                    ON tiene_item.id_lista = listas.id_lista WHERE listas.nombre_lista= '$nombre_lista'";
                    $resultado = $conexion->query($sqlITEM);
                    $res = $resultado->fetch_assoc();
            
                    $sqlSacarIDlista = "SELECT id_lista FROM listas WHERE nombre_lista = '$nombre_lista'";
                    $resultado1 = $conexion->query($sqlSacarIDlista);
                    $res1 = $resultado1->fetch_assoc();

                    $sqlSacarIDItem = "SELECT id_item FROM item WHERE nombre_item = '$nombre_item'";
                    $resultado2 = $conexion->query($sqlSacarIDItem);
                    $res2 = $resultado2->fetch_assoc();

                    $sqlEnlazarUsuario = "INSERT INTO tiene_item (id_item, id_lista) VALUES ('$res2[id_item]', '$res1[id_lista]')";
                    mysqli_query($conexion, $sqlEnlazarUsuario);

                    header("Location:index_usuario.php?mail=$mail");
                }
            }
            else{
                header("Location:index_usuario.php?mensajeItem=Escoge otro nombre para tu item&mail=$mail");  
            }
        }
        

?>