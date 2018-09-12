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

    if ($_REQUEST['action']=='sendMail' && $_REQUEST['mail']==1){
        // // Consultamos los correos en la base de datos
        require_once('../db/conexion.php');
        $db= new Conexion();
        $sql= "SELECT * FROM countries_and_population";
        $insert=$db->prepare($sql);
        $insert->execute();
        $cuan= $insert->rowCount();
        // echo $sql;
        // echo "\n";
        header('Content-Type: application/json');
        
        if ($cuan>0) {
            $i=0;
            $categoriaArray=array();
            while( $datos = $insert->fetch()){
                if ($datos[1]!="") {
                    $categoriaArray[$i]=$datos[1];
                    $i++;
                }
            }
            //echo json_encode( $categoriaArray);
        }else {
            // echo json_encode(['error' => $message]);
        }
        
        // echo json_encode(['mensaje'=>'Mensaje enviado', 'correos'=>$categoriaArray]);
        /*
        Primero, obtenemos el listado de e-mails
        desde nuestra base de datos y la incorporamos a un Array.
        */
    
        
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
        $mail->SMTPDebug = 0;
        // Log del debug SMTP en formato HTML 
        $mail->Debugoutput = 'html'; 
        $mail->Host = 'mail.host.net'; // El Host de Mandrill               
        $mail->Port = 587;  // El puerto que Mandrill nos indica utilizar
        $mail->SMTPAuth = true; // Indicamos que vamos a utilizar auteticación SMTP       
        $mail->Username = 'example@host.net'; // Nuestro usuario en Mandrill              
        $mail->Password = '123456'; // Key generado por Mandrill 
        $mail->SMTPSecure = 'tls'; // Activamos el cifrado tls (también ssl)
        
        // Ahora configuraremos los parámetros básicos de PHPMailer para hacer un envío típico
        
        $mail->From = 'example@host.net'; // Nuestro correo electrónico
        $mail->FromName = 'host'; // El nombre de nuestro sitio o proyecto
        // $mail->IsHTML(true); // Indicamos que el email tiene formato HTML                      
        $mail->Subject = 'Soy un asunto!'; // El asunto del email
        // $mail->Body = 'Hola, soy el cuerpo del mensaje :)'; // El cuerpo de nuestro mensaje
        $mail->msgHTML(file_get_contents('../view/template.html'), dirname(__FILE__)); 
        
        // Recorremos nuestro array de e-mails.
        
        foreach ($categoriaArray as $email) {
            $mail->AddAddress($email); // Cargamos el e-mail destinatario a la clase PHPMailer
            $mail->Send(); // Realiza el envío =)
            $mail->ClearAddresses(); // Limpia los "Address" cargados previamente para volver a cargar uno.
        }
        if (!$mail->send()) {
            // echo 'Mailer Error: ' . $mail->ErrorInfo;
            // echo "<br>";
            // echo json_encode('mensaje'=>$mail->ErrorInfo)
            // echo json_encode($categoriaArray);
            echo json_encode(['mensaje'=>'Mensaje de difusión enviado', 'correos'=>$categoriaArray]);
            // header('location:../index.php#enviado');
        } else {
            // echo "Message sent! <br>";
            // echo json_encode($categoriaArray);
            echo json_encode(['mensaje'=>'El Mensaje no se pudo enviar', 'correos'=>$categoriaArray]);
            // header('location:../index.php#errorEnvio');
        }
    }
?>