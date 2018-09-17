<?php
// =======================================================
// Name: Mailing
// Developer: Jauregui Crespo
// Author URL: https://jauregui82.github.io/cv/
// ======================================================= 

//Incluyo la clase

include '../lib/simplexlsx/simplexlsx.class.php';
$xlsx = new SimpleXLSX('../lib/data/b_datos.xlsx ');//Instancio la clase y le paso como parametro el archivo a leer
$fp = fopen( '../lib/data/datos.csv', 'w');//Abrire un archivo "datos.csv", sino existe se creara
 foreach( $xlsx->rows() as $fields ) {//Itero la hoja de calculo
        fputcsv( $fp, $fields);//Doy formato CSV a una línea y le escribo los datos
}
fclose($fp);//Cierro el archivo "datos.csv"
?>