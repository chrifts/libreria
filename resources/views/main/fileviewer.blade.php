@extends('layouts.app')

@section('content')
{{-- {{dd($pdf)}} --}}

    <iframe id='viewer' style='width: 100%; height: 50vh' src="http://127.0.0.1:8000/pdf#toolbar=0"/> 

<script>

    var myFrame = document.getElementById('viewer');

    myFrame.window.eval('document.addEventListener("contextmenu", function (e) {e.preventDefault();}, false)');


</script>

@endsection