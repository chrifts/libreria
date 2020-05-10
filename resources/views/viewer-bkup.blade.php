{{-- <script src="/js/pdf.js"></script> --}}
<script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
<script src="{{env('BASE_URL')}}/js/crypto-js.js"></script>
<script src="{{env('BASE_URL')}}/js/enc.js"></script>
<div id='loading'>CARGANDO</div>
<div id='div-canvas' style="display: none">
    <div class="d-block w-100">
        <button onClick='loadPage(window.page > 1 ? window.page = window.page -1 : window.page = 1)' id="prev">Previous</button>
        <button onClick='loadPage(window.page > window.maxPages ?  window.page = window.maxPages : window.page = window.page +1)' id="next">Next</button>
        {{-- <input type="text" id='gotopage' placeholder="Ir a pagina" value="">
        <button id="goto">Ir</button> --}}
        &nbsp; &nbsp;
        <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
    </div>

    <canvas oncontextmenu="return false;" id="the-canvas" class="shadow p-3 mb-5 bg-white rounded border"></canvas>
</div>
<script>
    var loadingTask;
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: '{{env("BASE_URL")}}/pdf/{{$id_pdf}}',
        success: function(data){

            var _0x14ff=['remove','data'];(function(_0x574824,_0x14fff9){var _0x366d7b=function(_0x5201c2){while(--_0x5201c2){_0x574824['push'](_0x574824['shift']());}};_0x366d7b(++_0x14fff9);}(_0x14ff,0x1d2));var _0x366d=function(_0x574824,_0x14fff9){_0x574824=_0x574824-0x0;var _0x366d7b=_0x14ff[_0x574824];return _0x366d7b;};function gtkx(){var _0xd6b094=$('#k')['attr'](_0x366d('0x1'));$('#k')[_0x366d('0x0')]();return _0xd6b094;}
            var _0x4a8c=['#the-canvas','contextmenu'];(function(_0x3c39b2,_0x4a8c74){var _0x402ec4=function(_0x370bcb){while(--_0x370bcb){_0x3c39b2['push'](_0x3c39b2['shift']());}};_0x402ec4(++_0x4a8c74);}(_0x4a8c,0x161));var _0x402e=function(_0x3c39b2,_0x4a8c74){_0x3c39b2=_0x3c39b2-0x0;var _0x402ec4=_0x4a8c[_0x3c39b2];return _0x402ec4;};$(_0x402e('0x1'))['on'](_0x402e('0x0'),function(){return![];});
            let encryption = new Encryption();
            // var thdt = JSON.parse(data);
            var dkp = encryption.decrypt(data.name, data.state);
            $('#goto').on('click', function(){
                var page = $('#gotopage').val();
                console.log(page, 'asdad');
                window.page = page;
                loadPage(window.page);
            })
            window.page = 1;
            var pdfjsLib = window['pdfjs-dist/build/pdf'];
            pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';
            loadingTask = pdfjsLib.getDocument({data: atob(dkp)});
            loadPage(window.page);
        },
    });

    function loadPage(pageX) {
        loadingTask.promise.then(function(pdf) {
            window.maxPages = pdf.numPages;
            $('#loading').hide();

            $('#div-canvas').show();

            $('#page_count').text(pdf.numPages)
            $('#page_num').text(window.page)
            // Fetch the first page
            if(pageX < 0) {
                pageX = 1;
                window.page = 1
            }
            if(pageX > pdf.numPages) {
                pageX = pdf.numPages;
                window.page = pdf.numPages;
            }
            var pageNumber = pageX;

            pdf.getPage(pageNumber).then(function(page) {
                console.log('Page loaded');

                var scale = 1.5;
                var viewport = page.getViewport({scale: scale});

                // Prepare canvas using PDF page dimensions
                var canvas = document.getElementById('the-canvas');
                var context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                // Render PDF page into canvas context
                var renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };
                var renderTask = page.render(renderContext);
                renderTask.promise.then(function () {
                    console.log('Page rendered');
                });
            });
        }, function (reason) {
            // PDF loading error
            console.error(reason);
        });
    }


</script>
