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
        alert("Sus datos fueron cargados con exito");
    }
    else if(window.location.hash=="#error"){
        alert("El archivo debe ser en formato de excel")
    }
    else if(window.location.hash=="#enviado"){
        alert("Los correos han sido enviados con exito")
    }
    else if(window.location.hash=="#errorEnvio"){
        alert("No se enviaron los correos")
    }
});