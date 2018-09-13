<?php 
	session_start();
	require_once "../db/conexion.php";

	$db= new conexion();

    $usuario=$_POST['usuario'];
    $pass=sha1($_POST['password']);

    // $sql="SELECT a.user, a.pass from usuarios u, admin a where u.id_us=a.id_us AND a.user='$usuario' AND a.pass='$pass'";
    // $result=mysqli_query($db,$sql);

    // if(mysqli_num_rows($result) > 0){
    // 	$_SESSION['user']=$usuario;
    // 	echo 1;
    // }else{
    // 	echo 0;
    // }


    //**************************************** */
    $sql="SELECT user, pass from usuarios where user='$usuario' AND pass='$pass'";
    $insert=$db->prepare($sql);
    $insert->execute();
    $cuan= $insert->rowCount();

    header('Content-Type: application/json');

    if ($cuan>0) {
        $_SESSION['user']=$usuario;
        echo 1;
    }else {
        echo 0;
    }
 ?>