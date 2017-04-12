<?php
require_once 'config.php';
session_start();
$mensaje = '';
$db_server   = DB_SERVER;
$db_name     = DB_NAME;
$db_username = DB_USERNAME;
$db_password = '';
function probar_coneccion($db_server, $db_username, $db_password, $db_name)
{
  $probar=array();
  $probar['conexion']=false;
  $probar['existe']=false;
  $mysqli = new mysqli($db_server, $db_username, $db_password, $db_name);
  $mensaje="";
  if (!mysqli_connect_error()) 
  {  
      $probar['conexion']=true;
      $sql = "SHOW TABLES";
      $result = $mysqli->query($sql);
      if($result->num_rows>0)
      {
          $probar['existe']=true;
      }

  }
  return $probar;
}

function eliminartablas($db_server, $db_username , $db_password, $db_name)
{
    $probar=probar_coneccion($db_server, $db_username , $db_password, $db_name);
    $retorna=true;
    if($probar['conexion']&&$probar['existe'])
    {
        $mysqli = new mysqli($db_server, $db_username, $db_password, $db_name);
        $sql = "SELECT CONCAT('drop table ',table_name,'; ') FROM information_schema.tables WHERE table_schema ='".$db_name."' ";
        $result = $mysqli->query($sql);
        while ($fila = $result->fetch_row()) {
            echo $fila[0]."<br>";
            $mysqli->query($fila[0]);
            if (mysqli_connect_error()) 
            {
                echo "Error al eliminar la linea con nombre: ".$fila[0];
                $retorna=false;
            }
        }
        
    }
    return $retorna;
    
}

if(@$_POST['enviar'])
{
    $db_server   = $_POST['db_server'];
    $db_name     = $_POST['db_name'];
    $db_username = $_POST['db_username'];
    $db_password = $_POST['db_password'];
    
    $probar=probar_coneccion($db_server, $db_username , $db_password, $db_name);
    if($probar['conexion'])
    {
        $_SESSION['db_password']=$db_password;
        $_SESSION['db_server']=$db_server;
        $_SESSION['db_name']=$db_name;
        $_SESSION['db_username']=$db_username;
        if($probar['existe'])
        {
            $mensaje="Existen datos en la base de datos ";
            $mensaje.='<button type = "submit" name="eliminar" value="eliminar" class = "btn btn-primary">Eliminar</button><br><br>';
            require_once 'formularioconexion.php';
        }
        else 
        {
           require_once 'bigdump.php'; 
        }
    }
    else 
    {
        $mensaje="Los datos del formulario no van en la base de datos";
        
        require_once 'formularioconexion.php';
    }
}
else if(@$_POST['config']) {
    // Database configuration
    defined( 'DB_SERVER' ) or die( ':(' );
    $probar=probar_coneccion(DB_SERVER, DB_USERNAME,DB_PASSWORD, DB_NAME);
    if($probar['conexion'])
    {
        $_SESSION['db_password']=DB_PASSWORD;
        $_SESSION['db_server']=DB_SERVER;
        $_SESSION['db_name']=DB_NAME;
        $_SESSION['db_username']=DB_USERNAME;
        
        if($probar['existe'])
        {
            $mensaje="Existen datos en la base de datos debes eliminarlos ";
            $mensaje.='<button type = "submit" name="eliminar" value="eliminar" class = "btn btn-primary">Eliminar</button><br><br>';
            require_once 'formularioconexion.php';
        }
        else 
        {
           $db_password = DB_PASSWORD; //el resto se carga en el principio
           require_once 'bigdump.php'; 
        }
            
        
    }
    else 
    {
        $mensaje="Los datos del archivo config no van en la base de datos";
        require_once 'formularioconexion.php';
    }
    
}
else if(@$_POST['eliminar'])
{
    $db_server   = $_POST['db_server'];
    $db_name     = $_POST['db_name'];
    $db_username = $_POST['db_username'];
    $db_password = $_POST['db_password'];
    if(eliminartablas($db_server, $db_username, $db_password, $db_name))
    {
        $mensaje = "Se han eliminado todas las tablas vuelve a enviar para continuar";
        require_once 'formularioconexion.php';
    }
    else 
    {
        $mensaje = "No se han podido eliminar todoas las tablas prueba a dar a eliminar otra vez ";
        $mensaje.='<button type = "submit" name="eliminar" value="eliminar" class = "btn btn-primary">Eliminar</button>';
        require_once 'formularioconexion.php';
    }
}
else if(@$_GET['start']) {
    $db_password=$_SESSION['db_password'];
    $db_server=$_SESSION['db_server'];
    $db_name=$_SESSION['db_name'];
    $db_username=$_SESSION['db_username'];
    require_once 'bigdump.php'; 
}
else {
    require_once 'formularioconexion.php';
}

