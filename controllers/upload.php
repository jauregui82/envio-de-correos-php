<?PHP
  if(!empty($_FILES['uploaded_file'])){
      // echo json_encode($_FILES['uploaded_file']);
    $path = "../lib/data/";
    $archivo="cargado";
    // $path = $path . basename( $_FILES['uploaded_file']['name']); // en caso de que se quiera dejar el nombre del archivo
    $path = $path ."archivo.xlsx";// se renombra el archivo para que pueda ser reemplazado
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($path,PATHINFO_EXTENSION));
    
     // verifica el formnato cargado 
    if($imageFileType != "xlsx" ) {
        // echo json_encode('Discupe, solo se admite en formato de excel &nbsp; ".xlsx"');
        $uploadOk = 0;
    }
    if ($uploadOk == 1) {
        if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
          // //echo "El archivo: ".  basename( $_FILES['uploaded_file']['name'])." Se ha cargado correctamente";
          echo json_encode("El archivo se ha cargado correctamente");
        
          // //*** sube el archivo generado a la base de datos
          require_once('../db/conexion.php');

          include '../lib/simplexlsx/simplexlsx.class.php';
          $xlsx = new SimpleXLSX( '../lib/data/archivo.xlsx' );
          try {
            $conn = new Conexion();
            $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          }
          catch(PDOException $e){
              echo $sql . "<br>" . $e->getMessage();
          }
          $stmt = $conn->prepare( "INSERT INTO auto2show2 (nombre, apellido_p, apellido_m, email, telefono) VALUES (?, ?, ?, ?, ?)");
            $stmt->bindParam( 1, $nombre);
            $stmt->bindParam( 2, $apellido_p);
            $stmt->bindParam( 3, $apellido_m);
            $stmt->bindParam( 4, $email);
            $stmt->bindParam( 5, $telefono);
            foreach ($xlsx->rows() as $fields){
                $nombre = $fields[0];
                $apellido_p = $fields[1];
                $apellido_m = $fields[2];
                $email = $fields[3];
                $telefono = $fields[4];
                $exito= $stmt->execute();
          }
          if($exito){ header('location:../inicio#importado'); echo json_encode('importacion completa'); }else{header('location:../inicio#error'); echo json_encode('Hubo un problema. Contacta a un administrador.');} 
          // //fin ***
        } 
        else{
            // echo json_encode("Ups, ocurrio un error en la carga del archivo!");
            header('location:../inicio#errorAr');
        }
    }
    else{
        echo json_encode("el archivo esta en un formato incorrecto");
    }
  }
?>