<?php
// =======================================================
// Name: Mailing
// Developer: Jauregui Crespo
// Author URL: https://jauregui82.github.io/cv/
// ======================================================= 
    // $result = ''; 
    // $result .= $this->HeaderLine("Organization" , SITE); 
    // $result .= $this->HeaderLine("Content-Transfer-encoding" , "8bit"); 
    // $result .= $this->HeaderLine("Message-ID" , "< ".md5(uniqid(time()))."@{$_SERVER['SERVER_NAME']}>"); 
    // $result .= $this->HeaderLine("X-MSmail-Priority" , "Normal"); 
    // $result .= $this->HeaderLine("X-Mailer" , "Microsoft Office Outlook, Build 11.0.5510"); 
    // $result .= $this->HeaderLine("X-MimeOLE" , "Produced By Microsoft MimeOLE V6.00.2800.1441"); 
    // $result .= $this->HeaderLine("X-Sender" , $this->Sender); 
    // $result .= $this->HeaderLine("X-AntiAbuse" , "This is a solicited email for - ".SITE." mailing list."); 
    // $result .= $this->HeaderLine("X-AntiAbuse" , "Servername - {$_SERVER['SERVER_NAME']}"); 
    // $result .= $this->HeaderLine("X-AntiAbuse" , $this->Sender); 

    /*
    Primero, obtenemos el listado de e-mails
    desde nuestra base de datos y la incorporamos a un Array.
    */

    $array = array("example@gmail.com","mail@example.com");

    /* 
    Incluimos el PHPMailerAutoload, que se encarga de incorporar 
    a nuestro código, todos los archivos necesarios para utilizar la librería.
    Supongamos que guardamos dicha librería en un directorio llamado "phpmailer"
    */

    require("../lib/phpmailer/class.phpmailer.php");
    require("../lib/phpmailer/class.smtp.php");

    
    $mail = new PHPMailer;
    
    // Configuramos los datos de sesión para conectarnos al servicio SMTP de Mandrill
    $mail->IsSMTP(); // Indicamos que vamos a utilizar SMTP
    // 0 = Apagado 
    // 1 = Mensaje de Cliente 
    // 2 = Mensaje de Cliente y Servidor 
    $mail->SMTPDebug = 2;
    // Log del debug SMTP en formato HTML 
    $mail->Debugoutput = 'html'; 
    $mail->Host = 'mail.example.net'; // El Host de Mandrill               
    $mail->Port = 587;  // El puerto que Mandrill nos indica utilizar
    $mail->SMTPAuth = true; // Indicamos que vamos a utilizar auteticación SMTP       
    $mail->Username = 'mail@example.net'; // Nuestro usuario en Mandrill              
    $mail->Password = '1234567'; // Key generado por Mandrill 
    $mail->SMTPSecure = 'tls'; // Activamos el cifrado tls (también ssl)
    
    // Ahora configuraremos los parámetros básicos de PHPMailer para hacer un envío típico
    
    $mail->From = 'mail@example.net'; // Nuestro correo electrónico
    $mail->FromName = 'example'; // El nombre de nuestro sitio o proyecto
    $mail->IsHTML(true); // Indicamos que el email tiene formato HTML                      
    $mail->Subject = 'Soy un asunto!'; // El asunto del email
    $mail->Body = 'Hola, soy el cuerpo del mensaje :)'; // El cuerpo de nuestro mensaje
    
    // Recorremos nuestro array de e-mails.
    
    foreach ($array as $email) {
        $mail->AddAddress($email); // Cargamos el e-mail destinatario a la clase PHPMailer
        $mail->Send(); // Realiza el envío =)
        $mail->ClearAddresses(); // Limpia los "Address" cargados previamente para volver a cargar uno.
    }
    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
        echo "<br>";
        echo json_encode($array);
    } else {
        echo "Message sent! <br>";
        echo json_encode($array);
    }
?>