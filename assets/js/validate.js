(function(a){
	a.fn.validaCampos=function(b){
		a(this).on({keypress:function(a){
				var c=a.which,d=a.keyCode,e=String.fromCharCode(c).toLowerCase(),f=b;
				(-1!=f.indexOf(e)||9==d||37!=c&&37==d||39==d&&39!=c||8==d||46==d&&46!=c)&&161!=c||a.preventDefault()
				}})}
})(jQuery);

$(document).ready(function(){
    toastr.options = {
        closeButton: true,
        progressBar: true,
        showMethod: 'slideDown',
        "positionClass": "toast-top-right",
        timeOut: 4000
    };

	$('#usuario').validaCampos('abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ1234567890-_@.');
	$('#fecha_nac').validaCampos('/1234567890');
	$('#cedula').validaCampos('.1234567890');
	$('#telefono').validaCampos('-1234567890');
	
	$('#createForm').validate({ 
	rules: { 
			usuario: { 
				required: true 
			}, 

			contrasena: { 
				required: true 
			},
		}, 
		messages: {
			usuario: {
				required: "El usuario es requerido para el ingreso"
			},
			contrasena: {
				required: "La contraseña es requerida para el ingreso"
			},
		},

	errorPlacement: function(error, element) { 
		toastr.error($(error).text(), 'Error');
	}, 
	highlight: function(element) { 
		$(element).closest('.input-group').addClass('has-error');
	}, 

	unhighlight: function(element) { 
		$(element).closest('.input-group').removeClass('has-error'); 
	} 
});



});


