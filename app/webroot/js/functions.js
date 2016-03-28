$(document).ready(function() {
    $('#buscador').submit(function(){
            document.location = baseDir + controller + '/buscar?q=' + $('#buscar').val();
        return false;
    });

    $('.cancel').click(function() {
        if(confirm('¿Está seguro que desea cancelar la operación?')) {
            document.location = $(this).attr('data-location');
        }
    });
});