<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Registro-CPD</title>
</head>
<body>
<img src="img/Clarcat_logotipo_naranja_negro.png" alt="">
    <h1>Registro CPD</h1>
    <div class="registroposicion">
    <form action="" method="POST" class="formulario">
        <fieldset>
            <legend>Registra tu entrada al CPD</legend>
            <div  class="contenedor-campos">
                <div class="campo">
                    <label for="">Nombre</label>
                    <select name="opciones" id="">

                        <option value="Diego Suarez">Diego Suárez</option>
                        <option value="Enol Muñiz">Enol Muñiz</option>

                    </select>
                </div>
                <div class="campo descripcion">
                    <label for="">Descripción</label>
                    <textarea name="descripcion" class="input-text" cols="30" rows="10"></textarea>
                </div>
                <div>
                    <input type="submit" name="Enviar" id="Enviar">
                </div>
        </fieldset>
    </form>
    </div>
</body>
<?php

if (isset($_POST['Enviar']))
{
    ini_set ('error_reporting', E_ALL);
    ini_set ('display_errors', '1');
    error_reporting (E_ALL|E_STRICT);
    $db = mysqli_init();
    
            
            //Cadenas de conexion//

            $server= "sslclarcat.mysql.database.azure.com";
            $usuario= "azadmin@sslclarcat";
            $pass= "Jup1t3r_3030";
            $bbdd= "registro";
            $ssl_cert= 'ssl/BaltimoreCyberTrustRoot.crt.pem';
    

            //--------------------------//
    
    
    $db->ssl_set(NULL, NULL, $ssl_cert, NULL, NULL);
    $link = mysqli_real_connect ($db, $server , $usuario , $pass , $bbdd, 3306, NULL);

    $nombre = $_POST['opciones'];
    $descripcion = $_POST['descripcion'];
    session_start();  
    $_SESSION["username"] = $nombre;

    $db->query("INSERT INTO registro_diario (Nombre, fecEntrada, fecSalida, Descripcion) values ('$nombre', NOW(), NULL, '$descripcion')") or die ($con->error);
    $db->close();

    header ("location: sesion.php");
};

//sincroniza
?>
</html>
