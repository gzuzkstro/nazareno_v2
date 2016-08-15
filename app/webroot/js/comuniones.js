$(document).ready(function() {
    $('.date_time_picker').datetimepicker({
        lang: 'es',
        timepicker: false,
        format: 'd/m/Y'
    });
  
  $('.certificado').click(function() {
    var motivo = prompt('Se pide este certificado para fines:', '');

    if(motivo != null) {
      var id = $(this).attr('data-id');
      window.open(baseDir + 'comuniones/certificado/' + id + '/' + motivo, '_blank').focus();
    }
  });
    
    
var botaoAdd = $('#add-comunion-boton'),
    botoesWrap = $('#personas-comunion'),
    template = $.trim($('#add-comunion').html()),
    nextItem = 1;

		function addNewInputToTheForm() {
			var newItemHtml = template.replace(/::num/g, nextItem++);
			botoesWrap.append(newItemHtml);
		}

		botaoAdd.on('click', function(e) {
			e.preventDefault();
			addNewInputToTheForm();
		});
});

