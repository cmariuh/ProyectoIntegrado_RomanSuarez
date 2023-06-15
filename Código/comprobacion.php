<?php
    if(isset($_POST['inicio']))
	{			
        extract($_POST);
        $conexion=mysqli_connect("localhost","root","","proyecto");
        $sql="SELECT tipo FROM usuarios WHERE mail='".$mail."' AND contraseña='".$pass."'";

        $consulta=mysqli_query($conexion,$sql);
        if ($fila=mysqli_fetch_array($consulta))
        {	
            echo $fila[0];
            if($fila[0]=="U"){			
                header("Location:index_usuario.php?mail=$mail");
            }
            else{
                header("Location:index_admin.php?mail=$mail");
            }
        }
        else{	
            header("Location:index.php?mensaje=Credenciales incorrectas");  
        }
      
	}		
?>