 
	<title>Enviar correo</title>
<link rel="icon" type="image/png" sizes="16x16" href="../situ.png">
  
  <link rel="stylesheet" type="text/css" href="../estilos.css">
  <link rel="stylesheet" type="text/css" href="../Assets/fonts/style.css">
  <link rel="stylesheet" type="text/css" href="../Assets/bootstrap-4.3.1-dist/css/bootstrap.min.css">
 
<?php
require '../Assets/funcion.php';
$nombre='SITU';
 $email= 'amjohan4@misena.edu.co';
	$url = 'http://'.$_SERVER["SERVER_NAME"].'/proyectoSituUL/administrador/memorandoSena.php';
        $asunto ='Memorando Sena Empresa';
        $cuerpo= utf8_decode("Hola <br/> <br/>Sena Empresa te ha notificado con un memorando por la inasistencia al turno
        <a href='$url'><i class='icon-bin'>descargar memorando</i></a>"); 
       
         if (enviarEmail($email,$nombre,$asunto,$cuerpo)) {

            


  		header('Refresh: 1; URL=ListarAsistencias.php');


  		echo "<script type='text/javascript'> alert('Memorando Enviado');</script>"; 
		} else {

  		echo "Mailer Error: ";
		}
           
            exit;
            
        

	
?>