$(document).ready(function() {

	$('.certificado').click(function() {
		var motivo = prompt('Se pide este certificado para fines:', '');
		
		if(motivo != null) {
			var id = $(this).attr('data-id');
			window.open(baseDir + 'matrimonios/certificado/' + id + '/' + motivo, '_blank').focus();
		}
	});

    $('#datetimepicker').datetimepicker({
        lang: 'es',
        timepicker: false,
        format: 'd/m/Y'
    });
    
    $('#datetimepicker2').datetimepicker({
        lang: 'es',
        timepicker: false,
        format: 'd/m/Y'
    });

    $('#datetimepicker3').datetimepicker({
        lang: 'es',
        timepicker: false,
        format: 'd/m/Y'
    });

    $('.datetimepicker4').datetimepicker({
        lang: 'es',
        timepicker: false,
        format: 'd/m/Y'
    });
    
    $('.datetimepicker5').datetimepicker({
        lang: 'es',
        format: 'd/m/Y h:i a',
        pick12HourFormat: true  
    });

    $('#MatrimonioEstadoNacimientoNovio').change(function(){
            $.ajax({
                    url: baseDir + '/bautizos/ciudades/' + $(this).val(),
                    beforeSend: function() {
                            $('#loading').show();
                    },
                    success: function(html) {
                            $('#MatrimonioCiudadNacimientoNovio').html(html);

                            if($('#MatrimonioEstadoNacimientoNovio').val() == 'Bolívar')
                                    $('#MatrimonioCiudadNacimientoNovio').val('Puerto Ordaz');
                    },
                    error: function() {
                            alert('Ha ocurrido un error cargando las ciudades, por favor intente nuevamente.');
                    },
                    complete: function() {
                            $("#loading").hide();
                    }
            });
    });
    
    $('#MatrimonioEstadoActualNovio').change(function(){
            $.ajax({
                    url: baseDir + '/bautizos/ciudades/' + $(this).val(),
                    beforeSend: function() {
                            $('#loading_actual').show();
                    },
                    success: function(html) {
                            $('#MatrimonioCiudadActualNovio').html(html);

                            if($('#MatrimonioEstadoActualNovio').val() == 'Bolívar')
                                    $('#MatrimonioCiudadActualNovio').val('Puerto Ordaz');
                    },
                    error: function() {
                            alert('Ha ocurrido un error cargando las ciudades, por favor intente nuevamente.');
                    },
                    complete: function() {
                            $("#loading_actual").hide();
                    }
            });
    });

    $('#MatrimonioPaisNacimientoNovio').change(function(){
            if($(this).val() == 'Venezuela') {
                    $('#MatrimonioEstadoNacimientoNovio2').parent().hide();
                    $('#MatrimonioCiudadNacimientoNovio2').parent().hide();
                    $('#MatrimonioEstadoNacimientoNovio').parent().show();
                    $('#MatrimonioCiudadNacimientoNovio').parent().show();
            } else {
                    $('#MatrimonioEstadoNacimientoNovio2').parent().show();
                    $('#MatrimonioCiudadNacimientoNovio2').parent().show();
                    $('#MatrimonioEstadoNacimientoNovio').parent().hide();
                    $('#MatrimonioCiudadNacimientoNovio').parent().hide();
            }
    });    
    
    $('#MatrimonioPaisActualNovio').change(function(){
            if($(this).val() == 'Venezuela') {
                    $('#MatrimonioEstadoActualNovio2').parent().hide();
                    $('#MatrimonioCiudadActualNovio2').parent().hide();
                    $('#MatrimonioEstadoActualNovio').parent().show();
                    $('#MatrimonioCiudadActualNovio').parent().show();
            } else {
                    $('#MatrimonioEstadoActualNovio2').parent().show();
                    $('#MatrimonioCiudadActualNovio2').parent().show();
                    $('#MatrimonioEstadoActualNovio').parent().hide();
                    $('#MatrimonioCiudadActualNovio').parent().hide();
            }
    });    

    // Eventos de la novia
    $('#MatrimonioEstadoNacimientoNovia').change(function(){
            $.ajax({
                    url: baseDir + '/bautizos/ciudades/' + $(this).val(),
                    beforeSend: function() {
                            $('#loading_novia').show();
                    },
                    success: function(html) {
                            $('#MatrimonioCiudadNacimientoNovia').html(html);

                            if($('#MatrimonioEstadoNacimientoNovia').val() == 'Bolívar')
                                    $('#MatrimonioCiudadNacimientoNovia').val('Puerto Ordaz');
                    },
                    error: function() {
                            alert('Ha ocurrido un error cargando las ciudades, por favor intente nuevamente.');
                    },
                    complete: function() {
                            $("#loading_novia").hide();
                    }
            });
    });
    
    $('#MatrimonioEstadoActualNovia').change(function(){
            $.ajax({
                    url: baseDir + '/bautizos/ciudades/' + $(this).val(),
                    beforeSend: function() {
                            $('#loading_actual_novia').show();
                    },
                    success: function(html) {
                            $('#MatrimonioCiudadActualNovia').html(html);

                            if($('#MatrimonioEstadoActualNovia').val() == 'Bolívar')
                                    $('#MatrimonioCiudadActualNovia').val('Puerto Ordaz');
                    },
                    error: function() {
                            alert('Ha ocurrido un error cargando las ciudades, por favor intente nuevamente.');
                    },
                    complete: function() {
                            $("#loading_actual_novia").hide();
                    }
            });
    });

    $('#MatrimonioPaisNacimientoNovia').change(function(){
            if($(this).val() == 'Venezuela') {
                    $('#MatrimonioEstadoNacimientoNovia2').parent().hide();
                    $('#MatrimonioCiudadNacimientoNovia2').parent().hide();
                    $('#MatrimonioEstadoNacimientoNovia').parent().show();
                    $('#MatrimonioCiudadNacimientoNovia').parent().show();
            } else {
                    $('#MatrimonioEstadoNacimientoNovia2').parent().show();
                    $('#MatrimonioCiudadNacimientoNovia2').parent().show();
                    $('#MatrimonioEstadoNacimientoNovia').parent().hide();
                    $('#MatrimonioCiudadNacimientoNovia').parent().hide();
            }
    });    
    
    $('#MatrimonioPaisActualNovia').change(function(){
            if($(this).val() == 'Venezuela') {
                    $('#MatrimonioEstadoActualNovia2').parent().hide();
                    $('#MatrimonioCiudadActualNovia2').parent().hide();
                    $('#MatrimonioEstadoActualNovia').parent().show();
                    $('#MatrimonioCiudadActualNovia').parent().show();
            } else {
                    $('#MatrimonioEstadoActualNovia2').parent().show();
                    $('#MatrimonioCiudadActualNovia2').parent().show();
                    $('#MatrimonioEstadoActualNovia').parent().hide();
                    $('#MatrimonioCiudadActualNovia').parent().hide();
            }
    });


    $('#loading').hide();
    $('#MatrimonioEstadoNacimientoNovio2').parent().hide();
    $('#MatrimonioCiudadNacimientoNovio2').parent().hide();
    
    $('#loading_actual').hide();
    $('#MatrimonioEstadoActualNovio2').parent().hide();
    $('#MatrimonioCiudadActualNovio2').parent().hide();
    
    $('#loading_novia').hide();
    $('#MatrimonioEstadoNacimientoNovia2').parent().hide();
    $('#MatrimonioCiudadNacimientoNovia2').parent().hide();
    
    $('#loading_actual_novia').hide();
    $('#MatrimonioEstadoActualNovia2').parent().hide();
    $('#MatrimonioCiudadActualNovia2').parent().hide();

    if($('#MatrimonioPaisNacimientoNovio').val() != 'Venezuela')
            $('#MatrimonioPaisNacimientoNovio').trigger('change');
        
    if($('#MatrimonioPaisActualNovio').val() != 'Venezuela')
            $('#MatrimonioPaisActualNovio').trigger('change');
        
    if($('#MatrimonioPaisNacimientoNovia').val() != 'Venezuela')
            $('#MatrimonioPaisNacimientoNovia').trigger('change');
        
    if($('#MatrimonioPaisActualNovia').val() != 'Venezuela')
            $('#MatrimonioPaisActualNovia').trigger('change');
});