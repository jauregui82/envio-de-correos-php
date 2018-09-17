$(window).load(function(){
	$('.preloader').fadeOut('slow');
	// $('body').loading('stop');
});

$('#uploadFile').click(function(){
    window.location.hash="";
    window.location.hash="#importar";
    $('#content').load('view/forms-upload.php');
});
$('#showData').click(function(){
    window.location.hash="";
    window.location.hash="#listado";
    $('#content').load('view/tables-datatable.php');
});
$('.salir').click(function(){
    window.location.href="controllers/salir.php"
});


function sendMail(){
$('#enviarMail').hide('slow');
$('.preloader').fadeIn('slow');
window.location.hash="";
var mail=1;
    cadena="mail=" + mail;
	$.ajax({ 
		type:"POST",
		url:"controllers/enviar.php?action=sendMail",
		data:cadena,
		success:function(r){
            $('.preloader').fadeOut();
            console.log(r);
            console.log(r.correos.length);
            $('#mdAlertTitle').html("&nbsp;Difisión enviada");
            $('#mdAlertContent').html(r.mensaje+" a "+r.correos.length+" correos");
            $('#mdAlert').modal();
			if(r==1){
                // $('#tabla').load('../../controllers/enviar.php');
                // alertify.success("agregado con exito :)");
                alert("enviado");
                console.log(r);
			}else{
                // alertify.error("Fallo el servidor :(");
			}
        },
        error:function(r){
            console.log(r);
        }
	});

}

$(document).ready(function () {
    if(window.location.hash=="#importado"){
        $('#mdAlertTitle').html("&nbsp; Importancion completada");
        $('#mdAlertContent').html("Sus datos fueron cargados con exito");
        $('#mdAlert').modal();
        
    }
    else if(window.location.hash=="#error"){
        $('#mdAlertTitle').html("&nbsp; Error");
        $('#mdAlertContent').html("Al parecer hubo un error o archivo debe ser en formato de excel");
        $('#mdAlert').modal();
        $('#btnAlertmd').click(function(){
            $('#content').load('view/forms-upload');
        });
    }
    else if(window.location.hash=="#errorAr"){
        $('#mdAlertTitle').html("&nbsp; Error");
        $('#mdAlertContent').html("Al parecer no se cargo un archivo antes de subirlo");
        $('#mdAlert').modal();
        $('#content').load('view/forms-upload');
        $('#btnAlertmd').click(function(){
            $('#content').load('view/forms-upload');
        });
    }
    else if(window.location.hash=="#errorEnvio"){
        $('#mdAlertTitle').html("&nbsp; Error");
        $('#mdAlertContent').html("Al parecer hubo un error y No se enviaron los correos");
        $('#mdAlert').modal();
        $('#btnAlertmd').click(function(){
            $('#content').load('view/forms-upload');
        });
    }
});