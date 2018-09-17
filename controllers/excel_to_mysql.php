<?php
// =======================================================
// Name: Mailing
// Developer: Jauregui Crespo
// Author URL: https://jauregui82.github.io/cv/
// ======================================================= 

    require_once('../db/conexion.php');

    include '../lib/simplexlsx/simplexlsx.class.php';
    $xlsx = new SimpleXLSX( '../lib/data/countries_and_population.xlsx' );
    try {
       $conn = new Conexion();
       $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }
    $stmt = $conn->prepare( "INSERT INTO auto2show (nombre, apellido_p, apellido_m, email, telefono) VALUES (?, ?, ?, ?, ?)");
    $stmt->bindParam( 1, $nombre);
    $stmt->bindParam( 2, $apellido_p);
    $stmt->bindParam( 3, $apellido_m);
    $stmt->bindParam( 4, $email);
    $stmt->bindParam( 5, $telefono);
    foreach ($xlsx->rows() as $fields)
    {
        $nombre = $fields[0];
        $apellido_p = $fields[1];
        $apellido_m = $fields[2];
        $email = $fields[3];
        $telefono = $fields[4];
        $exito= $stmt->execute();
    }
    if($exito){ echo 'importacion completa'; }else{ echo 'Hubo un problema. Contacta a un administrador. ';} 
