<?php
    require_once('../controllers/upload.php');
?>
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                    <div class="col-xl-12">
                            <div class="breadcrumb-holder">
                                    <h1 class="main-title float-left">Cargar archivos</h1>
                                    <ol class="breadcrumb float-right">
                                        <li class="breadcrumb-item">Home</li>
                                        <li class="breadcrumb-item active">Cargar archivos</li>
                                    </ol>
                                    <div class="clearfix"></div>
                            </div>
                    </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">						
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3><i class="fa fa-upload"></i> Importar archivos</h3>
                                Seleccione un archivo de <b>excel</b> en formato ".xlsx"
                        </div>
                            
                        <div class="card-body">
                            <form id="form" method="post" action="controllers/upload.php" enctype="multipart/form-data">
                                <input type="file" name="uploaded_file" id="filer_example2" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" runat="server">
                                <br>
                                <br>
                                &nbsp;
                                <input class="btn btn-success" type="submit" value="Inportar">
                            </form>
                        </div>														
                    </div><!-- end card-->					
                </div>
            </div>
        </div>
        <!-- END container-fluid -->
    </div>
    <!-- END content -->
</div>
<!-- END content-page -->


