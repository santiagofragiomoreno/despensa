<?php
use PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
///////// conexion BBDD ////////
$conexion = new mysqli('localhost','u823703154_despe','santiago87','u823703154_despe');
$conexion->set_charset('utf8');
//comprobamos si no hay errores en la conexion
if($conexion->connect_error){
    die ($conexion->connect_error);
    echo "Error en la conexion con la Base de Datos";
}
//include 'Exception.php';
include 'PHPMailer.php';
include 'SMTP.php';
$existe_producto = 0;
//comprobamos si nos llegan los parametros de la RASPBERRY
if(isset($_POST['codigo_producto']) && isset($_POST['usuario'])){
   
    //comprobamos en la tabla de productos
    $consulta = "SELECT codigo_producto FROM productos WHERE id_usuario =".$_POST['usuario']." AND codigo_producto =".$_POST['codigo_producto'];
    $resultado = $conexion->query($consulta);
    //si $resultado->num_rows == 0 -----> mandamos email con el link para insertar el nuevo producto
    if($resultado == false ){
        $c = 3;//$_GET['codigo_producto'];
        $u = 4 ;// $_GET['usuario'];
        $params = array($c,$u);
        //enviamos email----> hacemos uso de PHPmailer();
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                       // Enable verbose debug output
            $mail->isSMTP();                                            // Set mailer to use SMTP
            $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'santiagofragio@gmail.com';                     // SMTP username
            $mail->Password   = 'santiago87';                               // SMTP password
            $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to
            
            //Recipients
            $mail->setFrom('santiagofragio@gmail.com', 'yo');
            $mail->addAddress('santiagofragio@gmail.com', 'sannnttii');     // Add a recipient
            //$mail->addAddress('carlos.r@mixentradas.com');               // Name is optional
             /*$mail->addReplyTo('info@example.com', 'Information');
             $mail->addCC('cc@example.com');
             $mail->addBCC('bcc@example.com');*/
            
            // Attachments
            /*$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
             $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name*/
            
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Producto no existe en Base de Datos';
            $mail->Body    = //'Para dar de alta el producto, haga click en el siguiente enlce:\n localhost/APP/alta_producto/'.$params;
            $mail->AltBody = 'esta es el cuerpo del mensaje para los clientes';
            
            $mail->send();
            //echo 'El mensaje se envio correctamente';
        } catch (Exception $e) {
            //echo "Error al enviar el mensaje. Mailer Error: {$mail->ErrorInfo}";
        }
        echo $existe_producto = 2;
    }
    else{
        echo $existe_producto = 1;
    }
}
else{
    echo $existe_producto;
}