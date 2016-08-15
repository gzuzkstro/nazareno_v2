$(document).ready(function(){
    
    // Added in version 2
    
    $('.date_time_picker').datetimepicker({
        lang: 'es',
        timepicker: false,
        format: 'd/m/Y'
    });
    
    /*
    $('#datetimepicker_b1').datetimepicker({
        lang: 'es',
        timepicker: false,
        format: 'd/m/Y'
    });
    
    $('#datetimepicker_b2').datetimepicker({
        lang: 'es',
        timepicker: false,
        format: 'd/m/Y'
    });
    
    // -------------
    $('#datetimepicker1').datetimepicker({
        lang: 'es',
        timepicker: false,
        format: 'd/m/Y'
    });
    
    $('#datetimepicker2').datetimepicker({
        lang: 'es',
        timepicker: false,
        format: 'd/m/Y'
    });*/

	$('#BautizoCiudadNacimiento').change(function(){
		if($(this).val() == 'Otra') {
            $('#BautizoCiudadNacimientoOtra').parent().show();
		} else {
			$('#BautizoCiudadNacimientoOtra').parent().hide();
		}
	});

    $('#BautizoEstadoNacimiento').change(function(){
            $.ajax({
                    url: baseDir + '/bautizos/ciudades/' + $(this).val(),
                    beforeSend: function() {
                            $('#loading').show();
                    },
                    success: function(html) {
                            $('#BautizoCiudadNacimiento').html(html);

                            if($('#BautizoEstadoNacimiento').val() == 'Bolívar')
                                    $('#BautizoCiudadNacimiento').val('Puerto Ordaz');
                    },
                    error: function() {
                            alert('Ha ocurrido un error cargando las ciudades, por favor intente nuevamente.');
                    },
                    complete: function() {
                            $("#loading").hide();
                    }
            });
    });

    $('#BautizoPaisNacimiento').change(function(){
            if($(this).val() == 'Venezuela') {
                    $('#BautizoEstadoNacimiento2').parent().hide();
                    $('#BautizoCiudadNacimiento2').parent().hide();
                    $('#BautizoEstadoNacimiento').parent().show();
                    $('#BautizoCiudadNacimiento').parent().show();

					if($('#BautizoCiudadNacimiento').val() == 'Otra')
						$('#BautizoCiudadNacimientoOtra').parent().show();
            } else {
                    $('#BautizoEstadoNacimiento2').parent().show();
                    $('#BautizoCiudadNacimiento2').parent().show();
                    $('#BautizoEstadoNacimiento').parent().hide();
                    $('#BautizoCiudadNacimiento').parent().hide();
					$('#BautizoCiudadNacimientoOtra').parent().hide();
            }
    });

    $('#loading').hide();
    $('#BautizoEstadoNacimiento2').parent().hide();
    $('#BautizoCiudadNacimiento2').parent().hide();
	$('#BautizoCiudadNacimientoOtra').parent().hide();

    if($('#BautizoPaisNacimiento').val() != 'Venezuela')
		$('#BautizoPaisNacimiento').trigger('change');

	if($('#BautizoCiudadNacimiento').val() == 'Otra') {
		$('#BautizoCiudadNacimiento').trigger('change');
	}
    
});

   function fillModal (content1, content2, content3) {
       document.getElementById('p_modalContent1').innerHTML = content1;
       document.getElementById('p_modalContent2').innerHTML = content2;
       document.getElementById('p_modalContent3').innerHTML = content3;
   }