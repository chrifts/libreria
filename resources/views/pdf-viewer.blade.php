<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>'Hello, world!' example</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Seminario') }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js" integrity="sha256-/H4YS+7aYb9kJ5OKhFYPUjSJdrtV6AeyJOtTkw6X72o=" crossorigin="anonymous"></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <script src="{{env("BASE_URL")}}/generic/build/pdf.js"></script>
    <script src="https://unpkg.com/interactjs/dist/interact.min.js"></script>
</head>
<style>
    .no-btn {
        cursor: default !important;
    }
    .pd145 {
        padding-top: 180px !important;
    }
</style>

<body>
 <div class="container-fluid">
    <div class="progress" id='div_progress'>
        <div class="progress-bar" role="progressbar" aria-valuenow="0"
        aria-valuemin="0" aria-valuemax="100" style="width:0%" id='thebar'>
            <span id='percent'></span>
        </div>
    </div>
    <span id='Fsize'></span>
    <div class="row w-100 shadow p-1" style="position: fixed; background-color: rgb(255, 255, 255); z-index: 20;" >
        <div class="col-md-12" id='toolbar' style="display: none !important">
            <div>
                <a href="{{env('BASE_URL')}}/" class="btn btn-warning">Home</a>
                <label class="h5">Escala:</label>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button class='btn btn-secondary' id='s50'>0.5</button>
                    <button class='btn btn-secondary' id='s75'>0.75</button>
                    <button class='btn btn-secondary' id='s100' selected>1.0</button>
                    <button class='btn btn-secondary' id='s200'>2.0</button>
                </div>
                <label class="h5">Rotar:</label>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button class='btn btn-secondary' id='menos90'>-90</button>
                    <button class='btn btn-secondary' id='mas90'>+90</button>
                </div>

                <div class="btn-group" role="group" aria-label="Basic example">
                    <button for="pages" class="btn btn-secondary no-btn" disabled>Página</button>
                    <input type="number" id='pages' min='1' max='{{$theBook->total_pages}}' value="" style="width: 100px">
                    <button class='btn btn-secondary' id='goto'>Ir</button>
                </div>
                
                <div class="btn-group " role="group" aria-label="Basic example" id='maxPages' style="display: none;">
                    <p class="alert alert-danger m-0" style="padding: 5px !important">Rango de páginas: 1 - {{$theBook->total_pages}}</p>
                </div>

                <div class="float-right" role="group" aria-label="Basic example">
                    @if($isLarge)
                        <button id='next_large' class="btn btn-primary">Siguiente</button>
                        <button id='load_btn' class="btn btn-secondary" style="display: none" disabled>Aguarde</button>
                    @else
                        <button id='next' class="btn btn-primary">Siguiente</button>
                    @endif

                </div>

            </div>
        </div>
    </div>
    <div style="padding-top: 50px;" id='pd-book'></div>
    <div class="mx-auto border shadow" id='bookCont' style="width: 100%">
        <div id='holder' class="w-100" style="">
            <canvas id="the-canvas" class="w-100" style="display: none"></canvas>
        </div>
    </div>
    <div class="row">

    </div>
 </div>


<script id="script">
    var current_r = 0;
    var current_w = 100;

    $('#mas90').on('click', function(){
        current_r = current_r + 90
        $('#pd-book').toggleClass('pd145')
        $('#bookCont').attr('style', 'width: '+current_w+'%; transform: rotate('+current_r +'deg)')
    })
    $('#menos90').on('click', function(){
        current_r = current_r - 90
        $('#pd-book').toggleClass('pd145')
        $('#bookCont').attr('style', 'width: '+current_w+'%; transform: rotate('+current_r +'deg)')
    })

    $('#s50').on('click', function(){
        current_w = 50;
        $('#bookCont').attr('style', 'width: '+current_w+'%; transform: rotate('+current_r +'deg)')
    })

    $('#s75').on('click', function(){
        current_w = 75;
        $('#bookCont').attr('style', 'width: '+current_w+'%; transform: rotate('+current_r +'deg)' )
    })

    $('#s100').on('click', function(){
        current_w = 100;
        $('#bookCont').attr('style', 'width: '+current_w+'%; transform: rotate('+current_r +'deg)')
    })

    $('#s200').on('click', function(){
        current_w = 200;
        $('#bookCont').attr('style', 'width: '+current_w+'%; transform: rotate('+current_r +'deg)')
    })
    var totalPages = '{{$theBook->total_pages}}'
    var isLargeFile = parseInt('{{$isLarge}}');
    isLargeFile == 1 ? window.isLargeFile = true : window.isLargeFile = false;
    var page = 1;
    
    function pageInput(page) {
        $('#pages').val(0);
        $('#pages').val(page);
    }
    pageInput(page);
  
    (function addXhrProgressEvent($) {
        var originalXhr = $.ajaxSettings.xhr;
        $.ajaxSetup({
            xhr: function() {
                var req = originalXhr(), that = this;
                if (req) {
                    if (typeof req.addEventListener == "function" && that.progress !== undefined) {
                        req.addEventListener("progress", function(evt) {
                            that.progress(evt);
                        }, false);
                    }
                    if (typeof req.upload == "object" && that.progressUpload !== undefined) {
                        req.upload.addEventListener("progress", function(evt) {
                            that.progressUpload(evt);
                        }, false);
                    }
                }
                return req;
            }
        });
    })(jQuery);

    function requestBook(page) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            xhrFields: { responseType: 'blob' },
            type: "POST",
            url: isLargeFile == 1 ? '{{env("BASE_URL")}}/get_b/{{$book}}/'+page : '{{env("BASE_URL")}}/get_b_p/{{$book}}',
            complete: function (XMLHttpRequest, textStatus) {
                setTimeout(function(){
                    $('#div_progress').hide()
                    $('#Fsize').hide()
                    $('#the-canvas').fadeIn(1000)
                    $('#toolbar').fadeIn(1000)
                }, 2000);

            },
            progress: function(evt) {
                let fileSize = evt.total;
                $('#Fsize').text('Descargando: ' + (fileSize / 1000000).toFixed(2) + ' MB. Por favor, aguarde');
                if (evt.lengthComputable) {
                    $('#percent').text(parseInt( (evt.loaded / evt.total * 100), 10) + "% Loaded")
                    if(parseInt( (evt.loaded / evt.total * 100), 10) == 100) {
                        $('#percent').text('100% Done');
                    }
                    $('#thebar').attr('style', 'width:'+parseInt( (evt.loaded / evt.total * 100), 10) + "%")
                }
                else {
                    console.log("Length not computable.");
                }
            },
            progressUpload: function(evt) {
            // See above
            },
            success: function(data){
                const file = new Blob([data], {type: 'application/pdf'});
                const fileURL = URL.createObjectURL(file);
                var _0x4168=['decrypt','{{env("ENCRYPTER_EQ")}}','{{env("SINGED")}}'];(function(_0x4d8024,_0x4168b3){var _0x59584e=function(_0x31de9b){while(--_0x31de9b){_0x4d8024['push'](_0x4d8024['shift']());}};_0x59584e(++_0x4168b3);}(_0x4168,0x1a9));var _0x5958=function(_0x4d8024,_0x4168b3){_0x4d8024=_0x4d8024-0x0;var _0x59584e=_0x4168[_0x4d8024];return _0x59584e;};var e=_0x5958('0x2');var d=CryptoJS['AES'][_0x5958('0x1')](e,_0x5958('0x0'));
                pdfjsLib.GlobalWorkerOptions.workerSrc = '{{env("BASE_URL")}}/generic/build/pdf.worker.js';
                var _0x453f=['Utf8','toString','enc'];(function(_0x42d4aa,_0x453f08){var _0x39c378=function(_0xec52da){while(--_0xec52da){_0x42d4aa['push'](_0x42d4aa['shift']());}};_0x39c378(++_0x453f08);}(_0x453f,0x17c));var _0x39c3=function(_0x42d4aa,_0x453f08){_0x42d4aa=_0x42d4aa-0x0;var _0x39c378=_0x453f[_0x42d4aa];return _0x39c378;};var x=d[_0x39c3('0x2')](CryptoJS[_0x39c3('0x0')][_0x39c3('0x1')]);
                var loadingTask = pdfjsLib.getDocument({url: fileURL, password:x}, {disableAutoFetch: true, disableStream: true});

                loadingTask.promise.then(function(pdf) {
                    
                    $('#next').on('click', function(){
                        $(window).scrollTop(0);
                        page = page + 1;
                        pageInput(page);
                        pdf.getPage(page).then(function(page) {
                            var scale = 2;
                            var viewport = page.getViewport({ scale: scale, });
                            var canvas = document.getElementById('the-canvas');
                            var context = canvas.getContext('2d');
                            canvas.height = viewport.height;
                            //canvas.width = viewport.width;
                            var renderContext = {
                                canvasContext: context,
                                viewport: viewport,
                            };
                            page.render(renderContext);
                        });
                    })
                    if(!window.isLargeFile) {
                        $('#goto').on('click', function(){
                            page = parseInt($('#pages').val());
                            
                            $(window).scrollTop(0);
                            
                            pageInput(page);
                            pdf.getPage(page).then(function(page) {
                                var scale = 2;
                                var viewport = page.getViewport({ scale: scale, });
                                var canvas = document.getElementById('the-canvas');
                                var context = canvas.getContext('2d');
                                canvas.height = viewport.height;
                                //canvas.width = viewport.width;
                                var renderContext = {
                                    canvasContext: context,
                                    viewport: viewport,
                                };
                                page.render(renderContext);
                            });
                        })
                    }
                    
                    pdf.getPage(1).then(function(page) {
                        var scale = 2;
                        var viewport = page.getViewport({ scale: scale, });
                        var canvas = document.getElementById('the-canvas');
                        var context = canvas.getContext('2d');
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;
                        var renderContext = {
                            canvasContext: context,
                            viewport: viewport,
                        };
                        page.render(renderContext);
                    });
                });


            },
        });
    }

    requestBook(page)
    if(window.isLargeFile) {
        $('#goto').on('click', function(){
            
            page = parseInt($('#pages').val());
            if(page < 1 || page > totalPages) {
                $('#maxPages').show();
                setTimeout(function(){
                    $('#maxPages').fadeOut(1000)
                }, 3000);
                return;
            }
            console.log(page);
            pageInput(page);
            $('#next_large').hide()
            $('#load_btn').show()
            $(window).scrollTop(0);
            $('#the-canvas').empty();
            requestBook(page);
            setTimeout(function(){
                $('#next_large').show()
                $('#load_btn').hide()
            }, 1500);
        })
    }  
    
    $('#next_large').on('click', function(){
        $(this).hide()
        $('#load_btn').show()
        $(window).scrollTop(0);
        $('#the-canvas').empty();
        page = page + 1
        console.log(page)
        requestBook(page);
        pageInput(page);
        setTimeout(function(){
            $('#next_large').show()
            $('#load_btn').hide()
        }, 1500);
    })

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


</body>


