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
    nextItem = document.getElementById("personas-comunion").childElementCount;

		function addNewInputToTheForm() {
			var newItemHtml = template.replace(/::num/g, nextItem++);
			botoesWrap.append(newItemHtml);
		}
    
        function RemoveInputToTheForm() {
            if(document.getElementById("personas-comunion").childElementCount>1){
                document.getElementById("personas-comunion")
                    .removeChild(document.getElementById("personas-comunion").lastElementChild);
                nextItem--;
            }
		}

		botaoAdd.on('click', function(e) {
			e.preventDefault();
			addNewInputToTheForm();
		});
    
    var botonRemove = $("#remove-comunion-boton");
    botonRemove.on('click', function(e){
        e.preventDefault();
        RemoveInputToTheForm();
    });
});

function fillModal (content1, content2, content3) {
       document.getElementById('p_modalContent1').innerHTML = content1;
       document.getElementById('p_modalContent2').innerHTML = content2;
       document.getElementById('p_modalContent3').innerHTML = content3;
    }