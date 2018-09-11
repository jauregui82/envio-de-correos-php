<?PHP
  if(!empty($_FILES['uploaded_file'])){
    $path = "../lib/data/";
    $archivo="cargado";
    // $path = $path . basename( $_FILES['uploaded_file']['name']); // en caso de que se quiera dejar el nombre del archivo
    $path = $path ."archivo.xlsx";// se renombra el archivo para que pueda ser reemplazado
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($path,PATHINFO_EXTENSION));
    
    //  verifica el formnato cargado
    if($imageFileType != "xlsx" ) {
        echo 'Discupe, solo se admite en formato de excel &nbsp; ".xlsx"';
        $uploadOk = 0;
    }
    if ($uploadOk != 0) {
        if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
        // echo "El archivo: ".  basename( $_FILES['uploaded_file']['name'])." Se ha cargado correctamente";
        echo "El archivo se ha cargado correctamente";
        } 
        else{
            echo "Ups, ocurrio un error en la carga del archivo!";
        }
    }
  }
?>