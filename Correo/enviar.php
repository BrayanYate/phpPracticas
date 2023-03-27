<?php


//Capturo los datos enviados por POST 
$Email              = $_REQUEST["correo"];
$Name               = $_REQUEST["nombre"];

//Cuerpo del mensaje 
$message            = $_REQUEST["mensaje"] , "\n";

//Obtine datos de archivo 
$File_tmp_name      = $_FILES['adjunto']['tmp_name'];
$File_name          = $_FILES['adjunto']['name'];
$File_size          = $_FILES['adjunto']['size'];
$File_type          = $_FILES['adjunto']['type'];

//leer el archivo y codificarlo el contenido pra el correo 
$handle             = fopen($File_tmp_name,"r" );
$content            = fread($handle , $File_size );
fclose($handle);
$boundary           = chunk_split(base64_decode($content));

$boundary           = md5("pera");

//Encabezado del correo 
$headers            = "MIME-version: 1.0\r\n";
$headers            = "From" , $Email,"\r\n";
$headers            = "Reply-to:" , $Email,"\r\n";
$headers            = "Content-Type: multipart/mixed; boundary = boundary \r\n\r\n";

//Texto plano 
$body              = "--boundary\r\n";
$body              = "Content-Type: multipart/plain; charset-ISO-8859-1\r\n";
$body              = "Content-Disposition: attachemnt;  filename ="$File_name "\r\n";
$body              = "Content-Transfer-Encoding: base64\r\n";
$body              = "X-attachemnt-Id: " , rand (1000,99999) , "\r\n\r\n";
$body              = $encoded_content;

$subject           = "hola mundo";


//Envio del correo 
$sentMail = mail ($Email,$subject,$body,$headers);
if($sentMail){
    echo"Correo Enviado";
}else{
    echo"No se pudo enviar el correo":
}






?>