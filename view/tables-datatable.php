
	<div class="content-page">
		<!-- Start content -->
        <div class="content">
			<div class="container-fluid">
				<div class="row">
						<div class="col-xl-12">
							<div class="breadcrumb-holder">
								<h1 class="main-title float-left">Base de datos</h1>
								<ol class="breadcrumb float-right">
									<li class="breadcrumb-item">Home</li>
									<li class="breadcrumb-item active">Data Tables</li>
								</ol>
								<div class="clearfix"></div>
							</div>
						</div>
				</div>
				<!-- end row -->
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">						
						<div class="card mb-3">
							<div class="card-header">
								<h3><i class="fa fa-table"></i> Base de datos de correos</h3>
								Contiene los archivos procedentes de la importancion del excel
							</div>
							<div class="card-body">
								<div class="table-responsive">
								<table id="example1" class="table table-bordered table-hover display">
									<thead>
										<tr>
											<th>Nombre</th>
											<th>DNI</th>
											<th>Telefono</th>
											<th>Correo</th>
											<th>Dirección</th>
											<th>Distrito</th>
											<th>Region</th>
										</tr>
									</thead>										
									<tbody>
									<?php
										require_once('../db/conexion.php');
										$db = new Conexion();

										$sql="SELECT * FROM countries_and_population WHERE country!='' ORDER BY rank DESC";
			   
										$insert=$db->prepare($sql);
										$insert->execute();
										$cuan= $insert->rowCount();

										if ($cuan>0) {
											while($ver = $insert->fetch()){
										   $datos=$ver[0]."||". // id
												  $ver[1]."||". // Country
												  $ver[2]."||". // population
												  $ver[3]."||". // date
												  $ver[4]."||". // powp
												  $ver[5];      // rank
									?>
									<tr>
										<td><p id="<?php echo $ver[0] ?>"><?php echo $ver[1] ?></p></td>
										<td><p id="<?php echo $ver[0] ?>"><?php echo $ver[2] ?></p></td>
										<td><p id="<?php echo $ver[0] ?>"><?php echo $ver[3] ?></p></td>
										<td><p id="<?php echo $ver[0] ?>"><?php echo $ver[4] ?></p></td>
										<td><p id="<?php echo $ver[0] ?>"><?php echo $ver[5] ?></p></td>
										<td><p id="<?php echo $ver[0] ?>"><?php echo $ver[5] ?></p></td>
										<td><p id="<?php echo $ver[0] ?>"><?php echo $ver[5] ?></p></td>
									</tr>
									<?php
									  	 }
									   }
									?>
									</tbody>
									<thead>
										<tr>
											<th>Nombre</th>
											<th>DNI</th>
											<th>Telefono</th>
											<th>Correo</th>
											<th>Dirección</th>
											<th>Distrito</th>
											<th>Region</th>
										</tr>
									</thead>
									<a href="" class="btn btn-success small hide">Agregar</a>
									<br>
									<br>
								</table>
							</div>
							
						</div>														
						<span id="enviarMail" class="btn btn-danger" data-toggle="modal" data-target="#mdSendMail">Enviar</span>
						</div><!-- end card-->					
					</div>
				</div>
            </div>
			<!-- END container-fluid -->
		</div>
		<!-- END content -->
    </div>
	<!-- END content-page -->
    

</div>
<!-- END main -->

	<script>
	// START CODE FOR BASIC DATA TABLE 
	$(document).ready(function() {
		$('#example1').DataTable();
	} );
	// END CODE FOR BASIC DATA TABLE 

	</script>	
<!-- END Java Script for this page -->
