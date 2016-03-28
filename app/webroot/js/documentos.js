$(document).ready(function() {
	$('input.dname').hide();
	$('span.loading').hide();

	$('.delete').click(function() {
		var f = $(this).siblings()[0];
        var cat = $(this).attr('data-cat');
		f = $('#ad-' + $(f).attr('data-id')).html();

		if(confirm('¿Está seguro que desea borrar el archivo "' + f + '"?')) {
			document.location = baseDir + '/documentos/eliminar/' + cat + '/' + f;
		}
	});

    $('#cat').change(function() {
        document.location = baseDir + 'documentos/index/' + $(this).val();
    });

	$('.rename').click(function() {
		var input = '#id-' + $(this).attr('data-id');
		var a = '#ad-' + $(this).attr('data-id');

		$(a).hide();
		$(input).show();
		$(input).focus();
	});

	$('input.dname').blur(function() {
		var input = this;
		var a = $(this).siblings()[0];
		var span = $(this).siblings()[1];
        var cat = $(this).attr('data-cat');

		if($(input).val() != $(a).html()) {
			$.ajax({
				url: baseDir + '/documentos/rename/' + cat,
				type: 'POST',
				data: { old: $(a).html(), new: $(input).val() },
				beforeSend: function() {
					$(input).hide();
					$(span).show();
				},
				success: function(html) {
					$(a).html(html);
					$(a).attr('href', baseDir + 'documents/' + cat + '/' + html);
				},
				error: function() {
					alert('Ocurrió un error inesperado renombrando el archivo, por favor vuelva a intentarlo');
				},
				complete: function() {
					$(input).hide();
					$(span).hide();
					$(a).show();
				}
			});
		} else {
			$(input).hide();
			$(a).show();
		}
	});

	$('input.dname').keydown(function(event) {
		if(event.which == 13)
			$(this).trigger('blur');
	});

        $('#fdocumento').change(function(){
            var size = document.getElementById('fdocumento').files[0].size;
            var name = document.getElementById('fdocumento').files[0].name;
            var MAX_SIZE = 5; // Megabytes (MB)
            var valid_ext = 'csv|xls|xlsx|doc|docx|pdf|jpg|png|gif|bmp|txt';
            var regex = new RegExp('\.(' + valid_ext + ')$', 'i');
            
            if(!regex.test(name)) {
                alert('El tipo del archivo no es válido, solo le aceptan los siguientes tipos: ' + valid_ext);
                $(this).val('');
            } else if(size > (MAX_SIZE * 1048576)) {
                alert('El archivo debe pesar máximo ' + MAX_SIZE + ' MB');
                $(this).val('');
            } else {
                $('#uploadDocument').submit();
            }
        });
});