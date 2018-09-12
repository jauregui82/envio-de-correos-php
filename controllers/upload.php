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
          $stmt = $conn->prepare( "INSERT INTO countries_and_population (rank, country, population, date_of_estimate, powp) VALUES (?, ?, ?, ?, ?)");
          $stmt->bindParam( 1, $rank);
          $stmt->bindParam( 2, $country);
          $stmt->bindParam( 3, $population);
          $stmt->bindParam( 4, $date_of_estimate);
          $stmt->bindParam( 5, $powp);
          foreach ($xlsx->rows() as $fields){
              $rank = $fields[0];
              $country = $fields[1];
              $population = $fields[2];
              $date_of_estimate = $fields[3];
              $powp = $fields[4];
              $exito= $stmt->execute();
          }
          if($exito){ header('location:../index.php#importado'); echo json_encode('importacion completa'); }else{header('location:../index.php#error'); echo json_encode('Hubo un problema. Contacta a un administrador.');} 
          // //fin ***
        } 
        else{
            echo json_encode("Ups, ocurrio un error en la carga del archivo!");
        }
    }
    else{
        echo json_encode("el archivo esta en un formato incorrecto");
    }
  }
?>