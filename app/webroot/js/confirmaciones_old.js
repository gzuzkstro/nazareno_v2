$(document).ready(function() {
    $('#datetimepicker').datetimepicker({
        lang: 'es',
        timepicker: false,
        format: 'd/m/Y'
    });
  
  $('.certificado').click(function() {
    var motivo = prompt('Se pide este certificado para fines:', '');

    if(motivo != null) {
      var id = $(this).attr('data-id');
      window.open(baseDir + 'confirmaciones/certificado/' + id + '/' + motivo, '_blank').focus();
    }
  });
});