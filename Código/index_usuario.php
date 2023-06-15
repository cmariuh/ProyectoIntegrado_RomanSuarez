<!DOCTYPE html>          
<html lang="es">          
<head>         
  <meta charset="utf-8">  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/usuario.css" />   
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>  
  <link rel="shortcut icon" href="img/check-list.png" />
  <title>Mis recordatorios</title>
  <script type="text/javascript">
        window.history.forward();
        function noBack() {
            window.history.forward();
        }
  </script>        
</head>   
<body>
    <?php
      $conexion=mysqli_connect("localhost","root","","proyecto");
      mysqli_set_charset($conexion,"utf8");
      extract($_GET);
      extract($_POST);
      
      $sqlDNI = "SELECT dni, nombre FROM usuarios WHERE mail='$mail'";
      $sacarDNI = mysqli_query($conexion, $sqlDNI);
      $res=mysqli_fetch_assoc($sacarDNI);
      $dni = $res['dni'];

      
      // CABECERA
      echo "<div class='container'>
              <div class='row ' id='indice'>
                <div class='col-sm-4 col-lg-2 col-6'>
                  <form action='perfil.php' method='POST'> <p>Ir a mi perfil
                  <button id='person'> <img src='img/person.png' alt='Icono de perfil' width='15' height='15'> 
                  <input type='hidden' name='mail' value='$mail'>
                  </button></p>
                  </form>
                </div>
                <div class='col-sm-4 col-lg-2 col-7'>
                  <form action='papelera.php' method='POST'> <p> Papelera
                  <button id='papelera'> <img src='img/borrar.png' alt='Icono de papelera' width='15' height='15'> 
                  <input type='hidden' name='mail' value='$mail'>
                  </button></p>
                  </form>
                </div>
                <div class='col-sm-3  col-lg-2 col-7'>
                  <form action='index.php' method='POST'> <p>Salir
                  <button id='salir'> <img src='img/poder.png' alt='Icono de cerrar sesion' width='20' height='20'> 
                  </button></p>
                  </form>
                </div>
              </div>
          <h1> Mis recordatorios MakeAList </h1>";

          // MENSAJES DE ERROR
          if(isset($mensajeItem))
              echo "$mensajeItem";
          if(isset($mensaje))
              echo "<div class='mensajeLista'> $mensaje </div>";
              
    
          // AÑADIR UNA NUEVA LISTA
          echo "<div class='add_list'>
                  <form name='add_listt' method='POST'>
                    <input type='hidden' name='mail' value='$mail'>
                    <button name='add_listt'> 
                    <img src='img/add_list.png' class='añadir' alt='Añade un nuevo recordatorio.' width='32' height='32'> 
                    </button>              
                  </form>
                </div>";
          if(isset($add_listt)){
            echo "<div> 
                    <form action='añadir_lista.php' name='add_new_list' class='add_new_list' method='POST'>
                      <input type='text' class='inp' name='nombre_lista' placeholder='Nuevo recordatorio'  maxlength='20' required> 
                      <input type='hidden' name='dni' value='$dni'>
                      <input type='hidden' name='mail' value='$mail'>
                      <input type='submit' class='add' name='add_new_list' value='Añadir'>
                    </form>
                    <form  method='POST'>
                      <input type='submit'  id='cancelar' name='borrar' value='Cancelar'>
                    </form>
                  </div>";
            if(isset($borrar)){ // BORRA EL PEQUEÑO FORMULARIO PARA AÑADIR UNA NUEVA LISTA
              unset($add_list);
            }
          }
       


          $sqlLISTA= "SELECT nombre_lista FROM listas INNER JOIN tiene_listas ON listas.id_lista = tiene_listas.id_lista WHERE tiene_listas.dni='$dni'";
          $resultado = $conexion->query($sqlLISTA); //OBTIENE NOMBRE DE LA LISTA
          echo "<hr>";
          // IMPRIME LA LISTA
          while($row = $resultado->fetch_assoc()) {
                extract($row);
                echo "<li>
                       <label for='$nombre_lista' class='list'> ".$nombre_lista." 
                         <form action='compartir_lista.php' method='POST' class='compartir'>
                           <button name='compartir' > 
                           <img src='img/compartir.png' class='share' alt='Compartir la lista.' width='20' height='20'>   
                           <input type='hidden' name='mail' value='$mail'>
                           <input type='hidden' name='nombre_lista' value='$nombre_lista'>
                           </button> 
                         </form>
                         <form action='borrar_lista.php' method='POST' class='borrar'>
                           <button name='borrar' > 
                           <img src='img/borrar.png' class='borrar' alt='Borrar la lista.' width='20' height='20'>   
                           <input type='hidden' name='mail' value='$mail'>
                           <input type='hidden' name='nombre_lista' value='$nombre_lista'>
                           </button> 
                        </form>
                       </label>";

                $sqlITEM="SELECT * FROM item INNER JOIN tiene_item on item.id_item = tiene_item.id_item INNER JOIN listas 
                          ON tiene_item.id_lista = listas.id_lista WHERE listas.nombre_lista= '$nombre_lista'";
                $resu = $conexion->query($sqlITEM); // OBTIENE LOS ITEMS
              echo "<div class='row text-center '> ";
                while($row = $resu->fetch_assoc()) {
                  extract($row);
                  echo "<div class='card bg-transparent col-11 col-sm-10 col-lg-3'>";
                  echo "<form action='edit_item.php' method='POST'>" .$nombre_item." (".$fecha_alta.")
                          <button id='$id_item'> <img src='img/edit.png' alt='edit' width='15' height='15'> 
                          <input type='hidden' name='nombre_item' value='$nombre_item'>
                          <input type='hidden' name='mail' value='$mail'>
                          </button>    
                        </form>";
                  if($imagen == "")
                    echo "<img src='img/camara.png'  class='camara' />";
                  else
                    echo "<img class='imgcard' src='data:image/jpg;base64,".  base64_encode($imagen)."'  />";
                  echo "</div> ";
                }
              echo "</div>";
                // AÑADIR NUEVO ITEM
              echo "<form action='añadir_item.php' name='add_new_item' class='add_item' method='POST'>
                        <input type='text' class='inp' name='nombre_item' placeholder='Nuevo item'  maxlength='20' required> 
                        <input type='hidden' name='mail' value='$mail'>
                        <input type='hidden' name='nombre_lista' value='$nombre_lista'>
                        <input type='submit' name='add_new_item' value='Añadir'>
                    </form>
              </li> 
              <hr>";
          }
          



            // LISTAS COMPARTIDAS
            $sqlCompartidas ="SELECT * FROM listas INNER JOIN compartido ON listas.id_lista = compartido.id_lista WHERE compartido.mailReceptor='$mail'";
            $resultado = $conexion->query($sqlCompartidas);

            while($row = $resultado->fetch_assoc()) {
                extract($row);
                echo " 
                <li>
                  <p class='info_compartido'> Recordatorio compartido por el usuario $infoEmisor: </p>
                  <label for='$nombre_lista' class='list'> ".$nombre_lista." 
                    <form action='borrar_lista_compartida.php' method='POST' class='borrar'>
                      <button name='borrar' > 
                      <img src='img/borrar.png' class='borrar' alt='Borrar la lista.' width='20' height='20'>   
                      <input type='hidden' name='mail' value='$mail'>
                      <input type='hidden' name='nombre_lista' value='$nombre_lista'>
                      </button> 
                    </form>
                  </label>";

                  $sqlITEM="SELECT * FROM item INNER JOIN tiene_item on item.id_item = tiene_item.id_item INNER JOIN listas 
                  ON tiene_item.id_lista = listas.id_lista WHERE listas.nombre_lista= '$nombre_lista'";
                  $resu = $conexion->query($sqlITEM); // OBTIENE LOS ITEMS

                  echo "<div class='row text-center'> ";
                  while($row = $resu->fetch_assoc()) {
                    extract($row);
                    echo "<div class='card bg-transparent col-11 col-sm-10 col-lg-3'>";
                    echo $nombre_item." (".$fecha_alta.")";
                    if($imagen == "")
                      echo "<img src='img/camara.png'  class='camara' />";
                    else
                      echo "<img class='imgcard' src='data:image/jpg;base64,".  base64_encode($imagen)."'  />";
                    echo "</div> ";
                  }
                echo "</div>";
            }


        ?>
  </div>

</body>
</html>