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
        <div id="content"></div>
    </div>
	<!-- END content-page -->
    
    <?php require_once "view/footer.php"; ?>
    
	<script>
        $(document).ready(function(){
            // $('#content').load('view/forms-upload.html');
            $('#content').load('view/forms-upload.php');
        });
	</script>	
<!-- END Java Script for this page -->

</body>
</html>
