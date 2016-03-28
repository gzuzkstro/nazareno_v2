$(document).ready(function() {
    $('#desde').datetimepicker({
        lang: 'es',
        timepicker: false,
        format: 'd/m/Y'
    });
    $('#hasta').datetimepicker({
        lang: 'es',
        timepicker: false,
        format: 'd/m/Y'
    });
    
    $('#desde').prop('disabled', true);
    $('#hasta').prop('disabled', true);
    
    function cambiarConsulta() {
        if($('#del').prop('checked')) { 
            $('#desde').prop('disabled', true);
            $('#hasta').prop('disabled', true);
            $('#delselect').prop('disabled', false);
        } else {
            $('#desde').prop('disabled', false);
            $('#hasta').prop('disabled', false);
            $('#delselect').prop('disabled', true);
        }
    }
    
    $('#del').change(function() {
        cambiarConsulta();
    });
    
    $('#rango').change(function() {
        cambiarConsulta();
    });
    
    $('#consultar-button').click(function(){
        if($('#del').prop('checked')) {
            window.open('estadisticas/del/' + $('#delselect').val());
        } else {
            var desde = $('#desde').val().replace(/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/g, '$2-$1-$3');
            var hasta = $('#hasta').val().replace(/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/g, '$2-$1-$3');
            
            var desde_guion = $('#desde').val().replace(/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/g, '$1-$2-$3');
            var hasta_guion = $('#hasta').val().replace(/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/g, '$1-$2-$3');
            
            if(new Date(desde).getTime() <= new Date(hasta).getTime()) {
                window.open('estadisticas/rango/' + desde_guion + '/' + hasta_guion, '_blank').focus();
            } else {
                alert('La fecha desde debe ser menor o igual a la fecha hasta');   
            }
        }
    }); 
});