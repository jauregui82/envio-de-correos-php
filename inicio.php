<?php 
	session_start();

if(isset($_SESSION['user'])){
 ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Envio de correos</title>
      <?php require_once "view/header.php"; ?>
  </head>

  <body class="adminbody">
      
      <div id="main">
          <?php require_once "view/topBar.php"; ?>
          <?php require_once "view/nav.php"; ?>
          <?php include "controllers/upload.php"; ?>
          <div id="content"></div>
      </div>
    <!-- END content-page -->

  <!-- Modal -->
  <div class="modal fade" id="mdSendMail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-triangle"></i> Alto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ¿Esta seguro de que quiere enviar un mensaje de difusion?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="button" onclick="sendMail()" data-dismiss="modal" class="btn btn-success">Enviar Difusión</button>
        </div>
      </div>
    </div>
  </div>
  <!-- end Modal -->
  <!-- Modal -->
  <div class="modal fade" id="mdAlert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-triangle"></i><span id="mdAlertTitle"></span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <span id="mdAlertContent"></span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Aceptar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- end Modal -->
      <?php require_once "view/footer.php"; ?>
      
    <script>
          $(document).ready(function(){
              // $('#content').load('view/forms-validation.php');
              $('#content').load('view/tables-datatable.php');
              // $('#content').load('view/forms-upload.php');
          });
    </script>	
  <!-- END Java Script for this page -->

  </body>
  </html>
<?php 
} else {
	header("location:index.php");
	}
 ?>