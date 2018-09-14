<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envio de correos</title>
    <!-- <link rel="stylesheet" type="text/css" href="../../masterhelp_api_php/bootstrap/css/bootstrap.css"> -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap3.css">
    <?php require_once "view/header.php"; ?>
</head>
<style>
    body{
        background-color:#007bff3b;
    }
    .footer{
        background-color:#007bff1f;
        left:0px;
    }
</style>
<br>
<br>
<br>
<br>
&nbsp;
&nbsp;
&nbsp;
&nbsp;
&nbsp;
<div class="container">
	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			<div class="panel panel-primary">
				<div class="panel panel-heading" style="font-size: 3em;">Envio masivo de correos</div>
				<div class="panel panel-body">
					<div style="text-align: center;">
						<img src="assets/images/logo.png" height="50">
					</div>
					<p></p>
					<label style="font-size: large;">Usuario</label>
					<input type="text" id="usuario" class="form-control input-sm" name="">
					<label style="font-size: large;">Contraseña</label>
					<input type="password" id="password" class="form-control input-sm" name="">
					<p></p>
					<span class="btn btn-primary" id="entrarSistema">Entrar</span>
					<!-- <a href="registro.php" class="btn btn-danger">Registro</a>  -->
				</div>
			</div>
		</div>
		<div class="col-sm-4"></div>
	</div>
</div>

<?php require_once "view/footer.php"; ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#entrarSistema').click(function(){
			if($('#usuario').val()==""){
				alertify.alert("Debes agregar el usuario");
				return false;
			}else if($('#password').val()==""){
				alertify.alert("Debes agregar una contraseña");
				return false;
			}

			cadena="usuario=" + $('#usuario').val() + 
					"&password=" + $('#password').val();

				$.ajax({
					type:"POST",
					url:"controllers/login.php",
					data:cadena,
					success:function(r){
						if(r==1){
							window.location="inicio";
						}else{
							// window.location="inicio.php";
							alertify.alert("Fallo al entrar :(");
						}
					}
				});
		});	
	});
</script>