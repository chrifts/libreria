<style>
    .btn-back{
        background-color: rgba(0, 0, 0, 0);
        position: fixed;
        left: 0;
        top: 0;
        width: 50%;
        height: 100%;
        z-index: 2;
    }
    .btn-next{
        background-color: rgba(0, 0, 0, 0);
        position: fixed;
        right: 0;
        top: 0;
        width: 50%;
        height: 100%;
        z-index: 2;
    }
    .btn-home{
        background-color: #ececec;
        position: relative;
        right: 0;
        top: 0;
        width: 100%;
        z-index: 4;
        height: 100px;
        text-align: center;
        color: black;
    }
</style>
<div class="row mb-3">
    <a href="{{env('BASE_URL')}}/" class="btn-home shadow-sm rounded">Home</a>
</div>
{{-- <a href="?pages={{isset($_GET['pages']) ? $_GET['pages'] - 6 : 1}}" class="btn-back"></a>
<a href="?pages={{isset($_GET['pages']) ? $_GET['pages'] + 6 : 7}}" class="btn-next"></a> --}}
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6 mb-2" id='div_images' >
        <object width='100%' height='600px' :data='' id='obj' type='application/pdf'></object>
    </div>
    <div class="col-sm-3"></div>
    <a href="{{env('BASE_URL')}}/" class="btn-home shadow-sm rounded"> Home</a>
</div>

<script>


$.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        xhrFields: { responseType: 'blob' },
        type: "GET",
        url: '/test4.pdf',
        success: function(data){
            console.log(data);
            var urlPdf = URL.createObjectURL(data)

            // data.forEach(el => {
            //     var img = $('<img />', {
            //         class: 'w-100 mb-1 shadow',
            //         src:  'data:image/png;base64,'+el,
            //     });
            //     //img.appendTo($('#div_images'));

            // });
            // var src = 'data:image/png;base64,'+data
            $('#obj').attr('data', urlPdf)
        },
    });

$(window).bind('keydown', function(event) {
    if (event.ctrlKey || event.metaKey) {
        if(String.fromCharCode(event.which).toLowerCase() == 'c' || String.fromCharCode(event.which).toLowerCase() == 'f' || String.fromCharCode(event.which).toLowerCase() == 'r') {
            event.preventDefault();
        } else {
            event.preventDefault();
        }
    }
});
$('html').contextmenu(function() {
    return false;
})
$('img').on('dragstart', function(event) { event.preventDefault(); });

</script>
