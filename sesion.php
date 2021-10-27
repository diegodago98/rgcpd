<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/stylesesion.css">
    <title>Sesion</title>


</head>
<body>

    <!-- Inicio de sesión -->

    <img src="#" alt="">
    <h1>Ha iniciado sesión como <?php
            session_start();
            $id = $_SESSION["username"];
            ini_set ('error_reporting', E_ALL);
            ini_set ('display_errors', '1');
            error_reporting (E_ALL|E_STRICT);
            $db = mysqli_init();
            
            //Cadenas de conexion//
            
            
            $server= "host/ip";
            $usuario= "usuario@servidor-bbdd";
            $pass= "password_bbdd";
            $bbdd= "basededatos";
            $ssl_cert= 'ssl/certificado.pem';
            
            
            //--------------------------------------//
            
            mysqli_options ($db, MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, true);
            $db->ssl_set(NULL, NULL, $ssl_cert, NULL, NULL);
            $link = mysqli_real_connect ($db, $server , $usuario , $pass , $bbdd , 3306, MYSQLI_CLIENT_SSL);

            $query= "SELECT Nombre FROM registro_diario WHERE fecSalida is NULL ORDER by fecEntrada DESC LIMIT 5";
            $ensenar= $db->query($query) or die ("error en la select");
              if ($ensenar){
                $fila = $ensenar->fetch_assoc();
                    echo "{$fila['Nombre']}";
                    $nombres = $fila['Nombre'];
                    $ensenar->close();

            
          }
          

    ?>
  </h1>

            <!-- Tabla de los últimos registros -->

    <?php
            ini_set ('error_reporting', E_ALL);
            ini_set ('display_errors', '1');
            error_reporting (E_ALL|E_STRICT);
            $db = mysqli_init();
            mysqli_options ($db, MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, true);
            $db->ssl_set(NULL, NULL, $ssl_cert, NULL, NULL);
            $link = mysqli_real_connect ($db, $server , $usuario , $pass , $bbdd , 3306, MYSQLI_CLIENT_SSL);



            $sql = 'select Nombre, fecEntrada, fecSalida, Descripcion from registro_diario ORDER by fecEntrada DESC LIMIT 5';
		        $mostrar= $db->query($sql) or die ("error en la select");
		          if ($mostrar){
			          $fila = $mostrar->fetch_assoc();
                  echo '<table>';

                  echo "<tr>";
                    echo "<th>";
                    echo '<font face="sans-serif">'.'Nombre'."</font>";
                    echo "</th>";
                    echo "<th>";
                    echo '<font face="sans-serif">'."Fecha de entrada"."</font>";
                    echo "</th>";
                    echo "<th>";
                    echo '<font face="sans-serif">'."Fecha de Salida"."</font>";
                    echo "</th>";
                    echo "<th>";
                    echo "Descripcion";
                    echo "</th>";
                  echo "</tr>";
                  

                  $cerrar = $fila['Nombre'];

				          while ($fila){

					        echo '<tr>';
					          echo '<td>'."{$fila['Nombre']}"."</td>";
					          echo '<td>'."{$fila['fecEntrada']}"."</td>";
					          echo '<td>'."{$fila['fecSalida']}"."</td>";
                    echo '<td>'."{$fila['Descripcion']}"."</td>";
			            echo "</tr>";


	            $fila = $mostrar->fetch_assoc();
		          }
              echo "</table>";
            }
              $mostrar->close();
          ?>

            

          <form action="" method="POST" class="formulario">
              <fieldset>
                  <legend></legend>
                      <div>
                          
                          <input type="submit" name="Desconectar" value="Desconectar" class="Desconectar">
                        
                      </div>
              </fieldset>
          </form>
</body>


<!-- Desconexión y salida de la sala -->

<?php
if (isset($_POST['Desconectar']))
	{




  
  
  
  ini_set ('error_reporting', E_ALL);
  ini_set ('display_errors', '1');
  error_reporting (E_ALL|E_STRICT);
  $db = mysqli_init();
  mysqli_options ($db, MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, true);
  $db->ssl_set(NULL, NULL, $ssl_cert, NULL, NULL);
  $link = mysqli_real_connect ($db, $server , $usuario , $pass , $bbdd, 3306, MYSQLI_CLIENT_SSL);
  
    
    
    
    $query= "SELECT Nombre FROM registro_diario WHERE fecSalida is NULL ORDER by fecEntrada DESC LIMIT 5";
    $ensenar= $db->query($query) or die ("error en la select");
    if ($ensenar){
      $fila = $ensenar->fetch_assoc();
      $nombres = $fila['Nombre'];
      $name = $_SESSION["username"];
      $db->query("UPDATE registro_diario set fecSalida=NOW() where Nombre = '$name' and id = (select ID where fecSalida is NULL)") or die ($db->error);
      $_SESSION = array();
      session_destroy();

    header( "location: index.php" );


  };
};
 

  ?>

</html>
