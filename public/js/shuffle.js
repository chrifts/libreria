var options = { valueNames: [ 'name', 'born', 'title' ] };
var userList = new List('libros', options);
function countBooks() {
    var text = 'libros';
    $('.list').children().length == 1 ? text = 'libro' : 'libros'
    $('#count_books').text($('.list').children().length + ' ' + text);
}
$('.search').on('keyup', function(){
    countBooks()
})
var updateList = function(){
    
    var values_date = $(".date_s").val();
    var values_name = $(".name_s").val();
    if(values_date.length == 0) {
        values_date = null;
    }
    if(values_name.length == 0) {
        values_name = null;
    }
    userList.filter(function(item) {
        // console.log(item.values().name);
        // console.log(values_name);
        return (_(values_date).contains(item.values().born) || !values_date) 
            && (_(values_name).some( r => JSON.parse(item.values().name).includes(r)) || !values_name)
    });
    countBooks()

}
                               
$(function(){
    updateList();
    $(".date_s").change(updateList);
    $(".name_s").change(updateList);
    $(".title").change(updateList);
    var all_born = [];
    var all_name = [];
    _(userList.items).each(function(item){
        all_born.push(item.values().born)
        all_name.push(item.values().name)  
    });
    _(all_born).uniq().each(function(item){
        $(".date_s").append('<option value="'+item+'">'+ item +'</option>')
    });
    $('#select1').multipleSelect({
        filter: true,
        filterPlaceholder: 'Ingrese un Autor',
        animate: 'fade'
    })
    $('#select2').multipleSelect({
        filter: true,
        filterPlaceholder: 'Ingrese un tema',
        animate: 'fade'
    })
    $('.date_s').find('.ms-select-all label span').text('Seleccionar todo')
    $('.name_s').find('.ms-select-all label span').text('Seleccionar todo')
    
});

function sortList(type, el) {
    $('.btn-group-toggle button').removeClass('active');
    $(el).addClass('active');
    var list, i, switching, b, shouldSwitch;
    list = document.getElementById("id01");
    switching = true;
    while (switching) {
      switching = false;
      b = $('#id01 .picture-item');
      for (i = 0; i < (b.length - 1); i++) {
        shouldSwitch = false;
        if(type == 'date') {
            if (new Date(b[i].getAttribute("order")) < new Date(b[i + 1].getAttribute("order"))) {
                shouldSwitch = true;
                break;
            }
        }

        if(type == 'title') {
            if (b[i].getAttribute("title").toLowerCase() > b[i + 1].getAttribute("title").toLowerCase()) {
                shouldSwitch = true;
                break;
            }
        }
        
      }
      if (shouldSwitch) {
        b[i].parentNode.insertBefore(b[i + 1], b[i]);
        switching = true;       
      }
    }
  }

    
