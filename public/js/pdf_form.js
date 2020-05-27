$('.enviar').on('click', function(){
    $(this).hide();
    $('#loadingBook').show();
    $('.process').show();
    $('html, body').scrollTop( $(document).height() );
    if($('#row_added')) {
        $('#row_added').hide();
    }
})
$('#title').on('keyup', function(){
    var a = $(this).val();
    var b = a.replace(/[^a-z0-9]/gi,'');
    $('#identif').val(b.toLowerCase());
})
$('input[name=theFile]').change(function(ev, val) {
    $('#fileData').empty();
    Array.from(ev.target.files).forEach(file => { 
        console.log(file);
        $('#fileData').append('<span class="font-weight-bold">Archivo seleccionado: </span>')
        $('#fileData').append('<p class="mt-2"> Nombre: '+file.name+'</p>')
        if(file.size / 1000000 > 8) {
            $('#fileData').append('<p> Tamaño: '+(file.size / 1000000).toFixed(2)+' MB</p> <i class="fas fa-info-circle"></i><span> El PDF será dividido</span>')
        } else {
            $('#fileData').append('<p> Tamaño: '+(file.size / 1000000).toFixed(2)+' MB</p>')
        }
    });
    $('#fileData').show();
});
$('#togg_scan').on('click', function(){
    $('#togg_noscan').removeClass('active');
    $(this).addClass('active')
})
$('#togg_noscan').on('click', function(){
    $('#togg_scan').removeClass('active');
    $(this).addClass('active')
})
$(".select-theme").select2({
    tags: true,
    //theme: 'classic',
    placeholder: "Agregar temática",
    allowClear: false       
})
$(".select-autor").select2({
    tags: true,
    //theme: 'classic'
    placeholder: "Seleccionar Autor",
    allowClear: false  
})

$('textarea').on('keyup', function(el, val){
    var maxchar = 180
    $('#char_rest').text((maxchar - $(this).val().length) + ' caracteres restantes')
})